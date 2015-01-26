<?php

namespace byrokrat\checkdigit;

/**
 * Base calculator interface
 */
interface Calculator
{
    /**
     * Check if number contains valid check digit
     *
     * @param  string $number
     * @return bool
     * @throws InvalidStructureException If $number is not valid
     */
    public function isValid($number);

    /**
     * Calculate the check digit for number
     *
     * @param  string $number
     * @return string
     * @throws InvalidStructureException If $number is not valid
     */
    public function calculateCheckDigit($number);
}
