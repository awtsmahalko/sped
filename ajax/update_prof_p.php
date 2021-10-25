<?php
include '../core/config.php';
$account_id = $_SESSION['account_id'];
$p_lname = clean($_POST['p_lname']);
$p_fname = clean($_POST['p_fname']);
$p_mname = clean($_POST['p_mname']);
$p_bdate = date("Y-m-d",strtotime($_POST['p_bdate']));
$p_add = clean($_POST['p_add']);
$p_gender = $_POST['p_gender'];
$p_status = $_POST['p_status'];
$p_position = clean($_POST['p_position']);
$query = mysql_query("UPDATE `tbl_principal` SET `p_lname` = '$p_lname', `p_fname` = '$p_fname', `p_mname` = '$p_mname', `p_bdate` = '$p_bdate', `p_add` = '$p_add', `p_position` = '$p_position', `p_gender` = '$p_gender',`p_status` = '$p_status' WHERE `p_id` = $account_id");
if($query){
	echo 1;
}else{
	echo 0;
}