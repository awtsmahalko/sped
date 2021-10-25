<?php
include '../../core/config.php';
$account_id = $_SESSION['account_id'];
	$result = mysql_query("SELECT * FROM tbl_school_year ORDER BY school_year DESC") or die (mysql_error());
	$count = 1;
	$response['data'] = array();
	while($row = mysql_fetch_array($result)){
		$list = array();
		$sy = "$row[school_year] - ".($row['school_year'] + 1);
		$action = ($row['status'] == 1)?"<button class='btn btn-danger' onclick=\"closeSY('$sy')\"><span class='fa fa-lock'></span> Close SY</button>":"";
		$list['count'] = $count;
		$list['school_year'] = $sy;
		$list['status'] =($row['status'] == 1)?"<span class='label label-rouded label-success'>Currently Open</span>":"<span class='label label-rouded label-danger'>Finished</span>";
		$list['enroll'] = "<span class='label label-rouded label-danger'>".getEnrolled($row['school_year'])."</span>";
		$list['action'] = $action." <button class='btn btn-primary' data-toggle='modal' data-target='#view_modal' onclick='view_detail($row[school_year])'><span class='fa fa-list'></span> View Details</button>";
		array_push($response['data'], $list);
	$count++;
	}
	echo json_encode($response);
?>