<?php 
	if (!$_SESSION['L_PERMISSION'] == 2) {
		header("Location: dashboard.php");
	}
?>

<div class="container" id="create-project">
	<h1>Create Project</small></h1>
	<div class="section-row-1">
		<form method="post" role="form" action="dashboard.php?page=create-project">
			<table>
				<tr>
					<td>Project name</td>
					<td>
						<input type="text" name="name" id="name" />
					</td>
				</tr>
			</table>
			<input type="submit" name="submit" id="submit" class="btn submit-btn" value="Create" />
		</form>
		<?php if(isset($message)) { ?>
		<div class="message-container" style="text-align:center;color:#333">
			<p><?php echo $message; ?></p>
		</div>
		<?php } ?>
	</div>
</div>