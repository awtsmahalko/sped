<?php
$cq_id = $_GET['quiz'];
if(isset($_GET['id'])){
	$id = $_GET['id'];
}else{
	$id = $_SESSION['account_id'];
}
$get_quiz_details = getData("quiz_name,status,date_posted,t_id,sub_id,class_id,quarter","tbl_class_quiz_head","cq_id = $cq_id");

if($get_quiz_details[6] == 1){
	$quarter_label = "FIRST QUARTER";
}else if($get_quiz_details[6] == 2){
	$quarter_label = "SECOND QUARTER";
}else if($get_quiz_details[6] == 3){
	$quarter_label = "THIRD QUARTER";
}else if($get_quiz_details[6] == 4){
	$quarter_label = "FORTH QUARTER";
}else{
	$quarter_label = "NOT FOUND";
}

$class_name = getData("class_name,class_section,class_year","tbl_class","class_id = $get_quiz_details[5]");
$get_score = getData("score,`over`","tbl_stu_quiz_head","cq_id = $cq_id AND stu_id = $id");
?>
<div class="page-wrapper">
	<!-- Container fluid  -->
	<div class="container-fluid">
		<!-- Start Page Content -->
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<div class="row" style="color:#1b1a1a;">
								<div class="col-md-3">
									<center><img src='images/customLogo.png'></center>
								</div>
								<div class="col-md-6">
									<center style="line-height: 18px;">
										<span>Republic of the Philippines</span><br>
										<span>Department of Education</span><br>
										<span>Region VI - Western Visayas</span><br>
										<span>Division of Bacolod</span><br>
										<span>BACOLOD CITY SPED CENTER</span><br><br>
										<!-- <span>SPED CENTER CURRICULUMN</span><br><br> -->
										<span><?= strtoupper($get_quiz_details[0])." IN ".strtoupper(getSubjectName($get_quiz_details[4]));?></span><br>
										<span><?=$quarter_label;?></span>
									</center>
								</div>
								<div class="col-md-3">
									<center><img src='images/deped.png' height="100px" width="100px"></center>
								</div>
							</div><br>
							<div class="row">
								<div class="col-md-6">
									<span>Instructor Name: <?=strtoupper(getTeacherName($get_quiz_details[3]));?></span>
								</div>
								<div class="col-md-3">
									<span>Class: <?=$class_name[0]." - ".$class_name[1]?></span>
								</div>
								<div class="col-md-3">
									<span>SY: <?=$class_name[2]." - ".($class_name[2] + 1)?></span>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<span>Student Name: <?=strtoupper(getStudentName($id));?></span>
								</div>
								<div class="col-md-3">
									<span>Score: <?=$get_score[0]?></span>
								</div>
								<div class="col-md-3">
									<span>Over: <?=$get_score[1]?></span>
								</div>
							</div>
							<hr style="border:1px solid">
							<!-- <div id='item_div' style="height:350px;overflow:auto;"> -->
							<div id='item_div'>
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
<script type='text/javascript'>
$(document).ready(function (){
	getItemData();
});
function getItemData(){
	$.post("ajax/stu_ItemDataAnswer.php",{
		cq_id:<?= $cq_id; ?>,
		id:<?=$id?>,
		restrict:0
	},function (data,status){
		$("#item_div").html(data);
	});
}
</script>