<?php
class View
{
	protected $var_arr = array();
	
	protected $template = NULL;
	
	public function assign($var,$value)
	{
		if (is_array($var))//如果是数组则合并到$this->var_arr
		{
			$this->var_arr = array_merge($this->var_arr, $var);
		}
		else//如果是变量则将$var当作下标$value当作值, 添加到属性$var_arr中
		{
			$this->var_arr[$var] = $value;
		}
	}
	
	public function display($file)
	{
		global $config;
		include (SYSTEM_PATH.'Libs'.DIRECTORY_SEPARATOR.'template.class.php');
		$this->template = Template::getInstance();//获得类的实例
		$this->template->template_dir = $config['template']['template_dir'];
		$this->template->compile_dir = $config['template']['compile_dir'];
		$this->template->cache_dir = $config['template']['cache_dir'];
		$this->template->caching = $config['template']['caching'];	
		$this->template->left_delimiter = $config['template']['left_delimiter'];
		$this->template->right_delimiter = $config['template']['right_delimiter'];
		$templateFile = $this->template->template_dir.$file.'.tpl.html';
		if (!file_exists($templateFile))
		{
			exit('模板文件:'.$templateFile.'不存在'); 
		}
		$this->template->display($templateFile,$this->var_arr);
	}
}