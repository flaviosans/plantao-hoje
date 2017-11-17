<?php
/**
 * Created by PhpStorm.
 * User: flavi
 * Date: 18/09/2017
 * Time: 17:15
 */

namespace app\Library;


use Carbon\Carbon;

class Date
{
    public static function toUTF($dataBR){
        $dataBR = str_replace('/', '-', $dataBR);
        $dataBR = new Carbon($dataBR , config('app.timezone'));
        return $dataBR->toDateString();
    }
}