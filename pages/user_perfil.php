


<?php

/*
require_once (__DIR__ . '/../config.php');
require_once (__DIR__ . '/../class/database/Connect.php');
require_once (__DIR__ . '/../class/database/Select.php');

$getData = GlobalFilter::filterGet();

$entrie = (int) $getData->b;


$select = new Select();
$select->selectQuery("usuarios", "usuario_id = :dataid", "dataid={$entrie}");
if ($select->selectCount()) {
    foreach ($select->selectResult() as $value) {
        echo "Nome:{$value->nome}<br>";

    }
}
*/

