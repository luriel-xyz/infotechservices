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

  // Set request status to pre-post-repair inspected
  $.post(`${baseUrl}config/processors/requestArguments.php`, {
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
});

async function saveInspectionReport(reportData) { 
  try {
    const { data } = await axios.post(
      `${baseUrl}config/processors`,
      reportData
    );
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
