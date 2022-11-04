<?php

class MyCalculator
{
    private float $a;
    private float $b;
    private float $result;

    public function __construct(float $a, float $b)
    {
        $this->a = $a;
        $this->b = $b;
    }

    public function add(): object
    {
        if (isset($this->result)) {
            throw new Error('method add() is not allowed here');
        }
        $this->result = $this->a + $this->b;

        return $this;
    }

    public function subtract(): object
    {
        if (isset($this->result)) {
            throw new Error('method subtract() is not allowed here');
        }
        $this->result = $this->a - $this->b;

        return $this;
    }

    public function multiply(): object
    {
        if (isset($this->result)) {
            throw new Error('method multiply() is not allowed here');
        }
        $this->result = $this->a * $this->b;

        return $this;
    }

    public function divide(): object
    {
        if (isset($this->result)) {
            throw new Error('method divide() is not allowed here');
        }
        try {
            $this->result = $this->a / $this->b;
        } catch (ArithmeticError $arithmeticError) {
            echo $arithmeticError;
        }

        return $this;
    }

    public function addBy(float $x): object
    {
        $this->result += $x;

        return $this;
    }

    public function subtractBy(float $x): object
    {
        $this->result -= $x;

        return $this;
    }

    public function multiplyBy(float $x): object
    {
        $this->result *= $x;

        return $this;
    }

    public function divideBy(float $x): object
    {
        try {
            $this->result /= $x;
        } catch (ArithmeticError $arithmeticError) {
            echo $arithmeticError;
        }

        return $this;
    }

    public function __toString(): string {
        return $this->result;
    }

}

$myCalc = new MyCalculator(14, 2);
echo $myCalc->divide()->multiplyBy(4)->subtractBy(8)->subtractBy(10)->divideBy(5);
