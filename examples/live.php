<?php

require_once("../src/AbstractExchangeRates/autoload.php");

use Abstractapi\ExchangeRates\AbstractExchangeRates;


AbstractExchangeRates::configure($api_key = "YOUR_API_KEY");

$info = AbstractExchangeRates::live('EUR');


echo "<pre>";
print_r($info);
echo "</pre>";

echo $info->base;
echo "</br>";
echo var_export($info->last_updated);
echo "</br>";
echo var_export($info->exchange_rates);