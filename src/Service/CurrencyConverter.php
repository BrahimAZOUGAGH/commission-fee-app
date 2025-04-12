<?php

namespace App\Service;

use GuzzleHttp\Client;

class CurrencyConverter
{
    protected string $exchangeApiKey = 'bef887d80582c7a7f20391dc3b34ae1e';
    protected array $rates;

    public function __construct()
    {
        $this->rates = $this->fetchRates();
    }

    public function convertToEUR(float $amount, string $currency): float
    {
        return $amount / $this->rates[$currency];
    }

    public function convertFromEUR(float $amount, string $currency): float
    {
        return $amount * $this->rates[$currency];
    }

    protected function fetchRates(): array
    {
        $client = new Client();
        $response = $client->get("https://api.exchangeratesapi.io/latest?access_key={$this->exchangeApiKey}");
        $data = json_decode($response->getBody()->getContents(), true);

        return $data['rates'];
    }
}
