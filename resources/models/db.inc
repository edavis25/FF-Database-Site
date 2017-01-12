<?php
	function getDB()
	{
		static $connection;
		
		if(!isset($connection)) 
		{
			// Load DB config file as array.
			$config = parse_ini_file('/../db-config.ini');
			
			// Try and connect to the database
			//$connection = mysqli_connect('localhost',$config['username'],$config['password'],$config['dbname']) or die('Error connecting to MySQL server.');
			$connection = mysqli_connect('localhost', 'Read_User', 'readOnly', 'ffdatabase') or die('Error connecting to MySQL server.');
			//$connection = mysqli_connect('localhost', $config['username'], $config['password'], $config['dbname']) or die('Error connecting to MySQL server.');
		}
		
		if ($connection === false)
		{
			return mysqli_connect_error(); 
		}
		return $connection;
	}
?>