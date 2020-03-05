window._ = require("lodash");

window.axios = require("axios");

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

try {
  window.Popper = require("popper.js").default;
  window.$ = window.jQuery = require("jquery");

  // mdbootstrap
  require("mdbootstrap/js/bootstrap.min.js");

  // fontawesome
  require("@fortawesome/fontawesome-free/js/all");
  // jquery redirect
  require("jquery.redirect");

  require("jquery-validation/dist/jquery.validate.min.js");

  // require('bootstrap');
  // require("bootstrap-material-design/dist/css/bootstrap-material-design.min.css");
} catch (e) {}
