<?php

namespace Tests\AppBundle\Util;

use AppBundle\Util\Calculator;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    public function testAddition() {
        $result = Calculator::calculate("12 + 10");
        
        $this->assertEquals(22, $result);
    }
    
    public function testSubtraction() {
        $result = Calculator::calculate("22 - 10");
        
        $this->assertEquals(12, $result);
    }
    
    public function testMultiplication() {
        $result = Calculator::calculate("3 * 9");
        
        $this->assertEquals(27, $result);
    }
    
    public function testDivision() {
        $result = Calculator::calculate("20 / 5");
        
        $this->assertEquals(4, $result);
    }
    
    public function testComplexCalculation() {
        $result = Calculator::calculate("10 + 3 * 2 - 4");
        
        $this->assertEquals(12, $result);
    }
    
    public function testDecimalNumbers() {
        $result = Calculator::calculate("0.5 + 1.2");
        
        $this->assertEquals(1.7, $result);
    }
}
