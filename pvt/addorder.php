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
			<?php
				echo "<div style='margin:0 auto;width: 100px;'><h4>Add PurchaseOrder</h4></div><br><br>";
				
				$serverName = 'RASHID-HAIER-LA\RASHIDABBASI14';
				$connectionInfo = array( "Database"=>'Trims');
				$conn = sqlsrv_connect( $serverName, $connectionInfo);
				
				$sql="SELECT
						*
						FROM
						Py.PurchaseOrder";
				$stmt = sqlsrv_prepare( $conn, $sql);
				foreach( sqlsrv_field_metadata( $stmt ) as $fieldMetadata ) {
					$col=$fieldMetadata["Name"];
					$test='"Lucida Sans Unicode"';
					if($col!="poid")
					{
						if(strpos($col, "dt"))
						{
							if($col != "ordereddt")
								echo "$col <div style='position:absolute; display:inline; left:130;'><input type='date' id='inp$col' value=''></div><br><br>";
						}
						else if($col == "toolid")
						{
							echo "<l id='ldept'>toolid</l>&emsp;  &emsp;&emsp;&emsp; &emsp;<select id='dept_id'>";
								$sql="SELECT *
									FROM [Trims].[Py].[Tool]";
								$stmt = sqlsrv_query( $conn, $sql);
								if($stmt)
								while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC))  {
									$toolid=$row["toolid"];
									$name=$row["name"];
									echo "<option value='$toolid'>$name</option>";
								}
								echo "</select><br><br>";
						}
						else
							echo "$col <div style='position:absolute; display:inline; left:130;'><input id='inp$col' value=''></div><br><br>";
					}
				}
			?>
		</div>
	</body>
	<script>
			var counter = 0;
			var string = '';
			
			function CancelBut()
			{
				location.href = 'order.php';
			}
			
			function itemSave()
			{
				
				var counter=0;
				var flag=0;
				$("select").each(function(){
					if(this.value!=''){
						if(counter==0)
								string = string+"toolid="+this.value;
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
					var url = "phpdb/addOrderToDB.php";
					hr.open("POST",url,true);
					hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					hr.onreadystatechange=function()
					{
						if(hr.readyState == 4 && hr.status == 200)
						{
							var return_data = hr.responseText;
							r=confirm(return_data);
							location.href = 'addOrder.php';
						}
					}
					hr.send(string);
				}
				else
					alert("Fields cannot be empty.");
			}
	</script>