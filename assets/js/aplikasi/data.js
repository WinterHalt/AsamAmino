// Minta Data Java Script
// Define Content

function ControllerContent(apiUrl) {
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
        let pendingButton = ''; 
        let cardClass = '';
        let statusTextColor = '';
        let statusIcon = '';
        let filterTag = '';
        // Conditional Styling (Color)
        switch (row.status) {
          case 'Pending':
            // Grey Color
            cardClass = 'app-activity-bg-pending'; 
            statusTextColor = 'app-activity-text-pending';
            statusIcon = 'fa fa-hourglass-start';
            filterTag = 'filter-pending';
            break;
          case 'Terima':
            // Soft Green Color
            cardClass = 'app-activity-bg-terima';
            statusTextColor = 'app-activity-text-terima';
            statusIcon = 'fa fa-check-circle';
            filterTag = 'filter-ok';
            break;
          case 'Tolak':
            // Soft Red Color
            cardClass = 'app-activity-bg-tolak';
            statusTextColor = 'app-activity-text-tolak';
            statusIcon = 'fa fa-times-circle';
            filterTag = 'filter-reject';
            break;
        }
        // Conditional Delete (Pending Only)
        if (row.status === 'Pending') {
          pendingButton = `
            <!-- While Pending, User Perform Update -->
            <a href="/user/data/update/${row.uuid}" 
               class="btn btn-sm btn-warning">
              <i class="fa fa-pen"></i>
            </a>
            <!-- While Pending, User Perform Delete -->
            <a href="/user/data/delete/${row.uuid}" 
               class="btn btn-sm btn-danger">
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
                  <small class="pull-left" style="color:black">Tanggal : ${row.tanggal}</small>
                  <i class="${statusIcon} pull-right"></i>
                </div>
              </div>
              <!-- Panel Body -->
              <div class="panel-body">
                <h5 class="panel-title text-dark">
                  <strong>${row.name}</strong>
                </h5>
              </div>
              <!-- Panel Footer -->
              <div class="panel-footer card-footer clearfix">
                <!-- File of Surat -->
                <a href="/uploads/aplikasi/data/${row.uploadfiles}" 
                  class="btn btn-sm btn-info" target="_blank"
                  title="Lihat File">
                  <i class="fa fa-file"></i>
                </a>
                <!-- Detail -->
                <a href="/user/data/detail/${row.uuid}" 
                  class="btn btn-sm btn-dark"
                  title="Detail Data">
                  <i class="fa fa-eye"></i>
                </a>
                <!-- While Pending Button -->
                ${pendingButton}
              </div>
            </div>
          </div>
        `;
        // Render Content HTML
        $container.html(htmlContent);
      });
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

// Filter Custom Behaviour
$('.btn-filter').on('click', function() {
  $('.btn-filter').removeClass('active');
  $(this).addClass('active');
  const targetStatus = $(this).data('status');
  $('.filter-item').hide();
  $('.filter-' + targetStatus).fadeIn(300);
});