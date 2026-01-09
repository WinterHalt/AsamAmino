function TimelineController(apiUrl){
  // Retrieve Data Through Controller
  console.log(apiUrl);
  // Controller
  $.ajax({
    url: apiUrl,
    type: "GET",
    dataType: "json",
    success: function(data) {
      console.log(data);
    },
    // Fail
    error: function() {
      // Show Fail Error
      Swal.fire({
        type: 'error',
        title: 'Operasi Gagal !',
        text: "Terjadi Kegagalan Pada Aplikasi ! Hubungi Pihak SIMRS !",
        confirmButtonText: 'OK'
      });
    }
  })
}