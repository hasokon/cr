<?php
require 'password.php';

session_start();

if (isset($_SESSION['userId']) && isset($_SESSION['userName'])) {
	header('Location:main.php');
}

$db_server = "localhost";
$db_userName = "root";
$db_password = "gzxf6420";
$db_name = "climbing_recode";
$db_userTable = "user";

$errorMessage = '';
//var_dump($_POST);

if (isset($_POST['login'])) {
	if (!empty($_POST['userName']) && !empty($_POST['userPassword'])) {
		$userName = $_POST['userName'];
		$userPassword = $_POST['userPassword'];

		$mysqli = new mysqli($db_server, $db_userName, $db_password, $db_name);
		if ($mysqli->connect_error) {
			echo $mysqli->connect_error;
			exit();
		} else {
			$mysqli->set_charset('utf-8');
		}

		$sql = "SELECT * FROM ".$db_userTable." WHERE name='".$userName."';";
		$result = $mysqli->query($sql);
		if (!$result) {
			echo $mysqli->error;
			exit();
		}
		if ($result->num_rows == 1) {
			$row = $result->fetch_array(MYSQLI_ASSOC);
			$id = $row['id'];
			$password = $row['password'];
			if (password_verify($userPassword, $password)) {
				$_SESSION['userId'] = $id;
				$_SESSION['userName'] = $userName;
				header('Location:main.php');
			} else {
				$errorMessage = "Password is wrong";
			}
		} else if($result->num_rows > 1) {
			echo 'Multiple User who is same name in DB';
			exit();
		} else {
			$errorMessage = 'User Name is wrong';
		}
		$result->free();
		$mysqli->close();
	} else {
		$errorMessage = "Input 'name' and 'password'";
	}
}

?>
<html>
	<head>
		<title> Login </title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/login.css">
		</head>
	<body>
		<div class="container">
			<div class="page-header">
				<h1> Climbing Recode <small>~ login ~</small></h1>
			</div>
			<div class="modal-dialog">
				<div class="loginmodal-container">
					<h1> Login Your Account</h1>
					<form method="POST" action="index.php">
						<input type="text" name="userName" placeholder="Username">
						<input type="password" name="userPassword" placeholder="Password">
						<?php
						if (!empty($errorMessage)) {
							echo '<label>'.$errorMessage."</label>";
						}
						?>
						<input type="submit" name="login" class="login loginmodal-submit" value="Login">
					</form>
					<div class="login-help">
						<a href="register.php">Register</a>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
