<form action='' method='POST' id='add_form'>
	<div class="modal fade" id="add_modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-lg" role="document" >
		<div class="modal-content">
		  <div class="modal-header" style="background: #6610f2;">
			<h5 class="modal-title"><span style='color:#fff'>ADD NEW CLASS</span></h5>
		  </div>
		  <div class="modal-body">
		  	<?php
		  		if(getCurrentSY() > 0){
					$display_ = "";
		  	?>
				<div class="row">
					<div class="col-md-4" style="display: none;">
						<div class="form-group">
							<label class="control-label"><font style='color:blue'>Class Code</font></label>
							<input type="text" name='class_code' class="form-control">
						</div>
					</div>
					<!--/span-->
					<div class="col-md-4">
						<div class="form-group has-danger">
							<label class="control-label"><font style='color:blue'>Grade Level</font></label>
							<select name='class_name' class="form-control" required>
								<option value=''>--Please Select--</option>
								<option value='Grade 1'>Grade 1</option>
								<option value='Grade 2'>Grade 2</option>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label"><font style='color:blue'>Section</font></label>
							<input type="text" name='class_section' class="form-control" required>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label"><font style='color:blue'>Room</font></label>
							<input type="text" name='class_room' class="form-control" required>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label"><font style='color:blue'>Teacher / Adviser</font></label>
							<select name='teacher' class="form-control select2" style="width: 100%;" required>
								<option value=''>--Please Select--</option>
								<?php
									$fetch_teacher = mysql_query("SELECT * FROM tbl_teacher");
									while($row_teacher = mysql_fetch_array($fetch_teacher)){
								?>
								<option value='<?= $row_teacher['t_id'];?>'><?= $row_teacher['t_lname'].", ".$row_teacher['t_fname']." ".$row_teacher['t_mname']; ?></option>
								<?php
								}
								?>
							</select>
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group has-danger">
							<label class="control-label"><font style='color:blue'>School Year</font></label>
							<input type="text" value="<?=getCurrentSY()?> - <?=getCurrentSY() + 1?>" class="form-control" readonly>
						</div>
					</div>
				</div>
			<?php
				}else{
		  			$display_ = "display:none;";
			?>
			<center><h3><span class="fa fa-exclamation"></span> Please Add a school Year first</h3></center>
			<?php } ?>
		  </div>
		  <div class="modal-footer">
			<button id='submit' type="submit" class="btn btn-success" style="<?=$display_ ?>"> <span class="fa fa-check"></span> Save</button>
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
			<h5 class="modal-title"><span style='color:#fff'>UPDATE CLASS</span></h5>
		  </div>
		  <div class="modal-body">
				<input type="hidden" id="u_class_id" name="u_class_id">
				<div class="row">
					<div class="col-md-4" style="display: none;">
						<div class="form-group">
							<label class="control-label"><font style='color:blue'>Class Code</font></label>
							<input type="text" id='u_class_code' name='u_class_code' class="form-control" required>
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group has-danger">
							<label class="control-label"><font style='color:blue'>Grade Level</font></label>
							<select id='u_class_name' name='u_class_name' class="form-control" required>
								<option value=''>--Please Select--</option>
								<option value='Grade 1'>Grade 1</option>
								<option value='Grade 2'>Grade 2</option>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label"><font style='color:blue'>Section</font></label>
							<input type="text" id='u_class_section' name='u_class_section' class="form-control" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label"><font style='color:blue'>Room</font></label>
							<input type="text" id='u_class_room' name='u_class_room' class="form-control" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label"><font style='color:blue'>Teacher / Adviser</font></label>
							<select id='u_teacher' name='u_teacher' class="form-control" required>
								<option value=''>--Please Select--</option>
								<?php
									$fetch_teacher = mysql_query("SELECT * FROM tbl_teacher");
									while($row_teacher = mysql_fetch_array($fetch_teacher)){
								?>
								<option value='<?= $row_teacher['t_id'];?>'><?= $row_teacher['t_lname'].", ".$row_teacher['t_fname']." ".$row_teacher['t_mname']; ?></option>
								<?php
								}
								?>
							</select>
						</div>
					</div>
				</div>
					<!--/span-->
					<div class="col-md-6" style="display: none;">
						<div class="form-group has-danger">
							<label class="control-label"><font style='color:blue'>School Year</font></label>
							<select id='u_class_year' name='u_class_year' class="form-control" required>
								<option value=''>--Please Select--</option>
								<?php
									$year_now = date('Y');
									$dec = 5;
									while($dec > 0){
								?>
								<option value='<?= $year_now;?>'><?= "$year_now - ".($year_now + 1);?></option>
								<?php
									$dec--;
									$year_now--;
								}
								?>
							</select>
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