<?php 
	if (!$_SESSION['L_PERMISSION'] == 2) {
		header("Location: dashboard.php");
	}
?>

<div class="container" id="user-overview">
	<h1>User Overview</small></h1>
	<div class="section-row-1">
		<table>
			<thead>
				<tr>
					<th>#</th>
					<th>Firstname</th>
					<th>Lastname</th>
					<th>Email</th>
					<th>Phone</th>
					<th>Edit</th>
				</tr>
			</thead>
			<tbody>
    		<?php	
			    $sql = "SELECT * FROM users";
			    $stmt = $conn->prepare($sql);
			    $stmt->execute(array());
			    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
			    $i = 0;
			    foreach($users as $user) {
			    	$i++;
			?>
				<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $user['Firstname']; ?></td>
					<td><?php echo $user['Lastname']; ?></td>
					<td><?php echo $user['Email']; ?></td>
					<td>0<?php echo $user['Phone']; ?></td>
					<td><a href="dashboard.php?page=edit-profile&e=<?php echo $user['Email']; ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
				</tr>
			<?php
			    }
		    ?>
    </tbody>
		</table>
	</div>
</div>