<?php
/**
 * ****************************************************
 * @copyright: 2014, Spell Master(c)
 * @version: 6.5 - 2017, Spell Master(c)
 * ****************************************************
 * @Class: Classe de conexão PDO com SingleTon.
 * ****************************************************
 **/
class Connect {
    private static $host = HOST;
    private static $user = USER;
    private static $pass = PASS;
    private static $data = DATA;
    private static $isConnect = null;

    /** ************************************************
     * @Method: Para construir a conexão com o banco 
     * de dados
     * *************************************************/
    private static function makeConnect() {
        try {
            if (self::$isConnect == null) {
                $dsn = 'mysql:host=' . self::$host . '; dbname=' . self::$data;
                $options = [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'];
                self::$isConnect = new PDO($dsn, self::$user, self::$pass, $options);
            }
        } catch (PDOException $error) {
            die("<br>Não foi possível conectar com o banco de dados!<br Descrição: {$error->getMessage()}<br>");
        }
        self::$isConnect->SetAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return self::$isConnect;
    }

    /** ************************************************
     * @Method: Chama o construtor da conexão
     * *************************************************/
    protected function callConnect() {
        return self::makeConnect();
    }
}
