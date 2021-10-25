	<div class="modal fade" id="add_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document" >
		<div class="modal-content">
			<form action='' method='POST' id='add_form' enctype="multipart/form-data">
			  <div class="modal-header" style="background: #6610f2;">
				<h5 class="modal-title"><span style='color:#fff'>ADD NEW ITEM</span></h5>
			  </div>
			  <div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label"><font style='color:blue'>Question</font></label><br>
								(Visual Optional)<input type='file' name='file' id='file' >
								<textarea name='question' rows="4" cols="50" class="form-control" style='height:60px' required></textarea>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label"><font style='color:blue'>Choice A</font></label>
								<textarea name='choice_a' rows="4" cols="50"  class="form-control" style='height:60px' required></textarea>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label"><font style='color:blue'>Choice B</font></label>
								<textarea name='choice_b' rows="4" cols="50"  class="form-control" style='height:60px' required></textarea>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group has-danger">
								<label class="control-label"><font style='color:blue'>Correct Answer</font></label>
								<select name='answer' class="form-control" required>
									<option value=''>--Please Select--</option>
									<option value='A'>A</option>
									<option value='B'>B</option>
								</select>
							</div>
						</div>
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
	<div class="modal fade" id="update_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-lg" role="document" >
		<div class="modal-content">
			<form action='' method='POST' id='update_form'>
			  <div class="modal-header" style="background: #6610f2;">
				<h5 class="modal-title"><span style='color:#fff'>UPDATE ITEM</span></h5>
			  </div>
			  <div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label"><font style='color:blue'>Question</font></label>
								<textarea id='uquestion' name='uquestion' rows="4" cols="50" class="form-control" style='height:60px' required></textarea>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label"><font style='color:blue'>Choice A</font></label>
								<textarea id='uchoice_a' name='uchoice_a' rows="4" cols="50"  class="form-control" style='height:60px' required></textarea>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label"><font style='color:blue'>Choice B</font></label>
								<textarea id='uchoice_b' name='uchoice_b' rows="4" cols="50"  class="form-control" style='height:60px' required></textarea>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group has-danger">
								<label class="control-label"><font style='color:blue'>Correct Answer</font></label>
								<select id='uanswer' name='uanswer' class="form-control" required>
									<option value=''>--Please Select--</option>
									<option value='A'>A</option>
									<option value='B'>B</option>
								</select>
							</div>
						</div>
					</div>
			  </div>
			  <div class="modal-footer">
				<button id='usubmit' type="submit" class="btn btn-success"> <span class="fa fa-edit"></span> Update</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			  </div>
			</form>
		</div>
	  </div>
	</div>