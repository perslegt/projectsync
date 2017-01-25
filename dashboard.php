<?php include "includes/header.php"; ?>
<?php include "includes/sidemenu.php"; ?>
<?php 
	if (isset($_GET["page"])) {
		$page = $_GET["page"];
	} else {
		$page = "welcome";
	}
	if($page) {
		include("pages/".$page.".php");
	}
?>
<?php include "includes/footer.php"; ?>