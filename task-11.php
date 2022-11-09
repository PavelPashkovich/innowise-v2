<?php

class PathFinder
{
    private array $field;
    private array $startCoordinates;
    private array $finishCoordinates;
    private int $pointA = 1;
    private int $pointB;
    private array $shortestPath = [];
    private int $iteration = 0;

    public function __construct(array $field, array $startCoordinates, array $finishCoordinates)
    {
        $this->field = $field;
        $this->startCoordinates = $startCoordinates;
        $this->finishCoordinates = $finishCoordinates;

        $this->field[$startCoordinates[0]][$startCoordinates[1]] = $this->pointA;

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
                if ($item > 0) {
                    if (isset($field[$elemKey + 1][$itemKey]) && ($elemKey + 1 == $this->finishCoordinates[0] && $itemKey == $this->finishCoordinates[1])) {
                        $field[$elemKey + 1][$itemKey] = $item + 1;
                        $this->pointB = $item + 1;
                        $this->shortestPath[] = [$elemKey + 1, $itemKey];
                        $this->saveField();
                        $this->printPath([$elemKey + 1, $itemKey]);
                        return;
                    } elseif (isset($field[$elemKey - 1][$itemKey]) && ($elemKey - 1 == $this->finishCoordinates[0] && $itemKey == $this->finishCoordinates[1])) {
                        $field[$elemKey - 1][$itemKey] = $item + 1;
                        $this->pointB = $item + 1;
                        $this->shortestPath[] = [$elemKey - 1, $itemKey];
                        $this->saveField();
                        $this->printPath([$elemKey - 1, $itemKey]);
                        return;
                    } elseif (isset($field[$elemKey][$itemKey + 1]) && ($elemKey == $this->finishCoordinates[0] && $itemKey + 1 == $this->finishCoordinates[1])) {
                        $field[$elemKey][$itemKey + 1] = $item + 1;
                        $this->pointB = $item + 1;
                        $this->shortestPath[] = [$elemKey, $itemKey + 1];
                        $this->saveField();
                        $this->printPath([$elemKey, $itemKey + 1]);
                        return;
                    } elseif (isset($field[$elemKey][$itemKey - 1]) && ($elemKey == $this->finishCoordinates[0] && $itemKey - 1 == $this->finishCoordinates[1])) {
                        $field[$elemKey][$itemKey - 1] = $item + 1;
                        $this->pointB = $item + 1;
                        $this->shortestPath[] = [$elemKey, $itemKey - 1];
                        $this->saveField();
                        $this->printPath([$elemKey, $itemKey - 1]);
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
                    $this->iteration++;
                }
            }
        }
        if ($this->iteration > 2000) {
            echo "Path was not found! :(";
            return;
        }
        $this->findPath();
    }

    private function printPath($point) {
        $field = &$this->field;
        if($point != $this->startCoordinates) {
            $item = $field[$point[0]][$point[1]];
            if (isset($field[$point[0] + 1][$point[1]]) && $field[$point[0] + 1][$point[1]] == $item - 1) {
                $this->shortestPath[] = [$point[0] + 1, $point[1]];
            } elseif (isset($field[$point[0] - 1][$point[1]]) && $field[$point[0] - 1][$point[1]] == $item - 1) {
                $this->shortestPath[] = [$point[0] - 1, $point[1]];
            } elseif (isset($field[$point[0]][$point[1] + 1]) && $field[$point[0]][$point[1] + 1] == $item - 1) {
                $this->shortestPath[] = [$point[0], $point[1] + 1];
            } elseif (isset($field[$point[0]][$point[1] - 1]) && $field[$point[0]][$point[1] - 1] == $item - 1) {
                $this->shortestPath[] = [$point[0], $point[1] - 1];
            }
            $this->printPath(array_slice($this->shortestPath, -1)[0]);
        } else {
            foreach ($field as $elemKey => $elem) {
                foreach ($elem as $itemKey => $item) {
                    if (in_array([$elemKey, $itemKey], $this->shortestPath)) {
                        $field[$elemKey][$itemKey] = 'X';
                    }
                }
            }
            $this->printField();
        }
    }
}

$startCoordinates = [0, 0];
$finishCoordinates = [9, 9];

$field = [
    [0,0,-1,0,-1,0,0,0,0,0],
    [0,0,-1,0,0,0,-1,0,0,-1],
    [0,0,-1,0,-1,0,0,0,0,0],
    [0,0,0,0,-1,0,0,0,0,0],
    [0,0,0,0,0,0,-1,0,0,0],
    [0,0,0,0,0,0,-1,0,0,-1],
    [0,0,-1,0,0,0,0,0,0,0],
    [0,0,0,0,-1,0,0,-1,0,0],
    [0,0,0,0,-1,0,0,0,-1,-1],
    [0,0,-1,0,-1,0,0,0,0,0],
];

$pathFinder = new PathFinder($field, $startCoordinates, $finishCoordinates);
$pathFinder->findPath();

