<?php
session_start();

$_SESSION = array();
@session_destroy();
?>
<html>
	<head>
		<title> Logout </title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		</head>
	<body>
		<div class="container">
			<div class="page-header">
				<h1> Climbing Recode <small>~ logout ~</small></h1>
			</div>
			<div class="text-center">
				<h3>You have logged out</h3>
				<a href="index.php" class="btn btn-primary">Return to Login page</a>
			</div>
		</div>
	</body>
</html>
