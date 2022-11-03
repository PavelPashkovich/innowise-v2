<?php

// Given a list of values. Delete the element from the list in the 'n' position. After deleting the element,
// integer keys must be normalized. Use function array_values() is forbidden.

function deleteElementByPosition(array $arr, int $position): array {
    if ($position < 0) {
        throw new \InvalidArgumentException(
            'second function argument must be a non-negative integer. Input was: ' . $position
        );
    } elseif ($position > count($arr)) {
        throw new \InvalidArgumentException(
            "there is no index # $position in the given array"
        );
    }
    array_splice($arr, $position, 1);
    return $arr;
}

//print_r(deleteElementByPosition([1,2,3,4,5], 3));