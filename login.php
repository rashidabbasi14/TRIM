<!doctype html>

<html>
	<head>
		<title>Login form</title>
		<link rel="stylesheet" type="text/css" href="CSS/layout.css">
	</head>
	
	<style>
	body {
		background-image: url("Images/image.jpg");
	}
	</style>
	
	<body background="image.jpg">
	<?php	
			if(isset($_POST['Submit']))
			{
				$serverName = 'RASHID-HAIER-LA\RASHIDABBASI14';
				$connectionInfo = array( "Database"=>'Trims');
				$conn = sqlsrv_connect( $serverName, $connectionInfo);
				if( !$conn ) {
					echo "Connection could not be established.<br />";
					die( print_r( sqlsrv_errors(), true));
				}
				$username=isset($_POST["Username"]) ? $_POST["Username"] : '';
				$password=isset($_POST["Password"]) ? $_POST["Password"] : '';
				
				
				$sql="SELECT [username]
					  FROM [Trims].[Py].[Users]
					  WHERE username = '$username' AND password = '$password'";
				$stmt = sqlsrv_query( $conn, $sql);
				$rows = sqlsrv_has_rows( $stmt );
				if ($rows === true)
				{
					session_start();
					$_SESSION['LAST_ACTIVITY'] = time();
					$_SESSION["username"]=$username;
					$_SESSION["password"]=$password;
					
					echo "<script>alert('Successfully logged in.')</script>";
					echo "<script>location.href = 'index.php';</script>";
				}
				else 
					echo "<script>alert('Invalid Username and Password')</script>";
				
			}
	?>
		<h2 style="font:100px">Trims</h2>
		
		<div class="login-box">
		<h1>Login Here</h1>
			<form action="" method="POST">
				<p>Username</p>
				<input type="text" name="Username" placeholder="Enter Username">
				<p>Password</p>
				<input type="password" class="password" name="Password" placeholder="Password">
				<input type="submit" name="Submit" value="Login">
			</form>
			Not registered? <a href='register.php' style='color:blue'>Sign Up</a>.
		</div>
	</body>
</html>
