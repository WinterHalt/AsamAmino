<!-- Final Version of Detail on User Minta Aplikasi -->
<section class="panel">
  <div class="tabs-custom">
    <div class="tab-content">
      <div class="tab-pane box active">
        <!-- Instalasi, Pengaju & PIC -->
        <div class="form-group">
          <div class="row">
            <!-- Instalasi -->
            <div class="col-sm-4">
              <label class="form-label">Unit</label>
              <input type="text" class="form-control" value="<?php echo $result["unit"];?>" readonly>
            </div>
            <!-- User -->
            <div class="col-sm-4">
              <label class="form-label">User Melakukan Pengajuan</label>
              <input type="text" class="form-control" value="<?php echo $result["pengusul"];?>"readonly>
            </div>
            <!-- PIC -->
            <div class="col-sm-4">
              <label class="form-label">PIC Koordinasi</label>
              <input type="text" class="form-control" value="<?php echo $result["pic"];?>" readonly>
            </div>
          </div>
        </div>
        <!-- Judul -->
        <div class="form-group">
          <label class="form-label">Judul Permintaan Aplikasi</label>
          <input type="text" class="form-control" value="<?php echo $result["judul"];?>" readonly>
        </div>
        <!-- Deskripsi -->
        <div class="form-group">
          <label class="form-label">Deskripsi Permintaan Aplikasi</label>
          <input type="text" class="form-control" value="<?php echo $result["deskripsi"];?>" readonly>
        </div>
        <!-- File & Tanggal -->
        <div class="form-group">
          <div class="row">
            <!-- File Surat Aplikasi -->
            <div class="col-sm-4">
              <label class="form-label">File Surat Permintaan Aplikasi</label>
              <br>
              <a href="<?= base_url('uploads/aplikasi/aplikasi/surat/' . $result['surat']); ?>" class="btn btn-info" target="_blank">
                <i class="fas fa-file"></i>
              </a>
            </div>
            <!-- File Alur Aplikasi -->
            <div class="col-sm-4">
              <label class="form-label">File Alur Aplikasi</label>
              <br>
              <a href="<?= base_url('uploads/aplikasi/aplikasi/alur/' . $result['alur']); ?>" class="btn btn-info" target="_blank">
                <i class="fas fa-file"></i>
              </a>
            </div>
            <!-- Tanggal -->
            <div class="col-sm-4">
              <label class="form-label">Tanggal</label>
              <input type="text" class="form-control" value="<?php echo $result["tanggal_pengajuan"];?>" readonly>
            </div>
          </div>
        </div>
        <!-- Alasan -->
        <div class="form-group">
          <label class="form-label">Alasan Penolakan</label>
          <input type="text" class="form-control" value="<?php echo $result["alasan"];?>" readonly>
        </div>
        <!-- Footer -->
        <div class="panel-footer">
          <div class="row">
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