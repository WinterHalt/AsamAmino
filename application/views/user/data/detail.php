<!-- Final Version of Detail User Minta Data -->
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
<!-- Wrapper Panel Detail Input Form -->
<section class="panel">
  <div class="tabs-custom">
    <div class="tab-content">
      <div class="tab-pane box active">
        <!-- Kode Sistem -->
        <div class="form-group">
          <label for="uuid" class="form-label">Kode Sistem</label>
          <input type="text" class="form-control" name="uuid" value="<?php echo $result["uuid"];?>" readonly>
        </div>
        <div class="form-group">
          <div class="row">
            <!-- Tanggal Permintaan Data -->
            <div class="col-xs-12 col-sm-6 stack-spacing">
              <label for="tanggal" class="form-label">Tanggal</label>
              <input type="text" class="form-control" value="<?php echo $result["tanggal"];?>" readonly>
            </div>
            <!-- User Melakukan Permintaan -->
            <div class="col-xs-12 col-sm-6">
              <label for="user" class="form-label">User</label>
              <input type="text" value="<?php echo $result["user"];?>" class="form-control" readonly>
            </div>
          </div>
        </div>
        <!-- Tujuan Permintaan Data -->
        <div class="form-group">
          <label for="tujuan" class="form-label">Tujuan Kegiatan Permintaan Data</label>
          <input type="text" value="<?php echo $result["tujuan"];?>" class="form-control" readonly>
        </div>
        <div class="form-group">
          <div class="row">
            <!-- Electo Mail -->
            <div class="col-xs-12 col-sm-6 stack-spacing">
              <label for="email" class="form-label">Electronic Mail</label>
              <input type="text" value="<?php echo $result["email"];?>" class="form-control" readonly>
            </div>
            <!-- Telephone -->
            <div class="col-xs-12 col-sm-6">
              <label for="telepon" class="form-label">Telepon WhatsApp</label>
              <input type="text" value="<?php echo $result["telephone"];?>" class="form-control" readonly>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <!-- File -->
            <div class="col-xs-12 col-sm-6 stack-spacing">
              <label for="uploadfiles" class="form-label">File Permintaan Data</label>
              <br>
              <a href="<?= base_url('uploads/aplikasi/data/' . $result['uploadfiles']); ?>" class="btn btn-circle icon btn-info" target="_blank">
                <i class="fas fa-file"></i>
              </a>
            </div>
            <!-- Stats -->
            <div class="col-xs-12 col-sm-6">
              <label for="status" class="form-label">Status</label>
              <input type="text" value="<?php echo $result["status"];?>" class="form-control" readonly>
            </div>
          </div>
        </div>
        <div class="form-group">
          <!-- Alasan Penolakan -->
          <label for="tujuan" class="form-label">Alasan Penolakan</label>
          <input type="text" value="<?php echo $result["alasan"];?>" class="form-control" readonly>
        </div>
        <div class="panel-footer">
          <div class="row">
            <!-- Kembali -->
            <div class="col-xs-12 col-md-6">
              <button class="btn btn-default pull-left" onclick="history.back(); return false;">
                <i class="fas fa-arrow-left"></i> <?php echo translate('kembali'); ?>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>