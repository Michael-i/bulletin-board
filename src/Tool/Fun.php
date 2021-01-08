<?php
/**
 * Created by PhpStorm.
 * User: 17208
 * Date: 2021/1/4
 * Time: 17:24
 */

namespace FireScheme\BulletinBoard\Tool;


class Fun
{
    public static function create_id($namespace = '') {
        static $guid = '';
        $uid = uniqid("", true);
        $data = $namespace;
        $data .= $_SERVER['REQUEST_TIME'];
        $data .= $_SERVER['HTTP_USER_AGENT'];
        $data .= $_SERVER['REMOTE_ADDR'];
        $data .= $_SERVER['REMOTE_PORT'];
        $hash = strtoupper(hash('ripemd128', $uid . $guid . md5($data)));
        return $hash;
    }
}