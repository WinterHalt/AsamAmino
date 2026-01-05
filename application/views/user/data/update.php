<!-- Final Version of User Update Permintaan Data Template -->
<!-- Custom Styling -->
<style>
  .select2-container .select2-selection--single { height: 34px !important; }
  .select2-container--default .select2-selection--single .select2-selection__rendered { 
    line-height: 32px !important; 
    padding-left: 12px; 
  }
  .select2-container--default .select2-selection--single .select2-selection__arrow { height: 32px !important; display: none; }
  label { color: black }
</style>
<!-- Wrapper Panel Input Formulir -->
<section class="panel">
  <!-- Tab Custom Content -->
  <div class="tabs-custom">
    <div class="tab-content">
      <div class="tab-pane box active">
        <!-- Publish to Data User Controller on Publish -->
        <?php echo form_open_multipart('user/data/publish'); ?>
        <!-- Official Secret -->
        <br>
        <!-- Kode Sistem -->
        <div class="form-group">
          <label for="uuid" class="form-label">Kode Sistem</label>
          <input type="text" class="form-control" name="uuid" value="<?php echo $result["uuid"];?>" readonly>
        </div>
        <!-- Tanggal & User -->
        <div class="form-group">
          <!-- Tanggal -->
          <div class="row">
            <div class="col-xs-12 col-sm-6 stack-spacing">
              <label for="tanggal" class="form-label">Tanggal</label>
              <input type="date" class="form-control" value="<?php echo $result["tanggal"];?>" readonly>
            </div>
            <!-- User -->
            <div class="col-xs-12 col-sm-6">
              <label for="user" class="form-label">User</label>
              <input type="text" class="form-control" value="<?php echo $result["user"];?>" readonly>
            </div>
          </div>
        </div>
        <!-- Alasan Melakukan Permintaan Data -->
        <div class="form-group">
          <label for="tujuan" class="form-label">Tujuan Kegiatan Permintaan Data</label>
          <input type="text" class="form-control" name="tujuan" value="<?php echo $result["tujuan"];?>" require>
        </div>
        <!-- Electronic Mail & Telephone -->
        <div class="form-group">
          <!-- Electronic Mail -->
          <div class="row">
            <div class="col-xs-12 col-sm-6 stack-spacing">
              <label for="email" class="form-label">Electronic Mail</label>
              <input type="text" class="form-control" name="email" value="<?php echo $result["email"];?>" require>
            </div>
            <!-- Telepon -->
            <div class="col-xs-12 col-sm-6">
              <label for="telepon" class="form-label">Telepon WhatsApp</label>
              <input type="text" class="form-control" name="telephone" value="<?php echo $result["telephone"];?>" require>
            </div>
          </div>
        </div>
        <!-- File & Status -->
        <div class="form-group">
          <!-- File -->
          <div class="row">
            <div class="col-xs-12 col-sm-6 stack-spacing">
              <label for="uploadfiles" class="form-label">File Permintaan Data</label>
              <input type="file" name="uploadfiles" id="uploadfiles" class="form-control" accept="application/pdf">
            </div>
            <!-- Status -->
            <div class="col-xs-12 col-sm-6">
              <label for="status" class="form-label">Status</label>
              <input type="text" name="status" value="Pending" class="form-control" readonly>
            </div>
          </div>
        </div>
        <!-- Footer Panel -->
        <div class="panel-footer">
          <div class="row">
            <!-- Kembali -->
            <div class="col-12 col-md-6 mb-2 mb-md-0">
              <button class="btn btn-default pull-left w-100" onclick="history.back(); return false;">
                <i class="fas fa-arrow-left"></i> <?php echo translate('kembali'); ?>
              </button>
            </div>
            <!-- Publish -->
            <div class="col-12 col-md-6">
              <button class="btn btn-dark pull-right w-100" type="submit">
                <i class="fas fa-plus-circle"></i>&nbsp;&nbsp;<span>OK</span>
              </button>
            </div>
          </div>
        </div>
        <!-- Close Formulir -->
        <?php echo form_close(); ?>
      </div>
    </div>
  </div>
</section>

<!-- Support Script -->
<script type="text/javascript" language="javascript">
  $(document).ready(function() {
    // Tanggal
    const today = new Date();
    const formatDate = (date) => date.toISOString().split("T")[0];
    $('#tanggal').val(formatDate(today));
    // Select
    $('#user').select2({ width: '100%' });
    // File Upload
    $('#file_kerjasama').on('change', function() {
      const file = this.files[0];
      if (!file) return;
      // Check type
      if (file.type !== 'application/pdf') {
        Swal.fire({
          type: 'error',
          title: 'Invalid Format !',
          text: 'PDF Only !',
        });
        $(this).val('');
        return;
      }
      // Check Size (max 10 MB)
      const maxSize = 10 * 1024 * 1024; // 10 MB
      if (file.size > maxSize) {
        Swal.fire({
          type: 'error',
          title: 'Ukuran Terlalu Besar !',
          text: 'Maksimal File : 10 MB',
        });
        $(this).val('');
      }
    });
  })
</script>