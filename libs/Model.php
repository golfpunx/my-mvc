<?php
class Model
{
	function __construct()
	{
		$this->db = Database::getInstance(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS); 
	}
}