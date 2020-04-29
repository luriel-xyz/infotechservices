const checkNotification = async () => {
  // count rows from requests table
  const requestCount = await $.post(requestsPath, {
    action: "countTotalRequests",
  }).promise();

  const requestCountFromStorage = localStorage.getItem(KEY_NOTIF_COUNT) ?? 0;

  // If there is no new request
  if (requestCount <= requestCountFromStorage) return;

  // set new total request count
  localStorage.setItem(KEY_NOTIF_COUNT, requestCount);

  // Get the authenticated user type
  const { usertype } = JSON.parse(
    await $.post(requestsPath, {
      action: "getAuthenticatedUser",
    }).promise()
  );

  if (usertype === "department") return;

  // show dialog
  const { value: confirm } = await Swal.fire({
    title: "Hi",
    icon: "info",
    text: "There is a new repair request!",
    showConfirmButton: true,
    showCancelButton: true,
    confirmButtonText: "View",
    cancelButtonText: "View later",
  });

  if (confirm) {
    // redirect to incoming requests page
    $.redirect(`${baseUrl}app/admin/incoming-requests.php`);
  }
};

async function addRequestNotification(requests_total) {
  await $.post(requestsPath, {
    action: "addRequestNotification",
    requests_total,
  }).promise();
}

// Check for new requests every 6 seconds.
setInterval(checkNotification, 6000);
