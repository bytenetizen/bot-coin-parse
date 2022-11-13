<?php

namespace Bot\Parser\Livecoinwatch;

use Bot\Config;
use Bot\Helpers\BaseHelper;
use Bot\Helpers\CoinHelper;
use Bot\Models\PriceHistory;

class Livecoinwatch implements \Bot\Interfaces\IParse
{

    protected string $currencyPairs,$apiKey,$host;

    function __construct()
    {
        $this->currencyPairs = Config::getSomeConfigName('livecoinwatch_currency_pairs');
        $this->apiKey = Config::getSomeConfigName('livecoinwatch_api_key');
        $this->host = Config::getSomeConfigName('livecoinwatch_host');
    }

    public function getData()
    {
        try {

            $arrVcCurrency = CoinHelper::getCurrency($this->currencyPairs);

            foreach ($arrVcCurrency as $currency=>$coins){
                $data = $this->prepareData($currency,$coins);
                $context = stream_context_create($this->contextOptions($data));
                $fp = fopen($this->host, 'r', false, $context);
                $answer = json_decode(stream_get_contents($fp),true);
                PriceHistory::searchToSaveCoin($currency,$coins,$answer,'code','rate',__CLASS__);
            }

        } catch (\Exception $e) {
        }

    }

    /**
     * @param $currency
     * @param $codes
     * @return array
     */
    private function prepareData($currency,$codes):array
    {
        return [
            'codes' => $codes,
            'currency' => $currency,
            'sort' => 'rank',
            'order' => 'ascending',
            'offset' => 0,
            'limit' => 0,
            'meta' => false
        ];

    }

    /**
     * @param array $data
     * @return array|array[]
     */
    private function contextOptions(array $data):array
    {
        return [
            'http' => [
                'method' => 'POST',
                'header' => "Content-type: application/json\r\n"
                    . "x-api-key: {$this->apiKey}" . "\r\n",
                'content' => json_encode($data)
            ]
        ];
    }


}
