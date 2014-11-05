<?php
/*
 * 控制器
 */
class Controller
{
	public $url_arr;
	
	private $controllerClass;
	
	public function __construct()
	{
		$this->view = new View();
	}
	
	public function run()
	{
		$this->parsePath();
		$this->getControllerClass();
	}
	
	private function parsePath()
	{
		global $config;
		if ($config['common']['rewrite'])
		{
			//Rewrite模式
			exit('Rewrite模式还未开发');
		}
		else
		{
			//pathinfo模式
			if (isset($_SERVER["PATH_INFO"]) && $_SERVER["PATH_INFO"] != '/')
			{
				$this->url_arr = explode( '/',trim($_SERVER["PATH_INFO"], '/') );
				/*//IIS兼容模式(无path_info)
				$url = (strlen($_SERVER['SCRIPT_NAME']) > strlen($_SERVER['REQUEST_URI'])) ? $_SERVER['SCRIPT_NAME'] : $_SERVER['REQUEST_URI'];
				$this->url_arr = explode('/', trim(str_ireplace($_SERVER['SCRIPT_NAME'], '', $url), '/'));
				*/
				//设置默认Action
				isset($this->url_arr[1]) || $this->url_arr[1] = 'index';
			}
			else
			{
				//设置默认Controller
				$this->url_arr[0] = 'index';
				//设置默认Action
				$this->url_arr[1] = 'index';
			}
			//去掉URL后缀
			array_splice($this->url_arr, -1, 1, str_replace($config['common']['postfix'],'',end($this->url_arr)));
			//增加键名
			$this->url_arr['controller'] = $this->url_arr[0];
			$this->url_arr['action'] = $this->url_arr[1];
			//分析方法键值对
			$url_arr_num = count($this->url_arr)-2;//去掉2个带键值的key
			for ($i=2; $i < $url_arr_num; $i+=2)
			{
				$url_arr_num%2 && $this->url_arr[$url_arr_num] = 0;//如果为单数，末位数组值为0
				$this->url_arr[$this->url_arr[$i]] = $this->url_arr[$i+1];//为数组增加键值对
			}
		}
	}
	
	private function getControllerClass()
	{
		//controller文件绝对路径
		$this->controllerClass = SYSTEM_PATH.'Controller'.DIRECTORY_SEPARATOR.$this->url_arr['controller'].'.class.php';
		if (is_file($this->controllerClass))//判断是否有控制器文件
		{
			//载入controller文件
			include_once ($this->controllerClass);
			//获得类名
			$className = $this->url_arr['controller'].'Controller';
			if ( class_exists($className) )//判断是否有跟控制器同名的类
			{
				$ctl = new $className();
				$method = $this->url_arr['action'];
				if ( method_exists($ctl,$method) )//判断是否存在方法
				{
					$ctl->$method();
				}
				else
				{
					// todo 抛出异常
					exit('没有这个方法method:'.$method);
				}	
			}
			else
			{
				// todo 抛出异常
				exit('没有这个类class:'.$className);
			}
		}
		else
		{
			// todo 抛出异常
			exit('没有这个controller文件:'.$this->controllerClass);
		}
	}
	
	/**
	 * @return 对象
	 * @param String $model
	 * @desc 加载模型文件
	 */
	protected function loadModel($model)//子类继承载入模型使用
	{
		$model_file = SYSTEM_PATH.'Model'.DIRECTORY_SEPARATOR.$model.'.class.php';
		is_file($model_file) || exit('没有这个模型文件：'.$model_file);
		include_once (SYSTEM_PATH.'Model'.DIRECTORY_SEPARATOR.$model.'.class.php');
		$modelName = $model.'Model';
		$instance = new $modelName();
		return $instance;
	}
}
