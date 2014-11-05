<?php
/*
 * init
 */
defined('ROOT_PATH') || exit('Access Denied!');
// !defined('ROOT_PATH') && exit('Access Denied!');

require (SYSTEM_PATH.'config.inc.php');
require (SYSTEM_PATH.'Core/Controller.class.php');
require (SYSTEM_PATH.'Core/Model.class.php');
require (SYSTEM_PATH.'Core/View.class.php');

header('Content-type: text/html;charset='.$config['common']['charset']);

set_magic_quotes_runtime(0);

PHP_VERSION > '5.1' && @date_default_timezone_set($config['common']['timezone']);

$config['common']['debug'] ? error_reporting(E_ALL) : error_reporting(0);

if ($config['common']['gzip'])
{
	function_exists('ob_gzhandler') ? ob_start('ob_gzhandler') : ob_start();
} else {
	ob_start();
}
$c = new Controller();
$c->run();