<?php
/*
 * MySQL Class v1.0
 */
class mysql {
	private $hostname;
	private $username;
	private $password;
	private $table;
	private $characterSet; //字符集
	private $link;//连接句柄
	
	protected function __construct($hostname, $username, $password, $table, $characterSet) {
		$this->hostname = $hostname;
		$this->username = $username;
		$this->password = $password;
		$this->table = $table;
		$this->characterSet = $characterSet;
		$this->connect ();
	}
	
	function connect() {
		$this->link = mysql_connect ( $this->hostname, $this->username, $this->password ) or die ( $this->error () );
		if ( !(mysql_select_db ( $this->table, $this->link )) ) {//如果不存在库 则创建之
			mysql_query("CREATE DATABASE `$this->table`",$this->link) or die ( 'Can not create database: '.$this->table.'<br />'.$this->error () );
			mysql_select_db ( $this->table, $this->link ) or die ( 'Can not select the table: ' . $this->table . '<br />' . $this->error () );
		}
		//mysql_select_db ( $this->table, $this->link ) or die ( 'Can not select the table: ' . $this->table . '<br />' . $this->error () );
		mysql_query ( "SET NAMES '$this->characterSet'" );
	}
	
	function query($sql) {
		if (! ($result = mysql_query ( $sql, $this->link ))) {
			echo 'SQL: ' . $sql;
		}
		return $result;
	}
	
	function close() {
		mysql_close ( $this->link );
	}
	
	function error() {
		mysql_error ();
	}

}