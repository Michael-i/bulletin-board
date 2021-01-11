# bulletin-board [公告板组件]
 组件提供公告板一套接口，开箱即用
## 项目初始化

1.初始化数据库，\bulletin-board\doc\database.sql

2.数据库文件配置，\bulletin-board\src\Config\database.php

3.组件支持用户部门权限隔离，可在\bulletin-board\src\Server\BaseServer.php 配置用户信息和部门信息



## 接口：
 
### 一、管理后台接口

#### 1.公告板分类

（1）获取公告板分类列表 admin/BulletinBoardClassController->get_list_page

（2）保存公告板分类 admin/BulletinBoardClassController->save

（3）删除公告板分类 admin/BulletinBoardClassController->delete

#### 2.公告板

（1）获取列表 admin/BulletinBoardController->get_list_page

（2）保存公告板 admin/BulletinBoardController->save

（3）删除公告板 admin/BulletinBoardController->delete

（4）获取公告板详情 admin/BulletinBoardController->get_detail

### 二，客户端API接口
#### 1.公告板

（1）获取公告板分类列表 api/BulletinBoardClassController->get_list

（2）获取公告板列表 api/BulletinBoardController->get_list

（3）获取公告板列表 api/BulletinBoardController->get_detail


（4）获取我的公告板 api/BulletinBoardController->get_my_list

（5）保存公告板 api/BulletinBoardController->save

（6）删除公告板 api/BulletinBoardController->delete

### 使用示例：直接初始化控制器并调用其方法，按自己所需配置路由接口
    use FireScheme\BulletinBoard\Controller\admin\BulletinBoardClassController;
    $controller = new BulletinBoardClassController();
    $controller->get_list();
    
### 组件提供了入口文件 index.php
#### 1.默认路由地址： model/controller/method

[模块名称]/[控制器名称小写下划线分割]/[方法]

例：admin/bulletin_board/get_list

#### 2.nginx配置：
        
    server {
            listen       80;
            server_name  bb.com;
            root    "/bulletin-board/src";
            location / {
                index  index.html index.htm index.php l.php;
               autoindex  off;
    
               
                if (!-e $request_filename) {             
                    rewrite  ^/(.*)$  /index.php?s=$1  last;  
                    break;  
                } 
            }
            
            location ~ \.php(.*)$  {
                fastcgi_pass   127.0.0.1:9000;
                fastcgi_index  index.php;
                fastcgi_split_path_info  ^((?U).+\.php)(/?.+)$;
                fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
                fastcgi_param  PATH_INFO  $fastcgi_path_info;
                fastcgi_param  PATH_TRANSLATED  $document_root$fastcgi_path_info;
                include        fastcgi_params;
            }
    
        }

