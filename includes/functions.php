<?php
	include('config.php');

	$mysql = mysqli_connect($db['host'], $db['username'], $db['password'], $db['database']) or die("Database connection error: " . mysqli_connect_error($mysql));

	checkTables($mysql);

	function checkTables($mysql) {
		$mysql->query('CREATE TABLE IF NOT EXISTS Servers (Host VARCHAR(45), Port INT(7), Username VARCHAR(100), Password VARCHAR(200))');
	}

	function addServer($mysql, $host, $port, $user, $pass) {
		$connection = ssh2_connect($host, $port);
		if (!$connection) {
			return false;
		} 

		if (!ssh2_auth_password($connection, $user, $pass)) {
			return false;
		}

		if (!ssh2_exec($connection, "ls -l")) {
			return false;
		}
		$stmt = $mysql->prepare("INSERT INTO Servers VALUES (?, ?, ?, ?)");
		$stmt->bind_param('siss', $host, $port, $user, $pass);
		$stmt->execute();
		return true;
	}

	function delServer($mysql, $host, $port) {
		$exists = $mysql->prepare("SELECT * FROM Servers WHERE Host='?' AND Port=?");
		$exists->bind_param('si', $host, $port);
		$exists->execute();
		$exists = $exists->num_rows > 0;

		if ($exists) {
			$stmt = $mysql->prepare("DELETE FROM Servers WHERE Host=? AND Port=?");
			$stmt->bind_param('si', $host, $port);
			$stmt->execute();
			return true;
		} else {
			return false;
		}
	}

	function __destroy() {
		$mysql->close();
	}


?>
