<?php
namespace Abstractapi\ExchangeRates\Common;

use Abstractapi\ExchangeRates\Common\Extension\StringExtension;
use Abstractapi\ExchangeRates\Common\Exception\InvalidArgumentException;
use Abstractapi\ExchangeRates\Common\Exception\AbstractHttpErrorException;
use Abstractapi\ExchangeRates\Common\Exception\EndpointNotConfiguredException;

class AbstractEndpointBase
{
    /**
     * @var AbstractHttpClient  $abstractapi HttpClient for make HTTP requests to API.
     */
    private static $abstractHttpClient = null;

    /**
     * Configure API.
     *
     * @param string $api_key This is your private API key, specific to the this API.
     *
     * @throws  InvalidArgumentException
     */
    protected static function configureEndpoint($api_endpoint, $api_key)
    {
        if(StringExtension::isNullOrEmpty($api_endpoint))
        {
            throw new InvalidArgumentException("API endpoint can't be null or empty.");
        }

        if(StringExtension::isNullOrEmpty($api_key)){
            throw new InvalidArgumentException("API key can't be null or empty.");
        }

        self::$abstractHttpClient = new AbstractHttpClient($api_endpoint, $api_key);
    }


     /**
     * Was the last request successful?
     *
     * @return bool  True for success, false for failure
     */
    public static function success()
    {
        return self::client()->success();
    }

    /**
     * Get the last error returned by either the network transport, or by the API.
     * If something didn't work, this should contain the string describing the problem.
     *
     * @return  string|false  describing the error
     */
    public static function getLastError()
    {
        return self::client()->getLastError();
    }

    /**
     * Get an array containing the HTTP headers and the body of the API response.
     *
     * @return array  Assoc array with keys 'headers' and 'body'
     */
    public static function getLastResponse()
    {
        return self::client()->getLastResponse();
    }

    /**
     * Get an array containing the HTTP headers and the body of the API request.
     *
     * @return array  Assoc array
     */
    public static function getLastRequest()
    {
        return self::client()->getLastRequest();
    }

    /**
     * @return string The url to the API endpoint
     */
    public static function getApiEndpoint(){
        return self::client()->getApiEndpoint();
    }

    /**
     *
     * @return  AbstractHttpClient
     *
     * @throws  EndpointNotConfiguredException
     */
    protected static function &client()
    {
        if(!self::is_configured()){
            throw new EndpointNotConfiguredException();
        }

        return self::$abstractHttpClient;
    }

    /**
     *
     */
    protected static function is_configured()
    {
        if(isset(self::$abstractHttpClient))
        {
            return true;
        }
        return false;
    }
}
