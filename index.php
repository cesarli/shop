<?php

if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');

// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',True);
define('BIND_MODULE','Home');
define('APP_PATH','./');
// 定义应用目录

// 引入ThinkPHP入口文件
require '../../Framework/ThinkPHP/ThinkPHP.php';