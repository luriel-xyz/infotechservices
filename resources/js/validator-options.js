export default {
  validClass: "text-success",
  errorClass: "text-danger",
  successElement: "small",
  errorElement: "small",
  success: label => {
    label.text("OK").addClass("text-success");
  }
};