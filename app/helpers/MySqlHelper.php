<?php


namespace App\helpers;


use Illuminate\Support\Facades\DB;

class MySqlHelper
{
    /**
     * @param string $php_datetime
     * @return mixed
     */
    public static function UNIX_TIMESTAMP($php_datetime)
    {
        if (!$php_datetime)
            $php_datetime = date('Y-m-d H:i:s');
        $result = DB::select("select UNIX_TIMESTAMP('".$php_datetime."') res");
        $result = array_map(function ($value) {
            return (array)$value;
        }, $result);
        return $result[0]['res'];
    }

    /**
     * @return mixed
     */
    public static function selectNow()
    {
        $result = DB::select("select  now() res");
        $result = array_map(function ($value) {
            return (array)$value;
        }, $result);
        return $result[0]['res'];
    }
}