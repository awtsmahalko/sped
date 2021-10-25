<?php
include '../../core/config.php';
	$cq_id = $_GET['id'];
	$result = mysql_query("SELECT * FROM tbl_class_quiz_detail WHERE cq_id = $cq_id") or die (mysql_error());
	$count = 1;
	$response['data'] = array();
	while($row = mysql_fetch_array($result)){
		$list = array();
		$list['count'] = $count;
		$list['code'] = $row['quest'];
		$list['class'] = $row['item_1'];
		$list['subject'] = $row['item_2'];
		$list['year'] = $row['answer'];
		$list['action'] = "
				<button class='btn btn-success'><span class='fa fa-edit'></span></button>
				<button class='btn btn-danger'><span class='fa fa-trash'></span></button>
				";
		array_push($response['data'], $list);
	$count++;
	}
	echo json_encode($response);

?>