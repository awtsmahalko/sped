<?php
$class_id = $_GET['class_id'];
$sub_id = $_GET['sub_id'];
$cq_id = $_GET['quiz'];

$get_sub_details = getData("*","tbl_subject","sub_id = $sub_id");
$get_quiz_details = getData("quiz_name","tbl_class_quiz_head","cq_id = $cq_id");
//$quiz_head = getData("*","");
?>
<div class="page-wrapper">
	<!-- Bread crumb -->
	<div class="row page-titles">
		<div class="col-md-5 align-self-center">
			<h3 class="text-primary"><?= $get_quiz_details[0]." == > ".$get_sub_details['sub_code']." - ".$get_sub_details['sub_name'];?></h3> </div>
		<div class="col-md-7 align-self-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="javascript:void(0)">Master Data</a></li>
				<li class="breadcrumb-item active">Quiz</li>
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
					<?php if($_SESSION['user_type'] == 2){ ?>
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_modal" data-backdrop="static"><span class='fa fa-plus-circle'></span> Add </button>
					<?php } ?>
						<div class="table-responsive">
							<table id="myTable" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>#</th>
										<th>Action</th>
										<th>Question</th>
										<th>Item 1</th>
										<th>Item 2</th>
										<th>Answer</th>
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
<?php include 'modals/modal_class.php'; ?>
<script type='text/javascript'>
$(document).ready(function (){
	//getAllData();
});
function getAllData(){
	$("#myTable").DataTable().destroy();
	$("#myTable").DataTable({
		"ajax":{
			"url":"ajax/datatables/getAllQuiz.php?id=<?= $cq_id?>",
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
				"data":"code"
			},
			{
				"data":"class"
			},
			{
				"data":"subject"
			},
			{
				"data":"year"
			}
		]
	});
}
$('#add_form').submit(function(e){
	e.preventDefault();

	$("#submit").prop('disabled', true);
	$("#submit").html("<span class='fa fa-spinner'></span> Submitting ...");
	$.ajax({
		type:"POST",
		url:"ajax/addNewClass.php",
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