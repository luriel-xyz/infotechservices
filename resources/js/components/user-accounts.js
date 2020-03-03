$("#search").keyup(function() {
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

$("#addPersonnelAccount").click(function(e) {
  $("#modalPersonnelAccount").modal("toggle");
});

$("#addDeptAccount").click(function(e) {
  $("#modalDepartmentAccount").modal("toggle");
});

//Add Personnel User Account Script
$("#personnelUserAccount-form").submit(function(e) {
  e.preventDefault();

  $.post(
    `${baseUrl}config/processors/settingsArguments.php`,
    $(this).serialize()
  ).done(async res => {
    if (res) {
      await Swal.fire("Success", "Personnel Account Data Saved", "success");
      location.reload(true);
    } else {
      Swal.fire("Failure", "An error occured", "error");
    }
  });
});

//Add Department User Account Script
$("#departmentUserAccount-form").submit(function(e) {
  e.preventDefault();

  const url = `${baseUrl}config/processors/settingsArguments.php`;
  $.post(url, $(this).serialize()).done(async res => {
    if (res) {
      await Swal.fire("Success", "Department Account Data Saved", "success");
      location.reload(true);
    } else {
      Swal.fire("Failure", "Error", "error");
    }
  });
});

//Edit User Accounts Script
$(".edit-user").click(function(e) {
  e.preventDefault();

  const action = "editUserAccount";
  const useraccount_id = $(this).attr("id");
  $.post(`${baseUrl}config/processors/settingsArguments.php`, {
    action: action,
    useraccount_id: useraccount_id
  }).done(user => {
    user = JSON.parse(user);
    if (user.usertype === "personnel" || user.usertype === "admin") {
      $("#modalPersonnelAccount").modal("show");
      $(".modal-title").text("PERSONNEL ACCOUNT UPDATING FORM");
    } else {
      $("#modalDepartmentAccount").modal("show");
      $(".modal-title").text("DEPARTMENT ACCOUNT UPDATING FORM");
    }
    $(".useraccount_id").append(
      '<input type="hidden" name="useraccount_id" id="useraccount_id" class="useraccount_id" value=' +
        user.useraccount_id +
        ">"
    );
    $(".usertype").val(user.usertype);
    $("#emp_id").val(user.emp_id);
    $("#dept_id").val(user.dept_id);
    $(".username").val(user.username);
    $(".password").val(user.password);
    $(".password").hide();
    $(".useraccount_btn").text("Save Changes");
    $(".action").val("updateUserAccount");
  });
});

//Disable User Account Access Script
$(".disable").click(async function(e) {
  e.preventDefault();
  const { value } = await Swal.fire(
    "Confirm",
    "Are you sure you wanted to disable this account?",
    "question"
  );
  if (!value) return;

  const action = "disableUserAccount";
  const useraccount_id = $(this).attr("id");

  $.ajax({
    url: `${baseUrl}config/processors/settingsArguments.php`,
    type: "post",
    data: {
      action: action,
      useraccount_id: useraccount_id
    }
  }).done(async function(res) {
    if (!res) {
      Swal.fire("Failure", "Error", "error");
      return;
    }

    const { value } = await Swal.fire(
      "Success",
      "User Account Disabled",
      "success"
    );
    if (value) {
      location.reload();
    }
  });
});

//Enable User Account Access Script
$(".enable").click(async function(e) {
  e.preventDefault();
  const { value } = await Swal.fire("Confirm", "Are you sure?", "question");
  if (!value) return;

  const action = "enableUserAccount";
  const useraccount_id = $(this).attr("id");

  $.ajax({
    url: `${baseUrl}config/processors/settingsArguments.php`,
    type: "post",
    data: {
      action: action,
      useraccount_id: useraccount_id
    }
  }).done(async function(res) {
    if (!res) {
      Swal.fire("Failure", "Error", "error");
      return;
    }

    const { value } = await Swal.fire(
      "Success",
      "User Account Enabled",
      "success"
    );
    if (value) {
      location.reload();
    }
  });
});
