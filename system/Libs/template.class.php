<?php
class Template
{
	//模板实例
	public static $instance = NULL;
	
	//模板目录
	public $template_dir = 'template/';
	
	//模板编译目录
	public $compile_dir = 'template_c/';
	
	//缓存目录
	public $cache_dir = 'cache/';
	
	//是否缓存
	public $caching = false;
	
	//左边界符
	public $left_delimiter = '<!--{';
	
	//右边界符
	public $right_delimiter = '}-->';
	
	//不允许实例化
	private function __construct() {}
	
	//单例模式
	public static function getInstance()
	{
		if (is_null(self::$instance))
		{
			$c = __CLASS__;
			self::$instance = new $c();
		}
		return self::$instance;
	}
	
	public function display($file,$data = array())
	{
		extract($data);//将数组导出为变量
		include ($file);
	}
	
    // 阻止用户复制对象实例
    public function __clone()
    {
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }
}