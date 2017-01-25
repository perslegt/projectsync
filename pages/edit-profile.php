<?php
	$message = "";

	if(isset($_GET['e'])) {
		//check if admin etc
		if ($_SESSION['L_PERMISSION'] == 2) {
			if (isset($_POST['submit'])) {
				if (!empty($_POST['phone'])) {
					$phone = checkInput($_POST['phone']);
					if (!$phone > 0) {
						$message = "Please enter a valid phone number.";
					}
				}
				if(!$message) {
					$email = $_GET['e'];
					try {
						// Add a SQL-query.
						$sql = "UPDATE users SET phone=:phone WHERE email=:email";
						$stmt = $conn->prepare($sql);
						$stmt->execute(array(':phone'=>$phone,':email'=>$email));
						header("Location: dashboard.php?page=user-overview");
					} catch (PDOException $e) {
						echo $e->getMessage();
					}
				}
			}
			//show user his own profile
			$email = $_GET['e'];
			try {
				$sql = "SELECT * FROM `users` WHERE `Email` = :email";
	            $stmt = $conn->prepare($sql);
	            $stmt->bindValue(':email', $email);
	            $stmt->execute();
	            $result = $stmt->fetch(PDO::FETCH_ASSOC);
			}
			catch (PDOException $e) {
		    	echo $e->getMessage();
		    }
		}
		else {
			header("Location: dashboard.php?page=edit-profile");
		}
	}
	else {
		if (isset($_POST['submit'])) {
			if (!empty($_POST['phone'])) {
				$phone = checkInput($_POST['phone']);
				if (!$phone > 0) {
					$message = "Please enter a valid phone number.";
				}
			}
			if(!$message) {
				$email = $_SESSION['L_EMAIL'];
				try {
					// Add a SQL-query.
					$sql = "UPDATE users SET phone=:phone WHERE email=:email";
					$stmt = $conn->prepare($sql);
					$stmt->execute(array(':phone'=>$phone,':email'=>$email));
					header("Location: dashboard.php?page=profile");
				} catch (PDOException $e) {
					echo $e->getMessage();
				}
			}
		}
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

<div class="container" id="edit-profile">
	<h1><?php echo $result["Firstname"]." ".$result["Lastname"]; ?><small> - Edit Profile</small></h1>
	<div class="section-row-1">
		<form method="post" role="form" action="dashboard.php?page=edit-profile<?php if(isset($_GET['e'])){echo "&e=".$_GET['e'];} ?>">
			<table>
				<tr>
					<td>Email</td>
					<td><?php echo $result["Email"]; ?></td>
				</tr>
				<tr>
					<td>Phone Nr.</td>
					<td>
						<input type="text" name="phone" id="phone" value="0<?php echo $result["Phone"]; ?>" />
					</td>
				</tr>
			</table>
			<input type="submit" name="submit" id="submit" class="btn submit-btn" value="save" />
		</form>
		<?php if(isset($message)) { ?>
		<div class="message-container" style="text-align:center;color:#333">
			<p><?php echo $message; ?></p>
		</div>
		<?php } ?>
	</div>
</div>