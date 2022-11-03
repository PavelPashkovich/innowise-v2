<?php

// Create a simple 'birthday countdown' script, the script counts the number of days left
// until the person’s birthday. Your script should determine the number of days based on the current date.

function countDaysTillBirthday(string $date): int {

    // if date format is not valid ("isValidDate" function) throw an error
    if (!isValidDate($date)) {
        throw new \InvalidArgumentException(
            "function only accepts 'DD-MM-YYYY' date format. Input was: " . $date
        );
    }

    // if date format is OK count days till birthday
    $today = date_create(date('d-m-Y'));
    $birthday = date_create($date);
    $daysTillBirthday = date_diff($birthday, $today)->days;
    return $birthday > $today ? $daysTillBirthday : -$daysTillBirthday;
}

// function "isValidDate" checks if the date format is DD-MM-YYYY
function isValidDate(string $date): bool {
    $dateObj = date_create_from_format('d-m-Y', $date);
    return $dateObj && $dateObj->format('d-m-Y') === $date;
}

//print_r(countDaysTillBirthday('22-12-2022'));