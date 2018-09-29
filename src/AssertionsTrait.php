<?php

declare(strict_types = 1);

namespace byrokrat\checkdigit;

trait AssertionsTrait
{
    /**
     * Validate number sructure, returns number if structure is valid
     *
     * @throws InvalidStructureException If $number is not numerical
     * @return void
     */
    protected function assertNumber(string $number)
    {
        if (!ctype_digit($number)) {
            throw new InvalidStructureException(
                "Number can only contain numerical characters, found <$number>"
            );
        }
    }
}
