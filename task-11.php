<?php

class PathFinder
{
    private array $field;
    private int $pointA = 1;
    private string $pointB = 'x';

    public function __construct(array $field, array $pointA, array $pointB)
    {
        $this->field = $field;

        $this->field[$pointA[0]][$pointA[1]] = $this->pointA;
        $this->field[$pointB[0]][$pointB[1]] = $this->pointB;

        $this->saveField();
    }

    public function getField(): array {
        return $this->field;
    }

    public function printField(): void {
        $field = $this->field;
        foreach ($field as $elem) {
            echo "<table><tr>";
            foreach ($elem as $item) {
                echo "<td style='width: 20px; height: 20px; border: solid 1px black'>$item</td>";
            }
            echo "</tr></table>";
        }
    }

    private function saveField(): void {
        $field = $this->field;
        $fieldSerialized = serialize($field);
        file_put_contents('field.txt', $fieldSerialized);
    }

    private function getSavedField(): void {
        $fieldSerialized = file_get_contents('field.txt');
        $field = unserialize($fieldSerialized);
        $this->field = $field;
    }

    public function findPath(): void {
        $this->getSavedField();
        $field = &$this->field;
        foreach ($field as $elemKey => $elem) {
            foreach ($elem as $itemKey => $item) {
                if ($item > 0 && gettype($item) != 'string') {
                    if (isset($field[$elemKey + 1][$itemKey]) && $field[$elemKey + 1][$itemKey] == $this->pointB ||
                        isset($field[$elemKey - 1][$itemKey]) && $field[$elemKey - 1][$itemKey] == $this->pointB ||
                        isset($field[$elemKey][$itemKey + 1]) && $field[$elemKey][$itemKey + 1] == $this->pointB ||
                        isset($field[$elemKey][$itemKey - 1]) && $field[$elemKey][$itemKey - 1] == $this->pointB)
                    {
                        echo 'Path found!';
                        $this->printField();
                        return;
                    }
                    if (isset($field[$elemKey + 1][$itemKey]) && $field[$elemKey + 1][$itemKey] == 0) {
                        $field[$elemKey + 1][$itemKey] = $item + 1;
                    }
                    if (isset($field[$elemKey - 1][$itemKey]) && $field[$elemKey - 1][$itemKey] == 0) {
                        $field[$elemKey - 1][$itemKey] = $item + 1;
                    }
                    if (isset($field[$elemKey][$itemKey + 1]) && $field[$elemKey][$itemKey + 1] == 0) {
                        $field[$elemKey][$itemKey + 1] = $item + 1;
                    }
                    if (isset($field[$elemKey][$itemKey - 1]) && $field[$elemKey][$itemKey - 1] == 0) {
                        $field[$elemKey][$itemKey - 1] = $item + 1;
                    }
                    $this->saveField();
                }
            }
        }
        $this->findPath();
    }
}

$pointA = [0, 0];
$pointB = [9, 9];

$field = [
    [0,0,-1,0,-1,0,0,0,0,0],
    [0,0,-1,0,0,0,-1,0,0,-1],
    [0,0,-1,0,-1,0,0,0,0,0],
    [0,0,0,0,-1,0,0,0,0,0],
    [0,0,0,0,0,0,-1,0,0,0],
    [0,0,0,0,0,0,-1,0,0,-1],
    [0,0,-1,0,0,0,0,0,0,0],
    [0,0,0,0,-1,0,0,-1,0,0],
    [0,0,0,0,-1,0,0,0,0,0],
    [0,0,-1,0,-1,0,0,0,0,0],
];

$pathFinder = new PathFinder($field, $pointA, $pointB);
$pathFinder->findPath();

