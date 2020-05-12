<?php
	session_start();
	if(isset($_SESSION["username"]) && isset($_SESSION["password"]))
	{
		$username=$_SESSION["username"];
		$password=$_SESSION["password"];	
		$serverName = 'RASHID-HAIER-LA\RASHIDABBASI14';
		$connectionInfo = array( "Database"=>'Trims');
		$conn = sqlsrv_connect( $serverName, $connectionInfo);
		$sql="SELECT [username], [uType]
			FROM [Trims].[Py].[Users] 
			WHERE username = '$username' AND password = '$password'";
		$stmt = sqlsrv_query( $conn, $sql);	
		$rows = sqlsrv_has_rows( $stmt );
		if ($rows === false)
			echo "<script>location.href = 'login.php'</script>";
		else
		{
			while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
				  $uType = $row["uType"];
			}
			sqlsrv_free_stmt( $stmt);
		}
		if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
			echo "<script>location.href = 'logout.php'</script>";
			$_SESSION['LAST_ACTIVITY'] = time();
		}
	}
	else
		echo "<script>location.href = 'login.php'</script>";
?>
<link rel="stylesheet" type="text/css" href="../CSS/layout.css">
