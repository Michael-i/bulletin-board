<?php
/**
 * Created by PhpStorm.
 * User: 17208
 * Date: 2021/1/4
 * Time: 14:07
 */
namespace FireScheme\BulletinBoard\Controller;

use FireScheme\BulletinBoard\Tool\instance;

class BaseController
{
    use instance;
    protected $request;
    public function __construct()
    {
        $this->request = array_merge($_GET,$_POST);
    }
}