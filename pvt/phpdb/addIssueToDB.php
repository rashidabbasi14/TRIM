<?php
		session_start();
		$serverName = 'RASHID-HAIER-LA\RASHIDABBASI14';
		$connectionInfo = array( "Database"=>'Trims');
		$conn = sqlsrv_connect( $serverName, $connectionInfo);
		
		
		
		$sql="select ISNULL((select sum(quantity)
			from [Trims].[Py].[PurchaseOrder]
			where toolid = 8
			AND expectedarrivaldt < getdate()
			group by toolid),0)
			-
			ISNULL((SELECT sum(quantity)
			from [Trims].[Py].Issue
			where
				(
				/* ([]) */
				('".date('Y-m-d',strtotime($_POST["field4"]))."' >= fromdt
				AND '".date('Y-m-d',strtotime($_POST["field5"]))."' <= tilldt)
				/* [()] */
				OR ('".date('Y-m-d',strtotime($_POST["field4"]))."' <= fromdt
				AND '".date('Y-m-d',strtotime($_POST["field5"]))."' >= tilldt)
				/* ([)] */
				OR ('".date('Y-m-d',strtotime($_POST["field4"]))."' <= tilldt
				AND '".date('Y-m-d',strtotime($_POST["field5"]))."' >= tilldt)
				/* [(]) */
				OR ('".date('Y-m-d',strtotime($_POST["field4"]))."' <= fromdt
				AND '".date('Y-m-d',strtotime($_POST["field5"]))."' >= fromdt)
				)
				AND toolid = 8
			),0)";
					   
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
			if($stmt)
			{
				$row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC);
				if($row[0] >= $_POST["field3"])
				{
					$sql="INSERT INTO [Py].[Issue]
								   ([projectid],
								   [userid],
								   [toolid],
								   [quantity],
								   [fromdt],
								   [tilldt])
							 VALUES
								   (".$_POST["field0"].",
								   ".$_POST["field1"].",
								   ".$_POST["field2"].",
								   ".$_POST["field3"].",
								   '".date('Y-m-d',strtotime($_POST["field4"]))."',
								   '".date('Y-m-d',strtotime($_POST["field5"]))."')";
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
							echo "Could not add an Issue.";
					}
				}
				else
				{
					echo "Insufficient Items to be Issued on the given dates.";
					echo " \nYou need  ".((int)$_POST["field3"]-(int)($row[0]?$row[0]:0))." more.";
				}
			}
		}
	?>