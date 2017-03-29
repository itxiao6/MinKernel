<?php
# ENV 环境配置文件(用来适应不同的开发环境)
return [
	# 数据库主机
	'dbhost'=>'localhost',
	# 数据库名称
	'database'=>'hyzg',
	# 数据库用户名
	'username'=>'hyzg',
	# 数据库密码
	'password'=>'hyzg2017',
	# session储存方式
	'session'=>'file',# file\database
	# log储存方式
	'log'=>'file',# file\database
	# 七牛云存储参数
    'Bucket_Name'=>'',# 空间名称
    'Bucket_Host'=>'',# 空间名称
    'accessKey'=>'',# 空间名称
    'secretKey'=>'',# 空间名称
    'debugbar'=>true # 是否开启debugbar

];
