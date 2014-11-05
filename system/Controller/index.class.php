<?php
class IndexController extends Controller
{
	public $view;
	
	function index()
	{
		$test = '<b>this index Action model</b>';
		$test2 = 'test Char!';
		$this->view->assign('tpltemp1',$test);
		$this->view->assign('tpltemp2',$test2);
		$this->view->display('index');
	}
}