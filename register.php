<?php
require 'password.php';

$dbServer='localhost';
$dbUserName='root';
$dbPassword='gzxf6420';
$dbName='climbing_recode';

$errorMessage = '';
//var_dump($_POST);

if (isset($_POST['register'])) {
	if (!empty($_POST['name']) || !empty($POST['password']) || !empty($_POST['password-fc'])) {
		$userName = $_POST['name'];
		$password = $_POST['password'];
		$passwordFc = $_POST['password-fc'];
		
		if ($password == $passwordFc) {
			$mysqli = new mysqli($dbServer, $dbUserName, $dbPassword, $dbName);
			if ($mysqli->connect_error){
				echo $mysqli->connect_error;
				exit(1);
			}

			$sql = 'INSERT INTO user(name, password) VALUES(';
			$sql .= '"'.$userName.'",';
			$sql .= '"'.password_hash($password, PASSWORD_DEFAULT).'");';

			$result = $mysqli->query($sql);
			if (!$result) {
				echo 'databese query error';
				echo $mysqli->error;
				exit(1);
			}
			header('Location:index.php');
		} else {
			$errorMessage = 'The two passwword do not match';
		}
	} else {
		$errorMessage = 'Fill all form!';
	}
}
?>
<html>
	<head>
		<title> Register </title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/login.css">
		</head>
	<body>
		<div class="container">
			<div class="page-header">
				<h1> Climbing Recode <small>~ register ~</small></h1>
			</div>
			<div class="modal-dialog">
				<div class="loginmodal-container">
					<h1> Input Your Account</h1>
					<form method='POST' action='register.php'>
						<input type="text" name="name" placeholder="Username">
						<input type="password" name="password" placeholder="Password">
						<input type="password" name="password-fc" placeholder="Password for Comfirmation">
						<?php
						if (!empty($errorMessage)) {
							echo '<label>'.$errorMessage.'</label>';
						}
						?>
						<input type="submit" name="register" class="login loginmodal-submit" value="register">
					</form>
				</div>
			</div>
		</div>
	</body>
</html>
