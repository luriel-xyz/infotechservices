// Add validation rule for user account
let user;
$.validator.addMethod(
  "checkAccount",
  (value, element) => {
    const data = $("#login-form").serialize();
    $.post(requestArgumentsPath, data).done(res => (user = res));
    console.log(data);
    return user ? true : false; 
  },
  "Incorrect username or password"
);

$("#login-form").validate({
  ...validatorOptions,

  rules: {
    username: "required",
    password: {
      required: true,
      checkAccount: true 
    }
  },

  messages: {
    username: "Username is required",
    password: {
      required: "Password is required",
      checkAccount: "Incorrect username or password"
    }
  },

  submitHandle: form => {}
});
