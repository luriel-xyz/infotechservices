<form enctype="multipart/form-data" id="done-form">
	<div class="modal-header text-light bg-dark">
		<div class="container-fluid text-center">
			<p class="h4 modal-title" id="exampleModalLabel">COMPLETION FORM</p>
		</div>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>

	<div class="modal-body">

		<div class="form-group">
			<input type="hidden" class="form-control" name="action" id="action" value="statusDone">
		</div>

		<div id="itsrequest_id_done">
		</div>

		<div class="form-group">
			<label for="solution">Solution:</label>
			<textarea class="form-control" name="solution" id="solution"></textarea>
		</div>

	</div>

	<div class="modal-footer text-light bg-dark" style="margin-bottom: 0">
		<button type="button" class="btn btn-sm btn-secondary cancel" data-dismiss="modal">Cancel</button>
		<button type="submit" name="submit" class="btn btn-sm btn-primary" id="done">Done</button>
	</div>
</form>