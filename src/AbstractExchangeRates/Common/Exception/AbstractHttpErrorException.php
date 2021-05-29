<?php

namespace Abstractapi\ExchangeRates\Common\Exception;

final class AbstractHttpErrorException extends AbstractException
{
    /**
     * Error description.
     *
     * @var string
     */
    public $code;

    /**
     * Error description.
     *
     * @var int
     */
    public $http_code;

     /**
     * Details.
     *
     * @var array
     */
    public $details;

    public function __construct($message, $code, $http_code, $details, Throwable $previous = null) {
        parent::__construct($message, $http_code, $previous);

        $this->code= $code;
        $this->http_code = $http_code;
        $this->details = $details;

    }
}
