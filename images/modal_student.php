<div style="margin-top:10%" class="modal fade" id="addStudent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
		  <form action='' method='POST' id='addStud_form'>
				  <div class="modal-header">
					<h5 class="modal-title"><span style='color:green'>Add New Student </span></h5>
				  </div>
				  <div class="modal-body">
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">First Name</label>
									<input type="text" name='stu_fname' class="form-control" placeholder="Juan" required>
								</div>
							</div>
							<!--/span-->
							<div class="col-md-4">
								<div class="form-group has-danger">
									<label class="control-label">Middle Name</label>
									<input type="text" name='stu_mname' class="form-control" placeholder="Rizal">
								</div>
							</div>
							<!--/span-->
							<!--/span-->
							<div class="col-md-4">
								<div class="form-group has-danger">
									<label class="control-label">Last Name</label>
									<input type="text" name='stu_lname' class="form-control" placeholder="Dela Cruz" required>
								</div>
							</div>
							<!--/span-->
						</div>
						<!--/row-->
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Specialty</label>
									<select class="form-control" name='stu_special' required>
										<option value="">--Please Select--</option>
										<option value="Blind">Blind</option>
										<option value="Deaf">Deaf</option>
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Gender</label>
									<select class="form-control" name='stu_gender' required>
										<option value="">--Please Select--</option>
										<option value="1">Male</option>
										<option value="0">Female</option>
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Date of Birth</label>
									<input type="date" name='stu_bdate' class="form-control" placeholder="dd/mm/yyyy" required>
								</div>
							</div>
							<!--/span-->
						</div>
				  </div>
				  <div class="modal-footer">
					<button id='submit' type="submit" class="btn btn-success"> <span class="fa fa-check"></span> Save</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				  </div>
			</form>
		</div>
	  </div>
	</div>