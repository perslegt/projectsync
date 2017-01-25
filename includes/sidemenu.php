<div class="side-menu">
	<ul>
		<?php if ($_SESSION['L_PERMISSION'] == 2) { ?>
		<li>
			<a href="#" id="collapse-1">Admin</a>
			<div id="collapse-menu-1">
				<ul>
					<li>
						<a href="dashboard.php?page=project-overview">Project overview</a>
					</li>
					<li>
						<a href="dashboard.php?page=create-project">Create new project</a>
					</li>
					<li>
						<a href="dashboard.php?page=user-overview">User overview</a>
					</li>
					<li>
						<a href="dashboard.php?page=create-declaration">Create declaration</a>
					</li>
				</ul>
			</div>
		</li>
		<li>
			<a href="#" id="collapse-2">Rapports</a>
			<div id="collapse-menu-2" style="display:none">
				<ul>
					<li>
						<a href="#">Rapport 1</a>
					</li>
					<li>
						<a href="#">Rapport 2</a>
					</li>
				</ul>
			</div>
		</li>
		<?php }//close if ?>
		<li>
			<a href="#" id="collapse-3">User</a>
			<div id="collapse-menu-3" style="display:none">
				<ul>
					<li>
						<a href="#">Link 1</a>
					</li>
					<li>
						<a href="#">Link 2</a>
					</li>
					<li>
						<a href="#">Link 3</a>
					</li>
					<li>
						<a href="#">Link 4</a>
					</li>
				</ul>
			</div>
		</li>
	</ul>
	<script>
		$(document).ready(function(){
		    $("#collapse-1").click(function(){
		        $("#collapse-menu-1").slideToggle();
		    });
		    $("#collapse-2").click(function(){
		        $("#collapse-menu-2").slideToggle();
		    });
		    $("#collapse-3").click(function(){
		        $("#collapse-menu-3").slideToggle();
		    });
		});
	</script>
</div>