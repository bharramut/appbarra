<?php

/**
 * ****************************************************
 * @author Spell Master (Omar Pautz) 2018
 * ****************************************************
 * @Nota: Arquivo de comportamento corriqueiro.
 * * Requisita, define configurações básicas e de
 * altissima importância.
 * @Atenção!!!
 * NÃO EDITAR A NÃO SER QUE SAIBA O QUE REALMENTE FAZ
 * ****************************************************
 */
require_once (__DIR__ . '/../function/LoadClass.php');
require_once (__DIR__ . '/../function/Array_Object.php');

/* Inicia Cessões */
$session = Session::getSession();

/* Define as configurações */
$app = require_once (__DIR__ . '/application.php');
$config = StdArray($app);

/* Fuso horário do servidor */
date_default_timezone_set($config->timeZone);

/* Constants para conexão */
defined('HOST') || define('HOST', $config->dbHost);
defined('USER') || define('USER', $config->dbUser);
defined('PASS') || define('PASS', $config->dbPass);
defined('DATA') || define('DATA', $config->dbName);

/* Erros */
//error_reporting(0);
//ini_set('display_errors', false);