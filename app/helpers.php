<?php

/*
 * Helper functions
 */

/**
 * @param $value
 * @param int $digits
 * @return float
 */
function float_formatted($value, int $digits = 2): float {
    return floatval(number_format($value, $digits, '.', ''));
}

function my_asset($path) {
    return asset($path, request()->isSecure());
}

function test_secure(){
    if (isSecure())
        return 'si';
    else
        return 'no';
}

function test_server()
{
    dump($_SERVER);
}

function isSecure() {
    return !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off';
}