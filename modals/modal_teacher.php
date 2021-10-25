<form enctype="multipart/form-data" method='POST' id='addStud_form'>
	<div class="modal fade" id="addStudent" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-lg" role="document" >
		<div class="modal-content">
		  <div class="modal-header" style="background: #6610f2;">
			<h5 class="modal-title"><span style='color:#fff'>ADD NEW TEACHER</span></h5>
		  </div>
		  <div class="modal-body">
					<ul class="nav nav-tabs" id="myTab" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Personal Information</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Educational Background</a>
						</li>
					</ul>
					<div class="tab-content" id="myTabContent">
						<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
							<br>
							<div class="col-md-12">
								<div class="col-md-4" style="float: left;">
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-btn">
											<span class="btn btn-default btn-file">
											Browse… <input type="file" accept="image/*" name="fileToUpload" id="fileToUpload" required>
											</span>
											</span>
											<input type="text" class="form-control" readonly>
										</div>
										<img id='img-upload' style="height: 250px;width: 100%;border: 5px solid #5241b7;" />
									</div>								
								</div>
								<div class="col-md-8" style="float: right;">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">First Name</label>
												<input type="text" name='t_fname' class="form-control" required>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group has-danger">
												<label class="control-label">Middle Name</label>
												<input type="text" name='t_mname' class="form-control">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group has-danger">
												<label class="control-label">Last Name</label>
												<input type="text" name='t_lname' class="form-control" required>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Civil Status</label>
												<select class="form-control" name='t_civil_status' required>
													<option value="">--Please Select--</option>
													<option value="Single">Single</option>
													<option value="Married">Married</option>
													<option value="Widow">Widow</option>
													<option value="Divorce">Divorce</option>
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Gender</label>
												<select class="form-control" name='t_gender' required>
													<option value="">--Please Select--</option>
													<option value="1">Male</option>
													<option value="0">Female</option>
												</select>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Date of Birth</label>
												<input type="date" name='t_bdate' class="form-control" required>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label">Citizenship</label>
												<input type="text" name='t_citizen' class="form-control" required>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
							<br>
							<table border="1" id="teacherTbl_add" width="100%">
								<thead>
									<tr>
										<th style="width: 2%;"></th>
										<th><center>Degree</center></th>
										<th><center>Course</center></th>
										<th><center>School</center></th>
										<th><center>Batch</center></th>
									</tr>
								</thead>
								<tbody id="add-body">
									<tr>
										<td></td>
										<td contenteditable="true">Bachelor</td>
										<td contenteditable="true"></td>
										<td contenteditable="true"></td>
										<td contenteditable="true"></td>
									</tr>
								</tbody>
							</table>
							<button type="button" class="btn btn-sm btn-primary" style="margin-top: 2px;" onclick="addDegree()"><span class="fa fa-plus-circle"></span> Add Degree</button>
							<button type="button" class="btn btn-sm btn-danger" style="margin-top: 2px;" onclick="deleteDegree()"><span class="fa fa-trash"></span> Remove Degree</button>
						</div>
					</div>
		  </div>
		  <div class="modal-footer">
			<button id='submit' type="submit" class="btn btn-success"> <span class="fa fa-plus-circle"></span> Save</button>
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		  </div>
		</div>
	  </div>
	</div>
</form>
<form action='' method='POST' id='update_form'>
	<div class="modal fade" id="update_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-lg" role="document" >
		<div class="modal-content">
		  <div class="modal-header" style="background: #6610f2;">
			<h5 class="modal-title"><span style='color:#fff'>UPDATE TEACHER</span></h5>
		  </div>
		  <div class="modal-body">
				<input type="hidden" name="u_t_id" id="u_t_id">
					<ul class="nav nav-tabs" id="myTab" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" id="home-tab" data-toggle="tab" href="#u_home" role="tab" aria-controls="home" aria-selected="true">Personal Information</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="profile-tab" data-toggle="tab" href="#u_profile" role="tab" aria-controls="profile" aria-selected="false">Educational Background</a>
						</li>
					</ul>
					<div class="tab-content" id="myTabContent">
						<div class="tab-pane fade show active" id="u_home" role="tabpanel" aria-labelledby="home-tab">
							<br>
							<div class="col-md-12">
								<div class="col-md-4" style="float: left;">
									<div class="form-group">
										<img id='u_img-upload' style="height: 250px;width: 100%;border: 5px solid #5241b7;"/>
									</div>								
								</div>
								<div class="col-md-8" style="float: right;">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label"><strong>First Name</strong></label>
												<input type="text" name='u_t_fname' id="u_t_fname" class="form-control" required>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group has-danger">
												<label class="control-label"><strong>Middle Name</strong></label>
												<input type="text" name='u_t_mname' id="u_t_mname" class="form-control">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group has-danger">
												<label class="control-label"><strong>Last Name</strong></label>
												<input type="text" name='u_t_lname' id="u_t_lname" class="form-control" required>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label"><strong>Civil Status</strong></label>
												<select class="form-control" name='u_t_civil_status' id="u_t_civil_status" required>
													<option value="">--Please Select--</option>
													<option value="Single">Single</option>
													<option value="Married">Married</option>
													<option value="Widow">Widow</option>
													<option value="Divorce">Divorce</option>
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label"><strong>Gender</strong></label>
												<select class="form-control" name='u_t_gender' id="u_t_gender" required>
													<option value="">--Please Select--</option>
													<option value="1">Male</option>
													<option value="0">Female</option>
												</select>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label"><strong>Date of Birth</strong></label>
												<input type="date" name='u_t_bdate' id="u_t_bdate" class="form-control" required>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label"><strong>Citizenship</strong></label>
												<input type="text" name='u_t_citizen' id="u_t_citizen" class="form-control" required>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="u_profile" role="tabpanel" aria-labelledby="profile-tab">
							<br>
							<table border="1" id="teacherTbl_update" width="100%">
								<thead>
									<tr>
										<th style="width: 2%;"></th>
										<th><center>Degree</center></th>
										<th><center>Course</center></th>
										<th><center>School</center></th>
										<th><center>Batch</center></th>
									</tr>
								</thead>
								<tbody id="update-body">
								</tbody>
							</table>
							<button type="button" class="btn btn-sm btn-primary" style="margin-top: 2px;" onclick="addDegree_u()"><span class="fa fa-plus-circle"></span> Add Degree</button>
							<button type="button" class="btn btn-sm btn-danger" style="margin-top: 2px;" onclick="deleteDegree_u()"><span class="fa fa-trash"></span> Remove Degree</button>
						</div>
					</div>
		  </div>
		  <div class="modal-footer">
			<button id='submit' type="u_submit" class="btn btn-success"> <span class="fa fa-edit"></span> Update</button>
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		  </div>
		</div>
	  </div>
	</div>
</form>