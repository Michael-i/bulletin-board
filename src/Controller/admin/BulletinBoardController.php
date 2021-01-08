<?php
/**
 *  公告板
 * Created by PhpStorm.
 * User: 17208
 * Date: 2021/1/4
 * Time: 14:07
 */
namespace FireScheme\BulletinBoard\Controller\admin;
use FireScheme\BulletinBoard\Controller\BaseController;
use FireScheme\BulletinBoard\Server\BulletinBoardServer;
use FireScheme\BulletinBoard\Tool\Request;
use FireScheme\BulletinBoard\Tool\Response;

class BulletinBoardController extends BaseController
{
    // 获取列表接口
    public function get_list_page(){
        try{
            $params = Request::checkParams($this->request,['class_id','keyword','begin_time','end_time','page','page_size']);

            !$params['page'] && $params['page'] = 1;
            !$params['page_size'] && $params['page_size'] = 20;

            $server = BulletinBoardServer::getInstance();
            $data = $server->get_list_page($params);

            Response::success($data);
        }catch (\Exception $e){
            Response::error($e);
        }
    }
    public function get_detail(){
        try{
            $params = Request::checkParams($this->request,['id']);

            $server = BulletinBoardServer::getInstance();
            $data = $server->get_detail($params);

            Response::success($data);
        }catch (\Exception $e){
            Response::success($e);
        }
    }
    // 保存接口
    public function save(){
        try{
            $params = Request::checkParams($this->request,['id','class_id','title','cover','content','file','user_list','dept_list']);

            if(!$params['title']) throw new \Exception("标题不能为空");
            if(!$params['content']) throw new \Exception("内容不能为空");

            $params['user_list'] = json_decode($params['user_list'],true) ? json_decode($params['user_list'],true) : '';
            if($params['user_list']) $params['user_list'] = json_encode(array_map('strval',$params['user_list']));

            $params['dept_list'] = json_decode($params['dept_list'],true) ? json_decode($params['dept_list'],true) : '';
            if($params['dept_list']) $params['dept_list'] = json_encode(array_map('strval',$params['dept_list']));

            $server = BulletinBoardServer::getInstance();
            $data = $server->save($params);

            Response::success($data);
        }catch (\Exception $e){
            Response::error($e);
        }
    }
    // 删除接口
    public function delete(){
        try{
            $params = Request::checkParams($this->request,['id']);

            $server = BulletinBoardServer::getInstance();
            $data = $server->delete($params);

            Response::success($data);
        }catch (\Exception $e){
            Response::error($e);
        }
    }
}