<?php
$config['database']['dbhost'] = 'localhost';		//数据库地址
$config['database']['dbname'] = 'testdb';			//数据库名
$config['database']['username'] = 'test';			//数据库账户
$config['database']['passwd'] = 'test';					//数据库密码
$config['database']['charset'] = 'UTF8';			//数据库编码

$config['common']['charset'] = 'UTF-8';				//网站编码
$config['common']['timezone'] = 'Asia/Chongqing';	//时区
$config['common']['gzip'] = false;					//GZIP缓存
$config['common']['debug'] = true;					//调试模式
$config['common']['rewrite'] = false;				//伪静态 false-pathinfo模式 true-Rewrite模式
$config['common']['postfix'] = '.html';				//URL后缀

$config['template']['template_dir'] = ROOT_PATH.'template'.DIRECTORY_SEPARATOR;	//模板目录
$config['template']['compile_dir'] = ROOT_PATH.'template_c'.DIRECTORY_SEPARATOR;	//模板编译目录
$config['template']['cache_dir'] = 'cache/';		//缓存目录
$config['template']['caching'] = false;				//是否缓存
$config['template']['left_delimiter'] = '<!--{';
$config['template']['right_delimiter'] = '}-->';