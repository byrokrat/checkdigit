<?php

declare(strict_types = 1);

namespace byrokrat\checkdigit;

/**
 * Exception thrown if the structure of the processed number is invalid
 */
class InvalidStructureException extends \InvalidArgumentException implements Exception
{
}
