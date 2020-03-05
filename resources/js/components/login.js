$("#login-form").validate({
  ...validatorOptions,

  rules: {
    username: "required",
    password: "required"
  },

  messages: {
    username: "Username is required",
    password: "Password is required"
  },

  submitHandle: form => {
    
  }
});

