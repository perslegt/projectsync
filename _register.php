<?php
	require_once "_dbconfig.php";
	require_once "_functions.php";

	if(isset($_POST['register'])) {//when register button clicked!
		$message = "";

		//check firstname input
		if (!empty($_POST['firstname'])) {
			$firstname = checkInput($_POST['firstname']);
			if(!preg_match("|^[0-9\p{L}_\s-]*$|u", $firstname)){
				$message = "You entered an invalid name.";
			}
		}
		//check lastname input
		if (!empty($_POST['lastname'])) {
			$lastname = checkInput($_POST['lastname']);
			if(!preg_match("|^[0-9\p{L}_\s-]*$|u", $lastname)){
				$message = "You entered an invalid name.";
			}
		}
		//check if email is valid
		if (!empty($_POST['email'])) {
			$email = $_POST['email'];
			if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
				$message = "You entered an invalid email.";
			}
		}
		//check if email already is in database
		if (existEmail($email) == true) {
			$message = "This email adress is already in use.";
		}
		if (!empty($_POST['phone'])) {
			$phone = checkInput($_POST['phone']);
			if (!$phone > 0) {
				$message = "Please enter a valid phone number.";
			}
		}
		//check password
		if (!empty($_POST['password'])) {
			$password = checkInput($_POST['password']);
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
		//Add user to database and Send mail if all previous inputs are valid
		if (!$message) {
			echo "<div id='melding'>Thanks for your registration.<br>Please activate your account by clicking the link we send you to your mail.</div>";
			$key = sha1(mt_rand(1000,9999));
			$active = 0;
			$type = 1;

			$from = "noreply@projectsync.com";
			$to = $email;

			$subject = "Activate your account!";
			$mailmessage = "Welkom to ProjectSync.\nPlease activate your account by clicking the following link:\nhttp://localhost:81/ProjectSync/activateaccount.php?i=".$key."&e=".$email;
			$headers = "From: " . $from . "\r\n" . 'X-Mailer: PHP/' . phpversion();
			mail($to, $subject, $mailmessage, $headers);

			try {
				$sql = "INSERT INTO `users` (`Firstname`, `Lastname`, `Email`, `Password`, `Phone`, `Type`, `Key`, `Active`)VALUES(:firstname, :lastname, :email, :password, :phone, :type, :key, :active)";
				$sql= $conn->prepare($sql);
				$sql->execute(array(':firstname'=>$firstname,':lastname'=>$lastname,':email'=>$email,':password'=>$hashed,':phone'=>$phone,':type'=>$type,':key'=>$key,':active'=>$active));
			}
			catch (PDOException $e) {
				echo $e->getMessage();
			}
		}
	}
?>