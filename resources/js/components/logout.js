$(".btn-logout").click(async e => {
  e.preventDefault();

  const { value } = await Swal.fire({
    icon: "question",
    title: "Confirm",
    text: "Are you sure?",
    showCancelButton: true,
    customClass: {
      confirmButton: "btn btn-primary btn-sm text-capitalize",
      cancelButton: "btn btn-secondary btn-sm text-capitalize"
    }
  });

  if (value) {
    const logoutPath = `${baseUrl}/app/auth/logout.php`;

    window.location.href = logoutPath;
  }
});
