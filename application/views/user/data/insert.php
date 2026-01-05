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
        <!-- Tanggal & User -->
        <div class="form-group">
          <div class="row">
            <!-- Tanggal -->
            <div class="col-xs-12 col-sm-6 stack-spacing">
              <label for="tanggal" class="form-label">Tanggal</label>
              <input type="date" name="tanggal" id="tanggal" class="form-control" readonly>
            </div>
            <!-- User -->
            <div class="col-xs-12 col-sm-6">
              <label for="user" class="form-label">User</label>
              <select name="user" id="user" class="form-control">
                <option value="<?php echo get_user_name(false)[0];?>">
                    <?php echo get_user_name(false)[1];?>
                </option>
              </select>
            </div>
          </div>
        </div>
        <!-- Alasan Melakukan Permintaan Data -->
        <div class="form-group">
          <label for="tujuan" class="form-label">Tujuan Kegiatan Permintaan Data</label>
          <input type="text" name="tujuan" id="tujuan" class="form-control" require>
        </div>
        <!-- Electronic Mail & Telephone -->
        <div class="form-group">
          <div class="row">
            <!-- Electronic Mail -->
            <div class="col-xs-12 col-sm-6 stack-spacing">
              <label for="email" class="form-label">Electronic Mail</label>
              <input type="text" name="email" id="email" class="form-control" required>
            </div>
            <!-- Telephone -->
            <div class="col-xs-12 col-sm-6">
              <label for="telepon" class="form-label">Telepon WhatsApp</label>
              <input type="text" name="telephone" class="form-control" required>
            </div>
          </div>
        </div>
        <!-- File & Status -->
        <div class="form-group">
          <div class="row">
            <!-- File -->
            <div class="col-xs-12 col-sm-6 stack-spacing">
              <label for="uploadfiles" class="form-label">File Permintaan Data</label>
              <input type="file" name="uploadfiles" id="uploadfiles" class="form-control" accept="application/pdf" required>
            </div>
            <!-- Level of Status -->
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