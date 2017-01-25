<?php
	require_once "_dbconfig.php";
	require_once "_functions.php";

	session_start();

	if(!isset($_SESSION['L_EMAIL']) && !isset($_SESSION['L_FIRSTNAME'])){
		header("Location: index.php");
	}
?>

<!DOCTYPE hmtl>
<html>
	<head>
		<title>ProjectSync - Dashboard</title>
		<link rel="stylesheet" href="css/main.css" />
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link href="https://fonts.googleapis.com/css?family=Raleway:300,400,700" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	</head>
	<body>
		<header>
			<div class="top-nav">
				<ul>
					<li class="logo">
						<p>ProjectSync</p>
					</li>
					<li class="dropdown" id="profile">
						<a href="#" id="profile-dropdown"><i class="fa fa-user" aria-hidden="true"></i> <?php echo($_SESSION['L_FULLNAME']) ?> <i class="fa fa-caret-down" aria-hidden="true"></i></a>
					</li>
					<script>
						$(document).ready(function(){
						    $("#profile-dropdown").click(function(){
						        $("#profile-dropdown-collapse").slideToggle();
						    });
						});
					</script>
					<div id="profile-dropdown-collapse" style="display:none">
						<ul>
							<li>
								<a href="dashboard.php?page=profile"><i class="fa fa-caret-right" aria-hidden="true"></i> Profile</a>
							</li>
							<li>
								<a href="logout.php"><i class="fa fa-caret-right" aria-hidden="true"></i> Logout</a>
							</li>
						</ul>
					</div>
				</ul>
			</div>
		</header>