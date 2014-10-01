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
 * Modulo11 calculator
 *
 * @author Hannes Forsgård <hannes.forsgard@fripost.org>
 */
class Modulo11 implements Calculator
{
    /**
     * Check if the last digit of number is a valid modulo 11 check digit
     */
    public function isValid($number)
    {
        if (!is_string($number) || !preg_match("/^[0-9]*X?$/", $number) || strlen($number) < 1) {
            throw new InvalidStructureException("Number must consist of characters 0-9 and optionally end with X");
        }

        $weight = 0;
        $pos = strlen($number);
        $sum = 0;

        while (true) {
            // Set string position
            $pos--;
            if ($pos < 0) {
                break;
            }
            // Set weight
            $weight++;
            if ($weight > 10) {
                $weight = 1;
            }
            // Add to sum
            $n = $number[$pos];
            if ($n == 'X') {
                $n = 10;
            }
            $sum += $n * $weight;
        }

        // If remainder is 0 check digit is valid
        return $sum % 11 === 0;
    }

    /**
     * Calculate the modulo 11 check digit for number
     */
    public function calculateCheckDigit($number)
    {
        if (!is_string($number) || !ctype_digit($number)) {
            throw new InvalidStructureException("Number must consist of characters 0-9");
        }

        $weight = 1;
        $pos = strlen($number);
        $sum = 0;

        while (true) {
            // Set string position
            $pos--;
            if ($pos < 0) {
                break;
            }
            // Set weight
            $weight++;
            if ($weight > 10) {
                $weight = 1;
            }
            // Add to sum
            $n = $number[$pos];
            $sum += $n * $weight;
        }

        // Calculate check digit from remainder
        $rest = $sum % 11;
        $check = 11 - $rest;
        $check = (string)$check;

        if ($check == '10') {
            $check = 'X';
        }

        if ($check == '11') {
            $check = '0';
        }

        return $check;
    }
}
