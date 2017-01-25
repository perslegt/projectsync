<?php
	$message = "";

	if (!$_SESSION['L_PERMISSION'] == 2) {
		header("Location: dashboard.php");
	}
	if(!isset($_GET['i'])) {
		Header("Location: dashboard.php");
	}
	else {
		if (isset($_POST['submit']) && $_SESSION['L_PERMISSION'] == 2) {
			if (!empty($_POST['name'])) {
				$projectName = checkInput($_POST['name']);
				if(!preg_match("|^[0-9\p{L}_\s-]*$|u", $projectName)){
					$message = "You entered an invalid name.";
				}
			}
			if(!$message) {
				$id = $_GET['i'];
				try {
					// Add a SQL-query.
					$sql = "UPDATE projects SET Name=:name WHERE ID=:id";
					$stmt = $conn->prepare($sql);
					$stmt->execute(array(':name'=>$projectName,':id'=>$id));
					header("Location: dashboard.php?page=project-overview");
				} catch (PDOException $e) {
					echo $e->getMessage();
				}
			}
		}
		if (isset($_POST['delete']) && $_SESSION['L_PERMISSION'] == 2) {
			$id = $_GET['i'];
			try {
				// Add a SQL-query.
				$sql = "DELETE FROM projects WHERE ID=:id";
				$stmt = $conn->prepare($sql);
				$stmt->execute(array(':id'=>$id));
				header("Location: dashboard.php?page=project-overview");
			} catch (PDOException $e) {
				echo $e->getMessage();
			}
		}
		//show user his own profile
		$id = $_GET['i'];
		try {
			$sql = "SELECT * FROM `projects` WHERE `ID` = :id";
            $sql = $conn->prepare($sql);
            $sql->bindValue(':id', $id);
            $sql->execute();
            $result = $sql->fetch(PDO::FETCH_ASSOC);
		}
		catch (PDOException $e) {
	    	echo $e->getMessage();
	    }
	}
?>

<div class="container" id="edit-project">
	<h1><?php echo $result["Name"]; ?><small> - Edit Project</small></h1>
	<div class="section-row-1">
		<form method="post" role="form" action="dashboard.php?page=edit-project&i=<?php echo $id ?>">
			<table>
				<tr>
					<td>Project Name</td>
					<td>
						<input type="text" name="name" id="name" value="<?php echo $result["Name"]; ?>" />
					</td>
				</tr>
			</table>
			<input type="submit" name="submit" id="submit" class="btn submit-btn" value="save" />
			<input type="submit" name="delete" id="delete" class="btn delete-btn" value="delete" />
		</form>
		<?php if(isset($message)) { ?>
		<div class="message-container" style="text-align:center;color:#333">
			<p><?php echo $message; ?></p>
		</div>
		<?php } ?>
	</div>
</div>