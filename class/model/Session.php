<?php
/**
 * ****************************************************
 * @author ?
 * @copyright ?
 * @version 2.0: 2010, Spell Master (c)
 * @version 2.1: 2011, Spell Master (c)
 * @version 2.2: 2013, Spell Master (c)
 * @version 3.0: 2017, Spell Master (c)
 * 
 * ****************************************************
 * @class: Classe para o gerenciamento e manipulação
 * de sessões
 * ****************************************************
 * 
 * @Usage single session
 * ----------------------------------------------------
 * *** Pega a instância da classe
 * $session = Session::getSession();
 * 
 * *** Ver a cessão armazenada
 * $session->Word = "Olá mundo";
 * 
 * * Inicia uma cessão
 * $session->startSession();
 * 
 * *** Verificação de a sessão existe
 * if (isset($session->helloWord)) {
 *     echo "A cessão \"Word\" foi iniciada : "{$session->Word}".;
 * } else {
 *     echo "A cessão \"Word\" não foi iniciada";
 * }
 * 
 * *** Destroi a cessão
 * unset($session->Word);
 * 
 * ----------------------------------------------------
 * @Usage all sessions
 * ----------------------------------------------------
 * $session->destroy();
 * $session->restart();
 * $session->reset();
 * 
 * ****************************************************
 * @changelog
 * * Adicionado ducumentação e instruções de uso [spell master]
 * * Removido métodos e atributos desnecessários [spell master]
 * * Removido necessidade de parâmetros [spell master]
 * * Fixado na instância o construtor [spell master]
 * * Aplicado corretamente o uso de métodos estáticos [spell master]
 * ****************************************************
 */

class Session {

    /* Constants de definição */
    const SESSION_STARTED = true;
    const SESSION_STOPED = false;

    /* Atributo de verificação */
    private $sessionStatus = self::SESSION_STOPED;

    /* Atributo estático de método */
    private static $session;

    /**
     * ************************************************
     * @Method: Obtem a intância da cessão
     * (bool) Se a cessão já exite retorna a mesma
     * ************************************************
     */
    public static function getSession() {
        if (!isset(self::$session)) {
            self::$session = new self;
        }
        self::$session->startSession();
        return self::$session;
    }

    /**
     * ************************************************
     * @Method: Inicia a cessão
     * ************************************************
     */
    public function startSession() {
        $this->sessionStatus = session_start();
        return $this->sessionStatus;
    }

    /**
     * ************************************************
     * @Method: Elimina sessões
     * ************************************************
     */
    public function destroy() {
        if ($this->sessionStatus == self::SESSION_STARTED) {
            $this->sessionStatus = session_destroy();
            unset($_SESSION);
            return $this->sessionStatus;
        }
        return false;
    }

    /**
     * ************************************************
     * @Method: Reinicia as sessões
     * ************************************************
     */
    public function restart() {
        if (self::$session->destroy()) {
            self::$session->startSession();
        }
    }

    /**
     * ************************************************
     * @Method: Reseta as sessões
     * ************************************************
     */
    public function reset() {
        session_reset();
    }

    /**
     * ************************************************
     * @Method's HELPER: Helpes de auxílio a sessão
     * única
     * ************************************************
     */

    // ------------------------------------------------
    // Definir sessão
    public function __set($name, $value) {
        $_SESSION[$name] = $value;
    }

    // ------------------------------------------------
    // Obter sessão
    public function __get($name) {
        if (isset($_SESSION[$name])) {
            return $_SESSION[$name];
        }
    }

    // ------------------------------------------------
    // Verificar sessão
    public function __isset($name) {
        return isset($_SESSION[$name]);
    }

    // ------------------------------------------------
    // Desfazer sessão
    public function __unset($name) {
        unset($_SESSION[$name]);
    }

}
