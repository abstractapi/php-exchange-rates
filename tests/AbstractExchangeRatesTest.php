<?php

namespace Abstractapi\ExchangeRates\Tests;

use PHPUnit\Framework\TestCase;
use Abstractapi\ExchangeRates\AbstractExchangeRates;
use Abstractapi\ExchangeRates\Common\Exception\InvalidArgumentException;

class AbstractExchangeRatesTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testInvalidAPIKey()
    {
        $this->expectException('\Exception');
        AbstractExchangeRates::configure('');
    }

      /**
     * @throws \Exception
     */
    public function testInstantiation()
    {
        $API_KEY = getenv('EXCHANGE_RATES_API_KEY');

        AbstractExchangeRates::configure($API_KEY);

        $this->assertSame('https://exchange-rates.abstractapi.com/v1', AbstractExchangeRates::getApiEndpoint());

        $this->assertFalse(AbstractExchangeRates::success());

        $this->assertFalse(AbstractExchangeRates::getLastError());

        $this->assertSame(array('headers' => null, 'body' => null), AbstractExchangeRates::getLastResponse());

        $this->assertSame(array(), AbstractExchangeRates::getLastRequest());
    }

    public function testLiveResponseState()
    {
        $API_KEY = getenv('EXCHANGE_RATES_API_KEY');

        AbstractExchangeRates::configure($API_KEY);

        $base = 'EUR';

        $info = AbstractExchangeRates::live($base);

        $this->assertTrue(AbstractExchangeRates::success());

        $this->assertEquals($base, $info->base);

        sleep(1);
    }

    public function testLiveArgValidation()
    {
        $this->expectException('Abstractapi\ExchangeRates\Common\Exception\InvalidArgumentException');
        AbstractExchangeRates::live('');
    }

    public function testHistoricalResponseState()
    {
        $API_KEY = getenv('EXCHANGE_RATES_API_KEY');

        AbstractExchangeRates::configure($API_KEY);

        $base = 'EUR';
        $date = '2021-05-01';

        $info = AbstractExchangeRates::historical($base, $date);

        $this->assertTrue(AbstractExchangeRates::success());

        $this->assertEquals($base, $info->base);
        $this->assertEquals($date, $info->date);

        sleep(1);
    }

    public function testHistoricalArgValidation1()
    {
        $this->expectException('Abstractapi\ExchangeRates\Common\Exception\InvalidArgumentException');
        AbstractExchangeRates::historical('EUR', '');
    }

    public function testHistoricalArgValidation2()
    {
        $this->expectException('Abstractapi\ExchangeRates\Common\Exception\InvalidArgumentException');
        AbstractExchangeRates::historical('', '2021-05-01');
    }

    public function testConvertResponseState()
    {
        $API_KEY = getenv('EXCHANGE_RATES_API_KEY');

        AbstractExchangeRates::configure($API_KEY);

        $base = 'EUR';
        $target = 'USD';

        $info = AbstractExchangeRates::convert($base, $target);

        $this->assertTrue(AbstractExchangeRates::success());

        $this->assertEquals($base, $info->base);
        $this->assertEquals($target, $info->target);

        sleep(1);
    }

    public function testConvertArgValidation1()
    {
        $this->expectException('Abstractapi\ExchangeRates\Common\Exception\InvalidArgumentException');
        AbstractExchangeRates::convert('EUR', '');
    }

    public function testConvertArgValidation2()
    {
        $this->expectException('Abstractapi\ExchangeRates\Common\Exception\InvalidArgumentException');
        AbstractExchangeRates::convert('', 'USD');
    }
}