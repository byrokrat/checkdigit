<?php

namespace ledgr\checkdigit;

class Modulo97Test extends \PHPUnit_Framework_TestCase
{
    public function invalidStructureProvider()
    {
        return [
            ['y'],
            [''],
            ['1234x'],
            ['X2'],
            ['1234.234']
        ];
    }

    /**
     * @expectedException ledgr\checkdigit\InvalidStructureException
     * @dataProvider invalidStructureProvider
     */
    public function testInvalidStructureIsValid($number)
    {
        (new Modulo97)->isValid($number);
    }

    /**
     * @expectedException ledgr\checkdigit\InvalidStructureException
     * @dataProvider invalidStructureProvider
     */
    public function testInvalidStructureCalculateCheckDigit($number)
    {
        (new Modulo97)->calculateCheckDigit($number);
    }

    public function testIsValid()
    {
        $modulo97 = new Modulo97;
        $this->assertTrue($modulo97->isValid('80000800694930207677281474'));
        $this->assertTrue($modulo97->isValid('80000821499944458943281470'));
        $this->assertTrue($modulo97->isValid('80000815059942266959281422'));
        $this->assertFalse($modulo97->isValid('80000800694930207677281471'));
        $this->assertFalse($modulo97->isValid('80000821499944458943281471'));
        $this->assertFalse($modulo97->isValid('80000815059942266959281421'));
    }

    public function testCalculateCheckDigit()
    {
        $modulo97 = new Modulo97;
        $this->assertSame('74', $modulo97->calculateCheckDigit('800008006949302076772814'));
        $this->assertSame('70', $modulo97->calculateCheckDigit('800008214999444589432814'));
        $this->assertSame('22', $modulo97->calculateCheckDigit('800008150599422669592814'));
    }
}
