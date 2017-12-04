<?php

namespace byrokrat\checkdigit;

/**
 * Base calculator interface
 */
interface Calculator
{
    /**
     * Check if number contains valid check digit
     */
    public function isValid(string $number): bool;

    /**
     * Calculate the check digit for number
     */
    public function calculateCheckDigit(string $number): string;
}
