<?php include 'home.php';?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
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
									Py.Issue";
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
							where projectid=".$_GET["pid"];
						$stmt = sqlsrv_query( $conn, $sql);
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