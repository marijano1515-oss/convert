<?php

namespace App;



use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class CurrencyConverter
{
    protected string $apiUrl = 'https://nbg.gov.ge/gw/api/ct/monetarypolicy/currencies/en/json/';

    public function getRates(): array
    {
        // 1. Get the current date dynamically in 'Y-m-d' format.
        $today = now() ->format('Y-m-d');

        // 2. Send an HTTP GET request to the API URL passing the current date as a parameter.
        $response = Http::get($this->apiUrl, ['date' => $today]);

        // 3. Check if the response was successful and if the expected currency key exists in the JSON data.
        if($response->successful() && isset($response->json()[0]['currencies'])) {
            // 4. Extract the raw currencies array from the JSON response structure.
            $rawCurrencies = $response->json()[0]['currencies'];
            $result = [];

            foreach ($rawCurrencies as $currency) {
                $result[$currency["code"]] = $currency["rate"];
//                cache::remember('currencies', 60, function () {
//                    return $this->result;
//                });
            }
             return $result;


        }



        //    Make sure to cast rates to floats and quantities to integers.

        // 8. Assign these values to your formatted array, using the currency 'code' as the array key.

        // 9. Return the fully populated formatted array.

        // 10. Fallback: Return an empty array if the API request or validation fails.
        return [];
    }

    public function convert($record)
    {
// 1. Safeguard: Check if quantity is less than or equal to 0 to prevent division by zero errors.
        //    If it is invalid, return 0.00.

        // 2. Apply the formula: Multiply the user's amount by the exchange rate,
        //    then divide the total by the nominal unit quantity.

        // 3. Round the final calculated result to exactly 2 decimal places and return it.

    }
}
