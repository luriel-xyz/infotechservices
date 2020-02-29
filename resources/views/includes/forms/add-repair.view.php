<?php view('includes/header'); ?>

<!-- Page Content -->
<div class="h-100 w-100 row">

	<!--  Container -->
	<div class="container-fluid col-lg-6 col-md-6 col-sm-12 col-xs-12 offset-lg-3 offset-md-3 my-auto">

		<!-- Go back link -->
		<a href="<?= getPath('app/admin/incoming-repairs.php') ?>" class="btn btn-sm btn-default">
			<i class="fa fa-arrow-left fa-fw"></i>
			<span class="text-capitalize">Go back</span>
		</a>
		<!-- /# Go back link -->

		<!-- Add new repair form -->
		<form method="POST" class=" p-3 border rounded" id="incomingrepair-form">
			<div class="form-group text-center border-bottom pb-2">
				<p class="h3"><i class="fa fa-wrench fa-fw" style="font-size: 0.9em;" aria-hidden="true"></i> Repair Adding Form</p>
			</div>
			<div class="form-group">
				<input type="hidden" class="form-control" name="action" id="action" value="addWalk-inRepair">
			</div>

			<div class="form-group">
				<input type="hidden" class="form-control" name="statusupdate_useraccount_id" id="statusupdate_useraccount_id" value="<?= user()->useraccount_id; ?>" required>
			</div>

			<div>
				<input type="hidden" class="form-control" name="itshw_category" id="itshw_category" value="walk-in" required>
			</div>

			<div class="form-group">
				<select class="form-control" id="dept_id" name="dept_id" required>
					<option selected disabled> -- Select Department -- </option>
					<?php foreach ($departments as $department) :	?>
						<option value="<?= $department->dept_id ?>"> <?= $department->dept_code ?> </option>
					<?php endforeach;	?>
				</select>
			</div>

			<div class="form-group">
				<select class="form-control" id="emp_id" name="emp_id" required>
				</select>
			</div>

			<div class="form-group request_category" style="display: none">
				<select class="form-control" id="itsrequest_category" name="itsrequest_category" required>
					<option selected disabled> -- Select Request Category -- </option>
					<option value="hw"> Hardware </option>
					<option value="other"> Other </option>
				</select>
			</div>

			<div id="hw_category" style="display: none">
				<div class="form-group">
					<select class="form-control" id="hwcomponent_id" name="hwcomponent_id" required>
						<option selected disabled> -- Select Hardware -- </option>
						<?php foreach ($hardwarecomponents as $component) : ?>
							<option value="<?= $component->hwcomponent_id ?>"> <?= $component->hwcomponent_name ?> </option>
						<?php endforeach; ?>
					</select>
				</div>

				<div class="form-group property_num">
					<select class="form-control" id="hwcomponent_subcategory" name="hwcomponent_subcategory" required>
					</select>
				</div>

				<div class="form-group property_num">
					<input type="text" name="property_num" id="property_num" class="form-control" placeholder="Property Number" required>
				</div>

			</div>

			<div class="form-group">
				<textarea class="form-control" id="concern" name="concern" rows="4" placeholder="Concern" required></textarea>
			</div>

			<div class="row">
				<div class="col text-center">
					<button type="submit" class="btn btn-sm btn-primary" id="submit-btn"><i class="fas fa-plus fa-fw"></i>Add Repair</button>
				</div>
			</div>

		</form> 
		<!-- /# Add new repair form -->
	</div>
	<!--/# Container -->
</div>
<!-- /# Page Content -->

<?php view('includes/footer'); ?>