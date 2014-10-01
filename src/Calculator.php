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
 * Base calculator interface
 *
 * @author Hannes Forsgård <hannes.forsgard@fripost.org>
 */
interface Calculator
{
    /**
     * Check if number contains valid check digit(s)
     *
     * @param  string  $number
     * @return boolean
     * @throws InvalidStructureException If $number is not valid
     */
    public function isValid($number);

    /**
     * Calculate the check digit(s) for number
     *
     * @param  string $number
     * @return string
     * @throws InvalidStructureException If $number is not valid
     */
    public function calculateCheckDigit($number);
}
