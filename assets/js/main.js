// SweetAlert Triggers

function success() {
  Swal.fire({
    type: "success",
    title: "profile added succesfully"
  });
}

function error(err) {
  Swal.fire({
    type: "error",
    title: "Errors",
    html: err
  });
}
