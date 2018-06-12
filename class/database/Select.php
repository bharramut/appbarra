<?php

/**
 * ****************************************************
 * @Copyright (c) 2014, Spell Master.
 * @Version 1.2
 * ****************************************************
 * @Class "PDO" Faz leitura de dados no banco.
 * ****************************************************
 * @changelog
 * * V1.2 (Spell Master):
 * - Adicionado método de verificação de exceções para
 * tratamento de erros.
 * ****************************************************
 */
class Select extends Connect {

    /** @Attr: Armazena a tabela */
    private $selectTable;

    /** @Attr: Armazena os valores */
    private $selectFields;

    /** @Attr: Armazena a syntax da query */
    private $selectSyntax;

    /** @Attr: Armazena a conexão */
    private $selectConn;

    /** @Attr: Armazena se houve sucesso na incerssão */
    private $selectData;

    /** @Attr: Armazena o erro para personalizar a saída */
    private $selectError;

    /**
     * ************************************************
     * @Method: Recebe os dados para ler.
     * @Param ($table) : Tabela para ler.
     * @Param ($fields) : Campos para ler.
     * @Param ($statements) : Valores para ler.
     * @Note: (LIMIT/OFFSET) São opcionais.
     * ************************************************
     */
    public function selectQuery($table, $fields = null, $statements = null) {
        if (!empty($statements)) {
            parse_str($statements, $this->selectFields);
        }
        $this->selectTable = 'SELECT * FROM ' . $table . (isset($fields) ? ' WHERE ' . $fields : null);
        $this->selectExecute();
    }

    /**
     * ************************************************
     * @Method: Para leitura de múltipas tabelas
     * simultâneas com uso de "INNER_JOIN / LEFT_JOIN".
     * @Param ($Query) : Tabela para ler.
     * @Param ($statements) : Valores para ler.
     * @Note: (LIMIT/OFFSET) São opcionais.
     * ************************************************
     */
    public function selectQueryFull($Query, $statements = null) {
        $this->selectTable = (string) $Query;
        if (!empty($statements)) {
            parse_str($statements, $this->selectFields);
        }
        $this->selectExecute();
    }

    /**
     * ************************************************
     * @Method: Informa quantos resultados que foram
     * encontrados.
     * @Return: (INT) Quantidade de registros
     * ************************************************
     */
    public function selectCount() {
        return ($this->selectSyntax->rowCount());
    }

    /**
     * ************************************************
     * @Method: Informa os resultados que foram
     * encontrados.
     * @Return: (ARRAY/BOLL) Resultados em String/NULL
     * ************************************************
     */
    public function selectResult() {
        return ($this->selectData);
    }
    
    /**
     * ************************************************
     * @Method: Informa erros de consulta.
     * @Return: (STRING/BOLL) Resultado em a partir de
     * PDOException - String/NULL
     * ************************************************
     */
    public function selectError() {
        return ($this->selectError);
    }

    /**
     * ************************************************
     * @Method: Constroi a Syntax para query.
     * Altomaticamente detecta o uso de vinculos
     * atribuitivos de resultado (LIMIT/OFFSET) e
     * trata os mesmos como INTEGER.
     * ************************************************
     */
    private function selectConstruct() {
        if ($this->selectFields) {
            foreach ($this->selectFields as $type => $value) {
                if ($type == 'limit' || $type == 'offset') {
                    $value = (int) $value;
                }
                $this->selectSyntax->bindValue(":{$type}", $value, (is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR));
            }
        }
    }

    /**
     * ************************************************
     * @Method: Inicia a conexão e faz o
     * Prepare Statements.
     * ************************************************
     */
    private function selectConnect() {
        $this->selectConn = parent::callConnect();
        $this->selectSyntax = $this->selectConn->prepare($this->selectTable);
        $this->selectSyntax->setFetchMode(PDO::FETCH_OBJ);
    }

    /**
     * ************************************************
     * @Method: Executa os métodos e obtem os
     * resultados.
     * @Return: (EXCEPTION) TRUE or FALSE
     * ************************************************
     */
    private function selectExecute() {
        $this->selectConnect();
        try {
            $this->selectConstruct();
            $this->selectSyntax->execute();
            $this->selectData = $this->selectSyntax->fetchAll();
        } catch (PDOException $error) {
            $this->selectData = null;
            $this->selectError = "Erro ao ler dados: {$error->getMessage()} {$error->getCode()}";
        }
    }

}
