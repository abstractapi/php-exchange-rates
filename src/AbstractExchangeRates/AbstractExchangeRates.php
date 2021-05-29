<?php

namespace Abstractapi\ExchangeRates;

use Abstractapi\ExchangeRates\Common\AbstractEndpointBase;
use Abstractapi\ExchangeRates\Common\Extension\StringExtension;
use Abstractapi\ExchangeRates\DomainObject\ExchangeConvertData;
use Abstractapi\ExchangeRates\DomainObject\ExchangeHistoricalData;
use Abstractapi\ExchangeRates\DomainObject\ExchangeLiveData;
use Abstractapi\ExchangeRates\Common\DomainObject\HttpErrorDetail;
use Abstractapi\ExchangeRates\Common\Exception\InvalidArgumentException;
use Abstractapi\ExchangeRates\Common\Exception\AbstractHttpErrorException;

/**
 * Exchange Rates
 */
class AbstractExchangeRates extends AbstractEndpointBase
{
    /**
     * @var string api_endpoint Exchange Rates API endpoint.
     */
    const API_ENDPOINT = "https://exchange-rates.abstractapi.com/v1";

    /**
     * Configure Exchange Rates API.
     *
     * @param string $api_key This is your private API key, specific to the Exchange Rates API.
     */
    public static function configure($api_key)
    {
        parent::configureEndpoint(self::API_ENDPOINT, $api_key);
    }

    /**
     * Make an HTTP GET request to Abstract's Exchange Rates live API,
     * for retrieving all available rates about a specified currency.
     *
     * @param   string  $base           The base currency
     * @param   string  $target         (optional) the list of target currencies
     * @return  ExchangeLiveData
     *
     * @throws  InvalidArgumentException
     * @throws  AbstractHttpErrorException
     */
    public static function live($base, $target = false)
    {
        // Ensures that the base parameter is not empty.
        if (StringExtension::isNullOrEmpty($base)) {
            throw new InvalidArgumentException("Base is a required argument.");
        }

        // Will make a GET request for exchange rates.
        $args = ['base' => $base];
        if ($target) {
            $args['target'] = $target;
        }

        $result = parent::client()->get(
            'live/',
            $args
        );

        // Will check the status of the request response,
        // if successful returns a filled ExchangeLiveData.
        if (parent::client()->success()) {
            return new ExchangeLiveData($result);
        }

        $resp = self::client()->getLastResponse();

        // Get the status code of the last request.
        $http_status_code = $resp['headers']['http_code'];

        // When there is no network or the wrong endpoint address is set.
        if ($http_status_code === 0) {
            throw new \Exception("Check network connection.");
        }

        throw new AbstractHttpErrorException(
            $result['error']['message'],
            $result['error']['code'],
            $http_status_code,
            $result['error']['details']
        );
    }

    /**
     * Make an HTTP GET request to Abstract's Exchange Rates historical API,
     * for retrieving all available rates about a specified currency.
     *
     * @param   string  $base           The base currency
     * @param   string  $date           The date of the exchange rates
     * @param   string  $target         (optional) the list of target currencies
     * @return  ExchangeHistoricalData
     *
     * @throws  InvalidArgumentException
     * @throws  AbstractHttpErrorException
     */
    public static function historical($base, $date, $target = false)
    {
        // Ensures that the base and date parameters are not empty.
        if (StringExtension::isNullOrEmpty($base)) {
            throw new InvalidArgumentException("Base is a required argument.");
        }
        if (StringExtension::isNullOrEmpty($date)) {
            throw new InvalidArgumentException("Date is a required argument.");
        }

        // Will make a GET request for exchange rates.
        $args = [
            'base' => $base,
            'date' => $date
        ];
        if ($target) {
            $args['target'] = $target;
        }

        $result = parent::client()->get(
            'historical/',
            $args
        );

        // Will check the status of the request response,
        // if successful returns a filled ExchangeHistoricalData.
        if (parent::client()->success()) {
            return new ExchangeHistoricalData($result);
        }

        $resp = self::client()->getLastResponse();

        // Get the status code of the last request.
        $http_status_code = $resp['headers']['http_code'];

        // When there is no network or the wrong endpoint address is set.
        if ($http_status_code === 0) {
            throw new \Exception("Check network connection.");
        }

        throw new AbstractHttpErrorException(
            $result['error']['message'],
            $result['error']['code'],
            $http_status_code,
            $result['error']['details']
        );
    }

    /**
     * Make an HTTP GET request to Abstract's Exchange Rates convert API,
     * for retrieving all available rates about a specified convertion.
     *
     * @param   string  $base           The base currency
     * @param   string  $target         The target currency
     * @param   string  $date           (optional) the date of the exchange rates
     * @param   float   $base_amount    (optional) The amount of the base currency to convert
     * @return  ExchangeConvertData
     *
     * @throws  InvalidArgumentException
     * @throws  AbstractHttpErrorException
     */
    public static function convert($base, $target, $date = false, $base_amount = false)
    {
        // Ensures that the base and target parameters are not empty.
        if (StringExtension::isNullOrEmpty($base)) {
            throw new InvalidArgumentException("Base is a required argument.");
        }
        if (StringExtension::isNullOrEmpty($target)) {
            throw new InvalidArgumentException("Target is a required argument.");
        }

        // Will make a GET request for exchange rates.
        $args = [
            'base' => $base,
            'target' => $target
        ];
        if ($date) {
            $args['date'] = $date;
        }
        if ($base_amount) {
            $args['base_amount'] = $base_amount;
        }

        $result = parent::client()->get(
            'convert/',
            $args
        );

        // Will check the status of the request response,
        // if successful returns a filled ExchangeConvertData.
        if (parent::client()->success()) {
            return new ExchangeConvertData($result);
        }

        $resp = self::client()->getLastResponse();

        // Get the status code of the last request.
        $http_status_code = $resp['headers']['http_code'];

        // When there is no network or the wrong endpoint address is set.
        if ($http_status_code === 0) {
            throw new \Exception("Check network connection.");
        }

        throw new AbstractHttpErrorException(
            $result['error']['message'],
            $result['error']['code'],
            $http_status_code,
            $result['error']['details']
        );
    }
}
