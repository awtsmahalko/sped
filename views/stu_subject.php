<?php
if($_SESSION['user_type'] != 1){
	echo "<script>window.location='index.php';</script>";
}
$user_id = $_SESSION['account_id'];
$class_id = $_GET[md5('class_id')];
$sub_id = $_GET[md5('s_id')];
getPostedQuiz($user_id,$class_id,$sub_id);
getStudQuizHead($user_id,$class_id,$sub_id);

function getPostedQuiz($user_id,$class_id,$sub_id){
	$query = mysql_query("SELECT cq_id,`over` FROM `tbl_class_quiz_head` WHERE class_id = $class_id AND sub_id = $sub_id AND status = 1");
	while($row = mysql_fetch_array($query)){
		saveStudQuizHead($row[0],$row[1],$user_id,$class_id,$sub_id);
	}
}
function saveStudQuizHead($cq_id,$over,$stu_id,$class_id,$sub_id){
	$count = mysql_fetch_array(mysql_query("SELECT COUNT(sqh_id) FROM `tbl_stu_quiz_head` WHERE cq_id = $cq_id AND class_id = $class_id AND stu_id = $stu_id AND sub_id = $sub_id"));
	if($count[0] > 0){
	}else{
		mysql_query("INSERT INTO `tbl_stu_quiz_head` (`sqh_id`, `cq_id`, `class_id`, `stu_id`, `sub_id`, `status`, `date_taken`, `over`) VALUES (NULL, '$cq_id', '$class_id', '$stu_id', '$sub_id', '', '', '$over')");
	}
}
function getStudQuizHead($stu_id,$class_id,$sub_id){
	$fetch = mysql_query("SELECT sqh_id,cq_id FROM `tbl_stu_quiz_head` WHERE class_id = $class_id AND stu_id = $stu_id AND sub_id = $sub_id");
	while($row = mysql_fetch_array($fetch)){
		$fetch_det = mysql_query("SELECT * FROM `tbl_class_quiz_detail` WHERE cq_id = $row[1]");
		while($row_det = mysql_fetch_array($fetch_det)){
			saveStudQuizDetail($row_det['cqd_id'],$class_id,$stu_id);
		}
	}
}
function saveStudQuizDetail($cqd_id,$class_id,$stu_id){
	$count = mysql_fetch_array(mysql_query("SELECT COUNT(sqd_id) FROM `tbl_stu_quiz_detail` WHERE cqd_id = $cqd_id AND class_id = $class_id AND stu_id = $stu_id"));
	if($count[0] > 0){}else{
		mysql_query("INSERT INTO `tbl_stu_quiz_detail` (`sqd_id`, `cqd_id`, `class_id`, `stu_id`, `answer`, `status`) VALUES (NULL, '$cqd_id', '$class_id', '$stu_id', '', '')");
	}
}
$stu_data = mysql_fetch_array(mysql_query("SELECT * FROM tbl_student WHERE stu_id = $user_id"));
$sub_data = mysql_fetch_array(mysql_query("SELECT * FROM tbl_subject WHERE sub_id = $sub_id"));
?>
        <div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Quizzes</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Quizzes</li>
                    </ol>
                </div>
            </div>
            <!-- End Bread crumb -->
            <!-- Container fluid  -->
            <div class="container-fluid">
                <div class="row">
					<div class="col-lg-12">
                        <div class="card bg-dark"  style='font-size:25px'>
							<div class="row">
								<div class="col-md-8">
									<span>Name: <?= $stu_data['stu_fname']." ".$stu_data['stu_mname']." ".$stu_data['stu_lname']?></span>
								</div>
								<div class="col-md-4">
									<span>Status: <?= $stu_data['stu_special'] ?></span>
								</div>
							</div>
							<div class="row">
								<div class="col-md-8">
									<span>Age: <?= getAge($stu_data['stu_bdate']);?></span>
								</div>
								<div class="col-md-4">
									<span>Gender: <?= ($stu_data['stu_gender'] == 1)? "Male": "Female";?></span>
								</div>
							</div>
							<center><span>Subject: <?= $sub_data['sub_name'];?></span></center>
							<hr style='background:white'>
							<div class="row">
								<div class="col-12 col-sm-12">
									<div class="row" id='answer-sheet'>
									</div>
								</div>
							</div>
                        </div>
                    </div>
                </div>
                <!-- End PAge Content -->
            </div>
            <!-- End Container fluid  -->
            <!-- footer -->
	<footer class="footer"> © 2018 All rights reserved. BACOLOD CITY SPED CENTER EVALUATION AND ASSESSMENT</footer>
            <!-- End footer -->
        </div>
<script>
$(document).ready( function(){
	getQuizPosted();
});
function getQuizPosted(){
	$.post("ajax/stu_getQuizzes.php",{
		class_id: <?= $class_id ?>,
		sub_id: <?= $sub_id ?>,
		user_id: <?= $user_id ?>
	}, function (data,status){
		$("#answer-sheet").html(data);
	});
}
</script>