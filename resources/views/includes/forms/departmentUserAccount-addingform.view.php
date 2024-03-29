<form enctype="multipart/form-data" id="departmentUserAccount-form">
	<div class="modal-header text-dark border-bottom pb-3">
		<div class="container-fluid text-center">
			<p class="h5 modal-title text-capitalize" id="exampleModalLabel">DEPARTMENT ACCOUNT ADDING FORM</p>
		</div>
		<a class="p-1" type="button" data-dismiss="modal" aria-label="Close" onclick="$('#modalDepartmentAccount').modal('hide')">
			<span aria-hidden="true">&times;</span>
		</a>
	</div>

	<div class="modal-body">
		<div class="form-group">
			<input type="hidden" class="form-control action" name="action" id="action" value="addDepartmentUserAccount">
		</div>

		<div id="useraccount_id" class="useraccount_id">
		</div>

		<input type="hidden" class="form-control usertype" name="usertype" id="usertype" value="department">

		<!-- Select Department -->
		<div id="select-department-container" class="form-group">
			<label for="account_dept_id" class="font-size-small mb-0 pb-0">Department</label>
			<select name="account_dept_id" id="account_dept_id" class="form-control" required>
				<option selected disabled> -- Select Department -- </option>
				<!-- </?php foreach ($departments as $department) : ?>
					<option value="</?= $department->dept_id ?>">
						</?= $department->dept_code ?>
					</option>
				</?php endforeach; ?> -->
			</select>
		</div>
		<!-- /# Select Department -->

		<!-- Select Employee -->
		<div id="select-employee-container" class="form-group">
			<label for="account_emp_id" class="font-size-small mb-0 pb-0">Employee</label>
			<select name="account_emp_id" id="account_emp_id" class="form-control" required>
				<option selected disabled>-- Select Employee --</option>

			</select>
		</div>
		<!-- /# Select Employee -->

		<div class="form-group">
			<div class="md-form">
				<i class="fas fa-user prefix grey-text"></i>
				<input type="text" class="form-control department-username" name="username" id="username" placeholder="Username" required>
			</div>
		</div>

		<div class="form-group password-field">
			<div class="md-form">
				<i class="fas fa-lock prefix grey-text"></i>
				<input type="password" class="form-control password" name="password" id="password" placeholder="Password" required>
			</div>
		</div>

	</div>

	<div class="modal-footer text-dark mb-0">
		<button type="reset" class="btn btn-sm btn-secondary" data-dismiss="modal" onclick="$('#modalDepartmentAccount').modal('hide')">Cancel</button>
		<button type="submit" name="submit" class="btn btn-sm btn-primary useraccount_btn" id="useraccount_btn">Add User Account</button>
	</div>
</form>