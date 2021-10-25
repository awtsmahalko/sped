<?php
include '../core/config.php';
	$t_id = $_POST['u_t_id'];
	$t_fname = clean($_POST['u_t_fname']);
	$t_mname = clean($_POST['u_t_mname']);
	$t_lname = clean($_POST['u_t_lname']);
	$t_civil_status = clean($_POST['u_t_civil_status']);
	$t_citizen = clean($_POST['u_t_citizen']);
	$t_gender = clean($_POST['u_t_gender']);

	// $b_course = clean($_POST['u_b_course']);
	// $b_school = clean($_POST['u_b_school']);
	// $b_year = clean($_POST['u_b_year']);

	// $m_course = clean($_POST['u_m_course']);
	// $m_school = clean($_POST['u_m_school']);
	// $m_year = clean($_POST['u_m_year']);

	$t_bdate = date("Y-m-d",strtotime($_POST['u_t_bdate']));
	$count_t = mysql_fetch_array(mysql_query("SELECT COUNT(t_id) FROM tbl_teacher WHERE t_id != $t_id AND t_lname = '$t_lname' AND t_fname = '$t_fname'"));
	if($count_t[0] > 0){
		echo 2;
	}else{
		// $query = mysql_query("UPDATE `tbl_teacher` SET `t_lname` = '$t_lname', `t_fname` = '$t_fname', `t_mname` = '$t_mname', `t_gender` = '$t_gender', `t_civil_status` = '$t_civil_status', `t_citizen` = '$t_citizen', `t_bdate` = '$t_bdate', `b_course` = '$b_course', `b_school` = '$b_school', `b_year` = '$b_year', `m_course` = '$m_course', `m_school` = '$m_school', `m_year` = '$m_year' WHERE t_id  = $t_id");
		$query = mysql_query("UPDATE `tbl_teacher` SET `t_lname` = '$t_lname', `t_fname` = '$t_fname', `t_mname` = '$t_mname', `t_gender` = '$t_gender', `t_civil_status` = '$t_civil_status', `t_citizen` = '$t_citizen', `t_bdate` = '$t_bdate' WHERE t_id  = $t_id");
		if($query){
			$tableData = stripcslashes($_GET['c']);
			// Decode the JSON array
			$tableData = json_decode($tableData,TRUE);

			// now $tableData can be accessed like a PHP array
			mysql_query("DELETE FROM tbl_degree WHERE t_id = $t_id");
			foreach ($tableData as $key => $variable) {
				$degree = clean($tableData[$key]['degree']);
				$course = clean($tableData[$key]['course']);
				$school = clean($tableData[$key]['school']);
				$year_grad = clean($tableData[$key]['year']);
				mysql_query("INSERT INTO `tbl_degree`(`degree_id`, `degree_name`, `school`, `course`, `year_grad`, `t_id`) VALUES (NULL,'$degree','$school','$course','$year_grad',$t_id)");
			}
			echo 1;
		}else{
			echo 0;
		}
	}
?>