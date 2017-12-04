<?php

declare(strict_types = 1);

namespace byrokrat\checkdigit;

/**
 * Modulo97 calculator
 */
class Modulo97 implements Calculator
{
    /**
     * Check if the last two digits of number are valid modulo 97 check digits
     *
     * @throws InvalidStructureException If $number is not numerical
     */
    public function isValid(string $number): bool
    {
        return bcmod($this->readNumber($number), '97') === '1';
    }

    /**
     * Calculate the modulo 97 check digits for number
     *
     * @throws InvalidStructureException If $number is not numerical
     */
    public function calculateCheckDigit(string $number): string
    {
        return (string)(98 - bcmod($this->readNumber($number).'00', '97'));
    }

    /**
     * Validate number sructure, returns number if structure is valid
     *
     * @throws InvalidStructureException If $number is not numerical
     */
    private function readNumber(string $number): string
    {
        if (!ctype_digit($number)) {
            throw new InvalidStructureException(
                "Number can only contain numerical characters, found <$number>"
            );
        }

        return $number;
    }
}
