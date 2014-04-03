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
class Modulo10
{
    /**
     * Verify that the last digit of nr is a valid check digit
     *
     * @param  string                    $nr
     * @return bool
     * @throws InvalidStructureException If nr is not numerical
     */
    public static function verify($nr)
    {
        if (!is_string($nr) || !ctype_digit($nr)) {
            throw new InvalidStructureException("Number must consist of characters 0-9");
        }

        $check = substr($nr, -1);
        $nr = substr($nr, 0, strlen($nr)-1);

        return $check == self::getCheckDigit($nr);
    }

    /**
     * Calculate check digit for nr
     *
     * @param  string                    $nr
     * @return string
     * @throws InvalidStructureException If nr is not numerical
     */
    public static function getCheckDigit($nr)
    {
        if (!is_string($nr) || !ctype_digit($nr)) {
            throw new InvalidStructureException("Number must consist of characters 0-9");
        }

        $n = 2;
        $sum = 0;

        for ($i=strlen($nr)-1; $i>=0; $i--) {
            $tmp = $nr[$i] * $n;
            ($tmp > 9) ? $sum += 1 + ($tmp % 10) : $sum += $tmp;
            ($n == 2) ? $n = 1 : $n = 2;
        }

        $ceil = $sum;

        while ($ceil % 10 != 0) {
            $ceil++;
        }

        $check = $ceil-$sum;

        return (string)$check;
    }
}
