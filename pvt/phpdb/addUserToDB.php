<?php
		session_start();
		$serverName = 'RASHID-HAIER-LA\RASHIDABBASI14';
		$connectionInfo = array( "Database"=>'Trims');
		$conn = sqlsrv_connect( $serverName, $connectionInfo);
		
		$username=$_POST["field0"];
		$password=$_POST["field1"];
		
		$sql="SELECT [username]
			FROM [Trims].[Py].[Users] 
			WHERE username = '$username'";
			
		$stmt = sqlsrv_query( $conn, $sql);
		if(!sqlsrv_has_rows($stmt))
		{
			$sql="INSERT INTO [Py].[Users]
				   ([username]
				   ,[password]
				   ,[effectivedt]
				   ,[email])
			 VALUES
				   ('$username',
				   '$password',
				   getdate(),
				   '".$_POST["field3"]."')";
			$stmt = sqlsrv_query( $conn, $sql);
			$rows = sqlsrv_rows_affected( $stmt );
			if ($rows >= 1)
			{					
				echo "Successfully Registered.";
			}
			else 
				echo "Registeration Failed.";
		}
		else{
			echo "User with this username already exists.";
		}
	?>