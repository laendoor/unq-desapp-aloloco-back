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