<?php
		if(isset($_POST["count"])?$_POST["count"]!=0:0)
		{
			$serverName = 'RASHID-HAIER-LA\RASHIDABBASI14';
			$connectionInfo = array( "Database"=>'Trims');
			$conn = sqlsrv_connect( $serverName, $connectionInfo);
			$flag=0;
			for($i=0;$i<$_POST["count"];$i++)
			{
				$sql="delete from Py.Issue where Issueid=".$_POST["field$i"];
				$stmt = sqlsrv_query( $conn, $sql);
				if($stmt)
					$flag=1;
			}
			if($flag==1)
				echo "Issue have been removed.";
			else
				echo "No Issue was removed.";
		}
		else
			echo "No Issue selected.";
	?>