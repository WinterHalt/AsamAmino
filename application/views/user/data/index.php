<!-- Final Version of User History Template File -->
<!-- Custom Styling -->
<link rel="stylesheet" href="/assets/css/aplikasi/custom.css">

<!-- Filter Panel -->
<div class="row button-icon-row" style="margin-bottom: 20px;">
  <div class="col-xs-12 text-center">
    <div style="display: inline-block;">
      <!-- Pending Only -->
      <button type="button" class="btn btn-filter btn-circle" data-status="pending" title="Pending">
        <i class="fa fa-hourglass-start"></i>
      </button>
      <!-- Reject Only -->
      <button type="button" class="btn btn-filter btn-circle" data-status="reject" title="Reject">
        <i class="fa fa-times-circle"></i>
      </button>
      <!-- Available Only -->
      <button type="button" class="btn btn-filter btn-circle" data-status="ok" title="OK">
        <i class="fa fa-check-circle"></i>
      </button>
      <!-- Insert Data -->
      <a href="/user/data/insert" type="button" class="btn btn-filter btn-circle" data-status="insert" title="Insert">
        <i class="fa fa-plus"></i>
      </a>
    </div>
  </div>
</div>

<!-- Wrapper Panel on Multi Card on Deck -->
<div class="app-activity-card-layout">
  <div class="row" id="app-activity-card-container">
    <!-- JavaScript Auto Fill Content -->
  </div>
</div>

<script src="<?php echo base_url('assets/js/aplikasi/data.js'); ?>"></script>
<!-- Controller Content -->
<script type="text/javascript">
  $(document).ready(function() {
    // Define the Route to your Controller
    var apiUrl = "<?php echo base_url('user/data/tabel_historia'); ?>";
    // Call Function
    ControllerContent(apiUrl);
  });
</script>