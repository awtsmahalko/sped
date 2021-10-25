<form action='' method='POST' id='add_form'>
	<div class="modal fade" id="add_modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-lg" role="document" >
		<div class="modal-content">
		  <div class="modal-header" style="background: #6610f2;">
			<h5 class="modal-title"><span style='color:#fff'>ADD STUDENT TO CLASS</span></h5>
		  </div>
		  <div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<input type='hidden' name='class_id' value='<?= $get_class_id; ?>'>
						<div class="form-group">
							<label class="control-label"><font style='color:blue'>Student Name</font></label>
							<select name='stu_id' class="form-control select2" style="width: 100%;" required>
								<option value=''>--Please Select--</option>
								<?php
								$fetch_student = mysql_query("SELECT * FROM tbl_student WHERE status != 1");
								while($row_student = mysql_fetch_array($fetch_student)){
								?>
								<option value='<?= $row_student['stu_id']; ?>'><?= $row_student['stu_fname']." ".$row_student['stu_mname']." ".$row_student['stu_lname']; ?></option>
								<?php } ?>
							</select>
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