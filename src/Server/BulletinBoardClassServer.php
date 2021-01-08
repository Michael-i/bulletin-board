<?php
/**
 * Created by PhpStorm.
 * User: 17208
 * Date: 2021/1/6
 * Time: 17:38
 */
namespace FireScheme\BulletinBoard\Server;
use FireScheme\BulletinBoard\Model\BulletinBoardClassModel;
use FireScheme\BulletinBoard\Tool\instance;

class BulletinBoardClassServer extends BaseServer
{
    use instance;
    private $bulletin_board_class_model;
    public function __construct()
    {
        $this->bulletin_board_class_model = new BulletinBoardClassModel();
    }
    // 获取分类列表
    public function get_list_page($params,$power=null){
        $where = [
            'name[~]'=>$params['keyword']
        ];
        // 权限过滤
        if($power){
            $where = $this->get_power_where($where);
        }
        return $this->bulletin_board_class_model->select_page($where,$params['page'],$params['page_size']);
    }
    // 获取分类列表
    public function get_list($params){
        $where = [
            'name[~]'=>$params['keyword']
        ];
        return $this->bulletin_board_class_model->select($where);
    }
    // 保存分类
    public function save($params){
        if($params['id']){
            // 检验分类是否存在
            $this->bulletin_board_class_model->check($params['id']);
            // 检验分类名称是否重复
            $exist_class_name = $this->bulletin_board_class_model->select_one([
                'id[!]'=>$params['id'],
                'name'=>$params['name']
            ]);
            if($exist_class_name) throw new \Exception("{$params['name']}已存在！");
            // 更新分类名称
            $res = $this->bulletin_board_class_model->update($params['id'],[
                'name'=>$params['name'],
                'user_list'=>$params['user_list'],
                'dept_list'=>$params['dept_list']
            ]);
        }else{
            // 检验分类名称是否重复
            $exist_class_name = $this->bulletin_board_class_model->select_one([
                'name'=>$params['name']
            ]);
            if($exist_class_name) throw new \Exception("{$params['name']}已存在！");
            // 添加分类
            $res = $this->bulletin_board_class_model->insert([
                'name'=>$params['name'],
                'admin_id'=>$this->get_admin_id(),
                'user_list'=>$params['user_list'],
                'dept_list'=>$params['dept_list']
            ]);
        }
        if(!$res) throw new \Exception("保存失败");
        return $res;
    }
    // 删除分类
    public function delete($params){
        // 检验分类是否存在
        $this->bulletin_board_class_model->check($params['id']);

        // 删除分类
        $res = $this->bulletin_board_class_model->delete($params['id']);
        return $res;
    }
}