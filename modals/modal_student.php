<div style="" class="modal fade" id="addStudent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
		  <div class="modal-header" style="background: #6610f2;">
			<h5 class="modal-title"><span style='color:#fff'>ADD NEW STUDENT</span></h5>
		  </div>
			<form enctype="multipart/form-data" action='' method='POST' id='addStud_form'>
				<div class="modal-body">
					<ul class="nav nav-tabs" id="myTab" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Personal Information</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Family Background</a>
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
										<img id='img-upload' style="height: 250px;" />
									</div>								
								</div>
								<div class="col-md-8" style="float: right;">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">First Name</label>
												<input type="text" name='stu_fname' class="form-control" required>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group has-danger">
												<label class="control-label">Middle Name</label>
												<input type="text" name='stu_mname' class="form-control" required>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group has-danger">
												<label class="control-label">Last Name</label>
												<input type="text" name='stu_lname' class="form-control" required>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Specialty</label>
												<select class="form-control" name='stu_special' required>
													<option value="">--Please Select--</option>
													<option value="Blind">Blind</option>
													<option value="Deaf">Deaf</option>
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Gender</label>
												<select class="form-control" name='stu_gender' required>
													<option value="">--Please Select--</option>
													<option value="1">Male</option>
													<option value="0">Female</option>
												</select>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Date of Birth</label>
												<input type="date" name='stu_bdate' class="form-control" required>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
							<br>
							<div class="row">
								<div class="col-md-4">
									<h3>Father's Information</h3>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group has-danger">
										<label class="control-label" style="color: blue;">Father's Name</label>
										<input type="text" name='stu_f_name' class="form-control" required>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="control-label" style="color: blue;">Birthdate</label>
										<input type="date" name='stu_f_bdate' class="form-control" required>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="control-label" style="color: blue;">Occupation</label>
										<input type="text" name='stu_f_occ' class="form-control" required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group has-danger">
										<label class="control-label" style="color: blue;">Address</label>
										<input type="text" name='stu_f_add' class="form-control" required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label" style="color: blue;">Contact Number</label>
										<input type="text" name='stu_f_no' class="form-control" required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<h3>Mother's Information</h3>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group has-danger">
										<label class="control-label" style="color: blue;">Mother's Maiden Name</label>
										<input type="text" name='stu_m_name' class="form-control" required>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="control-label" style="color: blue;">Birthdate</label>
										<input type="date" name='stu_m_bdate' class="form-control" required>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="control-label" style="color: blue;">Occupation</label>
										<input type="text" name='stu_m_occ' class="form-control" required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group has-danger">
										<label class="control-label" style="color: blue;">Address</label>
										<input type="text" name='stu_m_add' class="form-control" required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label" style="color: blue;">Contact Number</label>
										<input type="text" name='stu_m_no' class="form-control" required>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button id='submit' name="submit" type="submit" class="btn btn-success"> <span class="fa fa-plus-circle"></span> Save</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div style="" class="modal fade" id="update_modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
		  <div class="modal-header" style="background: #6610f2;">
			<h5 class="modal-title"><span style='color:#fff'>UPDATE STUDENT</span></h5>
		  </div>
			<form action='' method='POST' id='update_form'>
				<div class="modal-body">
					<ul class="nav nav-tabs" id="myTab" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" id="home-tab" data-toggle="tab" href="#u_home" role="tab" aria-controls="home" aria-selected="true">Personal Information</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="profile-tab" data-toggle="tab" href="#u_profile" role="tab" aria-controls="profile" aria-selected="false">Family Background</a>
						</li>
					</ul>
					<input type="hidden" id="u_stu_id" name="u_stu_id">
					<div class="tab-content" id="myTabContent">
						<div class="tab-pane fade show active" id="u_home" role="tabpanel" aria-labelledby="home-tab">
							<br>
							<div class="col-md-12">
								<div class="col-md-4" style="float: left;height: 300px;">
									<div class="form-group">
										<img id='u_img-upload' style="height: 250px;width: 100%;border: 5px solid #5241b7;" />
									</div>								
								</div>
								<div class="col-md-8" style="float: right;">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">First Name</label>
												<input type="text" name='u_stu_fname' id="u_stu_fname" class="form-control" required>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group has-danger">
												<label class="control-label">Middle Name</label>
												<input type="text" name='u_stu_mname' id="u_stu_mname" class="form-control" required>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group has-danger">
												<label class="control-label">Last Name</label>
												<input type="text" name='u_stu_lname' id="u_stu_lname" class="form-control" required>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Specialty</label>
												<select class="form-control" name='u_stu_special' id="u_stu_special" required>
													<option value="">--Please Select--</option>
													<option value="Blind">Blind</option>
													<option value="Deaf">Deaf</option>
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Gender</label>
												<select class="form-control" name='u_stu_gender' id="u_stu_gender" required>
													<option value="">--Please Select--</option>
													<option value="1">Male</option>
													<option value="0">Female</option>
												</select>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Date of Birth</label>
												<input type="date" name='u_stu_bdate' id="u_stu_bdate" class="form-control" required>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="u_profile" role="tabpanel" aria-labelledby="profile-tab">
							<br>
							<div class="row">
								<div class="col-md-4">
									<h3>Father's Information</h3>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group has-danger">
										<label class="control-label" style="color: blue;">Father's Name</label>
										<input type="text" name='u_stu_f_name' id="u_stu_f_name" class="form-control" required>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="control-label" style="color: blue;">Birthdate</label>
										<input type="date" name='u_stu_f_bdate' id="u_stu_f_bdate" class="form-control" required>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="control-label" style="color: blue;">Occupation</label>
										<input type="text" name='u_stu_f_occ' id="u_stu_f_occ" class="form-control" required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group has-danger">
										<label class="control-label" style="color: blue;">Address</label>
										<input type="text" name='u_stu_f_add' id="u_stu_f_add" class="form-control" required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label" style="color: blue;">Contact Number</label>
										<input type="text" name='u_stu_f_no' id="u_stu_f_no" class="form-control" required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<h3>Mother's Information</h3>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group has-danger">
										<label class="control-label" style="color: blue;">Mother's Maiden Name</label>
										<input type="text" name='u_stu_m_name' id="u_stu_m_name" class="form-control" required>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="control-label" style="color: blue;">Birthdate</label>
										<input type="date" name='u_stu_m_bdate' id="u_stu_m_bdate" class="form-control" required>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="control-label" style="color: blue;">Occupation</label>
										<input type="text" name='u_stu_m_occ' id="u_stu_m_occ" class="form-control" required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group has-danger">
										<label class="control-label" style="color: blue;">Address</label>
										<input type="text" name='u_stu_m_add' id="u_stu_m_add" class="form-control" required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label" style="color: blue;">Contact Number</label>
										<input type="text" name='u_stu_m_no' id="u_stu_m_no" class="form-control" required>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button id='u_submit' name="u_submit" type="submit" class="btn btn-success"> <span class="fa fa-check-circle"></span> Update</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>