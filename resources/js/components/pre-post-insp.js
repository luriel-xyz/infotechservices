const getPartsToReplaceProcure = async () => {
  const partsToReplaceProcure = [];
  $(".row-part").each(function(i, val) {
    // Row column datum
    const qty = $(`.row-part-${i} .qty`).val();
    const description = $(`.row-part-${i} .particulars_descriptions`).val();
    const unit = $(`.row-part-${i} .unit`).val();
    const amount = $(`.row-part-${i} .amount`).val();

    // Check if some of the fields have values
    if (!qty || !description || !unit || !amount) return;
    partsToReplaceProcure.push({
      qty,
      description,
      unit,
      amount
    });
  });
  return partsToReplaceProcure;
};

function motorVehicleExists() {
  const type = $("#vehicle-type").val();
  const plate_no = $("#plate-no").val();
  const property_no = $("#vehicle-property-no").val();
  const engine_no = $("#engine-no").val();
  const chassis_no = $("#chassis-no").val();
  const acquisition_date = $("#vehicle-acquisition-date").val();
  const acquisition_cost = $("#vehicle-acquisition-cost").val();
  const repair_history = $("#repair-history").val();
  const repair_date = $("#repair-date").val();
  const nature_of_last_repair = $("#nature-of-last-repair").val();
  const defects_complaints = $("#defects-complaints").val();

  return (
    type ||
    plate_no ||
    property_no ||
    engine_no ||
    chassis_no ||
    acquisition_date ||
    acquisition_cost ||
    repair_history ||
    repair_date ||
    nature_of_last_repair ||
    defects_complaints
  );
}

// const getFormData = async () => ({
//   action: "addInspectionReport",
//   to: $("#to").val() || "n/a",
//   control_number: $("#control-number").val() || "n/a",
//   date: $("#date").val() || "n/a",
//   type: $("#type").val() || "n/a",
//   model: $("#model").val() || "n/a",
//   property_number: $("#property-number").val() || "n/a",
//   serial_number: $("#serial-number").val() || "n/a",
//   acquisition_date: $("#acquisition-date").val() || "n/a",
//   acquisition_cost: $("#acquisition-cost").val() || "n/a",
//   issued_to: $("#issued-to").val() || "n/a",
//   requested_by: $("#requested-by").val() || "n/a",
//   pre_repair_findings: $("#pre-repair-findings").val() || "n/a",
//   job_order: $("#job-order").val() || "n/a",
//   parts: await getPartsToReplaceProcure(),
//   additional_sheet: $("#additional-sheet").val() || "n/a",
//   pre_inspected_by: $("#pre-inspected-by").val() || "n/a",
//   pre_recommending_approval: $("#pre-recommending-approval").val() || "n/a",
//   pre_approved: $("#pre-approved").val() || "n/a",
//   pre_inspected_date: $("#pre-inspected-date").val() || "n/a",
//   post_repair_findings: $("#post-repair-findings").val() || "n/a",
//   stock_supplies: $("#stock-supplies").is(":checked") ? 1 : 0,
//   with: $("#with-waste-material").is(":checked") ? 1 : 0,
//   additional_sheet_attached: $("#additional-sheet-attached").is(":checked") ? 1 : 0,
//   ics_number: $("#ics-number").val() || "n/a",
//   inventory_item_number: $("#inventory-item-number").val() || "n/a",
//   stock_serial_number: $("#stock-serial-number").val() || "n/a",
//   post_inspected_by: $("#post-inspected-by").val() || "n/a",
//   post_recommending_approval: $("#post-recommending-approval").val() || "n/a",
//   post_approved: $("#post-approved").val() || "n/a",
//   post_inspected_date: $("#post-inspected-date").val() || "n/a"
// });

// Validate Pre and Post Repair Form
const inspectionReportRules = {
  to: { required: false },
  control_number: "required",
  date: "required"
};
const motorVehicleRules = {
  vehicle_type: { required: false },
  plate_no: { required: false },
  vehicle_property_no: { required: false },
  engine_no: { required: false },
  chassis_no: { required: false },
  vehicle_acquisition_date: { required: false },
  vehicle_acquisition_cost: { required: false },
  repair_history: { required: false },
  repair_date: { required: false },
  nature_of_last_repair: { required: false },
  defects_complaints: { required: false }
};
const otherPPAERules = {
  other_type: "required",
  model: "required",
  other_property_number: "required",
  serial_number: "required",
  other_acquisition_date: "required",
  other_acquisition_cost: "required",
  issued_to: "required",
  requested_by: "required"
};
const otherRules = {
  pre_repair_findings: "required",
  job_order: "required",
  additional_sheet: "required",
  pre_inspected_by: "required",
  pre_recommending_approval: "required",
  pre_approved: "required",
  pre_inspected_date: "required",
  post_repair_findings: "required",
  ics_number: {
    required: { depends: () => ($("#stock-supplies").is(":checked") ? 1 : 0) }
  },
  inventory_item_number: {
    required: { depends: () => ($("#stock-supplies").is(":checked") ? 1 : 0) }
  },
  stock_serial_number: {
    required: { depends: () => ($("#stock-supplies").is(":checked") ? 1 : 0) }
  },
  post_inspected_by: "required",
  post_recommending_approval: "required",
  post_approved: "required",
  post_inspected_date: "required"
};
// Validate the pre and post repair form
$("#pre-post-repair-form").validate({
  ...validatorOptions,

  rules: {
    ...inspectionReportRules,
    ...motorVehicleRules,
    ...otherPPAERules,
    ...otherRules
  },

  submitHandler: async form => {
    // Insert inspection report data
    const inspectionReportId = JSON.parse(
      await $.post(requestsPath, {
        action: "addInspectionReport",
        assessment_report_id: $("#assessment-report-id").val(),
        to_whom: $("#to").val(),
        control_no: $("#control-number").val(),
        date: $("#date").val()
      }).promise()
    );
    // Insert motor vehicle data
    if (motorVehicleExists()) {
      const motorVehicleId = JSON.parse(
        await $.post(requestsPath, {
          action: "addMotorVehicle",
          inspection_report_id: inspectionReportId,
          type: $("#vehicle-type").val(),
          plate_no: $("#plate-no").val(),
          property_no: $("#vehicle-property-no").val(),
          engine_no: $("#engine-no").val(),
          chassis_no: $("#chassis-no").val(),
          acquisition_date: $("#vehicle-acquisition-date").val(),
          acquisition_cost: $("#vehicle-acquisition-cost").val(),
          repair_history: $("#repair-history").val(),
          repair_date: $("#repair-date").val(),
          nature_of_last_repair: $("#nature-of-last-repair").val(),
          defects_complaints: $("#defects-complaints").val()
        }).promise()
      );
    }
    // Insert other property plant and equipment data
    const otherId = JSON.parse(
      await $.post(requestsPath, {
        action: "addOtherPropPlantEquip",
        inspection_report_id: inspectionReportId,
        other_type: $("#other-type").val(),
        model: $("#model").val(),
        other_property_number: $("#other-property-number").val(),
        serial_number: $("#serial-number").val(),
        other_acquisition_date: $("#other-acquisition-date").val(),
        other_acquisition_cost: $("#other-acquisition-cost").val(),
        issued_to: $("#issued-to").val(),
        requested_by: $("#requested-by").val()
      }).promise()
    );
    // Insert pre inspection report data
    const preInspectionReportId = JSON.parse(
      await $.post(requestsPath, {
        action: "addPreInspectionReport",
        inspection_report_id: inspectionReportId,
        repair_inspection: $("#pre-repair-findings").val(),
        job_order: $("#job-order").val(),
        additional_sheet: $("#additional-sheet-attached").is(":checked")
          ? 1
          : 0,
        inspected_by: $("#pre-inspected-by").val(),
        recommending_approval: $("#pre-recommending-approval").val(),
        approved: $("#pre-approved").val(),
        date_inspected: $("#pre-inspected-date").val()
      }).promise()
    );
    // Insert parts to be replaced or procured
    const parts = await getPartsToReplaceProcure();
    for (const part of parts) {
      await $.post(requestsPath, {
        action: "addPreInspectionHardware",
        pre_inspection_id: preInspectionReportId,
        qty: part.qty,
        unit: part.unit,
        description: part.description,
        amount: part.amount
      }).promise();
    }
    // Insert post inspection report data
    const postInspectionReportId = JSON.parse(
      await $.post(requestsPath, {
        action: "addPostInspectionReport",
        inspection_report_id: inspectionReportId,
        inspected_by: $("#post-inspected-by").val(),
        recommending_approval: $("#post-recommending-approval").val(),
        approved: $("#post-approved").val(),
        repair_inspection: $("#post-repair-findings").val(),
        stock: $("#stock-supplies").is(":checked") ? 1 : 0,
        with_wm_prs: $("#with-waste-material").is(":checked") ? 1 : 0,
        ics_no: $("#ics-number").val(),
        inventory_item_no: $("#inventory-item-number").val(),
        serial_no: $("#stock-serial-number").val(),
        date_inspected: $("#post-inspected-date").val()
      }).promise()
    );

    // Set request status to pre-post-repair inspected
    const res = await $.post(requestsPath, {
      action: $("#action").val(),
      itsrequest_id: $("#itsrequest_id").val(),
      useraccount_id: $("#statusupdate_useraccount_id").val()
    });

    if (res) {
      await Swal.fire("Success", "Request Inspected", "success");
      $.redirect(`${baseUrl}app/admin/download/pre-post-repair-form.php`, {
        assessment_report_id: $("#assessment-report-id").val()
      });
    } else {
      Swal.fire("Failure", "An error occured", "error");
    }
    // $.post('../config/processors/requestsPath.php', $(this).serialize())
    //   .fail(function() {
    //     alert('Error')
    //   })
    //   .done(function(res) {
    //     alert(res)
    //   });
  }
});

// Show stock text fields when stock-supplies checkbox is checked
$("#stock-supplies").change(function() {
  const stockContainer = $(".stock-container");
  if (this.checked) {
    stockContainer.removeClass("d-none");
    stockContainer.show();
  } else {
    $("#ics-number").val("");
    $("#inventory-item-number").val("");
    $("#stock-serial-number").val("");
    stockContainer.hide();
  }
});

$("#pre-post-repair-form").submit(function(e) {
  e.preventDefault();
});
