<?php

namespace AppBundle\Util;

use AppBundle\Exception\CalculatorException;

class Calculator
{
    /**
     * @param string $calculation
     *
     * @return float|string
     */
    public static function calculate(string $calculation) {
        if ( ! $calculation = filter_var(
            $calculation, FILTER_VALIDATE_REGEXP, ["options" => ["regexp" => "/^[\d\s\+\-\/\.*]+$/"]]
        )
        ) {
            throw new CalculatorException("Invalid string passed in for calculation: $calculation", 500);
        }
        
        $split = preg_split("/([\d.]+|\+|-|\/|\*)\K/", preg_replace("/\s/", "", $calculation), -1, PREG_SPLIT_NO_EMPTY);
        $split = self::doAllMultiplicationAndDivision($split);
        $result = self::doAllAdditionAndSubtraction($split);
        
        return $result;
    }
    
    /**
     * Return the sum of $a and $b
     *
     * @param float $a
     * @param float $b
     *
     * @return float
     */
    private static function add(float $a, float $b): float {
        return $a + $b;
    }
    
    /**
     * Return the result of $a divided by $b
     *
     * @param float $a
     * @param float $b
     *
     * @return float
     */
    private static function divide(float $a, float $b): float {
        return $a / $b;
    }
    
    private static function doAllAdditionAndSubtraction(array $split): float {
        $result = array_shift($split);
        foreach (array_chunk($split, 2) as $do) {
            if ($do[0] == "+") {
                $result = self::add($result, $do[1]);
            } elseif ($do[0] == "-") {
                $result = self::subtract($result, $do[1]);
            }
        }
    
        return $result;
    }
    
    /**
     * Loop through the array and perform all multiplications and divisions in the calculation
     *
     * @param array $split
     *
     * @return array
     */
    private static function doAllMultiplicationAndDivision(array $split): array {
        foreach ($split as $i => $val) {
            if ($val == "*") {
                $split[$i - 1] = self::multiply($split[$i - 1], $split[$i + 1]);
                unset($split[$i]);
                unset($split[$i + 1]);
            } elseif ($val == "/") {
                $split[$i - 1] = self::divide($split[$i - 1], $split[$i + 1]);
                unset($split[$i]);
                unset($split[$i + 1]);
            }
        }
    
        return $split;
    }
    
    /**
     * Return the product of $a and $b
     *
     * @param float $a
     * @param float $b
     *
     * @return float
     */
    private static function multiply(float $a, float $b): float {
        return $a * $b;
    }
    
    /**
     * Return the difference between $a and $b
     *
     * @param float $a
     * @param float $b
     *
     * @return float
     */
    private static function subtract(float $a, float $b): float {
        return $a - $b;
    }
}