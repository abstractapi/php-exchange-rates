# AbstractAPI php-exchange-rates library

Integrate the powerful [Exchange Rates API from Abstract](https://www.abstractapi.com/exchange-rate-api) in your PHP project in a few lines of code.

The Exchange Rate API is an REST API that allows you to:

- look up the latest exchange rates for 80+ currencies via the *live* endpoint
- get historical exchange rates using the *historical* endpoint
- convert an arbitrary amount from one currency to another using the *convert* endpoint

It's very simple to use: you only need to submit your API key and a currency symbol (such as "USD"), and the API will respond with current exchange rate, historical data, or convertion rates.

# Documentation

## Supported PHP Versions

This library supports the **PHP version 5.6** and higher.

## Installation

You can install **php-exchange-rates** via composer or by downloading the source.

### Via Composer:

**php-exchange-rates** is available on Packagist as the
[`abstractapi/php-exchange-rates`](https://packagist.org/packages/abstractapi/php-exchange-rates) package:

```bash
composer require abstractapi/php-exchange-rates
```

## API key

Get your API key for free and without hassle from the [Abstact website](https://app.abstractapi.com/users/signup?target=/api/exchange-rates/pricing/select).

## Quickstart

### Verify email

```php
<?php
$api_key = "YYYYYY"; // Get your API Key from https://app.abstractapi.com/api/exchange-rates/documentation

Abstractapi\ExchangeRates\AbstractExchangeRates::configure($api_key);

// Get live exchange rates using Abstract's Exchange Rates API and PHP
$info = Abstractapi\ExchangeRates\AbstractExchangeRates::live('EUR');
var_dump($info);

// Get historical exchange rates using Abstract's Exchange Rates API and PHP
$info = Abstractapi\ExchangeRates\AbstractExchangeRates::historical('EUR', '2021-05-01');
var_dump($info);

// Convert currency using Abstract's Exchange Rates API and PHP
$info = Abstractapi\ExchangeRates\AbstractExchangeRates::convert('EUR', 'USD');
var_dump($info);
```

## API response

The API response contains the following fields:

### `live` response parameters
| Parameter| Type| Details |
| - | - | - |
| base | String | The base currency used to get the exchange rates. |
| last_updated | String | The Unix timestamp of when the returned data was last updated. |
| exchange_rates | Object | A JSON Object containing each of the target currency as the key and its exchange rate versus the base currency as that key's value. |

### `historical` response parameters

| Parameter | Type | Details |
| - | - | - |
| base | String | The base currency used to get the exchange rates. |
| date | String | The date the currencies were pulled from, per the successful request. |
| exchange_rates | Object | A JSON Object containing each of the target currency as the key and its exchange rate versus the base currency as that key's value. |

### `convert` response parameters

| Parameter | Type | Details |
| - | - | - |
| base | String | The base currency used to get the exchange rates. |
| target | String | The target currency that the base_amount was converted into. |
| date | String | The date the currencies were pulled from, per the successful request. |
| base_amount | Float | The amount of the base currency from the request. |
| converted_amount | Float | The amount of the target currency that the base_amount has been converted into |
| exchange_rate | Float | The exchange rate used to convert the base_amount from the base currency to the target currency |

## Detailed documentation

You will find additional information and request examples in the [Abstract help page](https://app.abstractapi.com/api/exchange-rates/documentation).

## Getting help

If you need help installing or using the library, please contact [Abstract's Support](https://app.abstractapi.com/api/exchange-rates/support).

For bug report and feature suggestion, please use [this repository issues page](https://github.com/abstractapi/php-exchange-rates/issues).

# Contribution

Contributions are always welcome, as they improve the quality of the libraries we provide to the community.

Please provide your changes covered by the appropriate unit tests, and post them in the [pull requests page](https://github.com/abstractapi/php-exchange-rates/pulls).

## Composer

To work on the source code, you need to install composer on your local computer. At the time of writing, the latest version of composer is v2.0.12. The installation instructions can be found here: https://getcomposer.org/download/.

## Setup

To install the requirements, run:

```bash
composer install --prefer-source --no-interaction --ignore-platform-reqs
```

Once you implementer all your changes and the unit tests, run the following command to run the tests:

```bash
php vendor/bin/phpunit
```
