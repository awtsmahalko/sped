<div class="page-wrapper">
	<!-- Bread crumb -->
	<div class="row page-titles">
		<div class="col-md-5 align-self-center">
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_modal" data-backdrop="static"><span class='fa fa-plus-circle'></span> Add </button>
		</div>
		<div class="col-md-7 align-self-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
				<li class="breadcrumb-item active">Subject</li>
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
										<th>Subject Code</th>
										<th>Subject Name</th>
										<th>Percentage</th>
										<!-- <th>Language</th> -->
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
<?php include 'modals/modal_subject.php'; ?>
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
			"url":"ajax/datatables/getAllSubject.php",
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
				"data":"name"
			},
			{
				"data":"percent"
			}
			// {
			// 	"data":"lang"
			// }
		]
	});
}
$('#add_form').submit(function(e){
	e.preventDefault();

	$("#submit").prop('disabled', true);
	$("#submit").html("<span class='fa fa-spinner'></span> Submitting ...");
	$.ajax({
		type:"POST",
		url:"ajax/addNewSubject.php",
		data:$('#add_form').serialize(),
		success: function(data){
			closeModal('add_modal');
			if(data == 1){
				 swal("Good!", "New subject added!", "success");
			}else if(data == 2){
				 swal("Oops!", "Subject Already loaded!", "warning");
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
			}, 1500);
		}
	});
});
$('#update_form').submit(function(e){
	e.preventDefault();

	$("#u_submit").prop('disabled', true);
	$("#u_submit").html("<span class='fa fa-spinner'></span> Updating ...");
	$.ajax({
		type:"POST",
		url:"ajax/updateSubject.php",
		data:$('#update_form').serialize(),
		success: function(data){
			closeModal('update_modal');
			if(data == 1){
				 swal("Good!", "Subject Detail successfully updated!", "success");
			}else if(data == 2){
				 swal("Oops!", "Subject Detail Already Exist!", "warning");
			}else{
				 swal("Error!", "Unable to proccess!", "error");
			}
			$("#u_submit").prop('disabled', false);
			$("#u_submit").html("<span class='fa fa-edit'></span> UPDATE");
			getAllData();
			setTimeout( function(){
				location.reload();
			}, 1500);
		}
	});
});
function update_subject(id){
	$.post("ajax/getDetails.php?table=tbl_subject&primary=sub_id",{
		id:id
	}, function (data,status){
		var o = JSON.parse(data);
		$("#u_sub_id").val(id);
		$("#u_sub_code").val(o.sub_code);
		$("#u_sub_name").val(o.sub_name);
		$("#u_sub_percent").val(o.sub_percent);
		$("#u_lang").val(o.lang);
	});
}
function removeSub(id,name){
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
				$.post("ajax/deleteSubject.php",{
				id:id
			},function (data,status){
				if(data == 1){
					success_delete();
				}else if(data == 2){
					swal("Oops!", "Unable to delete "+name+" !", "warning");
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