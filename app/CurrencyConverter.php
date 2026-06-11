<?php

namespace App;



use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class CurrencyConverter
{
    protected string $apiUrl;
    public  function __construct()
    {
       $this->apiUrl = config('services.nbg.url');

    }
    public function getRates(): array
    {
        return Cache::remember('nbg_rates', now()->endOfDay(), function () {

            $today = now()->format('Y-m-d');

            $response = Http::get($this->apiUrl, ['date' => $today]);

            if ($response->successful() && isset($response->json()[0]['currencies'])) {
                $rawCurrencies = $response->json()[0]['currencies'];
                $result = [];

                foreach ($rawCurrencies as $currency) {
                    $result[$currency["code"]] = $currency["rate"];
                }
                return $result;
            }
            return [];

        });
    }
}

