<?php
class IndexModel extends Model
{
	private $db;
	
	public $modelName = 'This Model Name is index';
	
	function __construct()
	{
		global $config;
		$this->loadLib('db');
		$this->db = new db('mysql:host='.$config['database']['dbhost'].';dbname='.$config['database']['dbname'], $config['database']['username'], $config['database']['passwd'] = 'test');
	}
	
	function test()
	{
		$sql = 'select * from user';
		$result = '';
		$rst = $this->db->query($sql);
		foreach ($rst as $row)
		{
			$result .= $row['name'].' - '.$row['password'].' - '.$row['tel'].'<br />';
		}
		return $result;
	}
}