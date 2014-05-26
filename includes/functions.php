<?php
	include('config.php');
	include('mysql.class.php');

	$mysql = new MySQL;
	$mysql->connect($db['host'], $db['username'], $db['password'], $db['database']);

	checkTables($mysql);

	function checkTables($mysql) {
		$mysql->query('CREATE TABLE IF NOT EXISTS Servers (Host VARCHAR(45), Port INT(7), Username VARCHAR(100), Password VARCHAR(200))');
	}

	function addServer($mysql, $host, $port, $user, $pass) {
		$stmt = $mysql->prepare("INSERT INTO Servers Values(?, ?, ?, ?)");
		mysqli_stmt_bind_param($stmt, 'siss', $host, $port, $user, $pass);
		mysqli_stmt_execute($stmt);
	}
?>
