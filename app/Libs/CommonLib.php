<?php

namespace App\Libs;

use App\Models\ExperiencesCategory;
use Illuminate\Support\Facades\Config;

class CommonLib
{
    /**
     * Convert DataTable params to request
     *
     * @param array $params
     * @return \stdClass
     */
    public static function convertDataTableParam($params = [])
    {
        $length = $params['length'];
        $start = $params['start'];

        $params = $params['form'] ?? [];

        $paramConvert = new \stdClass();
        $paramConvert->length = $length;
        $paramConvert->start = $start;
        if (!empty($params)) {
            foreach ($params as $param) {
                if(strpos($param['name'], "[]") === false){
                    $paramConvert->{$param['name']} = $param['value'];
                }else{
                    $name = str_replace("[]", "", $param['name']);
                    if(!isset($paramConvert->{$name})){
                        $paramConvert->{$name} = [
                            $param['value']
                        ];
                    }else{
                        $paramConvert->{$name}[] = $param['value'];
                    }
                }

            }
        }

        return $paramConvert;
    }

}
