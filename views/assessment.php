<div class="page-wrapper">
	<!-- Bread crumb -->
	<div class="row page-titles">
		<div class="col-md-5 align-self-center">
			<?php if($_SESSION['user_type'] == 2){ ?>
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_modal" data-backdrop="static"><span class='fa fa-plus-circle'></span> Add </button>
			<?php } ?>
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
							<div class="col-md-4" style='float:left;'>
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
											$class_text = "$row_class[class_name] - $row_class[class_section] ($row_class[class_year]-".($row_class['class_year'] + 1).") [".getTeacherName($row_class['t_id'])."]"; 
										?>
										<option value='<?= $row_class['class_id']; ?>'><?=strtoupper($class_text);?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="col-md-4" style='float:left;'>
								<div class="form-group">
									<label class="control-label">Filter by Subject :</label>
									<select id='subject_id' onchange='getAllStudent()' name='subject_id' class="form-control select2" required>
									</select>
								</div>
							</div>
							<div class="col-md-4" style='float:left;'>
								<div class="form-group">
									<label class="control-label">Filter by Quarter :</label>
									<select onchange='getAllStudent()' id='quarter' name='quarter' class="form-control select2" required>
										<option value="0">&mdash; Please Select &mdash;</option>
										<option value="1">First Quarter</option>
										<option value="2">Second Quarter</option>
										<option value="3">Third Quarter</option>
										<option value="4">Fourth Quarter</option>
									</select>
								</div>
							</div>
						</div>
						<div class="table-responsive">
							<table id="myTable" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th width='2px'>#</th>
										<th>Action</th>
										<th>Quarter</th>
										<th>Quiz Name</th>
										<th>Teacher</th>
										<th># of Items</th>
										<th># of Students Took</th>
										<th>Status</th>
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
<link href="css/lib/sweetalert/sweetalert.css" rel="stylesheet">
<script src="js/lib/sweetalert/sweetalert.min.js"></script>
<script type='text/javascript'>
$(document).ready(function (){
	getAllStudent();
});
function getAllStudent(){
	var sub_id = $("#subject_id").val();
	var id = $("#class_id").val();
	var q_id = $("#quarter").val();
		$("#myTable").DataTable().destroy();
		$("#myTable").DataTable({
			"ajax":{
				"url":"ajax/datatables/getAllAssessment.php?id="+id+"&sub_id="+sub_id+"&quarter="+q_id,
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
					"data":"quarter"
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
				},
				{
					"data":"status"
				}
			]
		});
}
function getQuizName(){
	var class_id = $("#class_id_modal").val();
	var sub_id = $("#subject_id_modal").val();
	var q_id = $("#quarter_modal").val();
	$.post("ajax/getQuizName.php",{
		class_id:class_id,
		sub_id:sub_id,
		q_id:q_id
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
			closeModal('add_modal');
			if(data == 1){
				 swal("Good!", "New Quiz added!", "success");
			}else if(data == 2){
				 swal("Oops!", "Quiz Already loaded!", "warning");
			}else if(data == 3){
				 swal("Oops!", "Quiz limited to 10 only!", "warning");
			}else{
				 swal("Error!", "Unable to proccess!", "error");
			}
			$('#add_form').each(function(){
				this.reset();
			});
			$("#submit").prop('disabled', false);
			$("#submit").html("<span class='fa fa-plus-circle'></span> ADD");
			getAllStudent();
		}
	});
});
function removeQuiz(id,name){
	swal({
		title: "Are you sure to delete?",
		text: "You will not be able to recover "+name+" records!",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Yes, delete it !!",
		cancelButtonText: "No, cancel it !!",
		closeOnConfirm: false,
		closeOnCancel: false
	},
	function(isConfirm){
		if (isConfirm) {
				$.post("ajax/deleteQuiz.php",{
				id:id
			},function (data,status){
				if(data == 1){
					success_delete();
				}else if(data == 2){
					swal("Oops!", "Unable to delete "+name+" !", "warning");
				}else{
					error_delete();
				}
				getAllStudent();
			});
		}
		else {
			error_delete();
		}
	});
}
</script>