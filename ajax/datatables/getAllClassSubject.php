<?php
include '../../core/config.php';
$account_id = $_SESSION['account_id'];
$class_id = $_GET['class_id'];
	$result = mysql_query("SELECT * FROM tbl_class_subject WHERE t_id = $account_id AND class_id = $class_id") or die (mysql_error());
	$count = 1;
	$response['data'] = array();
	while($row = mysql_fetch_array($result)){
		$data = getData("sub_code,sub_name","tbl_subject","sub_id = ".$row['s_id']);
		$list = array();
		$list['count'] = $count;
		$list['code'] = $data[0];
		$list['name'] = $data[1];
		$list['action'] = "
				<button class='btn btn-danger' onclick='removeSub($row[0])'><span class='fa fa-minus-circle'></span></button>
				";
		array_push($response['data'], $list);
	$count++;
	}
	echo json_encode($response);
?>