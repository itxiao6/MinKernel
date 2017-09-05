<?php
# ENV 环境配置文件(用来适应不同的开发环境)
return [
    # 数据库主机
    'dbhost'=>'localhost',
    # 数据库名称
    'database'=>'test',
    # 数据库用户名
    'username'=>'root',
    # 数据库密码
    'password'=>'',
    # 前台应用域名绑定
    'home_host'=>'localhost',
    # 后台应用域名绑定
    'admin_host'=>'127.0.0.1',
    # session存储方式
    'session_save'=>'file', # file/redis
    # 缓存方式
    'cache_type'=>'file', # file/redis
    # 是否开启debugbar
    'debugbar'=>true
];