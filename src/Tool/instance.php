<?php
/**
 * Created by PhpStorm.
 * User: 17208
 * Date: 2021/1/6
 * Time: 17:52
 */

namespace FireScheme\BulletinBoard\Tool;

Trait instance{
    public static $instance = [];

    public static function getInstance(){
        $instance = self::$instance;
        if(!isset($instance[static::class]) || !($instance[static::class] instanceof static)){
            return $instance[static::class] = new static();
        }
        return $instance[static::class];
    }
}