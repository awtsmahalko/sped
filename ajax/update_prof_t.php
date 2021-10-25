<?php
include '../core/config.php';
$account_id = $_SESSION['account_id'];
$t_lname = clean($_POST['t_lname']);
$t_fname = clean($_POST['t_fname']);
$t_mname = clean($_POST['t_mname']);
$t_bdate = date("Y-m-d",strtotime($_POST['t_bdate']));
$t_add = clean($_POST['t_add']);
$t_gender = $_POST['t_gender'];
$t_civil_status = $_POST['t_civil_status'];
$t_citizen = clean($_POST['t_citizen']);

// $b_course = clean($_POST['b_course']);
// $b_school = clean($_POST['b_school']);
// $b_year = clean($_POST['b_year']);
// $m_course = clean($_POST['m_course']);
// $m_school = clean($_POST['m_school']);
// $m_year = clean($_POST['m_year']);

// $query = mysql_query("UPDATE `tbl_teacher` SET `t_lname` = '$t_lname', `t_fname` = '$t_fname', `t_mname` = '$t_mname', `t_gender` = '$t_gender', `t_civil_status` = '$t_civil_status', `t_citizen` = '$t_citizen', `t_bdate` = '$t_bdate', `t_add` = '$t_add', `b_course` = '$b_course',`b_school` = '$b_school',`b_year` = '$b_year',`m_course` = '$m_course',`m_school` = '$m_school',`m_year` = '$m_year' WHERE `t_id` = $account_id");
$query = mysql_query("UPDATE `tbl_teacher` SET `t_lname` = '$t_lname', `t_fname` = '$t_fname', `t_mname` = '$t_mname', `t_gender` = '$t_gender', `t_civil_status` = '$t_civil_status', `t_citizen` = '$t_citizen', `t_bdate` = '$t_bdate', `t_add` = '$t_add' WHERE `t_id` = $account_id");
if($query){
	$_SESSION['lname'] = $t_lname;
	echo 1;
}else{
	echo 0;
}