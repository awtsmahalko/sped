<?php
    $t_data = mysql_fetch_array(mysql_query("SELECT * FROM tbl_principal WHERE p_id = ".$_SESSION['account_id']));
    if($t_data[p_gender] == 1){
        $w_ = "Widower";
    }else{
        $w_ = "Widow";
    }
?>
<input type="hidden" id="h_g" value="<?=$t_data['p_gender']?>">
<input type="hidden" id="h_cs" value="<?=$t_data['p_status']?>">
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-two">
                                <center>
                                    <img src="pictures/<?=$t_data['img']?>" alt="user" width="200px" height="200px" style="border-radius:50%" /><br><br>
									<button class='btn btn-primary' data-toggle="modal" data-target="#exampleModal" >Change Picture</button>
                                </center>

                            <h3><?="$t_data[p_lname], $t_data[p_fname]";?></h3>
                            <div class="desc">
                                <?=$principal_d['p_position']?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card card-outline-primary">
                    <form method="POST" id="updateProfile_form">
                        <div class="card-header">
                            <h4 class="m-b-0 text-white">Profile!</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-body">
                                <h3 class="card-title m-t-15">Personal Info</h3>
                                <hr>
                                <div class="row p-t-20">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Last Name</label>
                                            <input type="text" value="<?= $t_data['p_lname'];?>" name="p_lname" id="p_lname" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">First Name</label>
                                            <input type="text" value="<?= $t_data['p_fname'];?>" name="p_fname" id="p_fname" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Middle Name</label>
                                            <input type="text" value="<?= $t_data['p_mname'];?>" name="p_mname" id="p_mname" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Birthday</label>
                                            <input type="date" value="<?= $t_data['p_bdate'];?>" name="p_bdate" id="p_bdate" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Gender</label>
                                            <select class="form-control" id="p_gender" name="p_gender">
                                                <option value="1">Male</option>
                                                <option value="0">Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Civil Status</label>
                                            <select class="form-control" id='p_civil_status' name='p_status' required>
                                                <option value="">--Please Select--</option>
                                                <option value="Single">Single</option>
                                                <option value="Married">Married</option>
                                                <option value="<?=$w_?>"><?=$w_?></option>
                                                <option value="Divorce">Divorce</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Address</label>
                                            <input type="text" value="<?= $t_data['p_add'];?>" name="p_add" id="p_add" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Position</label>
                                            <input type="text" value="<?= $t_data['p_position'];?>" name="p_position" id="p_position" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <center>
                                <button type="submit" id="btn-submit" class="btn btn-success"> <i class="fa fa-check-circle"></i>  Update Profile</button>
                            </center>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Container fluid  -->
    <!-- footer -->
   <footer class="footer"> © 2018 All rights reserved. BACOLOD CITY SPED CENTER EVALUATION AND ASSESSMENT</footer>
    <!-- End footer -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form enctype="multipart/form-data" action='' method='POST' id='updatePhoto_form'>
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Picture</h5>
                        </div>
                        <div class="modal-body">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="input-group col-md-12">
                                    <span class="input-group-btn">
                                    <span class="btn btn-default btn-file">
                                    Browse… <input type="file" accept="image/*" name="fileToUpload" id="fileToUpload" required>
                                    </span>
                                    </span>
                                    <input type="text" class="form-control" readonly>
                                </div>
                                <center><img id='img-upload' style="height: 250px;width: 250px;border-radius: 50%;" /></center>
                            </div>                              
                        </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
              </div>
            </div>
</div>
<link href="css/lib/sweetalert/sweetalert.css" rel="stylesheet">
<script src="js/lib/sweetalert/sweetalert.min.js"></script>
<script type="text/javascript">
$(document).ready( function(){
    var gender = $("#h_g").val();
    var cs = $("#h_cs").val();
    $("#p_gender").val(gender);
    $("#p_civil_status").val(cs);
    $(document).on('change', '.btn-file :file', function() {
    var input = $(this),
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [label]);
    });

    $('.btn-file :file').on('fileselect', function(event, label) {
        
        var input = $(this).parents('.input-group').find(':text'),
            log = label;
        
        if( input.length ) {
            input.val(log);
        } else {
            if( log ) alert(log);
        }
    
    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#img-upload').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#fileToUpload").change(function(){
        readURL(this);
    });

});
$("#updatePhoto_form").on('submit',(function(e) {
	e.preventDefault();

	$("#submit").prop('disabled', true);
	$("#submit").html("<span class='fa fa-spinner'></span> Adding ...");
	$.ajax({
		type:"POST",
		url:"ajax/updatePhoto.php",
		data: new FormData(this),
		contentType: false,
    	cache: false,
		processData:false,
		success: function(data){
			closeModal('exampleModal');
			//alert(data);
			if(data == 1){
				 swal("Good!", "Profile Picture Successfully Changed!", "success");
			}else{
				 swal("Error!", "Unable to proccess!", "error");
			}
			$('#updatePhoto_form').each(function(){
				this.reset();
			});
			setTimeout(function(){ location.reload(); }, 2000);
			
			$("#submit").prop('disabled', false);
			$("#submit").html("<span class='fa fa-plus-circle'></span> SAVE");
		}
	});
}));
$('#updateProfile_form').submit(function(e){

    $("#btn-submit").prop("disabled",true);
    $("#btn-submit").html("<span class='fa fa-spin fa-spinner'></span> Loading...");

    e.preventDefault();
    $.ajax({
        type:"POST",
        url:"ajax/update_prof_p.php",
        data:$('#updateProfile_form').serialize(),
        success:function(data){
            if(data == 1){
                swal("Hey, Good job !!", "Your profile successfully updated!!", "success");
            }else{
                sweetAlert("Oops...", "Something went wrong !!", "error");
                setTimeout(function(){ location.reload(); }, 2000);
            }
            $("#btn-submit").prop("disabled",false);
            $("#btn-submit").html("<span class='fa fa-check-circle'></span> Update Profile");
        }
    });
    
});
</script>