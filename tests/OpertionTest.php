<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;

use App\Entity\Operation;

class OpertionTest extends TestCase
{
    private Operation $actual1, $actual2;
    
    protected function setUp(): void
    {
        $this->actual1 = (new Operation())
        ->setA(99.993)
        ->setB(13.9);
        
        $this->actual2 = (new Operation())
        ->setA(97)
        ->setB(9);
    }

    public function testAddition(): void{
        $actualAdd1 = $this->actual1->add();
        $expected1 = 113.893;
        $this->assertEquals($expected1, $actualAdd1);

        $actualAdd2 = $this->actual2->add();
        $expected2 = 106;
        $this->assertEquals($expected2, $actualAdd2);
    }

    public function testSubstraction(): void{
        $actualAdd1 = $this->actual1->substraction();
        $expected1 = 86.093;
        $this->assertEquals($expected1, $actualAdd1);

        $actualAdd2 = $this->actual2->substraction();
        $expected2 = 88;
        $this->assertEquals($expected2, $actualAdd2);
    }

    /*public function testMultiply(): void{
        $actualAdd1 = $this->actual1->multiply();
        $expected1 = 1389.9027;
        $this->assertEquals($expected1, $actualAdd1);

        $actualAdd2 = $this->actual2->multiply();
        $expected2 = 873;
        $this->assertEquals($expected2, $actualAdd2);
    }*/

    public function testDivide(): void{
        $actualAdd1 = $this->actual1->divide();
        $expected1 = 7.194;
        $this->assertEquals($expected1, $actualAdd1);

        $actualAdd2 = $this->actual2->divide();
        $expected2 = 10.778;
        $this->assertEquals($expected2, $actualAdd2);
    }
}
