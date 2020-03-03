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

$("#add-department").click(function(e) {
  $("#modal").modal({
    backdrop: "static",
    keyboard: false
  });
});

//Add Department Script
$("#department-form").submit(function(e) {
  e.preventDefault();

  $.post(
    "../../../config/processors/settingsArguments.php",
    $(this).serialize()
  ).done(async res => {
    if (res) {
      await Swal.fire("Success", "Department Data Saved", "success");
      location.reload(true);
    } else {
      Swal.fire("Failure", "An error occured", "error");
    }
  });
});

//Edit Department Script
$(".edit-department").click(function(e) {
  e.preventDefault();
  const action = "editDepartment";
  const dept_id = $(this).attr("id");

  $.post("../../../config/processors/settingsArguments.php", {
    action: action,
    dept_id: dept_id
  })
    .done(function(department) {
      department = JSON.parse(department);

      $(".modal-title").text("DEPARTMENT UPDATING FORM");
      $("#dept_id").append(
        '<input type="hidden" name="dept_id" id="dept_id" value=' +
          department.dept_id +
          ">"
      );
      $("#dept_code").val(department.dept_code);
      $("#dept_name").val(department.dept_name);
      $("#dept_btn").text("Save Changes");
      $("#action").val("updateDepartment");
    })
    .fail(function() {
      Swal.fire("Failure", "An error occured", "error");
    });

  $("#modal").modal({
    backdrop: "static",
    keyboard: false
  });
});
