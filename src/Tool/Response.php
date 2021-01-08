<?php
/**
 * Created by PhpStorm.
 * User: 17208
 * Date: 2020/10/23
 * Time: 11:13
 */

namespace FireScheme\BulletinBoard\Tool;

class Response
{
    public static function success($data = null) {
        $res = [
            'errcode' => 0,
            'errmsg' => '成功',
            'data'  => $data
        ];
        exit(json_encode($res));
    }
    public static function error(\Exception $e) {
        $errcode = $e->getCode() ? $e->getCode() : -1;
        $res = [
            'errcode' => $errcode,
            'errmsg' => '失败',
            'data'  => $e->getMessage()
        ];
        exit(json_encode($res));
    }
}