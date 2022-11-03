<?php

// Write a PHP functions to test whether a number is greater than 30, 20 or 10
// using an if conditions, switch and ternary operator.

// "if" function checks if the given number is grater than 30, 20 or 10.
function ifIsGraterThan(int $inputNumber): string {
    if ($inputNumber > 30) {
        return 'More than 30';
    } elseif ($inputNumber > 20) {
        return 'More than 20';
    } elseif ($inputNumber > 10) {
        return 'More than 10';
    } else {
        return 'Equal or less than 10';
    }
}

// "switch" function checks if the given number is grater than 30, 20 or 10.
function switchIsGraterThan(int $inputNumber): string {
    switch ($inputNumber) {
        case $inputNumber > 30:
            return 'More than 30';
        case $inputNumber > 20:
            return 'More than 20';
        case $inputNumber > 10:
            return 'More than 10';
        default:
            return 'Equal or less than 10';
    }
}

// "match" function checks if the given number is grater than 30, 20 or 10.
function matchIsGraterThan(int $inputNumber): string {
    return match (true) {
        $inputNumber > 30 => 'More than 30',
        $inputNumber > 20 => 'More than 20',
        $inputNumber > 10 => 'More than 10',
                  default => 'Equal or less than 10',
    };
}

// "ternary" function checks if the given number is grater than 30, 20 or 10.
function ternaryIsGraterThan(int $inputNumber): string {
    return $inputNumber > 30 ? 'More than 30' :
          ($inputNumber > 20 ? 'More than 20' :
          ($inputNumber > 10 ? 'More than 10' :
                               'Equal or less than 10'));
}
