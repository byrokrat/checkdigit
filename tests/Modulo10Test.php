<?php

namespace byrokrat\checkdigit;

class Modulo10Test extends \PHPUnit_Framework_TestCase
{
    public function invalidStructureProvider()
    {
        return [
            ['y'],
            [''],
            ['12.12']
        ];
    }

    /**
     * @dataProvider invalidStructureProvider
     */
    public function testInvalidStructureIsValid($number)
    {
        $this->setExpectedException('byrokrat\checkdigit\InvalidStructureException');
        (new Modulo10())->isValid($number);
    }

    /**
     * @dataProvider invalidStructureProvider
     */
    public function testInvalidStructureCalculateCheckDigit($number)
    {
        $this->setExpectedException('byrokrat\checkdigit\InvalidStructureException');
        (new Modulo10())->calculateCheckDigit($number);
    }

    public function testIsValid()
    {
        $modulo10 = new Modulo10();
        $this->assertTrue($modulo10->isValid('55555551'));
        $this->assertTrue($modulo10->isValid('9912346'));
        $this->assertTrue($modulo10->isValid('9876543217'));
        $this->assertTrue($modulo10->isValid('49927398716'));
        $this->assertFalse($modulo10->isValid('55555550'));
        $this->assertFalse($modulo10->isValid('9912340'));
        $this->assertFalse($modulo10->isValid('9876543210'));
        $this->assertFalse($modulo10->isValid('49927398710'));
    }

    public function testCalculateCheckDigit()
    {
        $modulo10 = new Modulo10();
        $this->assertSame('1', $modulo10->calculateCheckDigit('5555555'));
        $this->assertSame('6', $modulo10->calculateCheckDigit('991234'));
        $this->assertSame('7', $modulo10->calculateCheckDigit('987654321'));
        $this->assertSame('6', $modulo10->calculateCheckDigit('4992739871'));
    }
}
