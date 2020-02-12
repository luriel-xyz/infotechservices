<form enctype="multipart/form-data" id="hardwareComponent-form">
	<div class="modal-header text-light bg-dark">
		<div class="container-fluid text-center">
 		<p class="h6 modal-title" id="exampleModalLabel">HARDWARE COMPONENT ADDING FORM</p>
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
	      	<input type="text" class="form-control" name="hwcomponent_name" id="hwcomponent_name" placeholder="Hardware Component Name" required="">
	  	</div>

	  	<div class="form-group">
	      	<select name="hwcomponent_type" id="hwcomponent_type" class="form-control" required="">
				<option value=""> -- Select Hardware Component Type -- </option>
	        	<option value="main"> Main </option>
	        	<option value="sub"> Sub </option>
		    </select>
	  	</div>

	  	<div class="form-group sub_type" id="sub_type" style="display: none">
	      	<select name="hwcomponent_category" id="hwcomponent_category" class="form-control">
	      		<?php
	      		foreach ($main_hwcomponents as $key => $value) {
	      		?>
	      			<option value="<?=$value['hwcomponent_id']?>"> <?=$value['hwcomponent_name']?> </option>
	      		<?php	
	      		}
	      		?>
		    </select>
	  	</div>

		</div>

	<div class="modal-footer text-light bg-dark" style="margin-bottom: 0">
		<button type="button" class="btn btn-secondary cancel" data-dismiss="modal">Cancel</button>
	 	<button type="submit" name="submit" class="btn btn-primary" id="hwcomponent_btn">Add Hardware Component</button>
	</div>
</form>  