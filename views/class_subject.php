<?php
$get_class_id = $_GET[md5('class_id')];
?>
<div class="page-wrapper">
	<!-- Bread crumb -->
	<div class="row page-titles">
		<div class="col-md-5 align-self-center">
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_modal" data-backdrop="static"><span class='fa fa-plus-circle'></span> Add </button>
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
						<div class="table-responsive">
							<table id="myTable" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th width='5%'>#</th>
										<th width='5%'>Action</th>
										<th width='15%'>Subject Code</th>
										<th>Subject Name</th>
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
<?php include 'modals/modal_class_subject.php'; ?>
<link href="css/lib/sweetalert/sweetalert.css" rel="stylesheet">
<script src="js/lib/sweetalert/sweetalert.min.js"></script>
<script type='text/javascript'>
$(document).ready(function (){
	getAllData();
});
function getAllData(){
	$("#myTable").DataTable().destroy();
	$("#myTable").DataTable({
		"paging":false,
		"ajax":{
			"url":"ajax/datatables/getAllClassSubject.php?class_id=<?= $get_class_id; ?>",
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
		url:"ajax/addNewClassSubject.php",
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
			$("#submit").prop('disabled', false);
			$("#submit").html("<span class='fa fa-plus-circle'></span> ADD");
			getAllData();
		}
	});
});
function removeSub(id,name){
    swal({
            title: "Are you sure to remove this?",
            text: "You will not be able to recover this record !!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, remove it !!",
            cancelButtonText: "No, cancel it !!",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function(isConfirm){
            if (isConfirm) {
				$.post("ajax/deleteClassData.php",{
					id:id,
					field:"cs_id",
					table:"tbl_class_subject"
				},function (data,status){
					if(data == 1){
						success_delete();
						getAllData();
					}else{
						error_delete();
					}
				});
            }
            else {
				error_delete();
            }
        });
}
</script>