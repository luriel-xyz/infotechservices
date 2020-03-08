export default {
  validClass: "is-valid",
  errorClass: "text-danger is-invalid",
  successElement: "small",
  errorElement: "small",
  success: label => {
    label.addClass("text-success");
  }
};
