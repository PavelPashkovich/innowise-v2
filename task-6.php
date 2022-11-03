<?php

// Given a string where words are separated by any of the '_', '-', ' ' characters. Write a function
// that converts such strings to single studly caps case words and removes extra spaces on both sides.

function stringToCapsCaseWords(string $string): string {
    $ucWords =  ucwords($string, ' -_');
    return preg_replace('#[-_\s]#', '', $ucWords);
}

//echo stringToCapsCaseWords('               The quick-brown_fox jumps over the_lazy-dog       ');
