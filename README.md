Checkdigit
==========

[![Packagist Version](https://img.shields.io/packagist/v/byrokrat/checkdigit.svg?style=flat-square)](https://packagist.org/packages/byrokrat/checkdigit)
[![Build Status](https://img.shields.io/travis/byrokrat/checkdigit/master.svg?style=flat-square)](https://travis-ci.org/byrokrat/checkdigit)
[![Quality Score](https://img.shields.io/scrutinizer/g/byrokrat/checkdigit.svg?style=flat-square)](https://scrutinizer-ci.com/g/byrokrat/checkdigit)
[![Dependency Status](https://img.shields.io/gemnasium/byrokrat/checkdigit.svg?style=flat-square)](https://gemnasium.com/byrokrat/checkdigit)

Helper classes to calculate and validate ckecksums.

Installation
------------
Install using [composer](http://getcomposer.org/). Exists as
[byrokrat/checkdigit](https://packagist.org/packages/byrokrat/checkdigit)
in the [packagist](https://packagist.org/) repository.

    composer require byrokrat/checkdigit

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
use byrokrat\checkdigit\Luhn;
$luhn = new Luhn();
$luhn->isValid('55555551');            // true
$luhn->isValid('55555550');            // false
$luhn->calculateCheckDigit('5555555'); // '1'
```

Credits
-------
Checkdigit is covered under the [WTFPL](http://www.wtfpl.net/).

@author Hannes Forsgård (hannes.forsgard@fripost.org)
