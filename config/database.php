<?php
return [
	// 读写分离(读)
	'read' 		=> [
		'host'      => 'localhost',					// 数据库连接地址
		'database'  => 'demo',				// 数据库名字
		'username'  => 'root',					// 数据库账号
		'password'  => 'hebi?DANGZHEN6',					// 数据库密码
		'prefix'    => '',							// 数据库表前缀
		'driver'    => 'mysql',						// 数据库驱动
		'charset'   => 'utf8',						// 数据库字符集
		'collation' => 'utf8_unicode_ci',			// 数据库编码
		],
	// 读写分离(读)
	'write' 		=> [
		'host'      => 'localhost',					// 数据库连接地址
		'database'  => 'demo',				// 数据库名字
		'username'  => 'root',					// 数据库账号
		'password'  => 'hebi?DANGZHEN6',					// 数据库密码
		'prefix'    => '',							// 数据库表前缀
		'driver'    => 'mysql',						// 数据库驱动
		'charset'   => 'utf8',						// 数据库字符集
		'collation' => 'utf8_unicode_ci',			// 数据库编码
		],
];