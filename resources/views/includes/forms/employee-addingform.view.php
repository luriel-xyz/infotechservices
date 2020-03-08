<form enctype="multipart/form-data" id="employee-form">
	<div class="modal-header text-dark pb-3 border-bottom">
		<div class="container-fluid text-center">
			<p class="h4 modal-title text-capitalize" id="exampleModalLabel">EMPLOYEE ADDING FORM</p>
		</div>
		<a type="reset" class="p-1" data-dismiss="modal" aria-label="Close" onclick="$('modal').modal('hide')">
			<span aria-hidden="true">&times;</span>
		</a>
	</div>

	<div class="modal-body">
		<div class="form-group">
			<input type="hidden" class="form-control" name="action" id="action" value="addEmployee">
		</div>


		<div class="form-group">
			<select name="dept_id" id="dept_id" class="form-control" required>
				<option selected disabled> -- Select Department -- </option>
				<?php foreach ($departments as $department) : ?>
					<option value="<?= $department->dept_id ?>">
						<?= $department->dept_code ?>
					</option>
				<?php endforeach;	?>
			</select>
		</div>

		<div class="form-group">
			<select name="emp_id" class="form-control" id="emp_id" style="display: none;"></select>
		</div>

		<div class="form-group form-row">
			<div class="col-6">
				<input type="number" class="form-control" name="emp_idnum" id="emp_idnum" placeholder="Employee ID Number" required>
			</div>
			<div class="col-6">
				<input type="text" class="form-control" name="position" id="emp-position" placeholder="Position" required>
			</div>
		</div>

		<div class="form-group form-row">
			<div class="col">
				<input type="text" class="form-control" name="fname" id="fname" placeholder="First Name" required>
			</div>
			<div class="col">
				<input type="text" class="form-control" name="lname" id="lname" placeholder="Last Name" required>
			</div>
		</div>

	</div>

	<div class="modal-footer text-dark mb-0">
		<button type="rest" class="btn btn-secondary" data-dismiss="modal" onclick="$('modal').modal('hide')">Cancel</button>
		<button type="submit" name="submit" class="btn btn-primary" id="emp_btn">Add Employee</button>
	</div>
</form>