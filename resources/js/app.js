import "./bootstrap";

import Swal from "sweetalert2";
import moment from "moment";
import options from "./validator-options";

window.moment = moment;
window.Swal = Swal;
window.appName = "infotechservices";
window.baseUrl = `${window.location.origin}/`;
window.requestArgumentsPath = `${baseUrl}/config/processors/requestArguments.php`;
window.settingsArgumentsPath = `${baseUrl}/config/processors/settingsArguments.php`;
window.validatorOptions = options;
window.truncateString = () => (string, maxLength = 40) => {
  if (!string) return null;
  if (string.length <= maxLength) return string;
  return `${string.substring(0, maxLength)}...`;
};

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
  require("./components/pre-post-insp");
  require("./components/employee");
  require("./components/logout");
  require("./components/login");
});
