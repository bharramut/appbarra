<?php

/**
 * ****************************************
 * * @Class StrClean
 * * @author Spell-Master (Omar Pautz)
 * * @version 1.0 (2018)
 * * @requires PHP 5.5 ou superior
 * ****************************************
 * * Faz gerenciamento de strings.
 * * ATENÇÃO!!!
 * - Esse aquivo só pode ser salvo com
 * codificação "utf8" para correto
 * funcionamento da classe.
 * - Caracteres ANSI enviados para
 * tratamento podem aprentar anomalias
 * pós tratados se a codificação da url não
 * for utf8.
 * - Certifique-se que sua aplicação
 * somente trabalhe em UTF-8.
 * ****************************************
 */
class StrClean {

    private $data;
    private $match;

    /**
     * ****************************************
     * * @method : Remove todos os tipos de
     * caracteres não aceitáveis de uma string
     * ****************************************
     */
    public function formatStr($string) {
        $this->match = array();
        $this->match['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:.,\\\'<>°ºª`';
        $this->match['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                  ';
        $this->data = strtr(utf8_decode($string), utf8_decode($this->match['a']), $this->match['b']);
        $this->data = strip_tags(trim($this->data));
        $this->data = preg_replace('/[ -]+/', '-', $this->data);
        return utf8_encode(strtolower($this->data));
    }

    /**
     * ****************************************
     * * @method : Limpa string removendo dados
     * usando em injeção de código.
     * - Ideal para tratamento de URL amigável
     * ****************************************
     */
    public function clearUrl($string) {
        $this->data = (string) $string;
        $this->data = filter_var($this->data, FILTER_SANITIZE_URL);
        if (preg_match_all('/[$|%|*|(|)|+|<|>]/', $this->data)) {
            return preg_replace('/[^A-Za-z0-9-]/', '', strtolower($this->data));
        } else if (filter_var($this->data, FILTER_VALIDATE_URL)) {
            $str = $this->formatStr($this->data);
            return $str;
        } else {
            return preg_replace('/[^A-Za-z0-9-]/', '', strtolower($this->data));
        }
    }

    /**
     * ****************************************
     * * @method : Criptograga dados
     * ****************************************
     */
    public function baseEncode($string) {
        $this->data = (string) $string;
        return base64_encode($this->data);
    }

    /**
     * ****************************************
     * * @method : Remove criptografia de dados
     * com base64
     * ****************************************
     */
    public function baseDecode($string) {
        $this->data = (string) $string;
        return base64_decode($this->data);
    }

    /**
     * ****************************************
     * * @method : Criptografa entradas XML 
     * para Syntax HTML
     * ****************************************
     */
    public function xmlEncode($string) {
        $this->data = (string) $string;
        return str_replace(['&', '"', "'", '<', '>', ' '], ['&amp;', '&quot;', '&apos;', '&lt;', '&gt;', '-'], $this->data);
    }

    /**
     * ****************************************
     * * @method : Descriptografa entradas de 
     * Syntax HTML para XML
     * ****************************************
     */
    public function xmlDecode($string) {
        $this->data = (string) $string;
        return str_replace(['&amp;', '&quot;', '&apos;', '&lt;', '&gt;', '-'], ['&', '"', "'", '<', '>', ' '], $this->data);
    }

    /**
     * ****************************************
     * * @method : Converte datas para o 
     * formato latino americano.
     * ****************************************
     */
    public function invertDate($date) {
        return implode('/', array_reverse(explode('-', $date)));
    }

}
