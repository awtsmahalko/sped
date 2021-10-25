<?php
include '../core/config.php';
	$id = $_GET['id'];
	$question = clean($_POST['question']);
	$choice_a = clean($_POST['choice_a']);
	$choice_b = clean($_POST['choice_b']);
	$answer = $_POST['answer'];
	$filename = $_FILES['file']['name'];
	$count = mysql_fetch_array(mysql_query("SELECT count(*) FROM `tbl_class_quiz_detail` WHERE cq_id = '$id'"));
	$item_no = $count[0] + 1;
	if($filename == ""){
		$query = mysql_query("INSERT INTO `tbl_class_quiz_detail` (`cqd_id`, `cq_id`, `quest`, `item_no`, `item_1`, `item_2`, `answer`) VALUES (NULL, '$id', '$question', '$item_no', '$choice_a', '$choice_b', '$answer')");
		if($query){
			echo 1;
		}else{
			echo 0;
		}
	}else{
		$location =  "../question/".$filename;

		// file extension
		$file_extension = pathinfo($location, PATHINFO_EXTENSION);
		$file_extension = strtolower($file_extension);

		// Valid image extensions
		$image_ext = array("jpg","png","jpeg","gif");

		$response = 0;
		if(in_array($file_extension,$image_ext)){
		  // Upload file
		  if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
			$query = mysql_query("INSERT INTO `tbl_class_quiz_detail` (`cqd_id`, `cq_id`, `quest`, `item_no`, `item_1`, `item_2`, `answer`, `img`) VALUES (NULL, '$id', '$question', '$item_no', '$choice_a', '$choice_b', '$answer', '$filename')");
		  	if($query){
		  		echo 1;
		  	}else{
		  		echo 0;
		  	}
		  }else{
		  	echo 0;
		  }
		}else{
			echo 2;
		}
	}
?>