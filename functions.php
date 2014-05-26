<?php
	include('config.php');
	include('mysql.class.php');
	
	$mysql = new Database;
	$database->connect($db['host'], $db['username'], $db['password'], $db['database']);

	checkTables();

	function checkTables() {
		$mysql->query('CREATE TABLE IF NOT EXISTS Servers (Host VARCHAR(45), Port INT(7), Username VARCHAR(100), Password VARCHAR(200), PrivKey VARCHAR(200))');
	}

	function addServer($host, $port, $user, $pass, $privkey = '') {
		$mysql->query("INSERT INTO Servers Values({$host}, {$port}, {$user}, {$pass}, {$privkey})");
	}
?>