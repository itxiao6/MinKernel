<?php
// php版本检测
if( PHP_VERSION <= 5.5 ){ exit('PHP version <= 5.6'); }
// 定义项目根目录
define('ROOT_PATH',__DIR__.'/../');
// 开启调试模式
define('DE_BUG',true);
// 引入
require( ROOT_PATH.'kernel/Kernel.php' );
// 启动
Kernel\Kernel::start();