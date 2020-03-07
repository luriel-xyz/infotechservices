const getPartsToReplaceProcure = async () => {
  const partsToReplaceProcure = [];
  $(".row-part").each(function(i, val) {
    // Row column datum
    const qty = $(`.row-part-${i} .qty`).val();
    const particularsDescriptions = $(
      `.row-part-${i} .particulars_descriptions`
    ).val();
    const unit = $(`.row-part-${i} .unit`).val();
    const amount = $(`.row-part-${i} .amount`).val();

    // Check if some of the fields have values
    if (!qty || !particularsDescriptions || !unit || !amount) return;
    partsToReplaceProcure.push({
      qty,
      particularsDescriptions,
      unit,
      amount
    });
  });
  return partsToReplaceProcure;
};

const getFormData = async () => ({
  action: "addInspectionReport",
  to: $("#to").val() || "n/a",
  control_number: $("#control-number").val() || "n/a",
  date: $("#date").val() || "n/a",
  type: $("#type").val() || "n/a",
  model: $("#model").val() || "n/a",
  property_number: $("#property-number").val() || "n/a",
  serial_number: $("#serial-number").val() || "n/a",
  acquisition_date: $("#acquisition-date").val() || "n/a",
  acquisition_cost: $("#acquisition-cost").val() || "n/a",
  issued_to: $("#issued-to").val() || "n/a",
  requested_by: $("#requested-by").val() || "n/a",
  pre_repair_findings: $("#pre-repair-findings").val() || "n/a",
  job_order: $("#job-order").val() || "n/a",
  parts: await getPartsToReplaceProcure(),
  additional_sheet: $("#additional-sheet").val() || "n/a",
  pre_inspected_by: $("#pre-inspected-by").val() || "n/a",
  pre_recommending_approval: $("#pre-recommending-approval").val() || "n/a",
  pre_approved: $("#pre-approved").val() || "n/a",
  pre_inspected_date: $("#pre-inspected-date").val() || "n/a",
  post_repair_findings: $("#post-repair-findings").val() || "n/a",
  stock_supplies: $("#stock-supplies").is(":checked"),
  with: $("#with-waste-material").is(":checked"),
  additional_sheet_attached: $("#additional-sheet-attached").is(":checked"),
  ics_number: $("#ics-number").val() || "n/a",
  inventory_item_number: $("#inventory-item-number").val() || "n/a",
  stock_serial_number: $("#stock-serial-number").val() || "n/a",
  post_inspected_by: $("#post-inspected-by").val() || "n/a",
  post_recommending_approval: $("#post-recommending-approval").val() || "n/a",
  post_approved: $("#post-approved").val() || "n/a",
  post_inspected_date: $("#post-inspected-date").val() || "n/a"
});

async function saveInspectionReport(reportData) {
  try {
    const { data } = await axios.post(requestArgumentsPath, reportData);
    console.log("data here: ", data);
    const { value } = await Swal.fire({
      icon: "question",
      title: "Confirm",
      text: "Do you want to print the inspection report now?",
      showCancelButton: true
    });
    const url = value
      ? `${baseUrl}app/admin/download/pre-post-repair-form.php`
      : `${baseUrl}app/admin/incoming-repairs.php`;
    window.location.replace(url);
  } catch (e) {
    Swal.fire("Failure", "An error occured, try again.", "error");
  }
  // $.redirect(`${baseUrl}app/admin/download/pre-post-repair-form.php`, {
  //   data: JSON.stringify()
  // });
}

// Validate Pre and Post Repair Form
$("#pre-post-repair-form").validate({
  ...validatorOptions,

  rules: {
    to: "required",
    control_number: "required",
    date: "required",
    type: "required",
    model: "required",
    property_number: "required",
    serial_number: "required",
    acquisition_date: "required",
    acquisition_cost: "required",
    issued_to: "required",
    requested_by: "required",
    pre_repair_findings: "required",
    job_order: "required",
    additional_sheet: "required",
    pre_inspected_by: "required",
    pre_recommending_approval: "required",
    pre_approved: "required",
    pre_inspected_date: "required",
    post_repair_findings: "required",
    ics_number: {
      depends: () => $("#stock-supplies").is(":checked")
    },
    inventory_item_number: {
      depends: () => $("#stock-supplies").is(":checked")
    },
    stock_serial_number: {
      depends: () => $("#stock-supplies").is(":checked")
    },
    post_inspected_by: "required",
    post_recommending_approval: "required",
    post_approved: "required",
    post_inspected_date: "required"
  },

  messages: {
    to: "To is required",
    control_number: "Control number is required",
    date: "Date is required",
    type: "Type is required",
    model: "Model is required",
    property_number: "Property number is required",
    serial_number: "Serial number is required",
    acquisition_date: "Acquisition date is required",
    acquisition_cost: "Acquisition cost is required",
    issued_to: "Issued to is required",
    requested_by: "Requested by is required",
    pre_repair_findings: "Pre repair findings or recommendations is required",
    job_order: "Job order is required",
    pre_inspected_by: "Pre inspected by is required",
    pre_recommending_approval: "Pre recommending approval is required",
    pre_approved: "Pre approved is required",
    pre_inspected_date: "Inspection date is required",
    post_repair_findings: "Post repair findings is required",
    stock_supplies: "Stock supplies is required",
    ics_number: "ICS number is required",
    inventory_item_number: "Inventory item number is required",
    stock_serial_number: "Stock serial number is required",
    post_inspected_by: "Inspected by is required",
    post_recommending_approval: "Recommending approval is required",
    post_approved: "Approved is required",
    post_inspected_date: "Inspection date is required"
  },

  submitHandler: form => {
    // Set request status to pre-post-repair inspected
    $.post(requestArgumentsPath, {
      action: $("#action").val(),
      itsrequest_id: $("#itsrequest_id").val(),
      useraccount_id: $("#statusupdate_useraccount_id").val()
    })
      .fail(function() {
        Swal.fire("Failure", "An error occured", "error");
      })
      .done(async res => {
        if (res) {
          await Swal.fire("Success", "Request Inspected", "success");
          const data = await getFormData();
          saveInspectionReport(data);
        } else {
          Swal.fire("Failure", "An error occured", "error");
        }
      });

    // $.post('../config/processors/requestArguments.php', $(this).serialize())
    //   .fail(function() {
    //     alert('Error')
    //   })
    //   .done(function(res) {
    //     alert(res)
    //   });
  }
});

$("#stock-supplies").change(function() {
  const stockContainer = $(".stock-container");
  if (this.checked) {
    stockContainer.removeClass("d-none");
    stockContainer.show("fast");
  } else {
    $("#ics-number").val("");
    $("#inventory-item-number").val("");
    $("#stock-serial-number").val("");
    stockContainer.hide("fast");
  }
});

$("#pre-post-repair-form").submit(function(e) {
  e.preventDefault();
});


