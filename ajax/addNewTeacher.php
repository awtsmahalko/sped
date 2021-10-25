<?php
include '../core/config.php';
	$t_fname = clean($_POST['t_fname']);
	$t_mname = clean($_POST['t_mname']);
	$t_lname = clean($_POST['t_lname']);
	$t_civil_status = clean($_POST['t_civil_status']);
	$t_citizen = clean($_POST['t_citizen']);
	$t_gender = $_POST['t_gender'];

	// $m_course = clean($_POST['m_course']);
	// $m_school = clean($_POST['m_school']);
	// $m_year = clean($_POST['m_year']);

	// $b_course = clean($_POST['b_course']);
	// $b_school = clean($_POST['b_school']);
	// $b_year = clean($_POST['b_year']);

	$t_bdate = date("Y-m-d",strtotime($_POST['t_bdate']));
	$fname = "T".substr($t_lname, 0,1)."".substr($t_fname, 0,1)."".substr($t_mname, 0,1)."".date("Ymd",strtotime($_POST['t_bdate']));
	$count_t = mysql_fetch_array(mysql_query("SELECT COUNT(t_id) FROM tbl_teacher WHERE t_lname = '$t_lname' AND t_fname = '$t_fname'"));
	if($count_t[0] > 0){
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
				// $query = mysql_query("INSERT INTO `tbl_teacher` (`t_id`, `t_lname`, `t_fname`, `t_mname`, `t_gender`, `t_civil_status`, `t_citizen`, `t_bdate`, `m_course`, `m_school`, `m_year`, `b_course`, `b_school`, `b_year`, `img`) VALUES (NULL, '$t_lname', '$t_fname', '$t_mname', '$t_gender', '$t_civil_status', '$t_citizen', '$t_bdate', '$m_course', '$m_school','$m_year', '$b_course','$b_school','$b_year','$filename')");
				$query = mysql_query("INSERT INTO `tbl_teacher` (`t_id`, `t_lname`, `t_fname`, `t_mname`, `t_gender`, `t_civil_status`, `t_citizen`, `t_bdate`, `img`) VALUES (NULL, '$t_lname', '$t_fname', '$t_mname', '$t_gender', '$t_civil_status', '$t_citizen', '$t_bdate', '$filename')");
				$account_id = mysql_insert_id();
				if($query){
					$tableData = stripcslashes($_GET['c']);
					// Decode the JSON array
					$tableData = json_decode($tableData,TRUE);

					// now $tableData can be accessed like a PHP array
					foreach ($tableData as $key => $variable) {
						$degree = clean($tableData[$key]['degree']);
						$course = clean($tableData[$key]['course']);
						$school = clean($tableData[$key]['school']);
						$year_grad = clean($tableData[$key]['year']);
						mysql_query("INSERT INTO `tbl_degree`(`degree_id`, `degree_name`, `school`, `course`, `year_grad`, `t_id`) VALUES (NULL,'$degree','$school','$course','$year_grad',$account_id)");
					}
					addUser($t_fname,$t_lname,2,$account_id);
					echo 1;
				}else{
					echo 0;
				}
		    } else {
		        echo "Sorry, there was an error uploading your file.";
		    }
		}
	}