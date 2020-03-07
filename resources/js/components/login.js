// Add validation rule for user account
let accountExists;
$.validator.addMethod(
  "checkAccount",
  () => {
    const formData = $("#login-form").serialize();
    axios.post(requestArgumentsPath, formData).then(({ data }) => {
      accountExists = !!data;
    });

    return accountExists;
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

  submitHandler: async form => {
    const { data } = await axios.post(
      requestArgumentsPath,
      $(form).serialize()
    );

    if (!data) return;
    const isClient = data.usertype === "department";
    const location = isClient
      ? `${baseUrl}app/client/index.php`
      : `${baseUrl}app/admin/incoming-requests.php`;
    $.redirect(location, {
      user: data
    });
  }
});
