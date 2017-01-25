<?php 
	if(isset($_GET['e'])) {
		//check if admin etc
	}
	else {
		//show user his own profile
		$email = $_SESSION['L_EMAIL'];
		try {
			$sql = "SELECT * FROM `users` WHERE `Email` = :email";
            $sql = $conn->prepare($sql);
            $sql->bindValue(':email', $email);
            $sql->execute();
            $result = $sql->fetch(PDO::FETCH_ASSOC);
		}
		catch (PDOException $e) {
	    	echo $e->getMessage();
	    }
	}
?>

<div class="container" id="profile">
	<h1><?php echo $result["Firstname"]." ".$result["Lastname"]; ?></h1>
	<div class="section-row-1">
		<div class="profile-img">
			<img src="./img/profile-img-placeholder.jpg">
		</div>
		<div class="profile-data">
			<table>
				<tbody>
					<tr>
						<td>Email</td>
						<td><?php echo $result["Email"]; ?></td>
					</tr>
					<tr>
						<td>Phone nr.</td>
						<td>0<?php echo $result["Phone"]; ?></td>
					</tr>
				</tbody>
			</table>
			<a href="dashboard.php?page=edit-profile<?php if(isset($_GET['e'])){echo "&e=".$_GET['e'];} ?>" class="btn">Edit Profile</a>
		</div>
	</div>
</div>