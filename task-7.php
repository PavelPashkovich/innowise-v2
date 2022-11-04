<?php

/*
Given a string with an url address.
Write a function to check if this string is a valid url address using regular expressions.
*/

function isValidUrl(string $input): string {
    $pattern = '#https?://(www\.)?[a-z0-9-_]+\.[a-z]{2,3}/#';
    return preg_match($pattern, $input) ? 'OK' : 'Not a valid URL';
}

echo isValidUrl('https://innowise.com/');
//echo isValidUrl('https://innowise,com/');
//echo isValidUrl('htps://innowise.com/');

