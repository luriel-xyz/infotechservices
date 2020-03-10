<form enctype="multipart/form-data" id="pullout_done-form">
	<div class="modal-header text-dark border-bottom pb-3">
		<div class="container-fluid text-center">
			<p class="h4 modal-title" id="exampleModalLabel">COMPLETION FORM</p>
		</div>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>

	<div class="modal-body">
		<div class="form-group">
			<input type="hidden" class="form-control" id="action" name="action" value="statusDone">
		</div>

		<div id="itsrequest_id">
		</div>

		<div id="statusupdate_useraccount_id">
		</div>

		<div class="form-group " id="hwcomponent_select" style="display: none;">
			<select class="form-control" id="hwcomponent_id" name="hwcomponent_id" required>
				<?php foreach ($hardwarecomponents as $component) : ?>
					<option value="<?= $component->hwcomponent_id ?>"> <?= $component->hwcomponent_name ?> </option>
				<?php endforeach; ?>
			</select>
		</div>

		<div class="form-group" id="input_field">
		</div>

	</div>

	<div class="modal-footer text-ligh mb-0">
		<button type="button" class="btn btn-sm btn-secondary cancel" data-dismiss="modal">Cancel</button>
		<button type="submit" name="submit" class="btn btn-sm btn-primary" id="submit_btn">Done</button>
	</div>
</form>