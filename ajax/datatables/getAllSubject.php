<?php
include '../../core/config.php';
$account_id = $_SESSION['account_id'];
	$result = mysql_query("SELECT * FROM tbl_subject WHERE t_id = $account_id") or die (mysql_error());
	$count = 1;
	$response['data'] = array();
	while($row = mysql_fetch_array($result)){
		$list = array();
		if($row['lang'] == 0){
			$lang = "English";
		}else{
			$lang = "Filipino";
		}
		$list['count'] = $count;
		$list['code'] = $row['sub_code'];
		$list['name'] = $row['sub_name'];
		$list['percent'] = $row['sub_percent'];
		$list['lang'] = $lang;
		$list['action'] = "
				<button class='btn btn-success' data-toggle='modal' data-target='#update_modal' onclick='update_subject($row[0])'><span class='fa fa-edit'></span></button>
				<button class='btn btn-danger' onclick='removeSub($row[0],\"".$row['sub_name']."\")'><span class='fa fa-trash'></span></button>
				";
		array_push($response['data'], $list);
	$count++;
	}
	echo json_encode($response);
?>