<!DOCTYPE html>
<?php 
	require_once "_dbconfig.php"; 
	require_once "_functions.php";

	$key = $_GET['i'];
	$email = $_GET['e'];

?>
<html>
<head>
	<title>ProjectSync - Welcome</title>
	<link rel="stylesheet" href="css/style.css" />
	<link href="https://fonts.googleapis.com/css?family=Raleway:300,400,700" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
</head>
<body>
	<h1>ProjectSync</h1>
	<div class="container">
		<div class="activation">
			<h2>Activate your account</h2>
			<?php if (activateAccount($key, $email) == true) {?>
			<p>Your account is activated.<br>Click the button below to login.</p>
			<a href="index.php" class="button">Login</a>
			<?php }else{ ?>
			<p>Incorrect link.<br>Please check your link again.</p>
			<?php } ?>
		</div>
	</div><!--container-->
</body>
</html>