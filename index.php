<?php
?>

<html>
	<head>
		<link rel="stylesheet"
			href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	</head>
	<body>
		<div class="container">
			<div class="page-header">
				<h1> Climbing Recode </h1>
			</div>

			<table class="table table-striped">
				<tr>
					<th>Date</th>
					<th>Name</th>
					<th>Height</th>
					<th>Place</th>
					<th>Nearest Station</th>
					<th>Distance</th>
					<th>Walk Time</th>
					<th>Level</th>
					<th>Evaluation</th>
				</tr>
				<tr>
				<?php
					echo "<td>".$_POST['date']."</td>";
					echo "<td>".$_POST['mname']."</td>";
					echo "<td>".$_POST['mheight']." m</td>";
					echo "<td>".$_POST['mplace']."</td>";
					echo "<td>".$_POST['mstation']."</td>";
					echo "<td>".$_POST['wdistance']." km</td>";
					echo "<td>".$_POST['wtime']." hours</td>";
					echo "<td>".$_POST['level']."</td>";
					echo "<td>".$_POST['evaluation']."</td>";
				?>
				</tr>
			</table>

			<div class="text-center">
				<a href="add-cr.html" class="btn btn-primary" role="button">Add Climbing Recode</a>
			</div>
		</div>
	</body>
</html>
