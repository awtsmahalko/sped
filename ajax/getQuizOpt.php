<?php
include '../core/config.php';
	$sub_id = $_POST['sub_id'];
	$class_id = $_POST['class_id'];
	$content = "<option value=''>&mdash; Please Select &mdash;</option>";
	$fetch = mysql_query("SELECT cq_id,quiz_name FROM `tbl_class_quiz_head` WHERE sub_id = $sub_id AND class_id = $class_id AND status = 1");
	while($row = mysql_fetch_array($fetch)){
		$content .= "<option value='$row[0]'>$row[1]</option>";
	}
echo $content;