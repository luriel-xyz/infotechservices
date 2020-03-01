$(".btn-logout").click(async e => {
  e.preventDefault();

  const { value } = await Swal.fire({
    icon: "question",
    title: "Confirm",
    text: "Are you sure?",
    showCancelButton: true,
  });

  if (value) {
    const logoutPath = `${window.location.origin}/${appName}/app/auth/logout.php`;

    window.location.href = logoutPath;
  }
});
