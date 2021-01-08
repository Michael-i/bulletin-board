<?php
/**
 * 公告板分类
 * Created by PhpStorm.
 * User: 17208
 * Date: 2021/1/4
 * Time: 14:07
 */
namespace FireScheme\BulletinBoard\Controller\admin;
use FireScheme\BulletinBoard\Controller\BaseController;
use FireScheme\BulletinBoard\Server\BulletinBoardClassServer;
use FireScheme\BulletinBoard\Tool\Request;
use FireScheme\BulletinBoard\Tool\Response;

class BulletinBoardClassController extends BaseController
{
    // 获取列表接口
    public function get_list_page(){
        try{
            $params = Request::checkParams($this->request,['keyword','page','page_size']);

            $server = BulletinBoardClassServer::getInstance();
            $data = $server->get_list_page($params);

            Response::success($data);
        }catch (\Exception $e){
            Response::error($e);
        }
    }
    // 获取列表接口
    public function get_list(){
        try{
            $params = Request::checkParams($this->request,['keyword','page','page_size']);

            $server = BulletinBoardClassServer::getInstance();
            $data = $server->get_list($params);

            Response::success($data);
        }catch (\Exception $e){
            Response::error($e);
        }
    }
    // 保存分类接口
    public function save(){
        try{
            $params = Request::checkParams($this->request,['id','name','user_list','dept_list']);

            if(!$params['name']) throw new \Exception("name不能为空");

            $params['user_list'] = json_decode($params['user_list'],true) ? json_decode($params['user_list'],true) : '';
            if($params['user_list']) $params['user_list'] = array_map('strval',$params['user_list']);

            $params['dept_list'] = json_decode($params['dept_list'],true) ? json_decode($params['dept_list'],true) : '';
            if($params['dept_list']) $params['dept_list'] = array_map('strval',$params['dept_list']);

            $server = BulletinBoardClassServer::getInstance();
            $data = $server->save($params);

            Response::success($data);
        }catch (\Exception $e){
            Response::error($e);
        }
    }
    // 删除分类接口
    public function delete(){
        try{
            $params = Request::checkParams($this->request,['id']);

            $server = BulletinBoardClassServer::getInstance();
            $data = $server->delete($params);

            Response::success($data);
        }catch (\Exception $e){
            Response::error($e);
        }
    }
}