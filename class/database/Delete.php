<?php
/**
 * ****************************************************
 * @Copyright (c) 2014, Spell Master.
 * ****************************************************
 * @Class: "PDO" Apaga dados no banco.
 * @Param ($table) : Tabela para buscar.
 * @Param ($fields) : Campos da tabela.
 * @Param ($statements) : Valor a ser apagado.
 * ****************************************************
 **/

class Delete extends Connect {
    /** @Attr: Armazena a tabela **/
    private $deleteTable;
    /** @Attr: Armazena os campos **/
    private $deleteFields;
    /** @Attr: Armazena os valores **/
    private $deleteValues;
    /** @Attr: Armazena a query **/
    private $deleteSyntax;
    /** @Attr: Armazena a conexão **/
    private $deleteConn;
    /** @Attr: Armazena os dados **/
    private $deleteData;
    /** @Attr: Armazena o erro para personalizar a saída **/
    public $deleteError;

    /** ************************************************
     * @Method: Recebe os dados para apagar.
     * @Param ($table) : Tabela para buscar.
     * @Param ($fields) : Campos da tabela.
     * @Param ($statements) : Valor a ser apagado.
     * *************************************************/
    public function deleteQuery($table, $fields, $statements) {
        $this->deleteTable = (string) $table;
        $this->deleteFields = (string) $fields;
        parse_str($statements, $this->deleteValues);
        $this->deleteConstruct();
        $this->deleteExecute();
    }

    /** ************************************************
     * @Method: Altera a query de forma a poder executar
     * novamente sem a necessidade de reiniciar a classe.
     * Ideal para ser usado com Stored Procedures, basta
     * que re-escreva os valores.
     * @Example: $statements = id={$id}&...
     * *************************************************/
    public function deleteChange($ParseString) {
        parse_str($ParseString, $this->deleteValues);
        $this->deleteConstruct();
        $this->deleteExecute();
    }

    /** ************************************************
     * @Method: Informa quantos valores foram apagados.
     * @Return: (INT) Quantidade.
     * *************************************************/
    public function deleteCount() {
        return $this->deleteSyntax->rowCount();
    }

    /** ************************************************
     * @Method: Informa se houve valores apagados.
     * @Return: (BOOL) TRUE/FALSE.
     * *************************************************/
    public function deleteResult() {
        return $this->deleteData;
    }

    /** ************************************************
     * @Method: Constroi a Syntax da query 
     * *************************************************/
    private function deleteConstruct() {
        $this->deleteSyntax = "DELETE FROM {$this->deleteTable} WHERE {$this->deleteFields}";
    }

    /** ************************************************
     * @Method: Inicia a conexão e faz o
     * Prepare Statements.
     * *************************************************/
    private function deleteConnect() {
        $this->deleteConn = parent::callConnect();
        $this->deleteSyntax = $this->deleteConn->prepare($this->deleteSyntax);
    }

    /** ************************************************
     * @Method: Executa os métodos e obtem os
     * resultados.
     * @Return: (EXCEPTION) TRUE or FALSE
     * *************************************************/
    private function deleteExecute() {
        $this->deleteConnect();
        try {
            $this->deleteSyntax->execute($this->deleteValues);
            $this->deleteData = true;
        } catch (PDOException $error) {
            $this->deleteData = null;
            $this->deleteError = "Erro ao ler dados: {$error->getMessage()} {$error->getCode()}";
        }
    }
}
