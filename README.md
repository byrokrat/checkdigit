# ledgr/checkdigit

[![Latest Stable Version](https://poser.pugx.org/ledgr/checkdigit/v/stable.png)](https://packagist.org/packages/ledgr/checkdigit)
[![Build Status](https://travis-ci.org/ledgr/checkdigit.svg?branch=1.0.0)](https://travis-ci.org/ledgr/checkdigit)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/ledgr/checkdigit/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/ledgr/checkdigit/?branch=master)

Helper classes to calculate and validate checkdigits.

> Install using [composer](http://getcomposer.org/). Exists as **ledgr/checkdigit** in
> the packagist repository.

Api
---
The [`Calculator`](/src/Calculator.php) interface defines two methods:

 * `isValid(string $number) : bool` checks if number contains a valid check digit
 * `calculateCheckDigit(string $number) : string` calculates the check digit for number

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
