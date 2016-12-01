<?php
// 定义项目根目录
CONST ROOT_PATH = __DIR__.'/../';
// 开启调试模式
CONST DE_BUG = true;
// 引入
require(ROOT_PATH.'kernel/Kernel.php');
// 启动
Kernel\Kernel::start();