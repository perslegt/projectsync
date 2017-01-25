
<?php
	require_once "_dbconfig.php";
	
	function checkInput($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = strip_tags($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	function existEmail($email){
		global $conn;


		$sql = "SELECT email FROM users WHERE email = :email";
		$sql = $conn->prepare($sql);
		$sql->bindValue(':email', $email);
		$sql->execute();

		if($sql->rowCount() > 0) {
			return true;
		}
		else {
			return false;
		}
	}
	function activateAccount($key, $email){
		global $conn;

		$sql = "SELECT active FROM `users` WHERE `email` = :email AND `Key` = :key";
		$sql = $conn->prepare($sql);
		$sql->execute(array(':email' => $email, ':key' => $key));

		if($sql->rowCount() > 0) {
			$sql = "UPDATE users SET `active` = 1, `key` = null WHERE `email` = :email AND `Key` = :key";
			$sql = $conn->prepare($sql);
			$sql->execute(array(':email' => $email, ':key' => $key));

			return true;
		}
		else {
			return false;
		}
	}
	function forgotPassword($email){
		global $conn;

		$key = sha1(mt_rand(1000,9999));

		$from = "noreply@projectsync.com";
		$to = $email;

		$subject = "Forgot password";
		$message = "Click the following link to get a new password:\nhttp://localhost:81/ProjectSync/resetpassword.php?i=".$key."&e=".$email;
		$headers = "From: " . $from . "\r\n" . 'X-Mailer: PHP/' . phpversion();
		mail($to, $subject, $message, $headers);

		try {
			$sql = "UPDATE `users` SET `Key` = :key WHERE `Email` = :email";
			$sql= $conn->prepare($sql);
			$sql->execute(array(':key'=>$key, ':email'=>$email));
		}
		catch (PDOException $e) {
			echo $e->getMessage();
		}
		return "An message has been send to ".$email;
	}
	function newPassword($password, $key, $email){
		global $conn;

		if (!empty($password)) {
			if (strlen($password) < 8) {
				$message = "Your password must contain at least 8 characters.";
			}
			elseif (!preg_match("#[0-9]+#", $password)) {
				$message = "Your password must contain at least 1 digit.";
			}
			elseif(!preg_match("#[A-Z]+#",$password)) {
		        $message = "Your password must contain at least 1 capital letter.";
		    }
		    elseif(!preg_match("#[a-z]+#",$password)) {
		        $message = "Your password must contain at least 1 lowercase letter.";
		    }
		    $hashed = password_hash($password, PASSWORD_BCRYPT);
		}
		//check if password and repeat password are the same
		if (!empty($_POST['rpassword']) && $_POST['rpassword'] == $_POST['password']) {
			// Also test this $_POST variable for any harmful chars that are crucial for SQL_injections and XSS.
			$rpassword = checkInput($_POST['rpassword']);
		}
		else {
			$message = "Your passwords do not match.";
		}
		$sql = "SELECT Active FROM `users` WHERE `Email` = :email AND `Key` = :key";
		$sql = $conn->prepare($sql);
		$sql->execute(array(':email' => $email, ':key' => $key));
		if($sql->rowCount() > 0) {
			$sql = "UPDATE `users` SET `Password` = :password, `Key` = null WHERE `Email` = :email AND `Key` = :key";
			$sql = $conn->prepare($sql);
			$sql->execute(array(':password' => $hashed, ':email' => $email, ':key' => $key));
			return "Your password is succesfully changed.";
		}
		else {
			return "Incorrect link.\nPlease check your link again.";
		}
	}
	function existProject($projectName){
		global $conn;

		$sql = "SELECT Name FROM projects WHERE Name = :name";
		$sql = $conn->prepare($sql);
		$sql->bindValue(':name', $projectName);
		$sql->execute();

		if($sql->rowCount() > 0) {
			return true;
		}
		else {
			return false;
		}
	}
?>