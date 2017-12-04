<?php

declare(strict_types = 1);

namespace byrokrat\checkdigit;

/**
 * Modulo11 calculator
 */
class Modulo11 implements Calculator
{
    /**
     * @var array Map modulo 11 remainder to check digit
     */
    private static $remainderToCheck = [
        0 => '0',
        1 => '1',
        2 => '2',
        3 => '3',
        4 => '4',
        5 => '5',
        6 => '6',
        7 => '7',
        8 => '8',
        9 => '9',
        10 => 'X',
        11 => '0',
    ];

    /**
     * Check if the last digit of number is a valid modulo 11 check digit
     *
     * @throws InvalidStructureException If $number is not valid
     */
    public function isValid(string $number): bool
    {
        if (!preg_match("/^\d*(X|\d){1}$/", $number)) {
            throw new InvalidStructureException(
                "Number must consist of characters 0-9 and optionally end with X"
            );
        }

        $sum = 0;

        foreach (array_reverse(str_split($number)) as $pos => $digit) {
            $digit = ($digit == 'X') ? 10 : $digit;
            $sum += $digit * $this->getWeight($pos);
        }

        // If remainder is 0 check digit is valid
        return $sum % 11 === 0;
    }

    /**
     * Calculate the modulo 11 check digit for number
     *
     * @throws InvalidStructureException If $number is not numerical
     */
    public function calculateCheckDigit(string $number): string
    {
        if (!ctype_digit($number)) {
            throw new InvalidStructureException("Number must consist of characters 0-9");
        }

        $sum = 0;

        foreach (array_reverse(str_split($number)) as $pos => $digit) {
            $sum += $digit * $this->getWeight($pos, 2);
        }

        // Calculate check digit from remainder
        return self::$remainderToCheck[11 - $sum % 11];
    }

    /**
     * Calculate weight based on position in number
     *
     * @param  int $pos   Position in number (starts from 0)
     * @param  int $start Start value for weight calculation (value of position 0)
     * @return int
     */
    protected function getWeight(int $pos, int $start = 1): int
    {
        $pos += $start;

        while ($pos > 10) {
            $pos -= 10;
        }

        return $pos;
    }
}
