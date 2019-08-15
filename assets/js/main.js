// SweetAlert Triggers

function success() {
  Swal.fire({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    type: "success",
    title: "Profile Added Successfully"
  });
}

function error(err) {
  Swal.fire({
    type: "error",
    title: "Errors",
    html: err
  });
}
