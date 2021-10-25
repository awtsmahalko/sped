<?php
include '../core/config.php';
	$sub_id = $_POST['sub_id'];
	$class_id = $_POST['class_id'];
	$quarter = $_POST['quarter'];
	$fetch = mysql_query("SELECT cq_id,quiz_name FROM `tbl_class_quiz_head` WHERE sub_id = $sub_id AND class_id = $class_id AND status = 1 AND quarter = $quarter");
	if(mysql_num_rows($fetch) > 0){
		$content = "<option value=''>&mdash; Please Select &mdash;</option>";
		while($row = mysql_fetch_array($fetch)){
			$content .= "<option value='$row[0]'>$row[1]</option>";
		}
	}else{
		$content = "";
	}
echo $content;