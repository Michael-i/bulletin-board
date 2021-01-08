<?php
/**
 * Created by PhpStorm.
 * User: 17208
 * Date: 2021/1/4
 * Time: 14:22
 */

namespace FireScheme\BulletinBoard\Config;
class Config
{
    private static $db_config;

    public static function getDbConfig(){
        if(!self::$db_config){
            self::$db_config = require __DIR__."/database.php";
        }
        return self::$db_config;
    }
}