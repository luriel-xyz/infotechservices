<form enctype="multipart/form-data" id="personnelUserAccount-form">
	<div class="modal-header text-dark border-bottom pb-3">
		<div class="container-fluid text-center">
			<p class="h5 modal-title" id="exampleModalLabel">PERSONNEL ACCOUNT ADDING FORM</p>
		</div>
		<a class="p-1" type="button" data-dismiss="modal" aria-label="Close" onclick="$('#modalPersonnelAccount').modal('hide')">
			<span aria-hidden="true">&times;</span>
		</a>
	</div>

	<div class="modal-body">
		<div class="form-group">
			<input type="hidden" class="form-control action" name="action" id="action" value="addPersonnelUserAccount">
			<input type="hidden" class="form-control personnel_dept_id" name="personnel_dept_id" id="personnel_dept_id" value="1">
		</div>

		<div id="useraccount_id" class="useraccount_id">
		</div>

		<div class="form-group">
			<label for="usertype" class="font-size-small mb-0 pb-0">Usertype</label>
			<select name="usertype" id="usertype" class="form-control usertype" required>
				<option selected disabled> -- Select User Type -- </option>
				<option value="admin"> Admin </option>
				<option value="personnel"> Personnel </option>
			</select>
		</div>

		<div class="form-group">
			<label for="emp_id" class="font-size-small mb-0 pb-0">PGO-IT Employee</label>
			<select name="emp_id" id="emp_id" class="form-control">
				<option selected disabled> -- Select Employee -- </option>
				<?php foreach ($personnels as $personnel) : ?>
					<option value="<?= $personnel->emp_id ?>">
						<?= $personnel->emp_fname ?> <?= $personnel->emp_lname ?>
					</option>
				<?php endforeach; ?>
			</select>
		</div>

		<div class="form-group">
			<div class="md-form">
				<i class="fas fa-user prefix grey-text"></i>
				<input type="text" class="form-control personnel-username" name="username" id="username" placeholder="Username" required>
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
		<button type="reset" class="btn btn-sm btn-secondary" data-dismiss="modal" onclick="$('#modalPersonnelAccount').modal('hide')">Cancel</button>
		<button type="submit" name="submit" class="btn btn-sm btn-primary useraccount_btn" id="useraccount_btn">Add User Account</button>
	</div>
</form>