<?php
include '../core/config.php';
	$t_id = $_SESSION['account_id'];
	$stu_fname = clean($_POST['stu_fname']);
	$stu_mname = clean($_POST['stu_mname']);
	$stu_lname = clean($_POST['stu_lname']);
	$stu_special = $_POST['stu_special'];
	$stu_gender = clean($_POST['stu_gender']);
	$stu_bdate = date("Y-m-d",strtotime($_POST['stu_bdate']));

	$stu_f_name = clean($_POST['stu_f_name']);
	$stu_f_bdate = date("Y-m-d",strtotime($_POST['stu_f_bdate']));
	$stu_f_occ = clean($_POST['stu_f_occ']);
	$stu_f_add = clean($_POST['stu_f_add']);
	$stu_f_no = clean($_POST['stu_f_no']);

	$stu_m_name = clean($_POST['stu_m_name']);
	$stu_m_bdate = date("Y-m-d",strtotime($_POST['stu_m_bdate']));
	$stu_m_occ = clean($_POST['stu_m_occ']);
	$stu_m_add = clean($_POST['stu_m_add']);
	$stu_m_no = clean($_POST['stu_m_no']);

	$fname = "S".substr($stu_lname, 0,1)."".substr($stu_fname, 0,1)."".substr($stu_mname, 0,1)."".date("Ymd",strtotime($_POST['stu_bdate']));
	$count = mysql_fetch_array(mysql_query("SELECT COUNT(stu_id) FROM tbl_student WHERE stu_fname = '$stu_fname' AND stu_lname = '$stu_lname'"));
	if($count[0] > 0){
		echo 2;
	}else{
		$temp = explode(".", $_FILES["fileToUpload"]["name"]);
      	$extension = end($temp);
		$filename = strtoupper($fname).".".$extension;

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
				$query = mysql_query("INSERT INTO `tbl_student`(`stu_id`, `t_id`, `stu_lname`, `stu_fname`, `stu_mname`, `stu_special`, `stu_gender`, `stu_bdate`, `status`, `stu_f_name`, `stu_f_bdate`, `stu_f_occ`, `stu_f_add`, `stu_f_no`, `stu_m_name`, `stu_m_bdate`, `stu_m_occ`, `stu_m_add`, `stu_m_no`, `img`) VALUES (NULL,'$t_id','$stu_lname','$stu_fname','$stu_mname','$stu_special','$stu_gender','$stu_bdate',0,'$stu_f_name','$stu_f_bdate','$stu_f_occ','$stu_f_add','$stu_f_no','$stu_m_name','$stu_m_bdate','$stu_m_occ','$stu_m_add','$stu_m_no','$filename')");
				$account_id = mysql_insert_id();
				if($query){
					addUser($stu_fname,$stu_lname,1,$account_id);
					echo 1;
				}else{
					echo "Error while saving product!";
				}
		    } else {
		        echo "Sorry, there was an error uploading your file.";
		    }
		}
	}
?>