<?php
/**
 * Created by PhpStorm.
 * User: 17208
 * Date: 2021/1/7
 * Time: 19:31
 */
include __DIR__."/../packages/autoload.php";

$namespace_src = "FireScheme\\BulletinBoard\\";
$namespace_controller = $namespace_src . "Controller\\";

$_GET['s'] = str_replace('.','',$_GET['s']);
$s = explode('/',$_GET['s']);

if(!isset($s[0]) || !isset($s[1]) || !isset($s[2])){
    exit('not found!');
}
$model = $s[0];
$controller = implode('',array_map('ucfirst',explode('_',$s[1]))) . 'Controller';
$method = $s[2];

$controller_class = $namespace_controller . "$model\\" .$controller;

if(!class_exists($controller_class)){
    exit('not found!');
}

$controller = new $controller_class();
if(!method_exists($controller,$method)){
    exit('not found!');
}
$controller->$method();

die;
