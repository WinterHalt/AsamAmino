<!-- Final Version of User Minta Aplikasi Template -->
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
        <!-- Publish to Aplikasi User Controller on Publish -->
        <?php echo form_open_multipart('user/aplikasi/publish'); ?>
        <!-- Instalasi, Pengaju & PIC -->
        <div class="form-group">
          <div class="row">
            <!-- Instalasi User -->
            <div class="col-sm-4">
              <label for="unit" class="form-label">Unit</label>
              <input type="text" name="unit" id="instalasi" class="form-control" required>
            </div>
            <!-- User in Select Option -->
            <div class="col-sm-4">
              <label for="user" class="form-label">User Melakukan Pengajuan</label>
              <select name="pengusul" id="user" class="form-control">
                <option value="<?php echo get_user_name(false)[0];?>">
                  <?php echo get_user_name(false)[1];?>
                </option>
              </select>
            </div>
            <!-- PIC Aplikasi -->
            <div class="col-sm-4">
              <label for="pic" class="form-label">PIC Koordinasi</label>
              <input type="text" name="pic" id="pic" class="form-control" require>
              </select>
            </div>
          </div>
        </div>
        <!-- Judul Aplikasi -->
        <div class="form-group">
          <label for="judul" class="form-label">Judul Permintaan Aplikasi</label>
          <input type="text" name="judul" id="judul" class="form-control" require>
        </div>
        <!-- Deskripsi Aplikasi -->
        <div class="form-group">
          <label for="deskripsi" class="form-label">Deskripsi Permintaan Aplikasi</label>
          <input type="text" name="deskripsi" id="deskripsi" class="form-control" require>
        </div>
        <!-- File Upload & Status Permintaan -->
        <div class="form-group">
          <div class="row">
            <!-- Upload File Surat Permintaan Aplikasi -->
            <div class="col-sm-4">
              <label for="surat" class="form-label">File Surat Permintaan Aplikasi</label>
              <input type="file" name="suratfile" id="surat" class="form-control" accept="application/pdf" required>
            </div>
            <!-- Upload File Alur Aplikasi -->
            <div class="col-sm-4">
              <label for="alur" class="form-label">File Alur Aplikasi</label>
              <input type="file" name="alurfile" id="alur" class="form-control" accept="application/pdf" required>
            </div>
            <!-- Status Permintaan Data -->
            <div class="col-sm-4">
              <label for="tanggal" class="form-label">Tanggal</label>
              <input type="date" name="tanggal_pengajuan" id="tanggal" class="form-control" require>
            </div>
          </div>
        </div>
        <!-- Footer Panel -->
        <div class="panel-footer">
          <div class="row">
            <!-- Kembali -->
            <div class="col-md-6">
              <button class="btn btn-default pull-left" onclick="history.back(); return false;">
                <i class="fas fa-arrow-left"></i> <?php echo translate('kembali'); ?>
              </button>
            </div>
            <!-- Publish -->
            <div class="col-md-6">
              <button class="btn btn-dark pull-right" type="submit">
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

<script>
  $(document).ready(function() {
    // Initialize Select2 Elements 
    $("#user").select2();
    // Tanggal
    const today = new Date();
    const formatDate = (date) => date.toISOString().split("T")[0];
    $('#tanggal').val(formatDate(today));
  });
</script>