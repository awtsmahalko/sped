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
							<div class="col-md-6" style='float:left;'>
								<div class="form-group">
									<label class="control-label">Filter by Class Name :</label>
									<select id='class_id' onchange='getSubject()' name='class_id' class="form-control select2" required>
										<option value='0'>--Please Select Class Name--</option>
										<?php
										if($_SESSION['user_type'] == 2){
											$inject = " WHERE t_id = ".$_SESSION['account_id'];
										}else{
											$inject = "";
										}
										$fetch_class = mysql_query("SELECT * FROM tbl_class$inject");
										while($row_class = mysql_fetch_array($fetch_class)){
										?>
										<option value='<?= $row_class['class_id']; ?>'><?= "<strong>[".$row_class['class_code']."]</strong> - <i>".$row_class['class_name']."</i> (".$row_class['class_year']." - ".($row_class['class_year'] + 1).")"; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="col-md-6" style='float:left;'>
								<div class="form-group">
									<label class="control-label">Filter by Subject :</label>
									<select onchange='getAllStudent()' id='subject_id' name='subject_id' class="form-control select2" required>
									</select>
								</div>
							</div>
						</div>
						<div class="table-responsive">
							<table id="myTable" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th width='2px'>#</th>
										<th width='2px'>Quiz</th>
										<th>Quiz Name</th>
										<th>Teacher</th>
										<th># of Items</th>
										<th># of Students Took</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
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
<?php include 'modals/modal_assessment.php'; ?>
<script type='text/javascript'>
$(document).ready(function (){
	getAllStudent();
});
function getAllStudent(){
	var sub_id = $("#subject_id").val();
	var id = $("#class_id").val();
	$("#myTable").DataTable().destroy();
	$("#myTable").DataTable({
		"ajax":{
			"url":"ajax/datatables/getAllAssessment.php?id="+id+"&sub_id="+sub_id,
			"dataSrc":"data"
		},
		"columns":[
			{
				"data":"count"
			},
			{
				"data":"action"
			},
			{
				"data":"quiz_name"
			},
			{
				"data":"teacher"
			},
			{
				"data":"no"
			},
			{
				"data":"total"
			}
		]
	});
}
function getQuizName(){
	var class_id = $("#class_id_modal").val();
	var sub_id = $("#subject_id_modal").val();
	$.post("ajax/getQuizName.php",{
		class_id:class_id,
		sub_id:sub_id
	}, function (data,status){
		$("#quiz_name").val(data);
	});
}
function getSubjectModal(){
	var id = $("#class_id_modal").val();
	$.post("ajax/getSubject.php",{
		id:id
	}, function (data,status){
		$("#subject_id_modal").html(data);
	});
}
function getSubject(){
	var id = $("#class_id").val();
	$.post("ajax/getSubject.php",{
		id:id
	}, function (data,status){
		$("#subject_id").html(data);
	});
}
$('#add_form').submit(function(e){
	e.preventDefault();

	$("#submit").prop('disabled', true);
	$("#submit").html("<span class='fa fa-spinner'></span> Submitting ...");
	$.ajax({
		type:"POST",
		url:"ajax/addNewQuiz.php",
		data:$('#add_form').serialize(),
		success: function(data){
			if(data == 1){
			}else{
				alert(data);
			}
			$("#add_modal").modal('hide');
			$("#submit").prop('disabled', false);
			$("#submit").html("<span class='fa fa-plus-circle'></span> ADD");
			getAllStudent();
			//$('.modal-backdrop').remove();
		}
	});
	setTimeout('location.reload()',500);
});
</script>