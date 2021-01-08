<?php
/**
 *  公告板
 * Created by PhpStorm.
 * User: 17208
 * Date: 2021/1/4
 * Time: 14:07
 */
namespace FireScheme\BulletinBoard\Controller\api;
use FireScheme\BulletinBoard\Controller\BaseController;
use FireScheme\BulletinBoard\Server\BulletinBoardClassServer;
use FireScheme\BulletinBoard\Server\BulletinBoardServer;
use FireScheme\BulletinBoard\Tool\Request;
use FireScheme\BulletinBoard\Tool\Response;

class BulletinBoardController extends BaseController
{
    // 获取列表接口
    public function get_class_list(){
        try{
            $params = Request::checkParams($this->request,['page','page_size']);

            !$params['page'] && $params['page'] = 1;
            !$params['page_size'] && $params['page_size'] = 20;

            $server = BulletinBoardClassServer::getInstance();
            $data = $server->get_list_page($params,true);

            Response::success($data);
        }catch (\Exception $e){
            Response::error($e);
        }
    }
    public function get_list(){
        try{
            $params = Request::checkParams($this->request,['class_id','keyword','begin_time','end_time','page','page_size']);

            !$params['page'] && $params['page'] = 1;
            !$params['page_size'] && $params['page_size'] = 20;

            $server = BulletinBoardServer::getInstance();
            $data = $server->get_list_page($params,true);

            Response::success($data);
        }catch (\Exception $e){
            Response::error($e);
        }
    }
    public function get_detail(){
        try{
            $params = Request::checkParams($this->request,['id']);

            $server = BulletinBoardServer::getInstance();
            $data = $server->get_detail($params,true);

            Response::success($data);
        }catch (\Exception $e){
            Response::error($e);
        }
    }

    /** 管理用户操作接口++ */
    // 获取列表接口
    public function get_my_list(){
        try{
            $params = Request::checkParams($this->request,['page','page_size']);

            !$params['page'] && $params['page'] = 1;
            !$params['page_size'] && $params['page_size'] = 20;

            $server = BulletinBoardServer::getInstance();
            $data = $server->get_my_list($params);

            Response::success($data);
        }catch (\Exception $e){
            Response::error($e);
        }
    }
    // 保存接口
    public function save(){
        try{
            $params = Request::checkParams($this->request,['id','class_id','title','cover','content','file','user_list','dept_list']);

            if(!$params['title']) throw new \Exception("标题不能为空");
            if(!$params['content']) throw new \Exception("内容不能为空");

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