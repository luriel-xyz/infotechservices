// Validate department form
$("#department-form").validate({
  ...validatorOptions,

  rules: {
    dept_code: "required",
    dept_name: "required"
  },

  messages: {
    dept_code: "Department code is required.",
    dept_name: "Department name is required."
  },

  submitHandler: async form => {
    const { data } = await axios.post(requestsPath, $(form).serialize());
    if (data) {
      await Swal.fire("Success", "Department Data Saved", "success");
      location.reload(true);
    } else {
      Swal.fire("Failure", "An error occured", "error");
    }
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

$("#add-department").click(function(e) {
  $("#modal").modal({
    backdrop: "static",
    keyboard: false
  });
});

//Add Department Script
$("#department-form").submit(function(e) {
  e.preventDefault();
});

//Edit Department Script
$(".edit-department").click(function(e) {
  e.preventDefault();
  const action = "editDepartment";
  const dept_id = $(this).attr("id");

  $.post(requestsPath, {
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
