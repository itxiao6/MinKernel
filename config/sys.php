<?php
# 系统配置
return [
    # 输入变量是否自动强制转换为字符串 如果开启则数组变量需要手动传入变量修饰符获取变量
    'var_auto_string'		=>	false,
    # 是否开启sql日志
    'database_log' => true,
    # 默认参数过滤方法 用于I函数...
    'default_filter'        =>  'htmlspecialchars',
    # 默认AJAX 数据返回格式,可选JSON XML ...
    'default_ajax_return'   =>  'JSON',
    # 是否开启调试面板
    'debugbar'=>env('debugbar'),
    #模板文件的后缀名
    'extensions'=>['php','html','tpl'],
    # 模板路径
    'view_path'=>[],
    # 默认时区
    'default_timezone'      =>  'PRC',
    # ajax提交的默认变量
    'var_ajax_submit'=>'ajax',
    # url 路由 分隔符
    'url_split'=>'/',
];
