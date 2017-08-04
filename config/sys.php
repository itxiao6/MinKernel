<?php
# 系统配置
return [
		'var_auto_string'		=>	false,	# 输入变量是否自动强制转换为字符串 如果开启则数组变量需要手动传入变量修饰符获取变量
		'database_log' => true, # 是否开启sql日志
		'default_filter'        =>  'htmlspecialchars', # 默认参数过滤方法 用于I函数...
		'default_ajax_return'   =>  'JSON',  # 默认AJAX 数据返回格式,可选JSON XML ...
		# 七牛云存储参数
		'Bucket_Name'=>env('Bucket_Name'),# 空间名称
		'accessKey'=>env('accessKey'),# 空间名称
		'secretKey'=>env('secretKey'),# 空间名称
		'Bucket_Host'=>env('Bucket_Host'),# 空间域名
		'debugbar'=>env('debugbar'),# 是否开启调试面板
		'extensions'=>['php','html','tpl'], #模板文件的后缀名
		'view_path'=>['message'=>ROOT_PATH.'message'], # 模板路径
		'default_timezone'      =>  'PRC',	# 默认时区
        'cache_time' => env('cache_time',-1), # 缓存时间单位为(秒) -1 为关闭缓存
        'var_ajax_submit'=>'ajax', # ajax提交的默认变量
	];
