$(".btn-logout").click(async e => {
  e.preventDefault();

  const { value } = await Swal.fire({
    icon: "question",
    title: "Confirm",
    text: "Are you sure?",
    showCancelButton: true,
    confirmButtonColor: "#009688"
  });

  if (value) {
    const path = window.location.pathname;
    const baseUrl = location.href.split("mywebsite")[0];
    // let directoryLevel;
    // if (path.indexOf("settings")) {
    //   directoryLevel = "../../../";
    // } else if (path.indexOf("admin") || path.indexOf('client')) {
    //   directoryLevel = "../";
    // } else {
    //   directoryLevel = "../../";
    // }

    alert(baseUrl);
    // window.location.href = `${directoryLevel}app/auth/logout.php`;
  }
});
