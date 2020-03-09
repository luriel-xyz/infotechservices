$("#request_category").show();
$("#hw_category").show();
$("#itsrequest_category").val("hw");

$("#dept_id").change(function() {
  const action = "getEmployeesByDepartment";
  const dept_id = $(this).val();
  $.ajax({
    url: requestArgumentsPath,
    type: "POST",
    data: {
      action: action,
      dept_id: dept_id
    }
  }).done(function(employees) {
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
});

$("#hwcomponent_id").change(function() {
  var action = "getHardwareComponentsBySubCategory";
  var hwcomponent_id = $(this).val();

  $.ajax({
    url: requestArgumentsPath,
    type: "POST",
    data: {
      action: action,
      hwcomponent_id: hwcomponent_id
    }
  }).done(function(components) {
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
    const res = await $.post(
      requestArgumentsPath,
      $(form).serialize()
    ).promise();
    if (res) {
      await Swal.fire("Success", "Repair Added!", "success");
      $.redirect(`${baseUrl}app/admin/incoming-repairs.php`);
    } else {
      Swal.fire("Failure", "Error!", "error");
    }
  }
});

$("#incomingrepair-form").submit(function(e) {
  e.preventDefault();

  // $.ajax({
  //   url: requestArgumentsPath,
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
