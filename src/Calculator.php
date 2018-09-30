<?php

namespace byrokrat\checkdigit;

interface Calculator
{
    /**
     * Check if number contains valid check digit
     *
     * @throws InvalidStructureException If $number is not valid
     */
    public function isValid(string $number): bool;

    /**
     * Calculate the check digit for number
     *
     * @throws InvalidStructureException If $number is not valid
     */
    public function calculateCheckDigit(string $number): string;
}
