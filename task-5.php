<?php

// Given two integers A and B. Write a function that outputs all numbers from A to B inclusive,
// in ascending order if A < B, or in descending order otherwise. Use recursion.

function getAllNumbers(int $a, int $b): string {
    if ($a >= $b) {
        if ($a == $b) {
            return $b;
        }
        return $a . ', ' . getAllNumbers(--$a, $b);
    } else {
        return $a . ', ' . getAllNumbers(++$a, $b);
    }
}

//echo getAllNumbers(4, 9);
