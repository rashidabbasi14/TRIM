<?php include 'pvt/home.php';?>

<html>

<head>
  <title>Index</title>
  
  
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  
  
  <style>
    html, body {
		text-transform: capitalize;
      height: 100%;
      width: 100%;
      margin: 0;
    }
    #header {
      background-image: url(Images/header.png);
      background-position: center;
      background-repeat: no-repeat;
      background-color: black;
      height: 15%;
    }
    #midsection {
      height: 81%;
      width: 100%;
      margin: 0; 
    }
    #htitle {
    	margin: 0;
    	padding: 2%;
    }
    #titlebox{
    	height: 10%;
    }
    #sidebar {
      width: 20%;
      height: 100%;
      margin: 0;
      background-color: #2196f382;
      overflow-y: scroll;
      float: left;
    }
    .center {
      text-align: center;
    }
    ul {
      list-style-type: none;
    }
    #contentarea {
      height: 100%;
      width: 80%;
      margin: 0;
      float: left;
    }
    #contentiframe {
      width: 100%;
      height: 90%;
      margin: 0;
      border: none;
    }
    .list-unstyled {
      padding-left: 0;
      display: flex;
      list-style: none;
    }
    #footer {
      height: 4%;
      background-color: grey;
      text-align: center;
      margin: 0;
	  padding:7px;
    }  
  </style>
  
  <style>
/* width */
::-webkit-scrollbar {
  width: 10px;
}

/* Track */
::-webkit-scrollbar-track {
  box-shadow: inset 0 0 5px grey; 
  border-radius: 10px;
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: gray; 
  border-radius: 10px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #00000000; 
}
</style>


</head>

<body>
  <section id="header">
		<div style="text-align: center; padding-top: 1%; color: white">
		<h1 >Tool Room</h1>
		<div style="right:15;top:15; position:absolute">
			<p>Welcome, <?php echo $username; ?><br>
			<button onclick="window.location.href='#logout'" name="logoutB" class ="btn btn-default"> Log out</button>
		</div>
  </section>

  <section id= "midsection">
  <section id="sidebar">
	<div id = "aPanel" style="display:none">
		<h3 style="text-align: center;">Admin Panel</h3>
		<ul class="list-group">
		  <a href="#AllUsers"><li class="list-group-item d-flex justify-content-between align-items-center">
			Users
			<?php
				$sql="SELECT count(*)
							FROM [Trims].[Py].[Users]";
						$stmt = sqlsrv_query( $conn, $sql);
						if($stmt)
							$row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC);
			?>
			<span class="badge badge-primary badge-pill"><?php echo $row[0]?></span>
		  </li></a>
    </ul>
	</div>
  <div id = "Visitor Division">
      <h3 style="text-align: center;">Tools</h3>
      <ul class="list-group">
		  <a href="#AllTools"><li class="list-group-item d-flex justify-content-between align-items-center">
			Tools
			<?php
				$sql="SELECT count(*)
							FROM [Trims].[Py].[Tool]";
						$stmt = sqlsrv_query( $conn, $sql);
						if($stmt)
							$row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC);
			?>
			<span class="badge badge-primary badge-pill"><?php echo $row[0]?></span>
		  </li></a>
    </ul>
  </div>
  <div id = "Admin Division">
      <h3 style="text-align: center;">Projects</h3>
      <ul class="list-group">
		  <a href="#AllProjects"><li class="list-group-item d-flex justify-content-between align-items-center">
			Projects
			<?php
				$sql="SELECT count(*)
							FROM [Trims].[Py].[Project]";
						$stmt = sqlsrv_query( $conn, $sql);
						if($stmt)
							$row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC);
			?>
			<span class="badge badge-primary badge-pill"><?php echo $row[0]?></span>
		  </li></a>
		  <a href="#IssueTool"><li class="list-group-item d-flex justify-content-between align-items-center">
			Issued Tool
			<?php
				$sql="SELECT count(*)
							FROM [Trims].[Py].[Issue]";
						$stmt = sqlsrv_query( $conn, $sql);
						if($stmt)
							$row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC);
			?>
			<span class="badge badge-primary badge-pill"><?php echo $row[0]?></span>
		  </li></a>
		  <a href="#TIssues"><li class="list-group-item d-flex justify-content-between align-items-center">
			To-Be Issued
			<?php
				$sql="SELECT count(*)
							FROM [Trims].[Py].[Issue]
							WHERE fromdt > CONVERT (date, GETDATE())";
						$stmt = sqlsrv_query( $conn, $sql);
						if($stmt)
							$row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC);
			?>
			<span class="badge badge-primary badge-pill"><?php echo $row[0]?></span>
		  </li></a>
		  <a href="#PIssues"><li class="list-group-item d-flex justify-content-between align-items-center">
			Previous Issues
			<?php
				$sql="SELECT count(*)
							FROM [Trims].[Py].[Issue]
							WHERE tilldt < CONVERT (date, GETDATE())";
						$stmt = sqlsrv_query( $conn, $sql);
						if($stmt)
							$row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC);
			?>
			<span class="badge badge-primary badge-pill"><?php echo $row[0]?></span>
		  </li></a>
		  <a href="#OIssues"><li class="list-group-item d-flex justify-content-between align-items-center">
			OnGoing Issues
			<?php
				$sql="SELECT count(*)
							FROM [Trims].[Py].[Issue]
							WHERE fromdt <= CONVERT (date, GETDATE())
							AND tilldt >= CONVERT (date, GETDATE())";
						$stmt = sqlsrv_query( $conn, $sql);
						if($stmt)
							$row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC);
			?>
			<span class="badge badge-primary badge-pill"><?php echo $row[0]?></span>
		  </li></a>
    </ul>
  </div>
  <div id = "User Division">
     <h3 style="text-align: center;">Orders</h3>
     <ul class="list-group">
		  <a href="#AllOrders"><li class="list-group-item d-flex justify-content-between align-items-center">
			Orders
			<?php
				$sql="SELECT count(*)
							FROM [Trims].[Py].[PurchaseOrder]";
						$stmt = sqlsrv_query( $conn, $sql);
						if($stmt)
							$row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC);
			?>
			<span class="badge badge-primary badge-pill"><?php echo $row[0]?></span>
		  </li></a>
		  <a href="#PendingOrders"><li class="list-group-item d-flex justify-content-between align-items-center">
			Pending Orders
			<?php
				$sql="SELECT count(*)
							FROM [Trims].[Py].[PurchaseOrder]
							WHERE expectedarrivaldt > getdate()";
						$stmt = sqlsrv_query( $conn, $sql);
						if($stmt)
							$row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC);
			?>
			<span class="badge badge-primary badge-pill"><?php echo $row[0]?></span>
		  </li></a>
		  <a href="#ordersArrived"><li class="list-group-item d-flex justify-content-between align-items-center">
			Orders Arrived
			<?php
				$sql="SELECT count(*)
							FROM [Trims].[Py].[PurchaseOrder]
							WHERE expectedarrivaldt < getdate()";
						$stmt = sqlsrv_query( $conn, $sql);
						if($stmt)
							$row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC);
			?>
			<span class="badge badge-primary badge-pill"><?php echo $row[0]?></span>
		  </li></a>
    </ul>
	</div>
  </section>
  
  
	  <section id="contentarea">
		<iframe id="contentiframe" src="" name="pageframe"></iframe>
	  </section>
  </section>

  <section id="footer">
    Web Programming @ FAST-NU
  </section>


  <script>
    function f1() {
      var x = location.hash;
      if(x=="#login"){
        document.getElementById("contentiframe").setAttribute('src', "pvt/screen2.php");
      }
      else if(x=="#signup"){
        document.getElementById("contentiframe").setAttribute('src', "pvt/screen3.php");
      }
      else  if (x == "#AllUsers") {
        document.getElementById("contentiframe").setAttribute('src', "pvt/user.php");
      }
      else if (x == "#AllTools") {
        document.getElementById("contentiframe").setAttribute('src', "pvt/tool.php");
      }
      else if (x == "#AllProjects") {
        document.getElementById("contentiframe").setAttribute('src', "pvt/project.php");
      }
      else if (x == "#AllOrders") {
        document.getElementById("contentiframe").setAttribute('src', "pvt/order.php");
      }
      else if (x == "#IssueTool") {
        document.getElementById("contentiframe").setAttribute('src', "pvt/issue.php");
      }
      else if (x == "#admin1") {
        document.getElementById("contentiframe").setAttribute('src', "pvt/screen9.php");
      }
      else if (x == "#admin2") {
        document.getElementById("contentiframe").setAttribute('src', "pvt/screen10.php");
      }
	  else if (x == "#PendingOrders") {
        document.getElementById("contentiframe").setAttribute('src', "pvt/pendingOrder.php");
      }
	  else if (x == "#ordersArrived") {
        document.getElementById("contentiframe").setAttribute('src', "pvt/ordersArrived.php");
      }
	  else if (x == "#TIssues") {
        document.getElementById("contentiframe").setAttribute('src', "pvt/TIssues.php");
      }
	  else if (x == "#PIssues") {
        document.getElementById("contentiframe").setAttribute('src', "pvt/PIssues.php");
      }
	  else if (x == "#OIssues") {
        document.getElementById("contentiframe").setAttribute('src', "pvt/OIssues.php");
      }
	  else if (x == "#logout") {
        location.href = 'logout.php';
      }
    }
		if(<?php echo $uType; ?>)
			document.getElementById('aPanel').style.display = 'block';
	 
    window.addEventListener("load", f1);
    window.addEventListener("hashchange", f1);
   // document.getElementById("contentiframe").onload = f2;
    
  </script>

</body>

</html>