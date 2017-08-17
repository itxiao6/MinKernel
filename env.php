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
    # session存储方式
    'session_save'=>'file', # file/redis
    # 缓存方式
    'cache_type'=>'file', # file/redis
    # 七牛云存储参数
    'Bucket_Name'=>'',# 空间名称
    'Bucket_Host'=>'',# 空间名称
    'accessKey'=>'',# 空间名称
    'secretKey'=>'',# 空间名称
    'cache_time' =>  -1 ,# 缓存时间单位为(秒) -1 为关闭缓存
    'debugbar'=>true # 是否开启debugbar
];