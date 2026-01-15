<!-- Final Version of SIMRS Dashboard File Template -->
<!-- Panel Pelaporan in Digit -->
<section class="panel bg-white shadow-sm border rounded">
  <div class="row">
    <!-- Berapa Input Total Kegiatan Permintaan Data ? -->
    <div class="col-md-4 border-responsive" style="height: 100px;">
      <div style="text-align: center; padding-top: 10px;">
        <p class="text-dark fw-bold fs-4 mb-2">Total Kegiatan Minta Data</p>
        <!-- Total -->
        <h2 class="display-5 fw-bold text-warning mb-3">
          <?php echo $total_minta_data; ?>
        </h2>
      </div>
    </div>
    <!-- Berapa Input Total Kegiatan Permintaan Aplikasi ? -->
    <div class="col-md-4 border-responsive" style="height: 100px;">
      <div style="text-align: center; padding-top: 10px;">
        <p class="text-dark fw-bold fs-4 mb-2">Total Minta Aplikasi</p>
        <!-- Total -->
        <h2 class="display-5 fw-bold text-warning mb-3">
          <?php echo $total_minta_aplikasi; ?>
        </h2>
      </div>
    </div>
    <!-- Berapa Input Total Pelaporan Masalah ? -->
    <div class="col-md-4" style="height: 100px;">
      <div style="text-align: center; padding-top: 10px;">
        <p class="text-dark fw-bold fs-4 mb-2">Total Pelaporan Masalah</p>
        <!-- Total -->
        <h2 class="display-5 fw-bold text-warning mb-3">
          <?php echo $total_pelaporan_masalah; ?>
        </h2>
      </div>
    </div>
  </div>
</section>

<!-- Panel Pelaporan in Digit -->
<section class="panel bg-white shadow-sm border rounded">
  <div class="row">
    <!-- Berapa Input Total Kegiatan Permintaan Data ? -->
    <div class="col-md-4 border-responsive" style="height: 100px;">
      <div style="text-align: center; padding-top: 10px;">
        <p class="text-dark fw-bold fs-4 mb-2">Time to Resolve Masalah Perangkat (Menit)</p>
        <!-- Total -->
        <h2 class="display-5 fw-bold text-warning mb-3">
          30
        </h2>
      </div>
    </div>
    <!-- Berapa Input Total Kegiatan Permintaan Aplikasi ? -->
    <div class="col-md-4 border-responsive" style="height: 100px;">
      <div style="text-align: center; padding-top: 10px;">
        <p class="text-dark fw-bold fs-4 mb-2">Time to Resolve Masalah Jaringan (Menit)</p>
        <!-- Total -->
        <h2 class="display-5 fw-bold text-warning mb-3">
          5
        </h2>
      </div>
    </div>
    <!-- Berapa Input Total Pelaporan Masalah ? -->
    <div class="col-md-4" style="height: 100px;">
      <div style="text-align: center; padding-top: 10px;">
        <p class="text-dark fw-bold fs-4 mb-2">Time to Resolve Masalah Aplikasi (Menit)</p>
        <!-- Total -->
        <h2 class="display-5 fw-bold text-warning mb-3">
          10
        </h2>
      </div>
    </div>
  </div>
</section>

<!-- Panel Bar Chart Total Kategori Masalah -->
<section class="panel bg-white shadow-sm border rounded mt-4 p-4">
  <h4 class="text-dark fw-bold mb-4" style="text-align: center;">Total Kategori</h4>
  <canvas id="myDashboardChart" height="100" data-label='<?php echo $label_masalah; ?>' data-value='<?php echo $total_masalah; ?>'></canvas>
</section>

<!-- Chart JS CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Support Script Chart JS on Bar Chart -->
<script src="<?php echo base_url('assets/js/aplikasi/primary.js'); ?>"></script>