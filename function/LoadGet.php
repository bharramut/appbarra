<?php

function LoadGet($initFile) {
    $incGet = null;
    if (isset($initFile)) {
        if (!$incGet && file_exists(__DIR__ . '/../pages/' . $initFile . '.php')) {
            $incGet = true;
            return (__DIR__ . '/../pages/' . $initFile . '.php');
        }
    }
    if (!$incGet) {
        return (__DIR__ . '/../pages/not_found.php');
    }
}


