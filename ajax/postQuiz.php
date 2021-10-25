<?php
include '../core/config.php';
$class_id = $_POST['class_id'];
$sub_id = $_POST['sub_id'];
$cq_id = $_POST['cq_id'];
$t_id = $_SESSION['account_id'];
$date_posted = date('Y-m-d');
$over = mysql_fetch_array(mysql_query("SELECT COUNT(cq_id) FROM `tbl_class_quiz_detail` WHERE cq_id = $cq_id"));
$query  = mysql_query("UPDATE `tbl_class_quiz_head` SET status = 1,date_posted = '$date_posted',`over` = '$over[0]' WHERE class_id = $class_id AND sub_id = $sub_id AND cq_id = $cq_id AND t_id = $t_id");
if($query){
	$tname = getTeacherNick($t_id);
	$qname = getQuizName($cq_id);
	$sname = getSubjectName($sub_id);
	$link = md5('class-quiz')."&sub_id=$sub_id&class_id=$class_id&quiz=$cq_id";
	$msg = "$tname posted $qname [$sname]";
	addNotif("Posted Quiz",$msg,$link,0,1);
	stuQuizNotif("New Quiz",$msg,$class_id,$sub_id);
	echo 1;
}else{
	echo 0;
}
?>