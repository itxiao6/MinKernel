<?php
return [
	// 读写分离(读)
	'read' 		=> [
		'host'      => 'localhost',					// 数据库连接地址
		'database'  => 'databaseName',				// 数据库名字
		'username'  => 'username',					// 数据库账号
		'password'  => 'password',					// 数据库密码
		'prefix'    => '',							// 数据库表前缀
		'driver'    => 'mysql',						// 数据库驱动
		'charset'   => 'utf8',						// 数据库字符集
		'collation' => 'utf8_unicode_ci',			// 数据库编码
		],
	// 读写分离(读)
	'write' 		=> [
		'host'      => 'localhost',					// 数据库连接地址
		'database'  => 'databaseName',				// 数据库名字
		'username'  => 'username',					// 数据库账号
		'password'  => 'password',					// 数据库密码
		'prefix'    => '',							// 数据库表前缀
		'driver'    => 'mysql',						// 数据库驱动
		'charset'   => 'utf8',						// 数据库字符集
		'collation' => 'utf8_unicode_ci',			// 数据库编码
		],
];