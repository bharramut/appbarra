<?php
/**
 * ****************************************************
 * @Copyright (c) 2014, Spell Master.
 * ****************************************************
 * @Class: "PDO" Faz incessão de dados no banco.
 * @Param ($table) : Tabela para inserir.
 * @Param ($fields) : Valores a inserir.
 * ****************************************************
 **/

class Insert extends Connect {
    /** @Attr: Armazena a tabela **/
    private $insertTable;
    /** @Attr: Armazena a ARRAY de valores **/
    private $insertFilds;
    /** @Attr: Armazena a syntax da query **/
    private $insertSyntax;
    /** @Attr: Armazena a conexão **/
    private $insertConn;
    /** @Attr: Armazena se houve sucesso na incerssão **/
    private $insertData;
    /** @Attr: Armazena o erro para personalizar a saída **/
    public $insertError;



    /** ************************************************
     * @Method: Recebe os dados para inserir.
     * @Param: ($table) Tabela para inserir.
     * @Param: ($field) Valores a inserir.
     * *************************************************/
    public function insertQuery($table, array $fields) {
        $this->insertTable = (string) $table;
        $this->insertFilds = $fields;
        $this->insertConstruct();
        $this->insertExecute();
    }

    /** ************************************************
     * @Method: Informa se o registro foi concluído.
     * @Return: (bool) TRUE or FALSE
     * *************************************************/
    public function insertResult() {
        return $this->insertData;
    }

    /** ************************************************
     * @Method: Controi a Syntax da query através da 
     * array recebida, para compor a uso de 
     * Prepare Statements.
     * *************************************************/
    private function insertConstruct() {
        $Column = implode(', ', array_keys($this->insertFilds));
        $values = ':' . implode(', :', array_keys($this->insertFilds));
        $this->insertSyntax = "INSERT INTO {$this->insertTable} ({$Column}) VALUES ({$values})";
    }

    /** ************************************************
     * @Method: Inicia a conexão e faz o
     * Prepare Statements.
     * *************************************************/
    private function insertConnect() {
        $this->insertConn = parent::callConnect();
        $this->insertSyntax = $this->insertConn->prepare($this->insertSyntax);
    }

    /** ************************************************
     * @Method: Executa os métodos e obtem os
     * resultados.
     * @Return: (EXCEPTION) TRUE or FALSE
     * *************************************************/
    private function insertExecute() {
        $this->insertConnect();
        try {
            $this->insertSyntax->execute($this->insertFilds);
            $this->insertData = $this->insertConn->lastInsertId();
            
        } catch (PDOException $error) {
            $this->insertData = null;
            $this->insertError = "Erro ao inserir dados: {$error->getMessage()} {$error->getCode()}";
        }
    }
}
