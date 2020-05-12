<!doctype html>

<html>
	<head>
		<title>Register form</title>
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
				if(!empty($_POST["Username"]) && !empty($_POST["Password"]) && !empty($_POST["Email"]))
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
					$email=isset($_POST["Email"]) ? $_POST["Email"] : '';
					
					
					$sql="INSERT INTO [Py].[Users]
						   ([username]
						   ,[password]
						   ,[effectivedt]
						   ,[email])
					 VALUES
						   ('$username',
						   '$password',
						   getdate(),
						   '$email')";
					$stmt = sqlsrv_query( $conn, $sql);
					$rows = sqlsrv_rows_affected( $stmt );
					echo $sql;
					if ($rows >= 1)
					{					
						echo "<script>alert('Successfully Registered.')</script>";
						echo "<script>location.href = 'login.php';</script>";
					}
					else 
						echo "<script>alert('Registeration Failed.')</script>";
				}
				else
					echo "<script>alert('Fields are missing.')</script>";
			}
	?>
		<h2 style="font:100px">Trims</h2>
		
		<div class="login-box">
		<h1>Register Here</h1>
			<form action="" method="POST">
				<p>Username</p>
				<input type="text" name="Username" placeholder="Enter Username">
				<p>Password</p>
				<input type="password" class="password" name="Password" placeholder="Password">
				<p>Email</p>
				<input type="text" name="Email" placeholder="Enter Email">
				
				<input type="submit" name="Submit" value="Register">
			</form>
			Already have an Account? <a href='login.php' style='color:blue'>Sign In</a>.
		</div>
	</body>
</html>
