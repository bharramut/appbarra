<?php
/**
 * ****************************************************
 * @Copyright (c) 2014, Spell Master.
 * ****************************************************
 * @Class: "PDO" Faz modificações de dados no banco.
 * @Param ($table) : Tabela para modificar.
 * @Param ($column) : Array com valores para modificar.
 * @Param ($fields) : Onde deve ser modificado.
 * @Param ($statements) : Valor do $fields.
 * ****************************************************
 **/

class Update extends Connect {
    /** @Attr: Armazena a tabela **/
    private $updateTable;
    /** @Attr: Armazena a coluna **/
    private $updateColumn;
    /** @Attr: Armazena os campos **/
    private $updateFields;
    /** @Attr: Armazena os valores **/
    private $updateValues;
    /** @Attr: Armazena a query **/
    private $updateSyntax;
    /** @Attr: Armazena a conexão **/
    private $updateConn;
    /** @Attr: Armazena o erro para personalizar a saída **/
    public $updateError;

    /** ************************************************
     * @Method: Recebe os dados para modificar.
     * @Param ($table) : Tabela para modificar.
     * @Param ($column) : Array com valores para modificar.
     * @Param ($fields) : Onde deve ser modificado.
     * @Param ($statements) : Valor do $fields.
     * *************************************************/
    public function updateQuery($table, array $column, $fields, $statements) {
        $this->updateTable = (string) $table;
        $this->updateColumn = $column;
        $this->updateFields = (string) $fields;

        parse_str($statements, $this->updateValues);
        $this->updateConstruct();
        $this->updateExecute();
    }

    /** ************************************************
     * @Method: Altera a query de forma a poder executar
     * novamente sem a necessidade de reiniciar a classe.
     * Ideal para ser usado com Stored Procedures, basta
     * que re-escreva os valores.
     * @Example: $statements = id={$id}&...
     * *************************************************/
    public function updateChange($statements) {
        parse_str($statements, $this->updateValues);
        $this->updateConstruct();
        $this->updateExecute();
    }

    /** ************************************************
     * @Method: Retorna se foram modificados e quantos
     * campos foram modificados.
     * *************************************************/
    public function updateCount() {
        return $this->updateSyntax->rowCount();
    }

    /** ************************************************
     * @Method: Constroi a Syntax da query 
     * *************************************************/
    private function updateConstruct() {
        foreach ($this->updateColumn as $Key => $Value) {
            $setKey[] = $Key . ' = :' . $Key;
        }
        $Value = array();
        $setKey = implode(', ', $setKey);
        $this->updateSyntax = "UPDATE {$this->updateTable} SET {$setKey} WHERE {$this->updateFields}";
    }
    
    /** ************************************************
     * @Method: Inicia a conexão e faz o
     * Prepare Statements.
     * *************************************************/
    private function updateConnect() {
        $this->updateConn = parent::callConnect();
        $this->updateSyntax = $this->updateConn->prepare($this->updateSyntax);
    }

    /** ************************************************
     * @Method: Executa os métodos e obtem os
     * resultados.
     * @Return: (EXCEPTION) TRUE or FALSE
     * *************************************************/
    private function updateExecute() {
        $this->updateConnect();
        try {
            $this->updateSyntax->execute(array_merge($this->updateColumn, $this->updateValues));
        } catch (PDOException $error) {
            $this->updateError = "Erro ao alterar dados: {$error->getMessage()} {$error->getCode()}";
        }
    }
}
