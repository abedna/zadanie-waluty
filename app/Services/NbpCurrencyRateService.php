<?php

declare(strict_types=1);

namespace App\Services;

use App\Interfaces\CurrencyRateServiceInterface;
use App\Models\Currency;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class NbpCurrencyRateService implements CurrencyRateServiceInterface
{
    protected const REQUEST_URL = 'http://api.nbp.pl/api/exchangerates/tables/a';

    /**
     * @return void
     */
    public function importRates(): void
    {
        $response = Http::get(self::REQUEST_URL);

        $preparedRates = $this->prepareData($response);

        Currency::upsert($preparedRates, ['exchange_code'], ['exchange_rate']);
    }

    /**
     * @param Response $response
     * @return array
     */
    protected function prepareData(Response $response): array
    {
        $currenciesRates = $response->json(0)['rates'];

        return array_map(function($currency) {
            return array(
                'uuid' => Str::uuid()->toString(),
                'currency_code' => $currency['code'],
                'exchange_rate' => $currency['mid']
            );
        }, $currenciesRates);
    }
}
