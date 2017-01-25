<?php
	require_once('_dbconfig.php');
	require_once('_functions.php');

	if(isset($_POST['login'])) {
		$message = "";
	    $email = htmlspecialchars($_POST["email"]);
	    $password = trim($_POST["password"]);
	    if(!isset($_POST['email'])) {
	        $message = "Please enter your email.";
	    }
	    if(!isset($_POST['password'])) {
	        $message = "Please enter your password.";
	    }
	    if(!$message) {
	        try {
	            $sql = "SELECT * FROM `users` WHERE `Email` = :email";
	            $sql = $conn->prepare($sql);
	            $sql->bindValue(':email', $email);
	            $sql->execute();
	            $result = $sql->fetch(PDO::FETCH_ASSOC);
	            if(count($result) > 0 && password_verify($password, $result['Password'])) {
	            	if($result['Active'] == 1) {
	            		session_start();
		                $_SESSION['L_EMAIL'] = $result['Email'];
		                $_SESSION['L_PERMISSION'] = $result['Type'];
		                $_SESSION['L_FIRSTNAME'] = $result['Firstname'];
		                $_SESSION['L_FULLNAME'] = $result['Firstname']." ".$result['Lastname'];
		                header("Location: dashboard.php");
	            	}
	            	else {
	            		$message = "Please activate your account by clicking on the link we send to your email.";
	            	}
	            } else {
	                $message .= "Wrong email or password.";
	            }
	        } catch (PDOException $e) {
	            echo $e->getMessage();
	        }
	    }
	}
?>