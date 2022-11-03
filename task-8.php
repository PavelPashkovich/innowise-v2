<?php

class Matrix
{
    private array $matrix;
    private int $rowsNumber;
    private int $columnsNumber;

    public function __construct(array $array)
    {
        if ($this->isValidMatrix($array)) {
            $this->matrix = $array;
            $this->rowsNumber = count($array);
            $this->columnsNumber = count($array[0]);
        } else {
            throw new \InvalidArgumentException(
                'constructor accepts two-dimensional array with numbers only and equal rows'
            );
        }
    }

    public function __get($property) {
        $properties = ['rowsNumber', 'columnsNumber'];
        if (in_array($property, $properties)) {
            return $this->$property;
        }
    }

    public function printOut(): array {
        return $this->matrix;
    }

    public function add(Matrix $matrix): array {
        $array = $matrix->matrix;
        if ($this->isValidMatrix($array)) {
            foreach ($array as $key => $value) {
                foreach ($value as $k => $v) {
                    $array[$key][$k] += $this->matrix[$key][$k];
                }
            }
            return $array;
        } else {
            throw new \InvalidArgumentException(
                'method accepts two-dimensional array with numbers only and equal rows'
            );
        }
    }

    public function multiply(Matrix $matrix): array {
        $array = $matrix->matrix;
        if ($this->isValidMatrix($array)) {
            foreach ($array as $key => $value) {
                foreach ($value as $k => $v) {
                    $array[$key][$k] *= $this->matrix[$key][$k];
                }
            }
            return $array;
        } else {
            throw new \InvalidArgumentException(
                'method accepts two-dimensional array with numbers only and equal rows'
            );
        }
    }

    public function multiplyBy(int $num): array {
        foreach ($this->matrix as $key => $value) {
            foreach ($value as $k => $v) {
                $this->matrix[$key][$k] *= $num;
            }
        }
        return $this->matrix;
    }

    protected function isValidMatrix(array $array): bool {
        return $this->isTwoDimensionalArray($array) && $this->isNumericArray($array) && $this->areArrayRowsEqual($array);
    }

    protected function isTwoDimensionalArray(array $array): bool {
        $flag = true;
        foreach ($array as $item) {
            if (!is_array($item)) {
                $flag = false;
            }
        }
        return $flag;
    }

    protected function isNumericArray(array $array): bool {
        $flag = true;
        foreach ($array as $elem) {
            foreach ($elem as $item) {
                if (!is_numeric($item)) {
                    $flag = false;
                }
            }
        }
        return $flag;
    }

    protected function areArrayRowsEqual(array $array): bool {
        $flag = true;
        foreach ($array as $elem) {
            if (count($array[0]) != count($elem)) {
                $flag = false;
            }
        }
        return $flag;
    }
}

//$matrix1 = new Matrix([[1,2,3], [4,5,6], [7,8,9]]);
//$matrix2 = new Matrix([[1,2,3], [4,5,6], [7,8,9]]);
//
//print_r($matrix1->add($matrix2));
//print_r($matrix1->multiply($matrix2));
//print_r($matrix1->multiplyBy(3));

