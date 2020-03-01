<?php view('includes/header'); ?>
<!-- Page Content -->
<div class="h-100 w-100 row">

	<!--  Container -->
	<div class="container-fluid col-md-10 col-md-10 col-sm-12 col-xs-12 offset-lg-1 offset-md-1 my-auto text-dark">
		<form method="POST" class="p-3 border border-light rounded" id="repassessmentreport-form">
			<div class="form-group text-center border-bottom pt-3">
				<div class="row">
					<div class="col-2">
						<!-- Redirect to incoming repairs page -->
						<a href="<?= getPath('app/admin/incoming-repairs.php') ?>" class="btn btn-link pl-0 text-dark"><i class="fas fa-arrow-left fa-fw"></i>Go Back</a>
					</div>
					<div class="col-8">
						<p class="h3"><i class="fas fa-file fa-fw" aria-hidden="true"></i> Repair Assessment Report Creation Form </p>
					</div>
				</div>
			</div>

			<div class="form-group">
				<input type="hidden" class="form-control" name="action" id="action" value="addRepAssessReport">
				<input type="hidden" class="form-control" name="itsrequest_id" id="itsrequest_id" value="<?= $itsrequest_id ?>">
			</div>

			<div class="form-group">
				<input type="hidden" class="form-control" name="assessmenttechrep_useraccount_id" id="assessmenttechrep_useraccount_id" value="<?= user()->useraccount_id ?>" required>
			</div>

			<div class="col-md-12 row">
				<div class="col-md-2 ml-3">
					<label class="form-group"> Date: </label>
				</div>
				<div class="form-group col-md-4">
					<input class="form-control" type="date" name="assessment_date" id="assessment_date" value="<?= date('Y-m-d') ?>" required />
				</div>
			</div>
			<hr class="border border-light">
			<div class="container-fluid row">
				<div class="col-md-3">
					<label class="form-group col-md-12"> Name of Item: </label>
					<br>
					<br>
					<label class="form-group col-md-12"> Model/Description: </label>
					<br>
					<br>
					<label class="form-group col-md-12"> Date Acquired: </label>
					<br>
					<br>
					<label class="form-group col-md-12"> Acquisition Price: </label>
				</div>

				<div class="col-md-3 form-group">
					<!-- Name of Item Select Field -->

					<!-- </?php dd($hardwarecomponents); ?> -->

					<select class="form-control" name="hwcomponent_id" id="hwcomponent_id" required disabled>
						<?php foreach ($hardwareComponents as $component) : ?>
							<option value="<?= $component->hwcomponent_id ?>" <?php if ($component->hwcomponent_id == $hwcomponent_id) : ?> selected <?php endif ?>>
								<?= $component->hwcomponent_name ?>
							</option>
						<?php endforeach; ?>
					</select>
					<!-- /# Name of Item Select Field -->
					<br>
					<!-- Hardware Component Description Field -->
					<textarea name="hwcomponent_description" class="form-control" id="hwcomponent_description" rows="2" required></textarea>
					<!-- <input class="form-control" type="text" name="hwcomponent_description" id="hwcomponent_description" required> -->
					<!-- /# Hardware Component Description Field -->
					<br>
					<!-- Date Acquired Field -->
					<input class="form-control" type="date" name="hwcomponent_dateAcquired" id="hwcomponent_dateAcquired" required />
					<!-- /# Date Acquired Field -->
					<br>
					<!-- Acquisition Cost Field -->
					<input class="form-control" type="number" name="hwcomponent_acquisitioncost" id="hwcomponent_acquisitioncost" min="0" step=".01" required placeholder="Php">
					<!-- /# Acquisition Cost Field -->
				</div>

				<div class="col-md-3">
					<label class="form-group col-md-12"> Department/Office: </label>
					<br>
					<br>
					<label class="form-group col-md-12"> Property Number: </label>
					<br>
					<br>
					<label class="form-group col-md-12"> Issued To: </label>
					<br>
					<br>
					<label class="form-group col-md-12"> Serial Number: </label>
				</div>

				<div class="col-md-3 form-group">
					<!-- Department Field -->
					<select class="form-control" name="dept_id" id="dept_id" required>
						<?php foreach ($departments as $department) : ?>
							<option value="<?= $department->dept_id ?>" <?php if ($dept_id == $department->dept_id) : ?> selected='selected' <?php endif; ?>>
								<?= $department->dept_code ?>
							</option>
						<?php endforeach; ?>
					</select>
					<!-- /# Department Field -->
					<br>
					<!-- Property Number Field -->
					<input class="form-control" type="text" name="property_num" id="property_num" required />
					<!-- /# Property Number Field -->
					<br>
					<!-- Employee Id Field -->
					<select class="form-control" name="emp_id" id="emp_id" required>
					</select>
					<!-- /# Employee Id Field -->
					<br>
					<!-- Serial Number Field -->
					<input class="form-control" type="text" name="serial_number" id="serial_number" required>
					<!-- /# Serial Number Field -->
				</div>

			</div>

			<div class="container-fluid row">
				<div class="col-md-3">
					<label class="form-group col-md-12"> Problem: </label>
				</div>

				<div class="col-md-9 form-group">
					<div class="col-md-12 border border-primary rounded" style="overflow:auto; height: 150px;">
						<!-- <div class="checkbox text-left " id="checkbox"> -->
						<label class="row py-2">
							<!-- Sub components checkboxes -->
							<div class="col-12" id="checkbox_container">
							</div>
							<!-- /# Sub components checkboxes -->
						</label>
						<!-- </div> -->
					</div>
				</div>
			</div>

			<div class="container-fluid row">
				<div class="col-md-3">
					<label class="form-group col-md-12"> Findings: </label>
					<br>
					<br>
					<label class="form-group col-md-12"> Notes: </label>
				</div>
				<div class="col-md-9 row">
					<div class="col-md-4 form-group">
						<!-- Findings Select Field -->
						<select class="form-control" name="findings_category" id="findings_category" required>
							<option selected disabled>-- Select Findings --</option>
							<option value="repaired">Repaired</option>
							<option value="partly damaged">Partly Damaged</option>
							<option value="beyond repair">Beyond Repair</option>
							<option value="for replacement">For Replacement</option>
						</select>
						<!-- /# Findings Select Field -->
					</div>
					<div class="col-md-8 form-group">
						<!-- Findings Description Field -->
						<input class="form-control" type="text" name="findings_description" id="findings_description" required placeholder="Findings Description">
						<!-- /# Findings Description Field -->
					</div>
					<div class="col-md-12 form-group">
						<!-- Notes Field -->
						<input class="form-control" type="text" name="notes" id="notes" required placeholder="Notes">
						<!-- /# Notes Field -->
					</div>
				</div>
			</div>
			<hr class="border border-light">
			<div class="row">
				<div class="col text-center">
					<button type="submit" class="btn btn-primary" id="submit-btn">Create</button>
				</div>
			</div>
		</form>
		<!-- <button class="btn btn-print btn-info">
				<i class="fa fa-print fa-fw"></i>
				Print
			</button> -->
	</div>
	<!--/# Container -->

</div>
<!-- /# Page Content -->
<?php view('includes/footer'); ?>