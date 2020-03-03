<form enctype="multipart/form-data" id="personnelUserAccount-form">
	<div class="modal-header text-dark border-bottom pb-3">
		<div class="container-fluid text-center">
			<p class="h5 modal-title" id="exampleModalLabel">PERSONNEL ACCOUNT ADDING FORM</p>
		</div>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>

	<div class="modal-body">
		<div class="form-group">
			<input type="hidden" class="form-control action" name="action" id="action" value="addPersonnelUserAccount">
		</div>

		<div id="useraccount_id" class="useraccount_id">
		</div>

		<div class="form-group">
			<select name="usertype" id="usertype" class="form-control usertype" required>
				<option selected disabled> -- Select User Type -- </option>
				<option value="admin"> Admin </option>
				<option value="personnel"> Personnel </option>
			</select>
		</div>

		<div class="form-group">
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