<?php

declare(strict_types = 1);

namespace byrokrat\checkdigit;

/**
 * Modulo10 calculator, variant used for GTIN (EAN, UPC, ISBN-13, JAN and ITF) barcodes
 */
class Modulo10Gtin implements Calculator
{
    /**
     * Check if the last digit of number is a valid modulo 10 check digit
     */
    public function isValid(string $number): bool
    {
        return substr($number, -1) === $this->calculateCheckDigit(substr($number, 0, -1) ?: '');
    }

    /**
     * Calculate the modulo 10 check digit for number
     *
     * @throws InvalidStructureException If $number is not numerical
     */
    public function calculateCheckDigit(string $number): string
    {
        if (!ctype_digit($number)) {
            throw new InvalidStructureException(
                "Number can only contain numerical characters, found <$number>"
            );
        }

        $weight = 3;
        $sum = 0;

        foreach (array_reverse(str_split($number)) as $pos => $digit) {
            $sum += $digit * ($pos % 2 ? 1 : $weight);
        }

        $ceil = $sum;

        while ($ceil % 10 != 0) {
            $ceil++;
        }

        return (string)($ceil-$sum);
    }
}
