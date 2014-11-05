<?php
/*
 * index.php
 */
$start_time = microtime(true);
define('ROOT_PATH',dirname(__FILE__).DIRECTORY_SEPARATOR);
define('SYSTEM_PATH',ROOT_PATH.'system'.DIRECTORY_SEPARATOR);
require (SYSTEM_PATH.'init.php');
