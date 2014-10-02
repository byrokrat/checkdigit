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
 * Modulo97 calculator
 *
 * @author Hannes Forsgård <hannes.forsgard@fripost.org>
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
        if (!ctype_digit($number)) {
            throw new InvalidStructureException(
                "Number can only contain numerical characters, found <$number>"
            );
        }

        return bcmod($number, 97) === '1';
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
        if (!ctype_digit($number)) {
            throw new InvalidStructureException(
                "Number can only contain numerical characters, found <$number>"
            );
        }

        return (string)(98 - bcmod($number.'00', 97));
    }
}
