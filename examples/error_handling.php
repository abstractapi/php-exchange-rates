<?php

require_once("../src/AbstractExchangeRates/autoload.php");

use Abstractapi\ExchangeRates\AbstractExchangeRates;
use Abstractapi\ExchangeRates\Common\Exception\AbstractHttpErrorException;

AbstractExchangeRates::configure($api_key = "YOUR_API_KEY");

try
{
    $info = AbstractExchangeRates::live('EUR');
}
catch (AbstractHttpErrorException $e)
{
    echo "Message:          ". $e->getMessage().     "; <br>";
    echo "Code:             ". $e->code.             "; <br>";
    echo "HttpStatusCode:   ". $e->http_code. "; <br>";
    echo "Details:          ";
    print_r($e->details);

    echo "<pre>";
    print_r(AbstractExchangeRates::getLastResponse());
    echo "</pre>";
}
catch (InvalidArgumentException $e)
{
    // Handle somehow
}
