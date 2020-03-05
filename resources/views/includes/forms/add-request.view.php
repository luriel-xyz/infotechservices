<?php view('includes/header'); ?>

<?php view('client/toolbar'); ?>

<!-- Page Content -->
<div class="h-100 w-100 row">

	<!--  Container -->
	<div class="container-fluid col-lg-6 col-md-6 col-sm-12 col-xs-12 offset-lg-3 offset-md-3 my-auto text-success">
		<form method="POST" class="p-3 border border-success rounded" id="incomingrequest-form">
			<div class="form-group text-center">
				<p class="h3">IT Service Request Form</p> 
			</div>

			<input type="hidden" class="form-control" name="action" id="action" value="addRequest">
			<input type="hidden" class="form-control" name="dept_id" id="dept_id" value="<?= user()->dept_id ?>">

			<div class="form-group">
				<select class="form-control" id="emp_id" name="emp_id" required>
					<option selected disabled>-- Select Your Name --</option>
					<?php foreach ($employees as $employee) : ?>
						<option value="<?= $employee->emp_id ?>"> <?= $employee->emp_fname ?> <?= $employee->emp_lname ?> </option>
					<?php endforeach; ?>
				</select>
			</div>

			<div class="form-group">
				<select class="form-control" id="itsrequest_category" name="itsrequest_category" required>
					<option selected disabled> -- Select Request Type -- </option>
					<option value="hw"> Hardware </option>
					<option value="other"> Other </option>
				</select>
			</div>

			<div id="hw_category" style="display: none;">
				<div class="form-group">
					<select class="form-control" id="hwcomponent_id" name="hwcomponent_id" required>
						<option selected disabled> -- Select Particular Hardware -- </option>
						<?php foreach ($mainHardwareComponents as $component) :	?>
							<option value="<?= $component->hwcomponent_id ?>"> <?= $component->hwcomponent_name ?> </option>
						<?php endforeach;	?>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label for="concern">Concerns:</label>
				<textarea class="form-control" id="concern" name="concern" placeholder="(e.g) CPU - Restarts on its own" required></textarea>
			</div>

			<div class="row">
				<div class="col text-center">
					<button type="submit" class="btn btn-success text-capitalize">Send Request</button>
				</div>
			</div>

		</form>

	</div>
	<!--/# Container -->

</div>
<!-- /# Page Content -->

<script type="text/javascript" src="<?= asset('js/add-request.js') ?>"></script>

<?php view('includes/footer'); ?>