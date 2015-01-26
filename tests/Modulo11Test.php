<?php

namespace byrokrat\checkdigit;

class Modulo11Test extends \PHPUnit_Framework_TestCase
{
    public function invalidStructureProviderIsValid()
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
     * @dataProvider invalidStructureProviderIsValid
     */
    public function testInvalidStructureIsValid($number)
    {
        $this->setExpectedException('byrokrat\checkdigit\InvalidStructureException');
        (new Modulo11)->isValid($number);
    }

    public function testIsValid()
    {
        $modulo11 = new Modulo11();
        $this->assertTrue($modulo11->isValid('0365327'));
        $this->assertTrue($modulo11->isValid('3928444042'));
        $this->assertTrue($modulo11->isValid('0131391399'));
        $this->assertTrue($modulo11->isValid('007007013X'));
        $this->assertTrue($modulo11->isValid('013139139119'));
        $this->assertTrue($modulo11->isValid('0365300'));
        $this->assertFalse($modulo11->isValid('0365321'));
        $this->assertFalse($modulo11->isValid('3928444041'));
        $this->assertFalse($modulo11->isValid('0131391391'));
        $this->assertFalse($modulo11->isValid('0070070131'));
    }

    public function invalidStructureProviderCalculateCheckDigit()
    {
        return [
            ['y'],
            [''],
            ['X2'],
            ['123X'],
            ['1234.234']
        ];
    }

    /**
     * @dataProvider invalidStructureProviderCalculateCheckDigit
     */
    public function testInvalidStructureCalculateCheckDigit($number)
    {
        $this->setExpectedException('byrokrat\checkdigit\InvalidStructureException');
        (new Modulo11)->calculateCheckDigit($number);
    }

    public function testCalculateCheckDigit()
    {
        $modulo11 = new Modulo11();
        $this->assertSame('7', $modulo11->calculateCheckDigit('036532'));
        $this->assertSame('2', $modulo11->calculateCheckDigit('392844404'));
        $this->assertSame('9', $modulo11->calculateCheckDigit('013139139'));
        $this->assertSame('9', $modulo11->calculateCheckDigit('01313913911'));
        $this->assertSame('X', $modulo11->calculateCheckDigit('007007013'));
        $this->assertSame('0', $modulo11->calculateCheckDigit('036530'));
    }
}
