<?php

namespace Bot\Helpers;


class CoinHelper
{

    /**
     * @param string $currencyPairs
     * @return array
     */
    public static function getCurrency(string $currencyPairs):array
    {
        $arrCurrency = explode(',',$currencyPairs);
        $arrVcCurrency = [];

        foreach ($arrCurrency as $item){
            $vcCurrency = explode('/',$item);
            $first = array_shift($vcCurrency);
            $last = array_pop($vcCurrency);
            $arrVcCurrency[$last][] = $first;
        }
        return $arrVcCurrency;
    }

}
