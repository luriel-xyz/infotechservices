$("#itsrequest_category").change(function(e) {
  e.preventDefault();
  const itsrequest_category = $(this).val();

  if (itsrequest_category === "hw") {
    $("#hw_category").show();
  } else {
    $("#hw_category").hide();
  }
});

// If you wanna include
// $('#hwcomponent_id').change(function() {
// 	var action = 'getHardwareComponentsBySubCategory';
// 	var hwcomponent_id = $(this).val();

// 	$.ajax({
// 		url: requestsPath,
// 		type: "POST",
// 		data: {
// 			action: action,
// 			hwcomponent_id: hwcomponent_id
// 		},
// 	}).done(function(components) {
// 		components = JSON.parse(components);
// 		$('#hwcomponent_subcategory').empty();
// 		$('#hwcomponent_subcategory').append('<option value = "">' + '-- Select Specific Hardware Component(Optional) --' + '</option>');
// 		components.forEach(function(components) {
// 			$('#hwcomponent_subcategory').append('<option value = ' + components.hwcomponent_id + '>' + components.hwcomponent_name + '</option>')
// 		});
// 	});
// });

$("#incomingrequest-form").submit(function(e) {
  e.preventDefault();

  $.post(requestsPath, $(this).serialize()).done(async res => {
    if (res) {
      await Swal.fire("Success", "Request Sent!", "success");
      $.redirect(`${baseUrl}app/client/index.php`);
    } else {
      Swal.fire("Failure", "An error occured", "error");
    }
  });
});
