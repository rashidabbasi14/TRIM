<?php
		session_start();
		$serverName = 'RASHID-HAIER-LA\RASHIDABBASI14';
		$connectionInfo = array( "Database"=>'Trims');
		$conn = sqlsrv_connect( $serverName, $connectionInfo);
		
		$sql="INSERT INTO [Py].[PurchaseOrder]
					   ([vendor],
					   [toolid],
					   [quantity],
					   [expectedarrivaldt],
					   [ordereddt])
				 VALUES
					   ('".$_POST["field1"]."',
					   ".$_POST["toolid"].",
					   ".$_POST["field2"].",
					   '".date('Y-m-d',strtotime($_POST["field3"]))."',
					   getdate())";
			$stmt = sqlsrv_query( $conn, $sql);
			
			if( $stmt === false ) {
				if( ($errors = sqlsrv_errors() ) != null) {
					foreach( $errors as $error ) {
						echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
						echo "code: ".$error[ 'code']."<br />";
						echo "message: ".$error[ 'message']."<br />";
					}
				}
			}
			else
			{
				$rows = sqlsrv_rows_affected( $stmt );
				if ($rows >= 1)
				{					
					echo "Successfully Added.";
				}	
				else 
					echo "Could not add an Order.";
				}
	?>