<?php

declare(strict_types = 1);

namespace byrokrat\checkdigit;

/**
 * Modulo97 calculator
 */
class Modulo97 implements Calculator
{
    use AssertionsTrait;

    /**
     * Check if the last two digits of number are valid modulo 97 check digits
     */
    public function isValid(string $number): bool
    {
        $this->assertNumber($number);
        return bcmod($number, '97') === '1';
    }

    /**
     * Calculate the modulo 97 check digits for number
     */
    public function calculateCheckDigit(string $number): string
    {
        $this->assertNumber($number);
        return (string)(98 - bcmod($number.'00', '97'));
    }
}
