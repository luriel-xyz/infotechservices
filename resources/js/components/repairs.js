function setAssessmentDone(itsrequest_id, useraccount_id) {
  const action = "statusAssessed";

  $.post(requestsPath, {
    action: action,
    itsrequest_id: itsrequest_id,
    useraccount_id: useraccount_id
  }).done(async function(res) {
    if (res) {
      await Swal.fire("Success", "Assessed", "success");
      location.reload(true);
    } else {
      Swal.fire("Error", "An error occured", "error");
    }
  });

  // $.ajax({
  //   url: requestsPath,
  //   type: "POST",
  //   data: {
  //     action: action,
  //     itsrequest_id: itsrequest_id,
  //     useraccount_id: useraccount_id*
  //   },
  // }).done(function(val) {
  //   alert(val);
  //   location.reload(true);
  // });
}

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

$('input[name="sort"]').change(function(e) {
  if ($('input[name="sort"]:checked').val() === "department") {
    $("#dept_selection").show();
    $("#date_selection").hide();
  } else if ($('input[name="sort"]:checked').val() === "day") {
    $("#dept_selection").hide();
    $("#date_selection").show();
  } else {
    $("#date_selection").hide();
    $("#dept_selection").hide();
  }
});

$("#printSummary").click(function(e) {
  e.preventDefault();
  $("#modalPrint").modal("toggle");
});

$("#printSorting-repairs-form").submit(function(e) {
  e.preventDefault();

  const action = "RepairSummaryReport";
  const sort = $('input[name="sort"]:checked').val();
  const dept_id = $("#dept_id").val();
  const day = $("#day").val();
  let url = "";

  if (sort === "all") {
    url = `${baseUrl}app/admin/download/excel-all.php`;
  } else if (sort === "department") {
    url = `${baseUrl}app/admin/download/excel-dept.php`;
  } else if (sort === "day") {
    url = `${baseUrl}app/admin/download/excel-date.php`;
  }

  $.redirect(url, {
    action: action,
    dept_id: dept_id,
    day: day
  });
  $("#modalPrint").modal("toggle");
});

//View Request Details Script
$(".view-repair").click(function(e) {
  e.preventDefault();
  const action = "getRequest";
  const itsrequest_id = $(this).attr("id");

  $.post({
    url: requestsPath,
    type: "post",
    data: {
      action: action,
      itsrequest_id: itsrequest_id
    },
    dataType: "JSON"
  }).done(function(request) {
    $("#modalView").modal("toggle");
    $("#data").empty();
    if (request.status === "received") {
      $("#data").append(
        '<label class="font-weight-bold text-info">' +
          request.status +
          "</label><br>"
      );
    } else if (
      request.status === "pending" ||
      request.status === "assessment pending"
    ) {
      $("#data").append(
        '<label class="font-weight-bold text-warning">' +
          request.status +
          "</label><br>"
      );
    } else if (
      request.status === "deployed" ||
      request.status === "assessed" ||
      request.status === "done"
    ) {
      $("#data").append(
        '<label class="font-weight-bold text-success">' +
          request.status +
          "</label><br>"
      );
    } else if (
      request.status === "pre-repair inspected" ||
      request.status === "post-repair inspected" ||
      request.status === "pre-post-repair inspected"
    ) {
      $("#data").append(
        '<label class="font-weight-bold text-secondary">' +
          request.status +
          "</label><br>"
      );
    }

    $("#data").append(
      '<label class="font-weight-bold">' +
        moment(request.itsrequest_date).format("MMM D, Y h:mm a") +
        "</label><br>"
    );
    $("#data").append(
      '<label class="font-weight-bold">' +
        request.dept_code +
        "|" +
        request.emp_fname +
        " " +
        request.emp_lname +
        "</label><br>"
    );
    $("#data").append(
      '<label class="font-weight-bold">' +
        request.hwcomponent_name +
        "</label><br>"
    );
    $("#data").append(
      '<label class="font-weight-bold">' + request.property_num + "</label><br>"
    );
    $("#data").append(
      '<label class="font-weight-bold">' +
        truncateString(request.concern) +
        "</label><br>"
    );
    $("#data").append(
      '<label class="font-weight-bold">' +
        request.itshw_category +
        "</label><br>"
    );
  });

  $("#modalView").modal({
    backdrop: "static",
    keyboard: false
  });
});

$(".pending").click(function(e) {
  e.preventDefault();
  const action = "statusPending";
  const itsrequest_id = $(this).attr("id");
  const statusupdate_useraccount_id = $(this).attr("data-id");

  $.ajax({
    url: requestsPath,
    type: "post",
    data: {
      action: action,
      itsrequest_id: itsrequest_id,
      statusupdate_useraccount_id: statusupdate_useraccount_id
    }
  }).done(async function(res) {
    if (res) {
      await Swal.fire("Success", 'Request set to "Pending"');
      location.reload(true);
    } else {
      Swal.fire("Error", "An error occured", "error");
    }
  });
});

$(".done-repair").click(function(e) {
  e.preventDefault();

  const itsrequest_id = $(this).attr("id");
  const statusupdate_useraccount_id = $(this).attr("data-id");

  $("#itsrequest_id").append(
    '<input type="hidden" class="form-control" name="itsrequest_id" id="itsrequest_id" value=' +
      itsrequest_id +
      ">"
  );
  $("#statusupdate_useraccount_id").append(
    '<input type="hidden" class="form-control" name="statusupdate_useraccount_id" id="statusupdate_useraccount_id" value=' +
      statusupdate_useraccount_id +
      ">"
  );
  $("#input_field").append(
    '<label for="solution">Solution:</label><textarea class="form-control" name="solution" id="solution"></textarea>'
  );
  $("#modalDone").modal({
    backdrop: "static",
    keyboard: false
  });
});

$("#pullout_done-form").submit(function(e) {
  e.preventDefault();

  const url = requestsPath;
  $.post(url, $(this).serialize()).done(async res => {
    if (res) {
      await Swal.fire("Success", "Done", "success");
      location.reload(true);
    } else {
      Swal.fire("Error", "An error occured", "error");
    }
  });
});

// Add new repair button click listener
$("#add").click(function(e) {
  e.preventDefault();
  $.redirect(`${baseUrl}app/admin/add-repair.php`);
});

// Assessment Button CLick Listener
$(".assess").click(function(e) {
  e.preventDefault();

  $.redirect(`${baseUrl}app/admin/assessment-form.php`, {
    itsrequest_id: $(this).attr("id"),
    useraccount_id: $(this).data("useraccount_id"),
    dept_id: $(this).data("dept_id"),
    hwcomponent_id: $(this).data("hwcomponent_id")
  });

  // var action = 'statusAssessmentPending';
  // const itsrequest_id = $(this).attr("id");
  // const useraccount_id = $(this).attr("data-id");
});

$(".assessment-created").click(function(e) {
  e.preventDefault();
  const itsrequest_id = $(this).attr("id");
  const useraccount_id = $(this).attr("data-id");
  setAssessmentDone(itsrequest_id, useraccount_id);
});

$(".btn-print-assessment").click(function() {
  $.redirect(
    `${baseUrl}app/admin/download/print-repassessmentreport-form.php`,
    {
      assessment_report_id: $(this).data("assessment-report-id")
    }
  );
});

$(".btn-print-inspection-report").click(function() {
  $.redirect(`${baseUrl}app/admin/download/pre-post-repair-form.php`, {
    assessment_report_id: $(this).data("assessment-report-id")
  });
});

// Pre and Post Inspect Button
$(".pre-post-inspect").click(function() {
  // Redirect to Inspection Report Form
  const action = "statusPreAndPostInspected";
  const itsrequest_id = $(this).attr("id");
  const useraccount_id = $(this).attr("data-id");
  const assessment_report_id = $(this).data("assessment-report-id");
  $.redirect(`${baseUrl}app/admin/pre-post-insp.php`, {
    action: action,
    itsrequest_id: itsrequest_id,
    useraccount_id: useraccount_id,
    assessment_report_id: assessment_report_id
  });
});

// $('.pre-inspect').click(function(e) {
//   e.preventDefault();

//   var action = 'statusPreInspected';
//   var itsrequest_id = $(this).attr('id');
//   var useraccount_id = $(this).attr('data-id');

//   $.ajax({
//     url: requestsPath,
//     type: "POST",
//     data: {
//       action: action,
//       itsrequest_id: itsrequest_id,
//       useraccount_id: useraccount_id
//     },
//   }).done(function(val) {
//     alert(val);
//     location.reload(true);
//   });
// });

// $('.post-inspect').click(function(e) {
//   e.preventDefault();

//   var action = 'statusPostInspected';
//   var itsrequest_id = $(this).attr('id');
//   var useraccount_id = $(this).attr('data-id');

//   $.ajax({
//     url: requestsPath,
//     type: "POST",
//     data: {
//       action: action,
//       itsrequest_id: itsrequest_id,
//       useraccount_id: useraccount_id
//     },
//   }).done(function(val) {
//     alert(val);
//     location.reload(true);
//   });
// });

/*$('.download-assessrep').click(function(e){
   e.preventDefault();

   var itsrequest_id = $(this).attr('id');
   var url = "downloadables/word.php";

   $.redirect(url, {itsrequest_id:itsrequest_id});
});*/
