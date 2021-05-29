<?php

namespace Abstractapi\ExchangeRates\DomainObject;

use Abstractapi\ExchangeRates\Common\Extension\StringExtension;

class ExchangeConvertData
{
    /**
     * Will map succes request result to ExchangeConvertData
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
     * The value for "target" that was entered into the request.
     *
     * @var string
     */
    public $target;

    /**
     *
     * @var string
     */
    public $date;

    /**
     *
     * @var float
     */
    public $base_amount;

    /**
     *
     * @var float
     */
    public $converted_amount;

    /**
     *
     * @var float
     */
    public $exchange_rate;
}