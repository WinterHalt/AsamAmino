<!-- Final Version of Detail Page -->
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
<!-- Wrapper Panel on Detail -->
<section class="panel">
  <!-- Tab Custom Content -->
  <div class="tabs-custom">
    <div class="tab-content">
      <div class="tab-pane box active">
        <!-- Tanggal & User -->
        <div class="form-group">
          <div class="row">
            <!-- Tanggal -->
            <div class="col-sm-6">
              <label for="tanggal" class="form-label">Tanggal</label>
              <input type="text" class="form-control" value="<?php echo $result["tanggal"];?>" readonly>
            </div>
            <!-- User in Select Option -->
            <div class="col-sm-6">
              <label for="user" class="form-label">User</label>
              <input type="text" value="<?php echo $result["user"];?>" class="form-control" readonly>
            </div>
          </div>
        </div>
        <!-- Alasan Melakukan Permintaan Data -->
        <div class="form-group">
          <label for="tujuan" class="form-label">Tujuan Kegiatan Permintaan Data</label>
          <input type="text" value="<?php echo $result["tujuan"];?>" class="form-control" readonly>
        </div>
        <!-- Personal Information -->
        <div class="form-group">
          <div class="row">
            <!-- Electronic Mail -->
            <div class="col-sm-6">
              <label for="email" class="form-label">Electronic Mail</label>
              <input type="text" value="<?php echo $result["email"];?>" class="form-control" readonly>
            </div>
            <!-- Telepone -->
            <div class="col-sm-6">
              <label for="telepon" class="form-label">Telepon WhatsApp</label>
              <input type="text" value="<?php echo $result["telephone"];?>" class="form-control" readonly>
            </div>
          </div>
        </div>
        <!-- File Upload & Status Permintaan -->
        <div class="form-group">
          <div class="row">
            <!-- Upload File Permintaan Data -->
            <div class="col-sm-6">
              <label for="uploadfiles" class="form-label">File Permintaan Data</label>
              <br>
              <a href="<?= base_url('uploads/aplikasi/data/' . $result['uploadfiles']); ?>" class="btn btn-circle icon btn-info" target="_blank">
                <i class="fas fa-file"></i>
              </a>
            </div>
            <!-- Status Permintaan Data -->
            <div class="col-sm-6">
              <label for="status" class="form-label">Status</label>
              <input type="text" value="<?php echo $result["status"];?>" class="form-control" readonly>
            </div>
          </div>
        </div>
        <!-- Alasan Melakukan Permintaan Data -->
        <div class="form-group">
          <label for="tujuan" class="form-label">Alasan Penolakan</label>
          <input type="text" value="<?php echo $result["alasan"];?>" class="form-control" readonly>
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
          </div>
        </div>
      </div>
    </div>
  </div>
</section>