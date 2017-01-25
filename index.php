<?php
	session_start();

	if(isset($_SESSION["L_EMAIL"]) && isset($_SESSION["L_FULLNAME"])) {
		header("Location: dashboard.php");
	}
	if(isset($_POST['register'])) {
		require_once "_register.php";
	}
	if(isset($_POST['login'])) {
		require_once "_login.php";
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
		<ul class="tab-menu">
			<li class="tab-link current" data-tab="tab-1">Login</li>
			<li class="tab-link" data-tab="tab-2">Register</li>
		</ul>
		<div id="tab-1" class="login tab-content current">
			<h2>Login</h2>
			<form method="post" role="form" action="index.php">
				<div class="form-row">
					<input type="text" name="email" id="email" placeholder="Email" />
					<label for="email">Email</label>
				</div>
				<div class="form-row">
					<input type="password" name="password" id="password" placeholder="Password" />
					<label for="password">Password</label>
				</div>
				<div class="form-row">
					<input type="submit" name="login" id="login" value="Login" />
				</div>
				<div class="form-row">
					<a href="forgotpassword.php">Wachtwoord vergeten?</a>
				</div>
			</form>
		</div>
		<div id="tab-2" class="register tab-content">
			<h2>Register</h2>
			<form method="post" role="form" action="index.php">
				<div class="form-row">
					<input type="text" name="firstname" id="firstname" placeholder="Firstname" />
					<label for="firstname">Firstname</label>
				</div>
				<div class="form-row">
					<input type="text" name="lastname" id="lastname" placeholder="Lastname" />
					<label for="lastname">Lastname</label>
				</div>
				<div class="form-row">
					<input type="text" name="email" id="email" placeholder="Email" />
					<label for="email">Email</label>
				</div>
				<div class="form-row">
					<input type="text" name="phone" id="phone" placeholder="Phone" />
					<label for="phone">Phone</label>
				</div>
				<div class="form-row">
					<input type="password" name="password" id="password" placeholder="Password" />
					<label for="password">Password</label>
				</div>
				<div class="form-row">
					<input type="password" name="rpassword" id="rpassword" placeholder="Repeat password" />
					<label for="password">Repeat password</label>
				</div>
				<div class="form-row">
					<input type="submit" name="register" id="register" value="Register" />
				</div>
			</form>
		</div>
		<?php if(isset($message)) { ?>
		<div class="message-container" style="text-align:center;color:#333">
			<p><?php echo $message; ?></p>
		</div>
		<?php } ?>
		<script>
			$(document).ready(function(){
			
				$('ul.tab-menu li').click(function(){
					var tab_id = $(this).attr('data-tab');

					$('ul.tab-menu li').removeClass('current');
					$('.tab-content').removeClass('current');

					$(this).addClass('current');
					$("#"+tab_id).addClass('current');
				})

			})
		</script>
	</div><!--container-->
</body>
</html>