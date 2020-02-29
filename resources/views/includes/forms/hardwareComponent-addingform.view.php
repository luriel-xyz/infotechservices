<form enctype="multipart/form-data" id="hardwareComponent-form">
	<div class="modal-header text-dark pb-3 border-bottom">
		<div class="container-fluid text-center">
			<p class="h6 modal-title text-capitalize" id="exampleModalLabel">HARDWARE COMPONENT ADDING FORM</p>
		</div>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>

	<div class="modal-body">
		<div class="form-group">
			<input type="hidden" class="form-control" name="action" id="action" value="addHardwareComponent">
		</div>

		<div id="hwcomponent_id">
		</div>

		<div class="form-group">
			<input type="text" class="form-control" name="hwcomponent_name" id="hwcomponent_name" placeholder="Hardware Component Name" required>
		</div>

		<div class="form-group">
			<select name="hwcomponent_type" id="hwcomponent_type" class="form-control" required>
				<option selected disabled> -- Select Hardware Component Type -- </option>
				<option value="main"> Main </option>
				<option value="sub"> Sub </option> 
			</select>
		</div>

		<div class="form-group sub_type" id="sub_type" style="display: none"> 
			<select name="hwcomponent_category" id="hwcomponent_category" class="form-control">
				<option selected disabled> -- Select Main Component -- </option>
				<?php foreach ($main_hwcomponents as $component) : ?>
					<option value="<?= $component->hwcomponent_id ?>"> <?= $component->hwcomponent_name ?> </option>
				<?php endforeach;	?>
			</select>
		</div>

	</div>

	<div class="modal-footer text-dark">
		<button type="button" class="btn btn-secondary cancel" data-dismiss="modal">Cancel</button>
		<button type="submit" name="submit" class="btn btn-primary" id="hwcomponent_btn">Add Hardware Component</button>
	</div>

</form>