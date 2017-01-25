<?php 
	if (!$_SESSION['L_PERMISSION'] == 2) {
		header("Location: dashboard.php");
	}
?>

<div class="container" id="project-overview">
	<h1>Project Overview</h1>
	<div class="section-row-1">
		<table>
			<thead>
				<tr>
					<th>#</th>
					<th>Project Name</th>
					<th>Edit</th>
				</tr>
			</thead>
			<tbody>
    		<?php	
			    $sql = "SELECT * FROM projects";
			    $stmt = $conn->prepare($sql);
			    $stmt->execute(array());
			    $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
			    $i = 0;
			    foreach($projects as $project) {
			    	$i++;
			?>
				<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $project['Name']; ?></td>
					<td><a href="dashboard.php?page=edit-project&i=<?php echo $project['ID']; ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
				</tr>
			<?php
			    }
		    ?>
    </tbody>
		</table>
	</div>
</div>