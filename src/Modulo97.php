<?php

namespace byrokrat\checkdigit;

/**
 * Modulo97 calculator
 */
class Modulo97 implements Calculator
{
    /**
     * Check if the last two digits of number are valid modulo 97 check digits
     *
     * @param  string $number
     * @return bool
     * @throws InvalidStructureException If $number is not valid
     */
    public function isValid($number)
    {
        return bcmod($this->readNumber($number), 97) === '1';
    }

    /**
     * Calculate the modulo 97 check digits for number
     *
     * @param  string $number
     * @return string
     * @throws InvalidStructureException If $number is not valid
     */
    public function calculateCheckDigit($number)
    {
        return (string)(98 - bcmod($this->readNumber($number).'00', 97));
    }

    /**
     * Validate number sructure, returns number if structure is valid
     *
     * @param  string $number
     * @return string
     * @throws InvalidStructureException If $number is not valid
     */
    private function readNumber($number)
    {
        if (!ctype_digit($number)) {
            throw new InvalidStructureException(
                "Number can only contain numerical characters, found <$number>"
            );
        }
        return $number;
    }
}
