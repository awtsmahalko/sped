<form action='' method='POST' id='add_form'>
	<div class="modal fade" id="add_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-lg" role="document" >
		<div class="modal-content">
		  <div class="modal-header" style="background: #6610f2;">
			<h5 class="modal-title"><span style='color:#fff'>ADD NEW SUBJECT</span></h5>
		  </div>
		  <div class="modal-body">
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label"><font style='color:blue'>Subject Code</font></label>
							<input type="text" name='sub_code' class="form-control" required>
						</div>
					</div>
					<!--/span-->
					<div class="col-md-4">
						<div class="form-group has-danger">
							<label class="control-label"><font style='color:blue'>Subject Name</font></label>
							<input type="text" name='sub_name' class="form-control">
						</div>
					</div>
<!-- 					<div class="col-md-6">
						<div class="form-group has-danger">
							<label class="control-label"><font style='color:blue'>Language</font></label>
							<select type="text" name='lang' class="form-control">
								<option value="0">English</option>
								<option value="1">Filipino</option>
							</select>
						</div>
					</div> -->
					<div class="col-md-4">
						<div class="form-group has-danger">
							<label class="control-label"><font style='color:blue'>Percentage</font></label>
							<input type="number" name='sub_percent' class="form-control">
						</div>
					</div>
				</div>
		  </div>
		  <div class="modal-footer">
			<button id='submit' type="submit" class="btn btn-success"> <span class="fa fa-check"></span> Save</button>
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
			<h5 class="modal-title"><span style='color:#fff'>UPDATE SUBJECT</span></h5>
		  </div>
		  <div class="modal-body">
				<input type="hidden" id="u_sub_id" name="u_sub_id">
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label"><font style='color:blue'>Subject Code</font></label>
							<input type="text" id='u_sub_code' name='u_sub_code' class="form-control" required>
						</div>
					</div>
					<!--/span-->
					<div class="col-md-4">
						<div class="form-group has-danger">
							<label class="control-label"><font style='color:blue'>Subject Name</font></label>
							<input type="text" id='u_sub_name' name='u_sub_name' class="form-control">
						</div>
					</div>
<!-- 					<div class="col-md-4">
						<div class="form-group has-danger">
							<label class="control-label"><font style='color:blue'>Language</font></label>
							<select type="text" id='u_lang' name='u_lang' class="form-control">
								<option value="">-Please Select--</option>
								<option value="0">English</option>
								<option value="1">Filipino</option>
							</select>
						</div>
					</div> -->
					<div class="col-md-4">
						<div class="form-group has-danger">
							<label class="control-label"><font style='color:blue'>Percentage</font></label>
							<input type="number" id="u_sub_percent" name='u_sub_percent' class="form-control">
						</div>
					</div>
				</div>
		  </div>
		  <div class="modal-footer">
			<button id='u_submit' type="submit" class="btn btn-success"> <span class="fa fa-edit"></span> Update</button>
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		  </div>
		</div>
	  </div>
	</div>
</form>