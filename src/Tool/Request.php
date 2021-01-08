<?php
/**
 * Created by PhpStorm.
 * User: 17208
 * Date: 2020/10/22
 * Time: 17:40
 */

namespace FireScheme\BulletinBoard\Tool;
class Request
{
    /**
     * 参数检验
     * @throws \Exception
     * @param $data
     * @param $need
     * @return array
     */
    public static function checkParams($data,$need){
        if (is_null($data)) {
            throw new \Exception("空参数！");
        }

        if (!is_array($data)) {
            throw new \Exception("参数错误！");
        }

        $keys = array_keys($data);
        foreach ($need as $field) {	//验证必备字段
            if (!in_array($field, $keys)) {
                throw new \Exception("缺少参数：{$field}");
            }
        }unset($field);

        return $data;
    }
}