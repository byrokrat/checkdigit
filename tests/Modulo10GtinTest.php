<?php

declare(strict_types = 1);

namespace byrokrat\checkdigit;

class Modulo10GtinTest extends \PHPUnit\Framework\TestCase
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
        $this->expectException(InvalidStructureException::CLASS);
        (new Modulo10Gtin)->isValid($number);
    }

    /**
     * @dataProvider invalidStructureProvider
     */
    public function testInvalidStructureCalculateCheckDigit($number)
    {
        $this->expectException(InvalidStructureException::CLASS);
        (new Modulo10Gtin)->calculateCheckDigit($number);
    }

    public function testIsValid()
    {
        $modulo10 = new Modulo10Gtin;
        $this->assertTrue($modulo10->isValid('5701872203005'));//EAN-13
        $this->assertTrue($modulo10->isValid('04210009'));//EAN-8
        $this->assertTrue($modulo10->isValid('4902179014290'));//JAN-13
        $this->assertTrue($modulo10->isValid('49012347'));//EAN-8
        $this->assertTrue($modulo10->isValid('98765432109213'));//ITF-14
        $this->assertTrue($modulo10->isValid('042100005264'));//UPC-A
        $this->assertTrue($modulo10->isValid('9780596528126'));//IBAN-13
        $this->assertFalse($modulo10->isValid('04252614'));//UPC-E (must first be expanded)
        $this->assertFalse($modulo10->isValid('0596528132'));//IBAN-10 (Modulo11)
    }

    public function testCalculateCheckDigit()
    {
        $modulo10 = new Modulo10Gtin;
        $this->assertSame('4', $modulo10->calculateCheckDigit('04210000526'));//Expaned UPC-8
        $this->assertSame('6', $modulo10->calculateCheckDigit('978059652812'));//Converted IBAN-10
    }
}
