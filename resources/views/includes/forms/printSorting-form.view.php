<div class="card">
	<div class="card-header py-0 text-center">
		<h1 class="h3 mt-3">Choose Type</h1>
	</div>
	<div class="card-body">
		<!-- Login Form -->
		<form enctype="multipart/form-data" id="printSorting-form">
			<div class="modal-body">
				<div class="form-group col-md-6">
					<label><input type="radio" name="sort" value="all">All</label><br>
					<div class="row">
						<div class="col-md-8">
							<label><input type="radio" name="sort" value="department">By Department</label><br>
						</div>
						<div class="form-group col-md-4" id="dept_selection" style="display: none">
							<select id="dept_id" class="form-control">
								<option selected disabled> -- Select Department -- </option>
								<?php foreach ($depts as $department) : ?>
									<option value="<?= $department->dept_id ?>"><?= $department->dept_code ?></option>;
								<?php endforeach;	?>
							</select>
						</div>
					</div>
					<!-- <div class="row">
	      		<div class="col-md-8">
	      			<label><input type="radio" name="sort" value="day">By Date</label><br>
	      		</div>
	      		<div class="form-group col-md-4" id="date_selection" style="display: none">
			      	<input type="date" name="day" id="day">
			    </div>
		  	</div> -->

				</div>

			</div>

			<div class="modal-footer text-light mb-0">
				<button type="button" class="btn btn-secondary cancel" data-dismiss="modal">Cancel</button>
				<button type="submit" name="submit" class="btn btn-primary" id="print_btn">
					Download
				</button>
			</div>
		</form>
		<!-- /# Login Form -->
	</div>
</div>