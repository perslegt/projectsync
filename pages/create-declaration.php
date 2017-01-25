<?php
	$message= "";

	if (isset($_POST['submit'])) {
		$userID = $_POST['user'];
		$projectID = $_POST['project'];
		$costPrice = $_POST['price'];
		$costDisc = $_POST['discription'];

		try {
			$sql = "INSERT INTO `cost` (`Price`,`Descrition`)VALUES(:price,:desc)";
			$stmt = $conn->prepare($sql);
			$stmt->execute(array('price'=>$costPrice,':desc'=>$costDisc));
			$costID = $conn->lastInsertId();
		}
		catch (PDOException $e) {
			echo $e->getMessage();
		}

		try {
			$sql = "INSERT INTO `declarations` (`User_ID`,`Projects_ID`,`Cost_ID`)VALUES(:user, :project, :cost)";
			$stmt= $conn->prepare($sql);
			$stmt->execute(array(':user'=>$userID,':project'=>$projectID,':cost'=>$costID));
		}
		catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	if (!$_SESSION['L_PERMISSION'] == 2) {
		header("Location: dashboard.php");
	}
?>

<div class="container" id="create-declaration">
	<h1>Create Declaration</small></h1>
	<div class="section-row-1">
		<form method="post" role="form" action="dashboard.php?page=create-declaration">
			<table>
				<tr>
					<td>User</td>
					<td>
						<select name="user">
						<?php 
							$sql = "SELECT * FROM users";
							$stmt = $conn->prepare($sql);
							$stmt->execute(array());
							$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
							foreach($users as $user) {
						?>
							<option value="<?php echo $user['ID']; ?>"><?php echo $user['Firstname'] . " " . $user['Lastname']; ?></option>
						<?php 
							}//close foreach
						?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Project</td>
					<td>
						<select name="project">
						<?php 
							$sql = "SELECT * FROM projects";
							$stmt = $conn->prepare($sql);
							$stmt->execute(array());
							$projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
							foreach($projects as $project) {
						?>
							<option value="<?php echo $project['ID']; ?>"><?php echo $project['Name']; ?></option>
						<?php 
							}//close foreach
						?>
						</select>
					</td>
				</tr>
			</table>
			<div id="costs">
				<table>
					<tr>
						<td>Price</td>
						<td>
							<input type="number" name="price" step="0.01" min="0" id="price" placeholder="10.00" />
						</td>
					</tr>
					<tr>
						<td>Description</td>
						<td>
							<textarea name="discription" id="discription" rows="2" cols="30">Type a text...</textarea>
						</td>
					</tr>
				</table>
			</div>
			<!--<input id="addcost" class="btn" type="button" value="Add cost" onClick="addCost();">
			<script type="text/javascript">
					var counter = 2;
					var limit = 7;
					function addCost(){
					     if (counter == limit)  {
					          alert("You have reached the limit of adding " + limit + " inputs");
					     }
					     else {
					          var newtable = document.createElement('table');
					          newtable.innerHTML = "<tr><td>Price</td><td><input type='number' name='prijs" + counter + "' id='prijs' placeholder='10.00' /></td></tr><tr><td>Description</td><td><textarea name='discription' id='discription" + counter + "' rows='2' cols='30'>Type a text...</textarea></td></tr>"
					          //newtable.innerHTML = "<tr><td>Price</td><td><input type='number' name='prijs" + counter+1 + "' id='prijs' placeholder='10.00' /></td></tr><tr><td>Description</td><td><textarea name='discription' id='discription" + counter+1 + "' rows='2' cols='30'>Type a text...</textarea></td></tr>";
					          document.getElementById('costs').appendChild(newtable);
					          counter++;
					     }
					}
				</script>-->
			<input type="submit" name="submit" id="submit" class="btn submit-btn" value="Create" />
		</form>
		<?php if(isset($message)) { ?>
		<div class="message-container" style="text-align:center;color:#333">
			<p><?php echo $message; ?></p>
		</div>
		<?php } ?>
	</div>
</div>