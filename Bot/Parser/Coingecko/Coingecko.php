<?php

namespace Bot\Parser\Coingecko;

use Bot\Config;
use Bot\Helpers\CoinHelper;
use Bot\Interfaces\IParse;
use Bot\Models\PriceHistory;
use Codenixsv\CoinGeckoApi\CoinGeckoClient;


class Coingecko implements IParse
{

    protected string $currencyPairs;

    function __construct()
    {
        $this->currencyPairs = Config::getSomeConfigName('coingecko_currency_pairs');
    }


    public function getData()
    {
        try {

            $arrVcCurrency = CoinHelper::getCurrency($this->currencyPairs);
            $client = new CoinGeckoClient();
            foreach ($arrVcCurrency as $currency=>$coins){
                $data = $result = $client->coins()->getMarkets($currency);
                PriceHistory::searchToSaveCoin($currency,$coins,$data,'symbol','current_price',__CLASS__);
            }

        } catch (\Exception $e) {
        }

    }

}
