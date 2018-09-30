<?php

declare(strict_types = 1);

namespace byrokrat\checkdigit;

trait AssertionsTrait
{
    /**
     * Assert that $number contains only numerical characters
     *
     * @throws InvalidStructureException If $number is not numerical
     */
    protected function assertNumber(string $number): void
    {
        if (!ctype_digit($number)) {
            throw new InvalidStructureException(
                "Number can only contain numerical characters, found <$number>"
            );
        }
    }
}
