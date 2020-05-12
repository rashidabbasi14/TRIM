<?php include 'home.php';?>
	<script>
		var hidden=0;
		var Issues=[];
	</script>
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	</head>
	<body>
			<div class="panel panel-default" style="margin:10px;">
			  <div class="panel-body">
					<button name="addField" id="addField" class ="btn btn-default" onclick="addIssue();"> Add Issue </button>
					<button name="RemItem" id="RemItem" class ="btn btn-default" onclick="test();"> Remove Issue </button>
			  </div>
			</div>
		<div style="padding:30px">
				<h2> Issues </h2>
				<table class="table table-hover">
					<thead>
					  <tr>
						<th class="cToggle" style="display:none;"></th>
						<?php
							$serverName = 'RASHID-HAIER-LA\RASHIDABBASI14';
							$connectionInfo = array( "Database"=>'Trims');
							$conn = sqlsrv_connect( $serverName, $connectionInfo);
							$sql="SELECT *
									FROM Py.Issue
									";
							$stmt = sqlsrv_prepare( $conn, $sql);
							foreach( sqlsrv_field_metadata( $stmt ) as $fieldMetadata ) {
								echo "<th>".$fieldMetadata["Name"]."</th>";
							}
						?>
					  </tr>
					</thead>
					<tbody>				
					<?php
						$sql="SELECT *
							FROM [Trims].[Py].[Issue]
							WHERE fromdt <= CONVERT (date, GETDATE())
							AND tilldt >= CONVERT (date, GETDATE())";
						$stmt = sqlsrv_query( $conn, $sql);
						if($stmt)
						while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC))  {
							echo "<tr>";
							echo "<td class='cToggle' style='display:none;'><input value='".$row[0]."' class='citem' type='checkbox' style='position:relative;'></td>";
							 echo "<td> ".$row[0]."</td>";  
							 echo "<td> ".$row[1]."</td>";
							 echo "<td> ".$row[2]."</td>";
							 echo "<td> ".$row[3]."</td>";
							 echo "<td> ".$row[4]."</td>";
							 echo "<td> ".date_format($row[5], 'Y-m-d')."</td>";
							 echo "<td> ".date_format($row[6], 'Y-m-d')."</td>";
							echo "</tr>";
						}  
					?>
					</tbody>
				</table>
				
				
			<div class="cToggle" style="display:none;">
				<button id="DelSave" class ="btn btn-default"> Confirm </button>&emsp;&emsp;
				<button id="DelCan" class ="btn btn-default" onclick="test()"> Cancel </button>
			</div>
		</div>
		
	</body>

	<script>
		function test()
		{ 
			var elms = document.getElementsByClassName('cToggle')
			for (var i = 0; i < elms.length; i++) {
				if (elms[i].style.display === 'block')
					elms[i].setAttribute("style","display:none");
				else
					elms[i].setAttribute("style","display:block");
			}
		}
		function addIssue()
		{
			location.href = 'addIssue.php';
		}		
		$('#DelSave').click(function(event) 
		{ 
			var counter=0;
			var string='';
			$(':checkbox').each(function() {
				if(this.checked)
				{
					if(counter==0)
						string = string+'field'+counter+"="+this.value;
					else
						string = string+'&field'+counter+"="+this.value;
					counter++;
				}
			});
			string=string+"&count="+counter;
			
			var hr = new XMLHttpRequest();
			var url = "phpdb/delIssueFromDB.php";
			hr.open("POST",url,true);
			hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			hr.onreadystatechange=function()
			{
				if(hr.readyState == 4 && hr.status == 200)
				{
					var return_data = hr.responseText;
					r=confirm(return_data);
					document.location.href = "Issue.php";
				}
			}
			hr.send(string);
		});
	</script>