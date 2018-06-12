<?php

/**
 * *********************************************************************
 * @function: Função para auto carregamento de classes
 * *********************************************************************
 * @autor: Spell Master
 * @copyright (c) 2014, Spell Master AND Zeed
 * *********************************************************************
 */
function __autoload($Class) {
    // Liste aqui todas as pastas que contém arquivos de classes
    $findDir = [
        'database',
        'model',
        'PHPMailer',
    ];
    $includeDir = null;
    foreach ($findDir as $DirName) {
        if (!$includeDir && file_exists(__DIR__ . "/../class/{$DirName}/{$Class}.php") && !is_dir(__DIR__ . "../class/{$DirName}/{$Class}.php")) {
            include_once (__DIR__ . "/../class/{$DirName}/{$Class}.php");
            $includeDir = true;
        }
    }
    // Isso é opcional
    // Caso a função não encontre o arquivo ela vai retornar isso como erro
    if (!$includeDir) {
        die("Erro interno no servidor ao encontrar dados cruciais de funcionamento!");
        //die("Erro ao incluir o arquivo: {$Class}.php");
    }
}
