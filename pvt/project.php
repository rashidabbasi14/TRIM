<?php include 'home.php';?>
<script>
		var hidden=0;
		var Projects=[];
	</script>
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	</head>
	<body>
			<div class="panel panel-default" style="position:relative;">
			  <div class="panel-body">
					<button name="addField" id="addField" class ="btn btn-default" onclick="addProject();"> Add Project </button>
					<button name="RemItem" id="RemItem" class ="btn btn-default" onclick="test();"> Remove Project </button>
			  </div>
			</div>
		<div style="padding:30px">
				<h2> Projects </h2>
				<table class="table table-hover">
					<thead>
					  <tr>
						<th class="cToggle" style="display:none;"></th>
						<?php
							$serverName = 'RASHID-HAIER-LA\RASHIDABBASI14';
							$connectionInfo = array( "Database"=>'Trims');
							$conn = sqlsrv_connect( $serverName, $connectionInfo);
							$sql="SELECT
									*
									FROM
									Py.Project";
							$stmt = sqlsrv_prepare( $conn, $sql);
							foreach( sqlsrv_field_metadata( $stmt ) as $fieldMetadata ) {
								echo "<th>".$fieldMetadata["Name"]."</th>";
							}
						?>
						<th>No of Issues</th>
						<th>View</th>
					  </tr>
					</thead>
					<tbody>				
					<?php
						$sql="SELECT *
							FROM [Trims].[Py].[Project]";
						$stmt = sqlsrv_query( $conn, $sql);
						while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC))  {
							echo "<tr>";
							echo "<td class='cToggle' style='display:none;'><input value='".$row[0]."' class='citem' type='checkbox' style='position:relative;'></td>";
							 echo "<td> ".$row[0]."</td>";  
							 echo "<td> ".$row[1]."</td>";
							 
							 $sql1="SELECT count(*)
							FROM [Trims].[Py].[Issue]
							where projectid=".$row[0];
							$stmt1 = sqlsrv_query( $conn, $sql1);
							$row1 = sqlsrv_fetch_array( $stmt1, SQLSRV_FETCH_NUMERIC);
							$test="'show.php?pid=".$row[0]."'";
							 echo "<td> ".$row1[0]."</td>";
							 echo '<td><button type="button" onclick="newPopup('.$test.')">Show</button></td>';
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

	<script type="text/javascript">
	
		function newPopup(url) {
			popupWindow = window.open(
				url,'popUpWindow','height=450,width=600,left=auto,top=auto,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
		}

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
		function addProject()
		{
			location.href = 'addProject.php';
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
			var url = "phpdb/delProjectFromDB.php";
			hr.open("POST",url,true);
			hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			hr.onreadystatechange=function()
			{
				if(hr.readyState == 4 && hr.status == 200)
				{
					var return_data = hr.responseText;
					r=confirm(return_data);
					document.location.href = "Project.php";
				}
			}
			hr.send(string);
		});
	</script>