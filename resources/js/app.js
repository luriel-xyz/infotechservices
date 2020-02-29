import "./bootstrap";

import Swal from "sweetalert2";
import moment from "moment";

window.moment = moment;
window.Swal = Swal;

$(() => {
  require("./components/add-repair");
  require("./components/add-request");
  require("./components/departments");
  require("./components/hwcomponents");
  require("./components/repairs");
  require("./components/requests");
  require("./components/sent_requests");
  require("./components/user-accounts");
  require("./components/assessment");
  require("./components/employee");
  require("./components/logout");
});
