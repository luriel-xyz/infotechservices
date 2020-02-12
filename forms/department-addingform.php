<form enctype="multipart/form-data" id="department-form">
	<div class="modal-header text-light bg-dark">
		<div class="container-fluid text-center">
 		<p class="h4 modal-title" id="exampleModalLabel">DEPARTMENT ADDING FORM</p>
 		</div>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	 		<span aria-hidden="true">&times;</span>
	 	</button>
    </div>

	<div class="modal-body">

		<div class="form-group">
			<input type="hidden" class="form-control" name="action" id="action" value="addDepartment">
		</div>

		<div id="dept_id">
		</div>

	  	<div class="form-group">
	      	<input type="text" class="form-control" name="dept_code" id="dept_code" placeholder="Department Code" required="">
	  	</div>

	  	<div class="form-group">
	      	<input type="text" class="form-control" name="dept_name" id="dept_name" placeholder="Department Name" required="">
	  	</div>

		</div>

	<div class="modal-footer text-light bg-dark" style="margin-bottom: 0">
		<button type="button" class="btn btn-secondary cancel" data-dismiss="modal">Cancel</button>
	 	<button type="submit" name="submit" class="btn btn-primary" id="dept_btn">Add Department</button>
	</div>
</form>  