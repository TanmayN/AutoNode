<?php

	include('includes/functions.php');

	$host = $_POST['host'];
	$port = intval($_POST['port']);
	$username = $_POST['username'];
	$password = $_POST['password'];
	$add = $_POST['add'];
	$delete = $_POST['delete'];

	if (isset($host, $port, $username, $password, $add)) {
		if (addServer($mysql, $host, $port, $username, $password)) {
			$success = true;
		} else {
			$success = false;
		}
	} elseif (isset($host, $port)) {
		if (delServer($mysql, $host, $port)) {
			$delSuccess = true;
		} else {
			$delSuccess = false;
		}
	}

?>
<html>
<body>
	<center>
		<h2>Add A Server</h2>
		<p>You can add servers manually here.<br>
		Enter all of the details below.<br>
		<form action="servers.php" method="post">
			Host: <input type="form" name="host"><br>
			Port: <input type="form" name="port" value="22"><br>
			Username: <input type="form" name="username" value="root"><br>
			Password: <input type="password" name="password"><br>
			<input type="hidden" name="add" value="true">
			<input type="submit">
		</form>
		<br>
		<?php
		if ($success) {
			echo "Server added succesfully.";
		} elseif (isset($success)) {
			echo "Error, could not add server, please check details.";
		}
		?>
		</p>
		<h2>Remove A Server</h2>
		<p>You can manually remove a server here.<br>
		<form action="servers.php" method="post">
			Host: <input type="form" name="host"><br>
			Port: <input type="form" name="port"><br>
			<input type="submit">
		</form>
		<br>
		<?php
			if ($delSuccess) {
				echo "Server removed successfully.";
			} elseif (isset($delSuccess)) {
				echo "Server could not be removed.";
			}
		?>
	</center>
</body>
</html>