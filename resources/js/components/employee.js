// Add validation rule for employee id number field
let isUniqueIdNumber;
let isEditEmployee = false;
$.validator.addMethod(
  "uniqueIdNumber",
  (value, element) => {
    $.post(requestsPath, {
      action: "isIdNumberTaken",
      emp_idnum: () => $("#emp_idnum").val()
    }).done(res => (isUniqueIdNumber = !res));

    return isUniqueIdNumber;
  },
  "This id number is already taken."
);

$("#employee-form").validate({
  ...validatorOptions,
  rules: {
    dept_id: {
      required: true,
      min: 1
    },
    emp_idnum: {
      required: true,
      uniqueIdNumber: {
        depends: () => !isEditEmployee
      }
    },
    fname: "required",
    lname: "required",
    position: "required"
  },

  messages: {
    dept_id: "Please select a department.",
    emp_idnum: {
      required: "Please indicate employee id number.",
      uniqueIdNumber: "This id number is already taken."
    },
    fname: "First name is required.",
    lname: "Last name is required.",
    position: "Position is required."
  },

  submitHandler: form => {
    $.post(requestsPath, $(form).serialize()).done(async res => {
      if (res) {
        await Swal.fire("Success", "Employee Data Saved!", "success");
        location.reload(true);
      } else {
        Swal.fire("Failure", "Error!", "error");
      }
    });
  }
});

$("#search").on("keyup", function() {
  const search_text = $(this)
    .val()
    .toLowerCase();
  $("#table_body tr").filter(function() {
    $(this).toggle(
      $(this)
        .text()
        .toLowerCase()
        .indexOf(search_text) > -1
    );
  });
});

$("#add-employee").click(function(e) {
  isEditEmployee = false;
  $(".modal-title").text("EMPLOYEE ADDING FORM");
  $("#emp_btn").text("Add Employee");
  // $("#emp_id").html("");
  $("#emp_dept_id").val("");
  $("#emp_idnum").val("");
  $("#fname").val("");
  $("#lname").val("");
  $("#emp-position").val("");
  $("#emp_btn").text("Save Changes");
  $("#action").val("addEmployee");

  $("#modal").modal({
    backdrop: "static",
    keyboard: false
  });
});

//Add Employee Script
// $("#employee-form").submit(function(e) {
//   e.preventDefault();

//   const url = requestsPath;
//   $.post(url, $(this).serialize()).done(async res => {
//     if (res) {
//       const { value } = await Swal.fire(
//         "Success",
//         "Employee Data Saved!",
//         "success"
//       );
//       if (value) {
//         location.reload(true);
//       }
//     } else {
//       Swal.fire("Failure", "Error!", "error");
//     }
//   });
// });

//Edit Employee Script
$(".edit-employee").click(function(e) {
  e.preventDefault();

  isEditEmployee = true;
  // Fetch Employee Data
  const action = "editEmployee";
  const emp_id = $(this).attr("id");
  $.ajax({
    url: requestsPath,
    type: "post",
    data: {
      action: action,
      emp_id: emp_id
    },
    dataType: "JSON"
  }).done(function(employee) {
    $("#emp_id").empty();
    $(".modal-title").text("EMPLOYEE UPDATING FORM");
    $("#emp_id").append(
      '<input type="hidden" name="emp_id" id="emp_id" value=' +
        employee.emp_id +
        ">"
    );
    $("#emp_dept_id").val(employee.dept_id);
    $("#emp_idnum").val(employee.emp_idnum);
    $("#fname").val(employee.emp_fname);
    $("#lname").val(employee.emp_lname);
    $("#emp-position").val(employee.emp_position);
    $("#emp_btn").text("Save Changes");
    $("#action").val("updateEmployee");
  });
  // Show Edit Employee Modal
  $("#modal").modal({
    backdrop: "static",
    keyboard: false
  });
});
