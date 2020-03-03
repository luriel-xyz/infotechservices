// fetchAllRequests();

// // Fetch requests every 5 seconds
// setInterval(fetchAllRequests, 5000);

// function fetchAllRequests() {
// 	$.get('../includes/tables/incomingrequest-tbl.php')
// 		.fail(() => alert('Error'))
// 		.done(table => $('#incoming-requests').html(table));
// }

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
    $("#dept_selection").fadeIn(600);
  } else {
    $("#dept_selection").fadeOut(600);
  }
});

$("#printSummary").click(function(e) {
  e.preventDefault();

  $("#modalPrint").modal("toggle");
});

$("#printSorting-requests-form").submit(function(e) {
  e.preventDefault();

  const action = "RequestSummaryReport";
  const sort = $('input[name="sort"]:checked').val();
  const dept_id = $("#dept_id").val();
  const day = $("#day").val();
  let url = "";

  if (sort === "all") {
    url = "../../app/admin/download/excel-all.php";
  } else if (sort === "department") {
    url = "../../app/admin/download/excel-dept.php";
  } else if (sort === "day") {
    url = "../../app/admin/download/excel-date.php";
  }

  $.redirect(url, {
    action: action,
    dept_id: dept_id,
    day: day
  });
  $("#modalPrint").modal("toggle");
});

//View Request Details Script
$(".view-request").click(function(e) {
  e.preventDefault();
  const action = "getRequest";
  const itsrequest_id = $(this).attr("id");

  $.post(`${baseUrl}config/processors/requestArguments.php`, {
    action: action,
    itsrequest_id: itsrequest_id
  }).done(request => {
    request = JSON.parse(request);
    $("#modalView").modal("toggle");
    $('#data').empty();
    $('#other-labels').empty();
    if (request.status === "received") {
      $("#data").append(
        '<label class="font-weight-bold text-info">' +
          request.status +
          "</label><br>"
      );
    } else if (request.status === "pending") {
      $("#data").append(
        '<label class="font-weight-bold text-success">' +
          request.status +
          "</label><br>"
      );
    } else if (request.status === "done") {
      $("#data").append(
        '<label class="font-weight-bold text-secondary">' +
          request.status +
          "</label><br>"
      );
    }

    $("#data").append(
      '<label class="font-weight-bold">' +
        moment(request.itsrequest_date.itsrequest_date).format("MMM D, Y") +
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
      '<label class="font-weight-bold text-truncate">' +
        request.concern +
        "</label><br>"
    );

    if (request.itsrequest_category == "hw") {
      $("#other-labels").append("<label> Repair Location: </label> <br>");
      $("#data").append(
        '<label class="font-weight-bold">' +
          request.itshw_category +
          "</label><br>"
      );
      $("#other-labels").append("<label> Hardware: </label> <br>");
      $("#data").append(
        '<label class="font-weight-bold">' +
          request.hwcomponent_name +
          "</label><br>"
      );

      if (
        request.itshw_category == "pulled-out" ||
        request.itshw_category == "walk-in"
      ) {
        $("#other-labels").append("<label> Property Number: </label> <br>");
        $("#data").append(
          '<label class="font-weight-bold">' +
            request.property_num +
            "</label><br>"
        );
      }
    }
  });

  $("#modalView").modal({
    backdrop: "static",
    keyboard: false
  });
});

$(".done-request").click(function(e) {
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

  $("#modalPulloutDone").modal({
    backdrop: "static",
    keyboard: false
  });
});

$(".pullout").click(function(e) {
  e.preventDefault();
  const itsrequest_id = $(this).attr("id");
  const hwcomponent_id = $(this).attr("hw-id");
  const statusupdate_useraccount_id = $(this).attr("data-id");

  $("#action").val("categoryPulloutRequest");
  $(".modal-title").text("Hardware Pullout Form");
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
  $("#hwcomponent_select").show();
  $("#hwcomponent_id").val(hwcomponent_id);
  $("#input_field").append(
    '<input type="text" class="form-control" name="property_num" id="property_num" placeholder="Property Number"/>'
  );
  $("#submit_btn").text("Pullout");
  $("#modalPulloutDone").modal({
    backdrop: "static",
    keyboard: false
  });
});

$("#pullout_done-form").submit(async function(e) {
  e.preventDefault();

  const res = await axios.post(
    "../../config/processors/requestArguments.php",
    $(this).serialize()
  );

  if (res) {
    await Swal.fire("Success", "Request Done", "success");
    $.redirect(`${baseUrl}app/admin/incoming-repairs.php`);
  } else {
    Swal.fire("Error", "An error occured", "error");
  }
});

$(".pending").click(async function(e) {
  e.preventDefault();
  const action = "statusPending";
  const itsrequest_id = $(this).attr("id");
  const statusupdate_useraccount_id = $(this).attr("data-id");

  const res = axios.post("../../config/processors/requestArguments.php", {
    action: action,
    itsrequest_id: itsrequest_id,
    statusupdate_useraccount_id: statusupdate_useraccount_id
  });

  if (res) {
    await Swal.fire("Success", "Request Set to Pending", "success");
    location.reload(true);
  } else {
    Swal.fire("Error", "An error occured", "error");
  }
});

