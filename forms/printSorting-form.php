<form enctype="multipart/form-data" id="printSorting-form">
	<div class="modal-header text-light bg-dark">
		<div class="container-fluid text-center">
			<p class="h4 modal-title" id="exampleModalLabel">CHOOSE TYPE:</p>
		</div>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>

	<div class="modal-body">

		<div class="form-group col-lg-6">

			<label><input type="radio" name="sort" value="all">All</label><br>
			<div class="row">
				<div class="col-lg-8">
					<label><input type="radio" name="sort" value="department">By Department</label><br>
				</div>
				<div class="form-group col-lg-4" id="dept_selection" style="display: none">
					<select id="dept_id">
						<option selected disabled> -- Select Department -- </option>
						<?php foreach ($depts as $department) : ?>
							<option value="<?= $department['dept_id'] ?>"><?= $department['dept_code'] ?></option>;
						<?php endforeach;	?>
					</select>
				</div>
			</div>
			<!-- <div class="row">
	      		<div class="col-lg-8">
	      			<label><input type="radio" name="sort" value="day">By Date</label><br>
	      		</div>
	      		<div class="form-group col-lg-4" id="date_selection" style="display: none">
			      	<input type="date" name="day" id="day">
			    </div>
		  	</div> -->

		</div>

	</div>

	<div class="modal-footer text-light bg-dark" style="margin-bottom: 0">
		<button type="button" class="btn btn-secondary cancel" data-dismiss="modal">Cancel</button>
		<button type="submit" name="submit" class="btn btn-primary" id="print_btn">Download</button>
	</div>
</form>