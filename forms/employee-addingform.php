<form enctype="multipart/form-data" id="employee-form">
	<div class="modal-header text-light bg-dark">
		<div class="container-fluid text-center">
			<p class="h4 modal-title text-uppercase" id="exampleModalLabel">EMPLOYEE ADDING FORM</p>
		</div>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>

	<div class="modal-body">
		<div class="form-group">
			<input type="hidden" class="form-control" name="action" id="action" value="addEmployee"> 
		</div>

		<div id="emp_id">
		</div>

		<div class="form-group">
			<select name="dept_id" id="dept_id" class="form-control" required>
				<option selected disabled> -- Select Department -- </option>
				<?php foreach ($departments as $department) : ?>
					<option value="<?= $department['dept_id'] ?>">
						<?= $department['dept_code'] ?>
					</option>
				<?php endforeach;	?>
			</select>
		</div>

		<div class="form-group form-row">
			<div class="col-6">
				<input type="text" class="form-control" name="emp_idnum" id="emp_idnum" placeholder="Employee ID Number" required>
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

	<div class="modal-footer text-light bg-dark mb-0">
		<button type="button" class="btn btn-secondary cancel" data-dismiss="modal">Cancel</button>
		<button type="submit" name="submit" class="btn btn-primary" id="emp_btn">Add Employee</button>
	</div>
</form>