<?php

function custom_print_r($var, $return = false) {
    $str = print_r($var, 1);
    $str = str_replace(' ', '&nbsp;', $str);
    $str = nl2br($str);
    if($return) {
        return $str;
    }

    echo $str;
}