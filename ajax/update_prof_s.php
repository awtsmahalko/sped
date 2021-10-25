<?php
include '../core/config.php';
$account_id = $_SESSION['account_id'];
$stu_lname = clean($_POST['stu_lname']);
$stu_fname = clean($_POST['stu_fname']);
$stu_mname = clean($_POST['stu_mname']);
$stu_bdate = date("Y-m-d",strtotime($_POST['stu_bdate']));
$stu_gender = $_POST['stu_gender'];
$stu_special = $_POST['stu_special'];

$stu_f_name = clean($_POST['stu_f_name']);
$stu_f_bdate = date("Y-m-d",strtotime($_POST['stu_f_bdate']));
$stu_f_occ = clean($_POST['stu_f_occ']);
$stu_f_add = clean($_POST['stu_f_add']);
$stu_f_no = clean($_POST['stu_f_no']);

$stu_m_name = clean($_POST['stu_m_name']);
$stu_m_bdate = date("Y-m-d",strtotime($_POST['stu_m_bdate']));
$stu_m_occ = clean($_POST['stu_m_occ']);
$stu_m_add = clean($_POST['stu_m_add']);
$stu_m_no = clean($_POST['stu_m_no']);

// $query = mysql_query("UPDATE `tbl_student` SET `stu_lname` = '$stu_lname', `stu_fname` = '$stu_fname', `stu_mname` = '$stu_mname', `stu_special` = '$stu_special', `stu_gender` = '$stu_gender', `stu_bdate` = '$stu_bdate' WHERE `stu_id` = $account_id");
$query = mysql_query("UPDATE `tbl_student` SET `stu_lname` = '$stu_lname', `stu_fname` = '$stu_fname', `stu_mname` = '$stu_mname', `stu_special` = '$stu_special', `stu_gender` = '$stu_gender', `stu_bdate` = '$stu_bdate',`stu_f_name`='$stu_f_name',`stu_f_bdate`='$stu_f_bdate',`stu_f_occ`='$stu_f_occ',`stu_f_add`='$stu_f_add',`stu_f_no`='$stu_f_no',`stu_m_name`='$stu_m_name',`stu_m_bdate`='$stu_m_bdate',`stu_m_occ`='$stu_m_occ',`stu_m_add`='$stu_m_add',`stu_m_no`='$stu_m_no' WHERE `stu_id` = $account_id");
if($query){
	$_SESSION['lname'] = $stu_fname;
	echo 1;
}else{
	echo 0;
}