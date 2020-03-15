$("#request_category").show();
$("#hw_category").show();
$("#itsrequest_category").val("hw");

$("#dept_id").change(async function() {
  const dept_id = $(this).val();
  let employees = await $.post(requestsPath, {
    action: "getEmployeesByDepartment",
    dept_id: dept_id
  }).promise();

  employees = JSON.parse(employees);
  $("#emp_id").empty();
  $("#emp_id").show();
  $("#emp_id").append(
    "<option selected disabled>" + "-- Select Employee --" + "</option>"
  );
  employees.forEach(function(employee) {
    $("#emp_id").append(
      "<option value = " +
        employee.emp_id +
        ">" +
        employee.emp_fname +
        " " +
        employee.emp_lname +
        "</option>"
    );
  });
});

$("#hwcomponent_id").change(async function() {
  var hwcomponent_id = $(this).val();

  let components = await $.post(requestsPath, {
    action: "getHardwareComponentsBySubCategory",
    hwcomponent_id: hwcomponent_id
  }).promise();

  components = JSON.parse(components);
  $("#hwcomponent_subcategory").empty();
  $("#hwcomponent_subcategory").append(
    "<option selected disabled>" +
      "-- Select Specific Hardware Component(Optional) --" +
      "</option>"
  );
  components.forEach(function(components) {
    $("#hwcomponent_subcategory").append(
      "<option value = " +
        components.hwcomponent_id +
        ">" +
        components.hwcomponent_name +
        "</option>"
    );
  });
});

// Validate Add repair form
$("#incomingrepair-form").validate({
  ...validatorOptions,

  rules: {
    dept_id: "required",
    emp_id: "required",
    itsrequest_category: "required",
    hwcomponent_id: "required",
    hwcomponent_subcategory: { required: false },
    property_num: "required",
    concern: "required"
  },

  submitHandler: async form => {
    showLoading();

    const res = await $.post(requestsPath, $(form).serialize()).promise();
    if (res) {
      await Swal.fire("Success", "Repair Added!", "success");
      $.redirect(`${baseUrl}app/admin/incoming-repairs.php`);
    } else {
      Swal.fire("Failure", "An error occured, try again.", "error");
    }
  }
});

$("#incomingrepair-form").submit(function(e) {
  e.preventDefault();

  // $.ajax({
  //   url: requestsPath,
  //   type: "POST",
  //   data: $(this).serialize()
  // }).done(async function(res) {
  //   if (res) {
  //     await Swal.fire("Success", "Repair Added!", "success");
  //     $.redirect(`${baseUrl}app/admin/incoming-repairs.php`);
  //   } else {
  //     Swal.fire("Failure", "Error!", "error");
  //   }
  // });
});
