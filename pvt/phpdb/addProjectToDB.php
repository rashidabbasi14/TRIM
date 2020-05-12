<?php
		session_start();
		$serverName = 'RASHID-HAIER-LA\RASHIDABBASI14';
		$connectionInfo = array( "Database"=>'Trims');
		$conn = sqlsrv_connect( $serverName, $connectionInfo);
		
		$sql="SELECT [title]
			FROM [Trims].[Py].[Project] 
			WHERE title = '".$_POST["field0"]."'";
			
		$stmt = sqlsrv_query( $conn, $sql);
		if(!sqlsrv_has_rows($stmt))
		{
			$sql="INSERT INTO [Py].[Project]
					   ([title])
				 VALUES
					   ('".$_POST["field0"]."')";
			$stmt = sqlsrv_query( $conn, $sql);
			$rows = sqlsrv_rows_affected( $stmt );
			if ($rows >= 1)
			{					
				echo "Successfully Added.";
			}
			else 
				echo "Could not add Project.";
		}
		else{
			echo "Project with this Title already exists.";
		}
	?>