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

//View Request Details Script
$(".view-sent-request").click(function(e) {
  e.preventDefault();
  const action = "getRequest";
  const itsrequest_id = $(this).attr("id");

  $.ajax({
    url: requestArgumentsPath,
    type: "post",
    data: {
      action: action,
      itsrequest_id: itsrequest_id
    },
    dataType: "JSON"
  }).done(function(request) {
    $("#modalView").modal("toggle");
    if (request.status === "received") {
      $("#data").append(
        '<label class="font-weight-bold text-info">' +
          request.status +
          "</label><br>"
      );
    } else if (request.status === "pending") {
      $("#data").append(
        '<label class="font-weight-bold text-warning">' +
          request.status +
          "</label><br>"
      );
    } else {
      $("#data").append(
        '<label class="font-weight-bold text-success">' +
          request.status +
          "</label><br>"
      );
    }

    $("#data").append(
      '<label class="font-weight-bold">' +
        moment(request.itsrequest_date).format("MMM d, Y h:mm a") +
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
      '<label class="font-weight-bold">' + truncateString(request.concern) + "</label><br>"
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
});

$(".close").click(function() {
  location.reload(true);
});

$(".cancel").click(function() {
  location.reload(true);
});

$(".receive").click(function(e) {
  e.preventDefault();
  var action = "statusDeployed";
  var itsrequest_id = $(this).attr("id");

  $.ajax({
    url: requestArgumentsPath,
    type: "post",
    data: {
      action: action,
      itsrequest_id: itsrequest_id
    }
  }).done(async function(res) {
    if (res) {
      await Swal.fire("Success", "Hardware received", "success");
      location.reload(true);
    } else {
      Swal.fire("Failure", "An error occured", "error");
    }
  });
});
