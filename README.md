# PayConn

**An easy to use, consistent payment processing library for PHP 5.5+**

[![Build Status](https://api.travis-ci.org/payconn/php-sdk.png?branch=master)](https://travis-ci.org/payconn/php-sdk)
[![Latest Stable Version](https://poser.pugx.org/payconn/php-sdk/v/stable)](https://packagist.org/packages/payconn/php-sdk)
[![Total Downloads](https://poser.pugx.org/payconn/php-sdk/downloads)](https://packagist.org/packages/payconn/php-sdk)

## Installation

PayConn is installed via [Composer](https://getcomposer.org/). For most uses, you will need to require an individual gateway:

```
composer require payconn/php-sdk
```

## Payment Gateways

The following gateways are available:

Gateway | Purchase | Cancel | Refund | Query | 3D
--- | --- | --- | --- | --- | ---
[iyzico](https://github.com/payconn/php-sdk) | :white_check_mark: | :white_check_mark: | :white_check_mark: | :white_check_mark: | :white_check_mark:
[Ak Bank (NestPay)](https://github.com/payconn/php-sdk) | :white_check_mark: | :white_check_mark: | :white_check_mark: | :ballot_box_with_check: | :ballot_box_with_check:

