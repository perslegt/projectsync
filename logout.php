<?php
	require_once "_dbconfig.php";

	session_start();

	if(isset($_SESSION["L_EMAIL"]) && isset($_SESSION["L_FULLNAME"])) {
		$_SESSION["L_EMAIL"] = "";
		$_SESSION["L_FIRSTNAME"] = "";
		$_SESSION["L_FULLNAME"] = "";
		# close the connection
		dbClose();

		session_destroy();
		header("Location: index.php");
	}
	else {
		header("Location: index.php");
	}
?>