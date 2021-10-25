<form action='' method='POST' id='add_form'>
	<div class="modal fade" id="add_modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-lg" role="document" >
		<div class="modal-content">
		  <div class="modal-header" style="background: #6610f2;">
			<h5 class="modal-title"><span style='color:#fff'>ADD NEW QUIZ</span></h5>
		  </div>
		  <div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">Filter by Class Name :</label>
							<select id='class_id_modal' onchange='getSubjectModal()' name='class_id_modal' class="form-control select2" style="width: 100%;" required>
								<option value='0'>--Select Class Name--</option>
								<?php
								$fetch_class = mysql_query("SELECT * FROM tbl_class WHERE t_id = ".$_SESSION['account_id']."");
								while($row_class = mysql_fetch_array($fetch_class)){
								?>
								<option value='<?= $row_class['class_id']; ?>'><?= $row_class['class_name']."</i> (".$row_class['class_year']." - ".($row_class['class_year'] + 1).")"; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group has-danger">
							<label class="control-label">Filter by Subject :</label>
							<select id='subject_id_modal' name='subject_id_modal' class="form-control select2" style="width: 100%;" required>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group has-danger">
							<label class="control-label">Choose Quarter :</label>
							<select id='quarter_modal' onchange='getQuizName()' name='quarter_modal' class="form-control select2" style="width: 100%;" required>
								<option value="">&mdash; Please Select &mdash;</option>
								<option value="1">First Quarter</option>
								<option value="2">Second Quarter</option>
								<option value="3">Third Quarter</option>
								<option value="4">Fourth Quarter</option>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group has-danger">
							<label class="control-label">Quiz Name :</label>
							<input type='text' id='quiz_name' name='quiz_name' class="form-control" readonly required>
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