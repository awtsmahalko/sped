<?php
$class_id = $_GET['class_id'];
$sub_id = $_GET['sub_id'];
$cq_id = $_GET['quiz'];
$t_id = $_SESSION['account_id'];

$get_sub_details = getData("*","tbl_subject","sub_id = $sub_id");
$get_class_details = getData("class_name,class_section,class_year","tbl_class","class_id = $class_id");
$get_t_details = getData("*","tbl_teacher","t_id = $t_id");
$get_quiz_details = getData("quiz_name,status,date_posted,date_added","tbl_class_quiz_head","cq_id = $cq_id");
$get_quiz_sub_details = getData("COUNT(cq_id)","tbl_class_quiz_detail","cq_id = $cq_id");
?>
<div class="page-wrapper">
	<!-- Bread crumb -->
	<div class="row page-titles">
		<div class="col-md-5 align-self-center">
		<?php
			if(($_SESSION['user_type'] == 2) && ($get_quiz_details[1] == 0)){
			$restrict = '1';
		?>
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_modal" data-backdrop="static"><span class='fa fa-plus-circle'></span> Add </button>
			<?php if($get_quiz_sub_details[0] > 0){?>
				<button type="button" class="btn btn-success" onclick="postQuiz()"><span class='fa fa-send'></span> Post </button>
			<?php }?>
		<?php }else{
			$restrict = '0';
				if($_SESSION['user_type'] == 2){
					$label="POSTED";
					$date_p = $get_quiz_details[2];
				}else{
					$label="ADDED";
					$date_p = $get_quiz_details[3];
				}
				echo "<h3><span style='color:green'>$label ON ".date("F d, Y",strtotime($date_p))."</span></h3>";
			}
		?> 
		</div>
		<input type="hidden" id="h_cq_id" value="<?=$cq_id?>">
		<input type="hidden" id="h_restrict" value="<?=$restrict?>">
		<div class="col-md-7 align-self-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="javascript:void(0)">Master Data</a></li>
				<li class="breadcrumb-item active"><?= $get_quiz_details[0]." == > ".$get_sub_details['sub_name'];?></li>
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
										<span><?= strtoupper($get_quiz_details[0])." IN ".strtoupper($get_sub_details['sub_name']);?></span>
									</center>
								</div>
								<div class="col-md-3">
									<center><img src='images/deped.png' height="100px" width="100px"></center>
								</div>
							</div><br>
							<div class="row">
								<div class="col-md-6">
									<span>Instructor Name: <?= $get_t_details['t_fname']." ".$get_t_details['t_mname']." ".$get_t_details['t_lname'];?></span>
								</div>
								<div class="col-md-3">
									<span>Class: <?=$get_class_details[0]." - ".$get_class_details[1]?></span>
								</div>
								<div class="col-md-3">
									<span>SY: <?=$get_class_details[2]." - ".($get_class_details[2] + 1)?></span>
								</div>
							</div>
							<hr style="border:1px solid">
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
<?php include 'modals/modal_quiz.php'; ?>
<link href="css/lib/sweetalert/sweetalert.css" rel="stylesheet">
<script src="js/lib/sweetalert/sweetalert.min.js"></script>
<script type='text/javascript'>
$(document).ready(function (){
	getItemData();
});
function update_item(id){
	$.post("ajax/getDetails.php?table=tbl_class_quiz_detail&primary=cqd_id",{
		id:id
	}, function (data,status){
		var o = JSON.parse(data);
		$("#uquestion").val(o.quest);
		$("#uchoice_a").val(o.item_1);
		$("#uchoice_b").val(o.item_2);
		$("#uanswer").val(o.answer);
	});
$('#update_form').submit(function(e){
	e.preventDefault();

	$("#usubmit").prop('disabled', true);
	$("#usubmit").html("<span class='fa fa-spinner'></span> Submitting ...");
	$.ajax({
		type:"POST",
		url:"ajax/updateItem.php?id="+id,
		data:$('#update_form').serialize(),
		success: function(data){
			closeModal('update_modal');
			swal("Good!", "Item updated!", "success");
			$("#usubmit").prop('disabled', false);
			$("#usubmit").html("<span class='fa fa-edit'></span> Update");
			getItemData();
		}
	});
	setTimeout(function(){ location.reload(); }, 2000);
});
}
$('#add_form').submit(function(e){
	e.preventDefault();

	$("#submit").prop('disabled', true);
	$("#submit").html("<span class='fa fa-spinner'></span> Submitting ...");
	$.ajax({
		type:"POST",
		url:"ajax/addNewItem.php?id=<?= $cq_id?>",
		data: new FormData(this),
		contentType: false,
    	cache: false,
		processData:false,
		success: function(data){
			closeModal('add_modal');
			if(data == 1){
				 swal("Good!", "New item added!", "success");
			}else if(data == 2){
				 swal("Oops!", "File is not an image!", "warning");
			}else{
				 swal("Error!", "Unable to proccess!", "error");
			}
			$('#add_form').each(function(){
				this.reset();
			});
			$("#submit").prop('disabled', false);
			$("#submit").html("<span class='fa fa-plus-circle'></span> ADD");
			getItemData();
		}
	});
	setTimeout(function(){ location.reload(); }, 2000);
});
function deleteQuestion(id,cq_id){
    swal({
            title: "Are you sure to delete ?",
            text: "You will not be able to recover this record !!",
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
				$.post("ajax/deleteQuizItem.php",{
					cq_id:cq_id,
					id:id
				},function (data,status){
					if(data == 1){
						success_delete();
						getItemData();
					}else{
						error_delete();
					}
					setTimeout(function(){ location.reload(); }, 1000);
				});
            }
            else {
				error_delete();
				setTimeout(function(){ location.reload(); }, 1000);
            }
        });
}
function postQuiz(){
    swal({
            title: "Post Quiz !!",
            text: "Submit to post the quiz !!",
            type: "info",
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        },
        function(){
			$.post("ajax/postQuiz.php",{
				class_id : "<?=$class_id?>",
				sub_id : "<?=$sub_id ?>",
				cq_id : "<?=$cq_id ?>"
			},function (data,status){
				// alert(data);
				if(data == 1){
					swal("Hey, your Quiz Already Posted!!");
    				setTimeout(function(){ location.reload(); }, 1000);
				}
			});
			getItemDataNew(0);
        });
}
function getItemData(){
	var cq_id = $("#h_cq_id").val();
	var restrict = $("#h_restrict").val();
	$.post("ajax/getItemData.php",{
		cq_id:cq_id,
		restrict:restrict
	},function (data,status){
		$("#item_div").html(data);
	});
}
function getItemDataNew(type){
	var cq_id = $("#h_cq_id").val();
	$.post("ajax/getItemData.php",{
		cq_id:cq_id,
		restrict:type
	},function (data,status){
		$("#item_div").html(data);
	});
}
</script>