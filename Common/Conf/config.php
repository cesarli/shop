<?php
return array(
	//'配置项'=>'配置值'
    'TMPL_PARSE_STRING'  =>array(
        'TMPL_HOME_JS'     => '/Public/Home/js',
        'TMPL_HOME_IMAGES'     => '/Public/Home/images',
        'TMPL_HOME_CSS'     => '/Public/Home/css',
        'TMPL_MAN_CSS'     => '/Public/Manage/css',
        'TMPL_MAN_JS'     => '/Public/Manage/js',
        'TMPL_MAN_IMAGES'     => '/Public/Manage/images',
        'TMPL_MAN'     => '/Public/Manage',
    ),
    'URL_HTML_SUFFIX'=>'',
    'MULTI_MODULE'          =>  false,
    'DEFAULT_MODULE'        =>  'Home',

    'DB_TYPE'   => 'mysql', // 数据库类型
    'DB_HOST'   => 'lgqaliyun.mysql.rds.aliyuncs.com', // 服务器地址
    'DB_NAME'   => 'shop', // 数据库名
    'DB_USER'   => 'lgq', // 用户名
    'DB_PWD'    => '453203102qqLGQ', // 密码
    'DB_PORT'   => 3306, // 端口
    'DB_PREFIX' => '', // 数据库表前缀
    'DB_CHARSET'=> 'utf8', // 字符集
);