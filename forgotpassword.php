<?php
	require_once "_functions.php";

	if(isset($_POST['submit'])) {
		$message = forgotPassword($_POST['email']);
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
		<div class="forgot-password">
			<h2>Forgot password</h2>
			<p>Enter your email.</p>
			<form method="post" role="form" action="forgotpassword.php">
				<div class="form-row">
					<input type="text" name="email" id="email" placeholder="Email" />
					<label for="email">Email</label>
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