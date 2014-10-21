# ledgr/checkdigit

[![Packagist Version](https://img.shields.io/packagist/v/ledgr/checkdigit.svg?style=flat-square)](https://packagist.org/packages/ledgr/checkdigit)
[![Build Status](https://img.shields.io/travis/ledgr/checkdigit/master.svg?style=flat-square)](https://travis-ci.org/ledgr/checkdigit)
[![Quality Score](https://img.shields.io/scrutinizer/g/ledgr/checkdigit.svg?style=flat-square)](https://scrutinizer-ci.com/g/ledgr/checkdigit)
[![Dependency Status](https://img.shields.io/gemnasium/ledgr/checkdigit.svg?style=flat-square)](https://gemnasium.com/ledgr/checkdigit)

Helper classes to calculate and validate checkdigits.

> Install using **[composer](http://getcomposer.org/)**. Exists as
> **[ledgr/checkdigit](https://packagist.org/packages/ledgr/checkdigit)**
> in the **[packagist](https://packagist.org/)** repository.


Api
---
The [`Calculator`](/src/Calculator.php) interface defines two methods:

 * `isValid(string $number) : bool` checks if number contains a valid check digit.
 * `calculateCheckDigit(string $number) : string` calculates the check digit for number.

Implementations include:

 * [`Modulo10`](/src/Modulo10.php) and [`Luhn`](/src/Luhn.php) for modulo 10 check digits
   (Luhn is simply a shorthand for Modulo10).
 * [`Modulo11`](/src/Modulo11.php) for modulo 11 check digits.
 * [`Modulo97`](/src/Modulo97.php) for modulo 97 check digits.

Usage
-----
```php
use ledgr\checkdigit\Luhn;
$luhn = new Luhn();
$luhn->isValid('55555551');            // true
$luhn->isValid('55555550');            // false
$luhn->calculateCheckDigit('5555555'); // '1'
```
