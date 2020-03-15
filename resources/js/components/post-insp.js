// Validate the pre and post repair form
$("#post-repair-form").validate({
  ...validatorOptions,

  rules: {
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
  },

  /**
   * Proccess:
   * 1. Save post inspection report.
   * 2. Set request status to pre-post-repair inspected
   * 3. Redirect to Inspection Report Print Page
   */
  submitHandler: async form => {
    Swal.showLoading();

    try {
      // Insert post inspection report data
      const postInspectionReportId = JSON.parse(
        await $.post(requestsPath, {
          action: "addPostInspectionReport",
          inspection_report_id: $("#inspection-report-id").val(),
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
        action: "statusPostInspected",
        itsrequest_id: $("#itsrequest_id").val(),
        useraccount_id: $("#statusupdate_useraccount_id").val()
      }).promise();

      if (res) {
        await Swal.fire(
          "Success",
          "Post Inspection Report Form Created!",
          "success"
        );
        // Redirect to Inspection Report Print Page
        $.redirect(`${baseUrl}app/admin/download/post-repair-form.php`, {
          assessment_report_id: $("#assessment-report-id").val()
        });
      } else {
        Swal.fire("Failure", "An error occured", "error");
      }
    } catch (e) {
      Swal.close();
      Swal.fire("Failure", "An error occured, try again.", "error");
    }
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

$("#post-repair-form").submit(function(e) {
  e.preventDefault();
});
