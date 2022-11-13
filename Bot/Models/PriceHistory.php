<?php

namespace Bot\Models;

use Bot\Helpers\BaseHelper;

class PriceHistory extends Model
{

    const TABLE = 'price_history';

    /**
     * @param array $arrData
     * @throws \Exception
     */
    public function save(array $arrData)
    {
        if(count($arrData) > 0){
            pg_insert($this->getConnection(), self::TABLE, $arrData);
        }
    }


    /**
     * @param array $arrData
     */
    public function saveArr(array $arrData)
    {
        if(count($arrData) > 0){
            foreach ($arrData as $datum){
                $this->save($datum);
            }
        }
    }

    /**
     * @param string $currency
     * @param array $coins
     * @param array $data
     * @param string $fieldsCoin
     * @param string $fieldsPrice
     * @param string $class
     */
    public static function searchToSaveCoin
    (
        string $currency,
        array $coins,
        array $data,
        string $fieldsCoin,
        string $fieldsPrice,
        string $class
    )
    {

        $result = [];

        foreach ($data as $datum){
            $key = array_search(mb_strtoupper($datum[$fieldsCoin]),$coins);

            if(is_numeric($key)){
                $result[]=[
                    'currency'=>$currency,
                    'symbol'=>$coins[$key],
                    'price'=>$datum[$fieldsPrice],
                    'source'=>BaseHelper::getNameClass($class),
                ];
            }
        }

        $save = new PriceHistory();
        $save->saveArr($result);
    }

}
