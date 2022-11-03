<?php

// Write a PHP function to add the digits by absolute of an integer repeatedly until the result has a single digit.
// Explanation: 5689 = 5+6+8+9 = 28 = 2+8 = 10 = 1+0 = 1

// "addDigitsTillOneRemains" function adds the digits by absolute of an integer repeatedly
// until the result has a single digit
function addDigitsTillOneRemains($number): int {
    if (gettype($number) !== 'integer' || $number <= 1) {
        throw new \InvalidArgumentException(
            'function accepts integers > 1 only. Input was: ' . $number
        );
    }

    while (strlen((string) $number) > 1) {
        $array = str_split($number);
        $number = array_sum($array);
    }

    return $number;
}

//echo addDigitsTillOneRemains(12345);