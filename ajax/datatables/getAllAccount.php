<?php
include '../../core/config.php';
	$result = mysql_query("SELECT * FROM tbl_user WHERE user_id !=1") or die (mysql_error());
	$count = 1;
	$response['data'] = array();
	while($row = mysql_fetch_array($result)){
		$list = array();
		if($row['user_status'] == 1){
			$status = "<font color='green'>Active</font>";
			$action ="<button class='btn btn-sm btn-danger' onclick='deactivateAccount(".$row['user_id'].")'><span class='fa fa-edit'></span> Deactivate</button>";
		}else{
			$status = "<font color='red'>Inactive</font>";
			$action ="<button class='btn btn-sm btn-primary' onclick='activateAccount(".$row['user_id'].")'><span class='fa fa-edit'></span> Activate</button>";
		}
		if($row['user_type'] == 0){
			$type = "Admin";
		}else{
			$type = "Cashier";
		}
		$list['count'] = $count;
		$list['personnel'] = getPersonnelName($row['account_id']);
		$list['username'] = $row['username'];
		$list['password'] = $row['password'];
		$list['type'] = $type;
		$list['status'] = $status;
		$list['action'] = $action;
		array_push($response['data'], $list);
	$count++;
	}
	echo json_encode($response);
function getPersonnelName($id){
	$fetch = mysql_fetch_array(mysql_query("SELECT personnel_name FROM tbl_personnel WHERE personnel_id = '$id'"));
	return $fetch[0];
}
?>