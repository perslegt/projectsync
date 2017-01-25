<?php
	DEFINE("DB_USER", "root");
	DEFINE("DB_PASS", "");

	$conn;

	try {
		$conn = new PDO("mysql:host=localhost;dbname=projectsync2", DB_USER, DB_PASS);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e) {
		echo "Error: " . $e->getMessage();
	}

	function dbClose(){
		$conn = null;
	}
?>
