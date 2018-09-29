<?php

declare(strict_types = 1);

namespace byrokrat\checkdigit;

/**
 * Modulo10 calculator, variant used for GTIN (EAN, UPC, ISBN-13, JAN and ITF) barcodes
 */
class Modulo10Gtin extends Modulo10
{
    protected function calculateSum(string $number): int
    {
        $sum = 0;

        foreach (array_reverse(str_split($number)) as $pos => $digit) {
            $sum += $digit * ($pos % 2 ? 1 : 3);
        }

        return $sum;
    }
}
