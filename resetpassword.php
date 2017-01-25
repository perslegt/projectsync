<?php
	require_once "_functions.php";

	$key = $_GET['i'];
	$email = $_GET['e'];

	$message = "";

	if(isset($_POST['submit'])) {
		//check password
		if(!$message) {
			$password = checkInput($_POST['password']);
			$message = newPassword($password, $key, $email);
		}
	}
?>

<!DOCTYPE html>
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
		<div class="reset-password">
			<h2>Reset password</h2>
			<p>Choose a new password.</p>
			<form method="post" role="form" action="resetpassword.php?i=<?php echo $key; ?>&e=<?php echo $email; ?>">
				<div class="form-row">
					<input type="password" name="password" id="password" placeholder="Password" />
					<label for="password">Password</label>
				</div>
				<div class="form-row">
					<input type="password" name="rpassword" id="rpassword" placeholder="Repeat password" />
					<label for="password">Repeat password</label>
				</div>
				<div class="form-row">
					<input type="submit" name="submit" id="submit" value="Submit" />
				</div>
			</form>
		</div>
		<?php if(isset($message)) { ?>
		<div class="message-container" style="text-align:center;color:#333">
			<p><?php echo $message; ?></p>
		</div>
		<?php } ?>
	</div><!--container-->
</body>
</html>