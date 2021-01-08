<?php
/**
 * Created by PhpStorm.
 * User: 17208
 * Date: 2021/1/7
 * Time: 17:32
 */

namespace FireScheme\BulletinBoard\Server;


class BaseServer
{
    /**  获取系统管理员id，如有用到需实现 */
    protected function get_admin_id(){
        return '3';
    }
    /**  获取用户id，如有用到需实现 */
    protected function get_user_id(){
        return '1';
    }
    /** 获取用户部门id集合，如有用户需实现 */
    protected function get_dept_ids(){
        return ["1","2"];
    }

    /** 添加权限过滤 */
    protected function get_power_where($where){
        $power_where = [
            'user_list[~]'=>"\"{$this->get_user_id()}\"",
            'AND'=>[
                'user_list'=>"",
                'dept_list'=>""
            ]
        ];
        foreach ($this->get_dept_ids() as $dept_id){
            $power_where['dept_list[~]'] = "\"{$dept_id}\"";
        }
        $where['AND'] = ['OR'=>$power_where];
        return $where;
    }
}