// Minta Aplikasi Java Script
// Define Content

function ControllerContent(apiUrl){
  // Retrieve Data Through Controller
  const $container = $('#app-activity-card-container');
  // Controller
  $.ajax({
    url: apiUrl,
    type: "GET",
    dataType: "json",
    // OK
    success: function(data) {
      // Define Content
      let htmlContent = '';
      // Single Row
      data.forEach(row => {
        // Define Variable
        let updateButton = '';
        let deleteButton = ''; 
        let cardClass = '';
        let statusTextColor = '';
        let statusIcon = '';
        let filterTag = '';
        // Conditional Styling (Color)
        switch (row.status) {
          case 'Pending':
            cardClass = 'app-activity-bg-pending'; 
            statusTextColor = 'app-activity-text-pending';
            statusIcon = 'fa fa-hourglass-start';
            filterTag = 'filter-pending';
            break;
          case 'Kondisional':
            cardClass = 'app-activity-bg-kondisional'; 
            statusTextColor = 'app-activity-text-kondisional';
            statusIcon = 'fa fa-hourglass-start';
            filterTag = 'filter-kondisional';
            break;
          case 'Terima':
            // Soft Green Color
            cardClass = 'app-activity-bg-terima';
            statusTextColor = 'app-activity-text-terima';
            statusIcon = 'fa fa-check-circle';
            filterTag = 'filter-ok';
            break;
        }
        // Conditional Update (Belum Final)
        if (row.status != 'Terima') {
          updateButton = `
            <!-- While Pending, User Perform Update -->
            <a href="/user/aplikasi/update/${row.uuid}" 
               class="btn btn-sm btn-warning">
              <i class="fa fa-pen"></i>
            </a>
          `;
        }
        // Conditional Delete (Pending Only)
        if (row.status === 'Pending') {
          deleteButton = `
            <!-- While Pending, User Perform Delete -->
            <a href="/user/aplikasi/delete/${row.uuid}" 
               class="btn btn-sm btn-danger" 
               title="Hapus Permintaan Aplikasi">
              <i class="fa fa-trash"></i>
            </a>
          `;
        }
        // Primary Content
        htmlContent += `
          <!-- Panel on Responsive Grid Layout -->          
          <div class="col-xs-12 col-lg-4 filter-item ${filterTag}">
            <!-- Panel Card -->
            <div class="app-activity-card-item panel panel-default ${cardClass}">
              <!-- Header -->
              <div class="panel-heading card-header ${statusTextColor}">
                <div class="clearfix">
                  <small class="pull-left" style="color:black">Tanggal : ${row.tanggal_pengajuan}</small>
                  <i class="${statusIcon} pull-right"></i>
                </div>
              </div>
              <!-- Panel Body -->
              <div class="panel-body">
                <h5 class="panel-title text-dark">
                  <strong>${row.unit}</strong>
                  <br>
                  <small>${row.pengusul}</small>
                </h5>
              </div>
              <!-- Panel Footer -->
              <div class="panel-footer card-footer clearfix">
                <!-- File of Surat -->
                <a href="/uploads/aplikasi/aplikasi/surat/${row.surat}" 
                  class="btn btn-sm btn-info" target="_blank"
                  title="Lihat File Surat">
                  <i class="fa fa-file"></i>
                </a>
                <!-- File of Alur -->
                <a href="/uploads/aplikasi/aplikasi/alur/${row.alur}" 
                  class="btn btn-sm btn-info" target="_blank"
                  title="Lihat File Alur">
                  <i class="fa fa-file-pdf"></i>
                </a>
                <!-- Detail -->
                <a href="/user/aplikasi/detail/${row.uuid}" 
                  class="btn btn-sm btn-dark"
                  title="Detail Data">
                  <i class="fa fa-eye"></i>
                </a>
                <!-- Update Button -->
                ${updateButton}
                <!-- Delete Button -->
                ${deleteButton}
              </div>
            </div>
          </div>
        `;
        // Render Content HTML
        $container.html(htmlContent);
      })
    },
    // Fail
    error: function(xhr, status, error) {
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

// Filter on Click
$('.btn-filter').on('click', function() {
  $('.btn-filter').removeClass('active');
  $(this).addClass('active');
  const targetStatus = $(this).data('status');
  $('.filter-item').hide();
  $('.filter-' + targetStatus).fadeIn(300);
});