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
      checkAccount: true
    }
  },

  messages: {
    username: "Username is required",
    password: {
      required: "Password is required",
      checkAccount: "Incorrect username or password"
    }
  }
});

// Login button click
$("#btn-login").click(async () => {
  Swal.showLoading();

  const { data } = await axios.post(requestsPath, $(loginForm).serialize());

  if (!data) {
    Swal.close();
    return;
  }

  const isClient = data.usertype === "department";
  const location = isClient
    ? `${baseUrl}app/client/index.php`
    : `${baseUrl}app/admin/incoming-requests.php`;
  $.redirect(location, {
    user: data
  });
});
