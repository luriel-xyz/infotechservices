$("#search").on("keyup", function() {
  var search_text = $(this)
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
  $("#modal").modal({
    backdrop: "static",
    keyboard: false
  });
});

//Add Employee Script
$("#employee-form").submit(function(e) {
  e.preventDefault();

  const url = "../../../config/processors/settingsArguments.php";
  $.post(url, $(this).serialize()).done(async res => {
    if (res) {
      const { value } = await Swal.fire(
        "Success",
        "Employee Data Saved!",
        "success"
      );
      if (value) {
        location.reload(true);
      }
    } else {
      Swal.fire("Failure", "Error!", "error");
    }
  });
});

//Edit Employee Script
$(".edit-employee").click(function(e) {
  e.preventDefault();

  // Fetch Employee Data
  const action = "editEmployee";
  const emp_id = $(this).attr("id");
  $.ajax({
    url: "../../../config/processors/settingsArguments.php",
    type: "post",
    data: {
      action: action,
      emp_id: emp_id
    },
    dataType: "JSON"
  }).done(function(employee) {
    // Set Modal Fields
    $(".modal-title").text("EMPLOYEE UPDATING FORM");
    $("#emp_id").append(
      '<input type="hidden" name="emp_id" id="emp_id" value=' +
        employee.emp_id +
        ">"
    );
    $("#dept_id").val(employee.dept_id);
    $("#emp_idnum").val(employee.emp_idnum);
    $("#fname").val(employee.emp_fname);
    $("#lname").val(employee.emp_lname);
    $("#emp-position").val(employee.emp_position);
    $("#emp_btn").val("Save Changes");
    $("#action").val("updateEmployee");
  });
  // Show Edit Employee Modal
  $("#modal").modal({
    backdrop: "static",
    keyboard: false
  });
});

$(".close").click(function() {
  location.reload(true);
});

$(".cancel").click(function() {
  location.reload(true);
});
