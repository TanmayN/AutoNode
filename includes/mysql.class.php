<?php
	class MySQL {

		public function connect($host, $user, $pass, $db) {
			$this->connection = mysqli_connect($host, $user, $pass, $db) or die("Database connection error: " . mysqli_connect_error($this->connection));
		}

		public function __destruct() {
			mysqli_close($this->connection);
		}

		public function query($query) {
			return mysqli_query($this->connection, $query);
		}

		public function error() {
			return mysqli_error($this->connection);
		}

		public function prepare($stmt) {
			return mysqli_prepare($this->connection, $stmt);
		}

	}
?>