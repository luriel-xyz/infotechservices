<form enctype="multipart/form-data" id="department-form">
	<div class="modal-header text-dark pb-3 border-bottom">
		<div class="container-fluid text-center">
			<p class="h4 modal-title text-capitalize" id="exampleModalLabel">DEPARTMENT ADDING FORM</p>
		</div>
		<a class="p-1" type="reset" data-dismiss="modal" aria-label="Close" role="button" onclick="$('#modal').modal('hide')">
			<span aria-hidden="true">&times;</span>
		</a>
	</div>

	<div class="modal-body">
		<input type="hidden" class="form-control" name="action" id="action" value="addDepartment">

		<div id="dept_id">
		</div>

		<div class="form-group">
			<input type="text" class="form-control" name="dept_code" id="dept_code" placeholder="Department Code" required>
		</div>

		<div class="form-group">
			<input type="text" class="form-control" name="dept_name" id="dept_name" placeholder="Department Name" required>
		</div>

	</div>

	<div class="modal-footer text-dark">
		<button type="reset" class="btn btn-sm btn-secondary" data-dismiss="modal" onclick="$('#modal').modal('hide')">Cancel</button>
		<button type="submit" name="submit" class="btn btn-sm btn-primary" id="dept_btn">Add Department</button>
	</div>
</form>