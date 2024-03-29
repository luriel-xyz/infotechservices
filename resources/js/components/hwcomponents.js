$("#hardwareComponent-form").validate({
  ...validatorOptions,

  rules: {
    hwcomponent_name: "required",
    hwcomponent_type: "required",
    hwcomponent_category: {
      depends: element => $("#hwcomponent_type").val() == "sub"
    }
  },

  messages: {
    hwcomponent_name: "Hardware component name is required.",
    hwcomponent_type: "Hardware component type is required.",
    hwcomponent_category: "Please indicate component category."
  },

  submitHandler: form => {
    $.post(requestsPath, $(form).serialize()).done(async res => {
      if (res) {
        await Swal.fire("Success", "Hardware Component Data Saved!", "success");
        location.reload(true);
      } else {
        Swal.fire("Failure", "Error", "error");
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

$("#add-hardware").click(function(e) {
  $(".modal-title").text("HARDWARE COMPONENT ADDING FORM");
  $("#hwcomponent_id").html("");
  $("#hwcomponent_name").val("");
  $("#hwcomponent_type").val("");
  $("#hwcomponent_category").val("");
  // $(".sub_type").hide();

  $("#hwcomponent_btn").text("Add Hardware Component");
  $("#action").val("addHardwareComponent");

  $("#modal").modal({
    backdrop: "static",
    keyboard: false
  });
});

$("#hwcomponent_type").change(function(e) {
  const hwcomponent_type = $("#hwcomponent_type").val();
  if (hwcomponent_type !== "sub") {
    $("#hwcomponent_category").val(null);
    $(".sub_type").hide();
  } else {
    $(".sub_type").show();
  }
});

//Add Hardware Component Script
// $("#hardwareComponent-form").submit(function(e) {
//   e.preventDefault();

//   $.post(requestsPath, $(this).serialize()).done(async function(res) {
//     if (res) {
//       await Swal.fire("Success", "Hardware Component Data Saved!", "success");
//       location.reload(true);
//     } else {
//       Swal.fire("Failure", "Error", "error");
//     }
//   });
// });

//Edit Hardware Component Script
$(".edit-hardware").click(function(e) {
  e.preventDefault();

  const action = "editHardwareComponent";
  const hwcomponent_id = $(this).attr("id");

  $.post(requestsPath, {
    action: action,
    hwcomponent_id: hwcomponent_id
  }).done(component => {
    component = JSON.parse(component);

    $(".modal-title").text("HARDWARE COMPONENT UPDATING FORM");
    $("#hwcomponent_id").append(
      '<input type="hidden" name="hwcomponent_id" id="hwcomponent_id" value=' +
        component.hwcomponent_id +
        ">"
    );
    $("#hwcomponent_name").val(component.hwcomponent_name);
    $("#hwcomponent_type").val(component.hwcomponent_type);
    $("#hwcomponent_category").val(component.hwcomponent_category);

    if (component.hwcomponent_type == "sub") {
      $(".sub_type").show();
    } else {
      $(".sub_type").hide();
    }

    $("#hwcomponent_btn").text("Save Changes");
    $("#action").val("updateHardwareComponent");
  });

  $("#modal").modal({
    backdrop: "static",
    keyboard: false
  });
});
