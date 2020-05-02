let depUsernameExists;
let perUsernameExists;
let departmentExists;
// Add validation rule for department duplicates
// One department should only have one account.
$.validator.addMethod(
  "checkDepartment",
  () => {
    $.post(requestsPath, {
      action: "departmentAccountExists",
      dept_id: $("#dept_id").val(),
    })
      .promise()
      .then((res) => (departmentExists = JSON.parse(res)));

    return !departmentExists;
  },
  "This department already has an account."
);

// Validation rule for deparment username
$.validator.addMethod(
  "uniqueDepUsername",
  () => {
    $.post(requestsPath, {
      action: "userNameExists",
      username: $(".department-username").val(),
    }).done((res) => (depUsernameExists = JSON.parse(res)));

    return !depUsernameExists;
  },
  "This username is already taken."
);

// Validation rule for personnel username
$.validator.addMethod(
  "uniquePerUsername",
  () => {
    $.post(requestsPath, {
      action: "userNameExists",
      username: $(".personnel-username").val(),
    }).done((res) => (perUsernameExists = JSON.parse(res)));

    return !perUsernameExists;
  },
  "This username is already taken."
);

// Validation for Personnel User Account Form
$("#personnelUserAccount-form").validate({
  ...validatorOptions,

  rules: {
    usertype: "required",
    emp_id: "required",
    username: {
      required: true,
      uniquePerUsername: true,
    },
    password: "required",
  },

  messages: {
    usertype: "Please indicate the type of the user.",
    emp_id: "Please select an employee name.",
    username: {
      required: "The username is required.",
      uniquePerUsername: "This username is already taken.",
    },
    password: "The password is required.",
  },

  submitHandler: async (form) => {
    const data = await $.post(requestsPath, $(form).serialize());
    if (data) {
      await Swal.fire("Success", "Personnel Account Data Saved", "success");
      location.reload(true);
    } else {
      Swal.fire("Failure", "An error occured", "error");
    }
  },
});

// Validation for Department User Account Form
$("#departmentUserAccount-form").validate({
  ...validatorOptions,

  rules: {
    usertype: "required",
    dept_id: {
      required: true,
      checkDepartment: true,
    },
    username: {
      required: true,
      uniqueDepUsername: true,
    },
    password: "required",
  },

  messages: {
    usertype: "Please indicate the type of the user.",
    dept_id: {
      required: "Please select a deparment name.",
      checkDepartment: "This department already has an account.",
    },
    username: {
      required: "The username is required.",
      uniqueDepUsername: "This username is already taken.",
    },
    password: "The password is required.",
  },

  submitHandler: async (form) => {
    const data = await $.post(requestsPath, $(form).serialize());
    if (data) {
      await Swal.fire("Success", "Department Account Data Saved", "success");
      location.reload(true);
    } else {
      Swal.fire("Failure", "An error occured", "error");
    }
  },
});

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

$("#addPersonnelAccount").click(() => {
  resetForm("personnel");
  $("#modalPersonnelAccount").modal("toggle");
});

$("#addDeptAccount").click(() => {
  resetForm("department");
  $("#modalDepartmentAccount").modal("toggle");
});

function resetForm(accountType) {
  $(".useraccount_id").html("");
  $(".useraccount_btn").text("Add User Account");
  $(".password").val("");

  switch (accountType) {
    case "department":
      $(".modal-title").text("DEPARTMENT ACCOUNT ADDING FORM");
      $("#dept_id").val("");
      $(".action").val("addDepartmentUserAccount");
      $(".usertype").val("department");
      $(".department-username").val("");
      break;
    case "personnel":
      $(".modal-title").text("PERSONNEL ACCOUNT ADDING FORM");
      $("#emp_id").val("");
      $(".action").val("addPersonnelUserAccount");
      $(".usertype").val("");
      $(".personnel-username").val("");
      break;
  }
}

//Add Personnel User Account Script
$("#personnelUserAccount-form").submit(function(e) {
  e.preventDefault();
});

//Add Department User Account Script
$("#departmentUserAccount-form").submit(function(e) {
  e.preventDefault();
});

//Edit User Accounts Script
$(".edit-user").click(async function(e) {
  e.preventDefault();

  const action = "editUserAccount";
  const useraccount_id = $(this).attr("id");

  const user = JSON.parse(
    await $.post(requestsPath, {
      action: action,
      useraccount_id: useraccount_id,
    }).promise()
  );

  if (user.usertype === "personnel" || user.usertype === "admin") {
    $("#modalPersonnelAccount").modal("show");
    $(".modal-title").text("PERSONNEL ACCOUNT UPDATING FORM");
    $(".personnel-username").val(user.username);
  } else {
    $("#modalDepartmentAccount").modal("show");
    $(".modal-title").text("DEPARTMENT ACCOUNT UPDATING FORM");
    $(".department-username").val(user.username);
  }
  $(".useraccount_id").empty();
  $(".useraccount_id").append(
    '<input type="hidden" name="useraccount_id" id="useraccount_id" class="useraccount_id" value=' +
      user.useraccount_id +
      ">"
  );
  $(".usertype").val(user.usertype);
  $("#emp_id").val(user.emp_id);
  $("#dept_id").val(user.dept_id);
  $(".password").val(user.password);
  $(".password-field").hide();
  $(".useraccount_btn").text("Save Changes");
  $(".action").val("updateUserAccount");
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
    url: requestsPath,
    type: "post",
    data: {
      action: action,
      useraccount_id: useraccount_id,
    },
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
    url: requestsPath,
    type: "post",
    data: {
      action: action,
      useraccount_id: useraccount_id,
    },
  }).done(async function(res) {
    if (!res) {
      Swal.fire("Failure", "Error", "error");
      return;
    }

    await Swal.fire("Success", "User Account Enabled", "success");
    location.reload();
  });
});
