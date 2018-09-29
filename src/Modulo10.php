<?php

declare(strict_types = 1);

namespace byrokrat\checkdigit;

/**
 * Modulo10 calculator
 */
class Modulo10 implements Calculator
{
    use AssertionsTrait;

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
        $this->assertNumber($number);

        $sum = $this->calculateSum($number);

        $ceil = $sum;

        while ($ceil % 10 != 0) {
            $ceil++;
        }

        return (string)($ceil-$sum);
    }

    protected function calculateSum(string $number): int
    {
        $weight = 2;
        $sum = 0;

        for ($pos=strlen($number)-1; $pos>=0; $pos--) {
            $tmp = $number[$pos] * $weight;
            $sum += ($tmp > 9) ? (1 + ($tmp % 10)) : $tmp;
            $weight = ($weight == 2) ? 1 : 2;
        }

        return $sum;
    }
}
