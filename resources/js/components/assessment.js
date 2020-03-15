// Validate assessment form
$("#repassessmentreport-form").validate({
  ...validatorOptions,

  rules: {
    hwcomponent_id: "required",
    hwcomponent_description: "required",
    hwcomponent_dateAcquired: "required",
    hwcomponent_acquisitioncost: "required",
    dept_id: "required",
    property_num: "required",
    emp_id: "required",
    serial_number: "required",
    findings_category: "required",
    findings_description: "required",
    notes: "required"
  },

  messages: {
    hwcomponent_id: "Name of item is required",
    hwcomponent_description: "Model/Description is required",
    hwcomponent_dateAcquired: "Date is required",
    hwcomponent_acquisitioncost: "Acquisition cost is required",
    dept_id: "Please select a department.",
    property_num: "Property number is required",
    emp_id: "Please select an employee",
    serial_number: "Serial number is required",
    findings_category: "Findings category is required",
    findings_description: "Findings description is required",
    notes: "Notes is required"
  },

  submitHandler: form => {
    Swal.showLoading();

    const action = $("#action").val();
    const itsrequest_id = $("#itsrequest_id").val();
    const hwSubComponentsAssessments = [];
    // Loop through all checked checkboxes except 'others checkbox'
    $(".cb_hwcomponent:checked").each(function(i, val) {
      const subComponentId = $(this).data("sub_component_id");
      const subComponentLabelId = $(this)
        .parent()
        .parent()
        .attr("id"); // We need this so that we can access the remark field
      const subComponentRecommendation = $(
        `#${subComponentLabelId} > .remark-container > #sub-component-remark-${subComponentId}`
      ).val();
      hwSubComponentsAssessments.push({
        sub_component_id: subComponentId,
        remark: subComponentRecommendation
      });
    });
    // Determine if "others checkbox" is checked
    // const othersCheckboxIsChecked = $('#checkbox-others').prop('checked');
    // if (othersCheckboxIsChecked) {
    // 	const othersComponentRecommendation = $('.others-recommendation').val();
    // 	};
    // }
    const assessmenttechrep_useraccount_id = $(
      "#assessmenttechrep_useraccount_id"
    ).val();
    const assessment_date = $("#assessment_date").val();
    const hwcomponent_id = $("#hwcomponent_id").val();
    const hwcomponent_description = $("#hwcomponent_description").val();
    const hwcomponent_dateAcquired = $("#hwcomponent_dateAcquired").val();
    const hwcomponent_acquisitioncost = $("#hwcomponent_acquisitioncost").val();
    const dept_id = $("#dept_id").val();
    const emp_id = $("#emp_id").val();
    const findings_category = $("#findings_category").val();
    const findings_description = $("#findings_description").val();
    const notes = $("#notes").val();
    const serial_number = $("#serial_number").val();
    const property_num = $("#property_num").val();
    const assessmentReportData = {
      action: action,
      assessmenttechrep_useraccount_id: assessmenttechrep_useraccount_id,
      assessment_date: assessment_date,
      hwcomponent_id: hwcomponent_id,
      hwcomponent_description: hwcomponent_description,
      hwcomponent_dateAcquired: hwcomponent_dateAcquired,
      hwcomponent_acquisitioncost: hwcomponent_acquisitioncost,
      dept_id: dept_id,
      emp_id: emp_id,
      findings_category: findings_category,
      findings_description: findings_description,
      notes: notes,
      itsrequest_id: itsrequest_id,
      serial_number: serial_number,
      property_num: property_num
    };
    // Insert assessment report data to db
    $.post(requestsPath, assessmentReportData).done(res => {
      const subComponentAssessmentData = {
        action: "addAssessmentSubComponents",
        assessmentReportId: res,
        subcomponents: hwSubComponentsAssessments
      };
      // Insert sub-component hardwares assessment data
      insertSubComponentAssessments(res, subComponentAssessmentData);
    });
  }
});

const dept_id = $("#dept_id").val();
if (dept_id) {
  $.post(requestsPath, {
    action: "getEmployeesByDepartment",
    dept_id: dept_id
  }).done(employees => {
    employees = JSON.parse(employees);
    $("#emp_id").empty();
    $("#emp_id").append(
      "<option selected disabled>-- Select Employee --</option>"
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
}

// var itsrequest_id = <?php echo $itsrequest_id; ?>;
let itsrequest_id = $("#itsrequest_id").val();

$.ajax({
  url: requestsPath,
  type: "post",
  data: {
    action: "getRepair",
    itsrequest_id: itsrequest_id
  },
  dataType: "JSON"
}).done(function(repair) {
  // $.each(requests, function(index, request) {
  $("#property_num").val(repair.property_num);
  $("#emp_id").val(repair.emp_id);
  // });
});

// Send POST request for retrieving the sub-components of the main component
const action = "getHardwareComponentsBySubCategory";
const hwcomponent_id = $("#hwcomponent_id").val();

if (hwcomponent_id) {
  $.post(requestsPath, {
    action: action,
    hwcomponent_id: hwcomponent_id
  }).done(function(components) {
    components = JSON.parse(components); // parse JSON string

    $("#checkbox_container").empty(); // clear checkbox container
    // Loop through subcomponents
    components.forEach(function(component) {
      // Create subcomponent field
      const subcomponent = `
        <label for="checkbox-${component.hwcomponent_id}" id="hw_component" class="hw_component form-check-label label-${component.hwcomponent_id} checkbox-inline d-block mb-0 d-flex justify-content-between align-items-center">
          <div class="checkbox-container">
            <input type="checkbox" class="cb_hwcomponent mr-1" name="cb_hwcomponent[]" id="checkbox-${component.hwcomponent_id}" data-sub_component_id="${component.hwcomponent_id}"> ${component.hwcomponent_name}
          </div>
          <div class="remark-container w-75" style="display: none">
            <input id="sub-component-remark-${component.hwcomponent_id}" type="text" class="w-100 mt-2 form-control" placeholder="Remark">
          </div>
        </label>
          `;

      // const subcomponent = "<p>subcomponent</p>";

      // Append subcomponent field to checkbox container
      $("#checkbox_container").append(subcomponent);

      // Listen to checkbox click event
      $(`#checkbox-${component.hwcomponent_id}`).click(() => {
        // Toggle remark container
        $(`.label-${component.hwcomponent_id} > .remark-container`).toggle(
          "slow"
        );
      });
    });

    // const others =
    // 	`<label for="checkbox-others" id="hw_component" class="hw_component label-others d-block mb-0 d-flex justify-content-between align-items-center">
    // 			<div class="checkbox-container">
    // 				<input type="checkbox" class="cb_hwcomponent mr-1" name="cb_hwcomponent[]" id="checkbox-others"> Others
    // 			</div>
    // 			<div class="remark-container w-75" style="display: none">
    // 				<input type="text" class="w-100 mt-2 others-recommendation" placeholder="Recommendation">
    // 			</div>
    // 		</label>`;

    // $('#checkbox_container').append(others);

    // // Listen to checkbox click event
    // $(`#checkbox-others`).click(() => {
    // 	// Toggle remark container
    // 	$(`.label-others > .remark-container`).toggle('slow');
    // });
  });
}

$("#dept_id").change(function(e) {
  e.preventDefault();

  var action = "getEmployeesByDepartment";
  var dept_id = $(this).val();
  $.ajax({
    url: requestsPath,
    type: "POST",
    data: {
      action: action,
      dept_id: dept_id
    }
  }).done(function(employees) {
    employees = JSON.parse(employees);
    $("#emp_id").empty();
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

$("#repassessmentreport-form").submit(function(e) {
  e.preventDefault();
});

function insertSubComponentAssessments(
  assessmentReportId,
  subComponentAssessmentData
) {
  const url = requestsPath;
  $.post(url, subComponentAssessmentData).done(async res => {
    if (res) {
      await Swal.fire("Success", "Assessment Report Created!", "success");
      // Redirect to Assessment Report Print Page
      const url = `${baseUrl}app/admin/download/print-repassessmentreport-form.php`;
      $.redirect(url, {
        assessment_report_id: assessmentReportId
      });
    } else {
      Swal.fire("Error", "An error occured", "error");
    }
  });
}
