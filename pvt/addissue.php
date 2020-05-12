<?php include 'home.php';?>
<body>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">		
		<div class="panel panel-default" style="position:relative;">
		  <div class="panel-body">	
				<button id="savBut" class ="btn btn-default" onclick="itemSave()"> Save </button>
				<button id="button5" class ="btn btn-default" onclick="CancelBut()"> Cancel </button>
		  </div>
		</div>
		<div style='padding-left:20px;'>
		<table class="table table-hover">
			<?php
				echo "<div style='margin:0 auto;width: 100px;'><h4>Add Issue</h4></div><br><br>";
				
				$serverName = 'RASHID-HAIER-LA\RASHIDABBASI14';
				$connectionInfo = array( "Database"=>'Trims');
				$conn = sqlsrv_connect( $serverName, $connectionInfo);
				
				$sql="SELECT
						*
						FROM
						Py.Issue";
				$stmt = sqlsrv_prepare( $conn, $sql);
				foreach( sqlsrv_field_metadata( $stmt ) as $fieldMetadata ) {
					echo "<tr>";
					$col=$fieldMetadata["Name"];
					$test='"Lucida Sans Unicode"';
					if($col!="issueid")
					{
						if(strpos($col, "dt"))
							echo "<td>$col</td> <td><div style='position:absolute; display:inline;'><input type='date' id='inp$col' value=''></div></td>";
						else if($col == "projectid")
						{
							echo "<td><l id='ldept'>projectid</l></td><td><select style='width:150px' id='projectid'>";
								$sql="SELECT *
									FROM [Trims].[Py].[Project]";
								$stmt = sqlsrv_query( $conn, $sql);
								if($stmt)
								while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC))  {
									$toolid=$row["projectid"];
									$name=$row["title"];
									echo "<option value='$toolid'>$name</option>";
								}
								echo "</select></td>";
						}
						else if($col == "userid")
						{
							echo "<td><l id='ldept'>userid</l></td><td><select style='width:150px' id='userid'>";
								$sql="SELECT *
									FROM [Trims].[Py].[Users]";
								$stmt = sqlsrv_query( $conn, $sql);
								if($stmt)
								while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC))  {
									$toolid=$row["userid"];
									$name=$row["username"];
									echo "<option value='$toolid'>$name</option>";
								}
								echo "</select></td>";
						}
						else if($col == "toolid")
						{
							echo "<td><l id='ldept'>toolid</l></td><td><select style='width:150px' id='toolid'>";
								$sql="SELECT *
									FROM [Trims].[Py].[Tool]";
								$stmt = sqlsrv_query( $conn, $sql);
								if($stmt)
								while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC))  {
									$toolid=$row["toolid"];
									$name=$row["name"];
									echo "<option value='$toolid'>$name</option>";
								}
								echo "</select><td>";
						}
						else
							echo "<td>$col</td> <div style='position:absolute; display:inline;'><td><input id='inp$col' value=''></div></td>";
					}
				}
				echo "</tr>";
			?>
		</div>
	</body>
	<script>
			var counter = 0;
			var string = '';
			
			function CancelBut()
			{
				location.href = 'Issue.php';
			}
			
			function itemSave()
			{
				var counter=0;
				var flag=0;
				$("select").each(function(){
					if(this.value!=''){
						if(counter==0)
								string = string+'field'+counter+"="+this.value;
							else
								string = string+'&field'+counter+"="+this.value;
							counter++;
					}
					else
						flag=1;
				});
				$("input").each(function(){
					if(this.value!=''){
						if(counter==0)
								string = string+'field'+counter+"="+this.value;
							else
								string = string+'&field'+counter+"="+this.value;
							counter++;
					}
					else
						flag=1;
				});
				if(flag==0){
					var hr = new XMLHttpRequest();
					var url = "phpdb/addIssueToDB.php";
					hr.open("POST",url,true);
					hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					hr.onreadystatechange=function()
					{
						if(hr.readyState == 4 && hr.status == 200)
						{
							var return_data = hr.responseText;
							r=confirm(return_data);
							location.href = 'addIssue.php';
						}
					}
					hr.send(string);
				}
				else
					alert("Fields cannot be empty.");
			}
	</script>