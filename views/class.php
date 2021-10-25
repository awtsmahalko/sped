<div class="page-wrapper">
	<!-- Bread crumb -->
	<div class="row page-titles">
		<div class="col-md-5 align-self-center">
		<?php if($_SESSION['user_type'] == 0){ ?>
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_modal" data-backdrop="static"><span class='fa fa-plus-circle'></span> Add </button>
		<?php } ?>
		</div>
		<div class="col-md-7 align-self-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="javascript:void(0)">Master Data</a></li>
				<li class="breadcrumb-item active">Class</li>
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
						<div class="table-responsive">
							<table id="myTable" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>#</th>
										<th>Action</th>
										<!-- <th>Class Code</th> -->
										<th>Teacher</th>
										<th>Level</th>
										<th>Section</th>
										<th>Room</th>
<!-- 										<th>Subjects</th>
										<th>Students</th> -->
										<th>S.Y.</th>
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
<link href="css/lib/sweetalert/sweetalert.css" rel="stylesheet">
<script src="js/lib/sweetalert/sweetalert.min.js"></script>
<script type='text/javascript'>
$(document).ready(function (){
	getAllData();
});
function getAllData(){
	$("#myTable").DataTable().destroy();
	$("#myTable").DataTable({
		"ajax":{
			"url":"ajax/datatables/getAllClass.php",
			"dataSrc":"data"
		},
		"columns":[
			{
				"data":"count"
			},
			{
				"data":"action"
			},
			// {
			// 	"data":"code"
			// },
			{
				"data":"teacher"
			},
			{
				"data":"class"
			},
			{
				"data":"section"
			},
			{
				"data":"room"
			},
			// {
			// 	"data":"subject"
			// },
			// {
			// 	"data":"student"
			// },
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
			closeModal('add_modal');
			if(data == 1){
				 swal("Good!", "New Class added!", "success");
			}else if(data == 2){
				 swal("Oops!", "Class Already loaded!", "warning");
			}else{
				 swal("Error!", "Unable to proccess!", "error");
			}
			$('#add_form').each(function(){
				this.reset();
			});
			$("#submit").prop('disabled', false);
			$("#submit").html("<span class='fa fa-plus-circle'></span> ADD");
			getAllData();
			setTimeout( function(){
				location.reload();
			},1500);
		}
	});
});
$('#update_form').submit(function(e){
	e.preventDefault();

	$("#u_submit").prop('disabled', true);
	$("#u_submit").html("<span class='fa fa-spinner'></span> Updating ...");
	$.ajax({
		type:"POST",
		url:"ajax/updateClass.php",
		data:$('#update_form').serialize(),
		success: function(data){
			closeModal('update_modal');
			if(data == 1){
				 swal("Good!", "Class successfully updated!", "success");
			}else if(data == 2){
				 swal("Oops!", "Class Already loaded!", "warning");
			}else{
				 swal("Error!", "Unable to proccess!", "error");
			}
			$("#u_submit").prop('disabled', false);
			$("#u_submit").html("<span class='fa fa-edit'></span> UPDATE");
			getAllData();
			setTimeout( function(){
				location.reload();
			},1500);
		}
	});
});
function update_class(id){
	$.post("ajax/getDetails.php?table=tbl_class&primary=class_id",{
		id:id
	}, function (data,status){
		var o = JSON.parse(data);
		$("#u_class_id").val(id);
		$("#u_class_code").val(o.class_code);
		$("#u_class_name").val(o.class_name);
		$("#u_class_section").val(o.class_section);
		$("#u_class_room").val(o.class_room);
		$("#u_teacher").val(o.t_id);
		$("#u_class_year").val(o.class_year);
	});
}
function deleteClass(id,name){
	swal({
		title: "Are you sure to delete?",
		text: "You will not be able to recover Class "+name+" record !!",
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
				$.post("ajax/deleteClass.php",{
				id:id
			},function (data,status){
				if(data == 1){
					success_delete();
				}else if(data == 2){
					swal("Oops!", "Unable to delete class "+name+" !", "warning");
				}else{
					error_delete();
				}
				getAllData();
			});
		}
		else {
			error_delete();
		}
	});
}
</script>