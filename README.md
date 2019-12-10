# Checkdigit

[![Packagist Version](https://img.shields.io/packagist/v/byrokrat/checkdigit.svg?style=flat-square)](https://packagist.org/packages/byrokrat/checkdigit)
[![Build Status](https://img.shields.io/travis/byrokrat/checkdigit/master.svg?style=flat-square)](https://travis-ci.org/byrokrat/checkdigit)
[![Quality Score](https://img.shields.io/scrutinizer/g/byrokrat/checkdigit.svg?style=flat-square)](https://scrutinizer-ci.com/g/byrokrat/checkdigit)
[![Scrutinizer Coverage](https://img.shields.io/scrutinizer/coverage/g/byrokrat/checkdigit.svg?style=flat-square)](https://scrutinizer-ci.com/g/byrokrat/checkdigit/?branch=master)

Helper classes to calculate and validate ckecksums.

Installation
------------
```shell
composer require byrokrat/checkdigit
```

Checkdigit requires the [bcmath](http://php.net/manual/en/book.bc.php) php extension.

API
---
The [`Calculator`](/src/Calculator.php) interface defines two methods:

 * `isValid(string $number): bool` checks if number contains a valid check digit.
 * `calculateCheckDigit(string $number): string` calculates the check digit for number.

Implementations include:

 * [`Modulo10`](/src/Modulo10.php) and [`Luhn`](/src/Luhn.php) for modulo 10 check digits
   (Luhn is simply a shorthand for Modulo10).
 * [`Modulo10Gtin`](/src/Modulo10Gtin.php) for modulo 10 check digits variant used in GTIN barcodes.
 * [`Modulo11`](/src/Modulo11.php) for modulo 11 check digits.
 * [`Modulo97`](/src/Modulo97.php) for modulo 97 check digits.

Usage
-----
<!-- @expectOutput 11 -->
```php
$luhn = new byrokrat\checkdigit\Luhn;

// outputs '1' (true)
echo $luhn->isValid('55555551');

// outputs '' (false)
echo $luhn->isValid('55555550');

// outputs '1'
echo $luhn->calculateCheckDigit('5555555');
```
