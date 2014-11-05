<?php
class Model
{
	public function loadLib($lib)
	{
		require (SYSTEM_PATH.'Libs'.DIRECTORY_SEPARATOR.'db'.DIRECTORY_SEPARATOR.$lib.'.class.php');
	}
}