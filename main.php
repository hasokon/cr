<?php
session_start();
//echo $_SESSION['userId'];
//echo $_SESSION['userName'];

//SQL connect
$server = "localhost";
$userName = "root";
$password = "gzxf6420";
$dbName = "climbing_recode";
$cr = "climbing_recode";

$userId = 1;

$mysqli = new mysqli($server, $userName, $password, $dbName);

if ($mysqli->connect_error) {
	echo $mysqli->connect_error;
	exit();
}else{
	$mysqli->set_charset("utf-8");
}

//Insert New Data
//var_dump($_POST);
$allSet = true;
$countPostValues = 0;
foreach($_POST as $key => $value) {
	//echo $key.":".$value."<br>";
	if ($value == ""){
		$allSet = false;
	}
	$countPostValues++;
}
if ($countPostValues <= 0) $allSet = false;

if($allSet) {
	$sql = "INSERT INTO ".$cr."(date, name, height, place, station, distance, time, level, evaluation, user_id) VALUES (";
	$sql .= '"'.$_POST['date'].'",';
	$sql .= '"'.$_POST['mname'].'",';
	$sql .= $_POST['mheight'].',';
	$sql .= '"'.$_POST['mplace'].'",';
	$sql .= '"'.$_POST['mstation'].'",';
	$sql .= $_POST['wdistance'].',';
	$sql .= $_POST['wtime'].',';
	$sql .= $_POST['level'].',';
	$sql .= $_POST['evaluation'].',';
	$sql .= $_SESSION['userId'].');';

	$result = $mysqli->query($sql);
	if (!$result) {
		echo $mysqli->error;
		exit();
	}
}

//Table Value Get
$sql = "SELECT * FROM ".$cr." WHERE user_id=".$_SESSION['userId'].";";

$result = $mysqli->query($sql);
if (!$result) {
	echo $mysqli->error;
	exit();
}

$row_count = $result->num_rows;
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
	$rows[] = $row;
}

//Post Processing
$result->free();
$mysqli->close();
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
				<?php
					foreach($rows as $row) {
						echo "<tr>";
						echo "<td>".$row['date']."</td>";
						echo "<td>".$row['name']."</td>";
						echo "<td>".$row['height']." m</td>";
						echo "<td>".$row['place']."</td>";
						echo "<td>".$row['station']."</td>";
						echo "<td>".$row['distance']." km</td>";
						echo "<td>".$row['time']." hours</td>";
						echo "<td>".$row['level']."</td>";
						echo "<td>".$row['evaluation']."</td>";
						echo "</tr>";
					}
				?>
			</table>

			<div class="text-center">
				<a href="add-cr.html" class="btn btn-primary" role="button">Add Climbing Recode</a>
			</div>
		</div>
	</body>
</html>
