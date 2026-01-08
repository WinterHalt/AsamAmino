<!-- Final Version of User Update Permintaan Aplikasi -->
<section class="panel">
  <div class="tabs-custom">
    <div class="tab-content">
      <div class="tab-pane box active">
        <!-- Publish to Aplikasi User Controller on Publish -->
        <?php echo form_open_multipart('user/aplikasi/publish'); ?>
        <!-- Judul -->
        <div class="form-group">
          <label class="form-label">Kode Sistem</label>
          <input type="text" class="form-control" name="uuid" value="<?php echo $result["uuid"];?>" readonly>
        </div>
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
              <input type="text" class="form-control" value="<?php echo $result["pengusul"];?>" readonly>
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
          <input type="text" class="form-control" name="judul" value="<?php echo $result["judul"];?>" require>
        </div>
        <!-- Deskripsi -->
        <div class="form-group">
          <label class="form-label">Deskripsi Permintaan Aplikasi</label>
          <input type="text" class="form-control" name="deskripsi" value="<?php echo $result["deskripsi"];?>" require>
        </div>
        <!-- File & Tanggal -->
        <div class="form-group">
          <div class="row">
            <!-- File Surat -->
            <div class="col-sm-4">
              <label class="form-label">File Surat Permintaan Aplikasi</label>
              <input type="file" name="suratfile" id="surat" class="form-control" accept="application/pdf">
            </div>
            <!-- File Alur -->
            <div class="col-sm-4">
              <label class="form-label">File Alur Aplikasi</label>
              <input type="file" name="alurfile" id="alur" class="form-control" accept="application/pdf">
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