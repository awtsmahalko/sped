<?php
$t_data = mysql_fetch_array(mysql_query("SELECT * FROM tbl_student WHERE stu_id = ".$_SESSION['account_id']));
?>
<input type="hidden" id="h_g" value="<?= $t_data['stu_gender']?>" >
<input type="hidden" id="h_s" value="<?= $t_data['stu_special']?>" >
<div class="page-wrapper">
            <div class="container-fluid">
                <!-- Start Page Content -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-two">
                                        <center>
                                            <img src="pictures/<?=$student_d[0]?>" alt="user" width="200px" height="200px" style="border-radius:50%" /><br><br>
											<button class='btn btn-primary' data-toggle="modal" data-target="#exampleModal" >Change Picture</button>
                                        </center>

                                    <h3><?="$student_d[1], $student_d[2]";?></h3>
                                    <div class="desc">
                                        Student (<?=$student_d[3]?>)
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-12">
                        <div class="card">
                            <form method="POST" id="updateProfile_form">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs profile-tab" role="tablist">
                                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab">Profile</a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab">Family Background</a> </li>
                                </ul>
                            <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="home" role="tabpanel">
                                        <div class="card card-outline-primary">
                                            <div class="card-header">
                                                <h4 class="m-b-0 text-white">Personal Information</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-body">
                                                    <hr>
                                                    <div class="row p-t-20">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label">Last Name</label>
                                                                <input type="text" value="<?= $t_data['stu_lname'];?>" name="stu_lname" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label">First Name</label>
                                                                <input type="text" value="<?= $t_data['stu_fname'];?>" name="stu_fname" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label">Middle Name</label>
                                                                <input type="text" value="<?= $t_data['stu_mname'];?>" name="stu_mname" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label">Birthday</label>
                                                                <input type="date" value="<?= $t_data['stu_bdate'];?>" name="stu_bdate" id="stu_bdate" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label">Specialty</label>
                                                                <select class="form-control" id='stu_special' name='stu_special' required>
                                                                    <option value="">--Please Select--</option>
                                                                    <option value="Blind">Blind</option>
                                                                    <option value="Deaf">Deaf</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label">Gender</label>
                                                                <select class="form-control" name='stu_gender' id='stu_gender' required>
                                                                    <option value="">--Please Select--</option>
                                                                    <option value="1">Male</option>
                                                                    <option value="0">Female</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        <!--second tab-->
                                    <div class="tab-pane" id="profile" role="tabpanel">
                                        <div class="card card-outline-primary">
                                            <div class="card-header">
                                                <h4 class="m-b-0 text-white">Father's Information</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-body">
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group has-danger">
                                                                <label class="control-label" style="color: blue;">Father's Name</label>
                                                                <input type="text" name='stu_f_name' value="<?= $t_data['stu_f_name'];?>" class="form-control" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label" style="color: blue;">Birthdate</label>
                                                                <input type="date" value="<?= $t_data['stu_f_bdate'];?>" name='stu_f_bdate' class="form-control" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label" style="color: blue;">Occupation</label>
                                                                <input type="text" value="<?= $t_data['stu_f_occ'];?>" name='stu_f_occ' class="form-control" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group has-danger">
                                                                <label class="control-label" style="color: blue;">Address</label>
                                                                <input type="text" name='stu_f_add' value="<?= $t_data['stu_f_add'];?>" class="form-control" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label" style="color: blue;">Contact Number</label>
                                                                <input type="text" name='stu_f_no' value="<?= $t_data['stu_f_no'];?>" class="form-control" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card card-outline-primary">
                                            <div class="card-header">
                                                <h4 class="m-b-0 text-white">Mother's Information</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-body">
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group has-danger">
                                                                <label class="control-label" style="color: blue;">Mother's Name</label>
                                                                <input type="text" value="<?= $t_data['stu_m_name'];?>" name='stu_m_name' class="form-control" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label" style="color: blue;">Birthdate</label>
                                                                <input type="date" value="<?= $t_data['stu_m_bdate'];?>" name='stu_m_bdate' class="form-control" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label" style="color: blue;">Occupation</label>
                                                                <input type="text" value="<?= $t_data['stu_m_occ'];?>" name='stu_m_occ' class="form-control" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group has-danger">
                                                                <label class="control-label" style="color: blue;">Address</label>
                                                                <input type="text" value="<?= $t_data['stu_m_add'];?>" name='stu_m_add' class="form-control" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label" style="color: blue;">Contact Number</label>
                                                                <input type="text" value="<?= $t_data['stu_m_no'];?>" name='stu_m_no' class="form-control" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                            <button type="submit" id="btn-submit" class="btn btn-success"> <i class="fa fa-check-circle"></i>  Update Profile</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Column -->
                </div>

                <!-- End PAge Content -->
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
    var cs = $("#h_s").val();
    $("#stu_gender").val(gender);
    $("#stu_special").val(cs);

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
        url:"ajax/update_prof_s.php",
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