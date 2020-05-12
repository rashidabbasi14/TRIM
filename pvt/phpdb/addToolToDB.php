<table>
<?php 

	if(isset($_POST["submit"]) && !empty($_POST["inpname"]))
	{
		
		
		$target_dir = "../../Images/Tools/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if($check !== false) {
				$uploadOk = 1;
			} else {
				echo "<script>alert('File is not an image.'); location.href = '../tool.php';</script>";
				$uploadOk = 0;
			}
		}
		// Check if file already exists
		if (file_exists($target_file)) {
			echo "<script>alert('Sorry, file already exists.');location.href = '../tool.php';</script>";
			$uploadOk = 0;
		}
		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 500000) {
			echo "<script>alert('Sorry, your file is too large.'); location.href = '../tool.php';</script>";
			$uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
			echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.'); location.href = '../tool.php';</script>";
			$uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			
			echo "<script>alert('Sorry, your file was not uploaded.'); location.href = '../tool.php';</script>";
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				$serverName = 'RASHID-HAIER-LA\RASHIDABBASI14';
				$connectionInfo = array( "Database"=>'Trims');
				$conn = sqlsrv_connect( $serverName, $connectionInfo);
				$sql="INSERT INTO [Py].[Tool]
					   ([name]
					   ,[picturepath])
				 VALUES
					   ('".$_POST["inpname"]."',
					   '".basename($_FILES["fileToUpload"]["name"])."')";
				$stmt = sqlsrv_query( $conn, $sql);
				
				
				echo "<script>alert('Uploaded.'); location.href = '../tool.php';</script>";

			} else {
				echo "<script>alert('Sorry, there was an error uploading your file.'); location.href = '../tool.php';</script>";
			}
		}
	}
	else
		echo "<script>alert('Please fill all the fields.'); location.href = '../tool.php';</script>";

?>
</table>