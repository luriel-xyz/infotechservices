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

  $.ajax({
    url: "../../config/processors/settingsArguments.php",
    type: "POST",
    data: $(this).serialize()
  }).done(function(res) {
    if (res) {
      alert("Department Data Saved");
      location.reload(true);
    } else {
      alert("Error");
    }
  });
});

//Edit Department Script
$(".edit-department").click(function(e) { 
  e.preventDefault();
  const action = "editDepartment";
  const dept_id = $(this).attr("id");

  $.post("../../config/processors/settingsArguments.php", {
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
      alert("error");
    });

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
