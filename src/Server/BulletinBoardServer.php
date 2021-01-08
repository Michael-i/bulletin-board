<?php
/**
 * Created by PhpStorm.
 * User: 17208
 * Date: 2021/1/6
 * Time: 17:38
 */
namespace FireScheme\BulletinBoard\Server;
use FireScheme\BulletinBoard\Model\BulletinBoardClassModel;
use FireScheme\BulletinBoard\Model\BulletinBoardModel;
use FireScheme\BulletinBoard\Tool\instance;

class BulletinBoardServer extends BaseServer
{
    use instance;
    private $bulletin_board_class_model;
    private $bulletin_board_model;
    public function __construct()
    {
        $this->bulletin_board_class_model = new BulletinBoardClassModel();
        $this->bulletin_board_model = new BulletinBoardModel();
    }
    // 获取我的公告板
    public function get_my_list($params){
        $params['user_id'] = $this->get_user_id();
        return $this->get_list_page($params);
    }
    // 获取分类列表
    public function get_list_page($params,$power=null){
        $where = [
            'title[~]'=>$params['keyword'],
        ];
        isset($params['user_id']) && $where['user_id'] = $params['user_id'];

        $params['begin_time'] && $where['create_time[>]'] = $params['begin_time'];
        $params['end_time'] && $where['create_time[<]'] = $params['end_time'];
        // 权限过滤
        if($power){
            $where = $this->get_power_where($where);
        }
        return $this->bulletin_board_model->select_page($where,$params['page'],$params['page_size']);
    }
    // 获取分类列表
    public function get_detail($params,$power=null){
        $where = ['id'=>$params['id']];
        // 权限过滤
        if($power){
            $where = $this->get_power_where($where);
        }
        return $this->bulletin_board_model->select_one($where);
    }
    // 保存分类
    public function save($params){
        // 检验分类是否存在
        $this->bulletin_board_class_model->check($params['class_id']);

        if($params['id']){
            $this->bulletin_board_model->check($params['id']);
            // 更新公告板
            $res = $this->bulletin_board_model->update($params['id'],[
                'class_id'=>$params['class_id'],
                'title'=>$params['title'],
                'cover'=>$params['cover'],
                'content'=>$params['content'],
                'file'=>$params['file'],
                'user_list'=>$params['user_list'],
                'dept_list'=>$params['dept_list'],
            ]);
        }else{
            // 添加分类
            $res = $this->bulletin_board_model->insert([
                'admin_id'=>$this->get_admin_id(),
                'user_id'=>$this->get_user_id(),
                'class_id'=>$params['class_id'],
                'title'=>$params['title'],
                'cover'=>$params['cover'],
                'content'=>$params['content'],
                'file'=>$params['file'],
                'user_list'=>$params['user_list'],
                'dept_list'=>$params['dept_list'],
            ]);
        }
        return $res;
    }
    // 删除分类
    public function delete($params){
        // 检验分类是否存在
        $this->bulletin_board_model->check($params['id']);

        // 删除分类
        $res = $this->bulletin_board_model->delete($params['id']);
        return $res;
    }
}