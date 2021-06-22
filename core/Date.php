<?php
namespace core;

use core\Application;
/**
 * Date time operation
 */
class Date
{
    
    function __construct()
    {
        date_default_timezone_set('America/New_York');
    }

    public static function getUnixTimeStamp($dateTime)
    {
        $date = new \DateTime($dateTime);
        return $date->getTimeStamp();
       
    }


    public static function getDateTime($timestamp)
    {
        $date->setTimeStamp($timestamp);
       return $date->format('U = Y-m-d H:i:s a');
    }

    public static function isUnique($key,$value)
    {
        if(count(Application::$app->db->where($key,'=',$value)->get())){
            return false;
        }
        return true;
    }

       
}
