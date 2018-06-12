<?php

/**
 * ****************************************
 * * @Class GlobalFilter
 * * @author Spell-Master (Omar Pautz)
 * * @version 1.1 (2018)
 * ****************************************
 * * @changes :
 * * V-1.1 = Aterado métodos privados para
 * protegidos para serem extendidos.
 * ****************************************
 * * Aplica um filtro padrão sobre
 * super-globais e retorna os mesmos
 * como objetos.
 * ****************************************
 */
class GlobalFilter {

    private static $filter;

    /**
     * ****************************************
     * * @method : Converte os valores em 
     * objetos
     * ****************************************
     */
    private static function objArray($array) {
        $object = new stdClass();
        if (is_array($array)) {
            foreach ($array as $name => $value) {
                $object->$name = $value;
            }
        }
        return $object;
    }
    
    // ========================================
    //  METODOS PROTEGIDOS
    //  Podem ser herdados pelas classes filhas
    // ========================================

    /**
     * ****************************************
     * * @method : Aplica filtro sobre get
     * ****************************************
     */
    protected static function setFilterGet() {
        $filterGet = filter_input_array(INPUT_GET, FILTER_DEFAULT);
        if (isset($filterGet)) {
            self::$filter = self::objArray($filterGet);
        }
    }

    /**
     * ****************************************
     * * @method : Aplica filtro sobre post
     * ****************************************
     */
    protected static function setFilterPost() {
        $filterPost = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($filterPost)) {
            self::$filter = self::objArray($filterPost);
        }
    }

    /**
     * ****************************************
     * * @method : Aplica filtro sobre cookie
     * ****************************************
     */
    protected static function setFilterCookie() {
        $filterCookie = filter_input_array(INPUT_COOKIE, FILTER_DEFAULT);
        if (isset($filterCookie)) {
            self::$filter = self::objArray($filterCookie);
        }
    }

    /**
     * ****************************************
     * * @method : Aplica filtro sobre o 
     * servidor
     * ****************************************
     */
    protected static function setFilterServe() {
        $filterCookie = filter_input_array(INPUT_SERVER, FILTER_DEFAULT);
        if (isset($filterCookie)) {
            self::$filter = self::objArray($filterCookie);
        }
    }

    /**
     * ****************************************
     * * @method : Aplica filtro sobre eventos
     * ****************************************
     */
    protected static function setFilterEven() {
        $filterCookie = filter_input_array(INPUT_ENV, FILTER_DEFAULT);
        if (isset($filterCookie)) {
            self::$filter = self::objArray($filterCookie);
        }
    }

    /**
     * ****************************************
     * * @method : Aplica filtro sobre sessões
     * ****************************************
     */
    protected static function setFilterSession() {
        $filterCookie = filter_input_array(INPUT_SESSION, FILTER_DEFAULT);
        if (isset($filterCookie)) {
            self::$filter = self::objArray($filterCookie);
        }
    }

    /**
     * ****************************************
     * * @method : Aplica filtro sobre 
     * requisissões
     * ****************************************
     */
    protected static function setFilterReqest() {
        $filterCookie = filter_input_array(INPUT_REQUEST, FILTER_DEFAULT);
        if (isset($filterCookie)) {
            self::$filter = self::objArray($filterCookie);
        }
    }

    // ========================================
    //  METODOS PÚBLICOS
    // ========================================

    /**
     * ****************************************
     * * @method : Filtro sobre Get
     * ****************************************
     */
    public static function filterGet() {
        self::setFilterGet();
        return self::$filter;
    }

    /**
     * ****************************************
     * * @method : Filtro sobre Post
     * ****************************************
     */
    public static function filterPost() {
        self::setFilterPost();
        return self::$filter;
    }

    /**
     * ****************************************
     * * @method : Filtro sobre Cookie
     * ****************************************
     */
    public static function filterCookie() {
        self::setFilterCookie();
        return self::$filter;
    }

    /**
     * ****************************************
     * * @method : Filtro sobre Servidor
     * ****************************************
     */
    public static function filterServe() {
        self::setFilterServe();
        return self::$filter;
    }

    /**
     * ****************************************
     * * @method : Filtro sobre Eventos
     * ****************************************
     */
    public static function filterEven() {
        self::setFilterEven();
        return self::$filter;
    }

    /**
     * ****************************************
     * * @method : Filtro sobre 
     * ****************************************
     */
    public static function filterSession() {
        self::setFilterSession();
        return self::$filter;
    }

    /**
     * ****************************************
     * * @method : Filtro sobre requisissões
     * ****************************************
     */
    public static function filterRequest() {
        self::setFilterReqest();
        return self::$filter;
    }

}
