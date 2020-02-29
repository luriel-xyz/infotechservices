<form enctype="multipart/form-data" id="departmentUserAccount-form">
	<div class="modal-header text-dark border-bottom pb-3">
		<div class="container-fluid text-center">
			<p class="h5 modal-title text-capitalize" id="exampleModalLabel">DEPARTMENT ACCOUNT ADDING FORM</p>
		</div>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>

	<div class="modal-body">
		<div class="form-group">
			<input type="hidden" class="form-control action" name="action" id="action" value="addDepartmentUserAccount">
		</div>

		<div id="useraccount_id" class="useraccount_id">
		</div>

		<input type="hidden" class="form-control usertype" name="usertype" id="usertype" value="department">

		<div class="form-group">
			<select name="dept_id" id="dept_id" class="form-control" required>
				<option selected disabled> -- Select Department -- </option>
				<?php foreach ($departments as $department) : ?>
					<option value="<?= $department->dept_id ?>">
						<?= $department->dept_code ?>
					</option>
				<?php endforeach; ?>
			</select>
		</div>

		<div class="form-group">
			<input type="text" class="form-control username" name="username" id="username" placeholder="Username" required>
		</div>

		<div class="form-group">
			<input type="password" class="form-control password" name="password" id="password" placeholder="Password" required>
		</div>

	</div>

	<div class="modal-footer text-dark mb-0">
		<button type="button" class="btn btn-secondary cancel" data-dismiss="modal">Cancel</button>
		<button type="submit" name="submit" class="btn btn-primary useraccount_btn" id="useraccount_btn">Add User Account</button>
	</div>
</form>