<form action='' method='POST' id='add_form'>
	<div class="modal fade" id="add_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-lg" role="document" >
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title"><span style='color:green'>Add New Subject </span></h5>
		  </div>
		  <div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<input type='hidden' name='class_id' value='<?= $get_class_id; ?>'>
						<div class="form-group">
							<label class="control-label"><font style='color:blue'>Subject Name</font></label>
							<select name='sub_id' class="form-control" required>
								<option value=''>--Please Select--</option>
								<?php
								$fetch_subject = mysql_query("SELECT * FROM tbl_subject WHERE t_id = ".$_SESSION['account_id']."");
								while($row_subject = mysql_fetch_array($fetch_subject)){
								?>
								<option value='<?= $row_subject['sub_id']; ?>'><?= "[".$row_subject['sub_code']."] - ".$row_subject['sub_name']; ?></option>
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