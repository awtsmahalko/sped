<?php
include '../core/config.php';
	$id = $_SESSION['account_id'];
	$user_type = $_SESSION['user_type'];
		if($user_type == 1){
			$tbl = "tbl_student";
			$param = "stu_id = $id";
			$fstr = "S-".date("his");
		}else if($user_type == 2){
			$tbl = "tbl_teacher";
			$param = "t_id = $id";
			$fstr = "T-".date("his");
		}else{
			$tbl = "tbl_principal";
			$param = "p_id = $id";
			$fstr = "P-".date("his");
		}
		$get_file = mysql_fetch_array(mysql_query("SELECT img FROM $tbl WHERE $param"));
		$old_file = $get_file[0];
		$temp = explode(".", $_FILES["fileToUpload"]["name"]);
      	$extension = end($temp);
		$filename = $fstr.".".$extension;

		$target_dir = "../pictures/";
		$target_file = $target_dir . basename($filename);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		if(isset($_POST["submit"])) {
		    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		    if($check !== false) {
		        echo "File is an image - " . $check["mime"] . ".";
		        $uploadOk = 1;
		    } else {
		        echo "File is not an image.";
		        $uploadOk = 0;
		    }
		}
		// Check if file already exists
		if (file_exists($target_file)) {
		    echo "Sorry, file already exists.";
		    $uploadOk = 0;
		}
		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 5000000) {
		    echo "Sorry, your file is too large.";
		    $uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		    $uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		    echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
		    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				$query = mysql_query("UPDATE $tbl SET img = '$filename' WHERE $param");
				if($query){
					unlink("../pictures/".$old_file);
					$_SESSION['img'] = $filename;
					echo 1;
				}else{
					unlink("../pictures/".$filename);
					echo "Error while saving product!";
				}
		    } else {
		        echo "Sorry, there was an error uploading your file.";
		    }
		}
?>