<?php

namespace Abstractapi\ExchangeRates\DomainObject;

use Abstractapi\ExchangeRates\Common\Extension\StringExtension;

class ExchangeHistoricalData
{
    /**
     * Will map succes request result to ExchangeHistoricalData
     *
     * @param array $succesResult
     */
    public function __construct(array $succesResult = [])
    {
        foreach ($succesResult as $key => $val) {
            if (property_exists(__CLASS__, $key)) {
                    $this->$key = $val;
            }
        }
    }

    /**
     * The value for "base" that was entered into the request.
     *
     * @var string
     */
    public $base;

    /**
     *
     * @var string
     */
    public $date;

    /**
     *
     * @var array
     */
    public $exchange_rates;
}