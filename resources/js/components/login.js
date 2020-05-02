const loginForm = $("#login-form");
// Add validation rule for user account
let accountExists;
$.validator.addMethod(
  "checkAccount",
  () => {
    const formData = loginForm.serialize();
    axios.post(requestsPath, formData).then(({ data }) => {
      accountExists = !!data;
    });

    return accountExists;
  },
  "Incorrect username or password"
);

loginForm.validate({
  ...validatorOptions,

  onkeyup: false,

  rules: {
    username: "required",
    password: {
      required: true,
      checkAccount: true,
    },
  },

  messages: {
    username: "Username is required",
    password: {
      required: "Password is required",
      checkAccount: "Incorrect username or password",
    },
  },
});

// Login form submit handler
$(loginForm).submit(async () => {
  Swal.showLoading();

  const data = await $.post(requestsPath, $(loginForm).serialize()).promise();
  const user = $.parseJSON(data);

  if (!user) {
    Swal.close();
    return;
  }

  // If user account is disabled (user.status == 0)
  if (!user.status) {
    $(loginForm).preventDefault();
  }

  const isClient = user.usertype === "department";
  const location = isClient
    ? `${baseUrl}app/client/index.php`
    : `${baseUrl}app/admin/incoming-requests.php`;
  $.redirect(location, { user });
});
