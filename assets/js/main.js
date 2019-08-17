// SweetAlert Triggers

function success(msg) {
  Swal.fire({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    type: "success",
    title: msg
  });
}

function error(err) {
  Swal.fire({
    type: "error",
    title: "Errors",
    html: err
  });
}
