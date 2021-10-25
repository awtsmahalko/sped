<?php
include '../core/config.php';
	$stu_id = $_POST['u_stu_id'];
	$stu_fname = clean($_POST['u_stu_fname']);
	$stu_mname = clean($_POST['u_stu_mname']);
	$stu_lname = clean($_POST['u_stu_lname']);
	$stu_special = $_POST['u_stu_special'];
	$stu_gender = $_POST['u_stu_gender'];
	$stu_bdate = date("Y-m-d",strtotime($_POST['u_stu_bdate']));

	$stu_f_name = clean($_POST['u_stu_f_name']);
	$stu_f_bdate = date("Y-m-d",strtotime($_POST['u_stu_f_bdate']));
	$stu_f_occ = clean($_POST['u_stu_f_occ']);
	$stu_f_add = clean($_POST['u_stu_f_add']);
	$stu_f_no = clean($_POST['u_stu_f_no']);

	$stu_m_name = clean($_POST['u_stu_m_name']);
	$stu_m_bdate = date("Y-m-d",strtotime($_POST['u_stu_m_bdate']));
	$stu_m_occ = clean($_POST['u_stu_m_occ']);
	$stu_m_add = clean($_POST['u_stu_m_add']);
	$stu_m_no = clean($_POST['u_stu_m_no']);

	$count = mysql_fetch_array(mysql_query("SELECT COUNT(stu_id) FROM tbl_student WHERE stu_id != $stu_id AND stu_fname = '$stu_fname' AND stu_lname = '$stu_lname'"));
	if($count[0] > 0){
		echo 2;
	}else{
		$query = mysql_query("UPDATE `tbl_student` SET `stu_lname`='$stu_lname',`stu_fname`='$stu_fname',`stu_mname`='$stu_mname',`stu_special`='$stu_special',`stu_gender`='$stu_gender',`stu_bdate`='$stu_bdate',`stu_f_name`='$stu_f_name',`stu_f_bdate`='$stu_f_bdate',`stu_f_occ`='$stu_f_occ',`stu_f_add`='$stu_f_add',`stu_f_no`='$stu_f_no',`stu_m_name`='$stu_m_name',`stu_m_bdate`='$stu_m_bdate',`stu_m_occ`='$stu_m_occ',`stu_m_add`='$stu_m_add',`stu_m_no`='$stu_m_no' WHERE stu_id = $stu_id");
		if($query){
			echo 1;
		}else{
			echo 0;
		}
	}
?>