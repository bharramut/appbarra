<?php

/**
 * ****************************************************
 * @copyright : 2015, Spell Master(c)
 * @version : 1.2 - 2016, Spell Master(c)
 * ****************************************************
 * @info : Conversores de arrays em objetos.
 * ****************************************************
 */

/**
 * ************************************************
 * @function: Converte array singular em objeto
 * @param ($array) : array para converter.
 * ************************************************
 */
function StdArray($array) {
    $object = new stdClass();
    if (is_array($array)) {
        foreach ($array as $name => $value) {
            $object->$name = $value;
        }
    }
    return $object;
}

/**
 * ************************************************
 * @function: Converte array multi-dimensional em
 * objeto
 * @param ($array) : array para converter.
 * ************************************************
 */
function ObjArray($array) {
    if (is_array($array)) {
        return (object) array_map(__FUNCTION__, $array);
    } else {
        return $array;
    }
}
