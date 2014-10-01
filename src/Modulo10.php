<?php
/**
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the Do What The Fuck You Want
 * To Public License, Version 2, as published by Sam Hocevar. See
 * http://www.wtfpl.net/ for more details.
 */

namespace ledgr\checkdigit;

/**
 * Modulo10 calculator
 *
 * @author Hannes Forsgård <hannes.forsgard@fripost.org>
 */
class Modulo10 implements Calculator
{
    /**
     * Check if the last digit of number is a valid modulo 10 check digit
     */
    public function isValid($number)
    {
        return substr($number, -1) === $this->calculateCheckDigit(substr($number, 0, -1));
    }

    /**
     * Calculate the modulo 10 check digit for number
     */
    public function calculateCheckDigit($number)
    {
        if (!ctype_digit($number)) {
            throw new InvalidStructureException(
                "Number can only contain numerical characters, using <$number>"
            );
        }

        $weight = 2;
        $sum = 0;

        for ($pos=strlen($number)-1; $pos>=0; $pos--) {
            $tmp = $number[$pos] * $weight;
            $sum += ($tmp > 9) ? (1 + ($tmp % 10)) : $tmp;
            $weight = ($weight == 2) ? 1 : 2;
        }

        $ceil = $sum;

        while ($ceil % 10 != 0) {
            $ceil++;
        }

        return (string)($ceil-$sum);
    }
}
