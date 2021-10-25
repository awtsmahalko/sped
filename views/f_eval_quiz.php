<div class="page-wrapper">
	<!-- Bread crumb -->
	<div class="row page-titles">
		<div class="col-md-5 align-self-center">
		</div>
		<div class="col-md-7 align-self-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
				<li class="breadcrumb-item active">Dashboard</li>
			</ol>
		</div>
	</div>
	<!-- End Bread crumb -->
	<!-- Container fluid  -->
	<div class="container-fluid">
		<!-- Start Page Content -->
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<div class="col-md-12">
							<div class="col-md-3" style='float:left;'>
								<div class="form-group">
									<label class="control-label">Class:</label>
									<select id='class_id' onchange='getSubject()' name='class_id' class="form-control select2" required>
										<option value='0'>&mdash; Select Class &mdash; </option>
										<?php
										if($_SESSION['user_type'] == 2){
											$inject = " WHERE t_id = ".$_SESSION['account_id'];
										}else{
											$inject = "";
										}
										$fetch_class = mysql_query("SELECT * FROM tbl_class$inject");
										while($row_class = mysql_fetch_array($fetch_class)){
											$class_text = "$row_class[class_name] - $row_class[class_section] ($row_class[class_year]-".($row_class['class_year'] + 1).") [".getTeacherName($row_class['t_id'])."]"; 
										?>
										<option value='<?= $row_class['class_id']; ?>'><?=strtoupper($class_text);?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="col-md-3" style='float:left;'>
								<div class="form-group">
									<label class="control-label">Subject :</label>
									<select id='subject_id' onchange="changeSubject()" name='subject_id' class="form-control select2" required>
									</select>
								</div>
							</div>
							<div class="col-md-3" style='float:left;'>
								<div class="form-group">
									<label class="control-label">Quarter :</label>
									<select id='quarter' onchange='getQuizName()' name='quarter' class="form-control select2" required>
										<option value="0">&mdash; Please Select &mdash;</option>
										<option value="1">First Quarter</option>
										<option value="2">Second Quarter</option>
										<option value="3">Third Quarter</option>
										<option value="4">Fourth Quarter</option>
									</select>
								</div>
							</div>
							<div class="col-md-3" style='float:left;'>
								<div class="form-group">
									<label class="control-label">Quiz :</label>
									<select onchange='getAllQuiz()' id='quiz_name' class="form-control select2" required>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div id="list-content">
					</div>
				</div>
			</div>
		</div>
		<!-- End PAge Content -->
	</div>
	<!-- End Container fluid  -->
	<!-- footer -->
	<footer class="footer"> &copy; 2018 All rights reserved. BACOLOD CITY SPED CENTER EVALUATION AND ASSESSMENT</footer>
	<!-- End footer -->
</div>
<?php include 'modals/modal_assessment.php'; ?>
<script type='text/javascript'>
$(document).ready(function (){
});
function getAllQuiz(){
	var cq_id = $("#quiz_name").val();
	if(cq_id ==""){
		alert("Choose quiz first");
	}else{
		$.post("ajax/getFEvalQuiz.php",{
			cq_id:cq_id
		},function(data,status){
			$("#list-content").html(data);
		});
	}
}
function getQuizName(){
	var class_id = $("#class_id").val();
	var sub_id = $("#subject_id").val();
	var quarter = $("#quarter").val();
	$.post("ajax/getQuizOptQuarter.php",{
		class_id:class_id,
		sub_id:sub_id,
		quarter:quarter
	}, function (data,status){
		$("#list-content").html("<center><h3><strong><span class='fa fa-exclamation'></span> No data found.</strong></h3></center>");
		$("#quiz_name").html(data);
	});
}
function getSubject(){
	var id = $("#class_id").val();
	$.post("ajax/getSubject.php",{
		id:id
	}, function (data,status){
		$("#list-content").html("");
		$("#subject_id").html(data);
	});
}
function changeSubject() {
 	$("#quarter").val(0);
 	$("#quiz_name").html("");
	$("#list-content").html("<center><h3><strong><span class='fa fa-exclamation'></span> No data found.</strong></h3></center>");
 }
function printDiv(inventory_balance){
	var printContents = document.getElementById(inventory_balance).innerHTML;
	var originalContents = document.body.innerHTML;
	document.body.innerHTML = printContents;
	window.print();
	document.body.innerHTML = originalContents;
 }
</script>