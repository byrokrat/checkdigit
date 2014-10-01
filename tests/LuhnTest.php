<?php

namespace ledgr\checkdigit;

class LuhnTest extends \PHPUnit_Framework_TestCase
{
    public function testIsValid()
    {
        $this->assertTrue((new Luhn)->isValid('55555551'));
    }

    public function testCalculateCheckDigit()
    {
        $this->assertSame(
            '1',
            (new Luhn)->calculateCheckDigit('5555555')
        );
    }
}
