<?php

namespace App;



use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class CurrencyConverter
{
    protected string $apiUrl = 'https://nbg.gov.ge/gw/api/ct/monetarypolicy/currencies/en/json/';

    public function getRates(): array
    {
        $today = now() ->format('Y-m-d');

        $response = Http::get($this->apiUrl, ['date' => $today]);

        if($response->successful() && isset($response->json()[0]['currencies'])) {
            $rawCurrencies = $response->json()[0]['currencies'];
            $result = [];

            foreach ($rawCurrencies as $currency) {
                $result[$currency["code"]] = $currency["rate"];
//                cache::remember('currencies', 60, function () {
//                    return $this->result;
//                })
            }
             return $result;

        }
        return [];
    }


    }
