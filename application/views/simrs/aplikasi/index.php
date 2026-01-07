<!-- Final Version of Primary Filter & Table of All Minta Aplikasi -->
<!-- Custom Styling -->
<style>
  .select2-container .select2-selection--single { height: 34px !important; }
  .select2-container--default .select2-selection--single .select2-selection__rendered { 
    line-height: 32px !important; 
    padding-left: 12px; 
  }
  .select2-container--default .select2-selection--single .select2-selection__arrow { height: 32px !important; }
  .table th, .table td {
    vertical-align: middle !important;
  }
  .dt-buttons, #table-export_filter, div.dataTables_wrapper div.dataTables_paginate {
    display: none !important;
  }
</style>
<!-- Wrapper Panel on Filter Section Panel -->
<section class="panel">
  <header class="panel-heading">
    <h4 class="panel-title"><i class="far fa-edit"></i> Input Tanggal</h4>
  </header>
  <form id="laporanForm">
    <div class="row" style="margin:0 1px">
      <!-- Tanggal Awal -->
      <div class="col-lg-5 mb-5" style="margin:10px 0;">
        <label for="start_date" class="form-label">Tanggal Awal</label>
        <input type="date" class="form-control" id="start_date" name="start_date" required>
      </div>
      <!-- Tanggal Akhir -->
      <div class="col-lg-5 mb-5" style="margin:10px 0;">
        <label for="final_date" class="form-label">Tanggal Akhir</label>
        <input type="date" class="form-control" id="final_date" name="final_date" required>
      </div>
      <!-- Filter Button -->
      <div class="col-lg-2 mb-2" style="margin:36px 0;">
        <button type="submit" class="btn btn-primary w-100" id="generate">
          <i class="fas fa-search"></i>
        </button>
      </div>
    </div>
  </form>
</section>
<!-- Wrapper Panel Tabel on Histori Minta Aplikasi Instalasi -->
<section class="panel">
  <div class="table-responsive" style="margin: 10px">
    <!-- Tabel Minta Aplikasi -->
    <table class="table table-bordered table-hover table-condensed" cellspacing="0" width="100%" id="table-export">
      <thead>
        <tr>
          <th class="text-center">Tanggal Pengajuan</th>
          <th class="text-center">Instalasi</th>
          <th class="text-center">Pengusul</th>
          <th class="text-center">Judul</th>
          <th class="text-center">Surat</th>
          <th class="text-center">Alur</th>
          <th class="text-center">Detail</th>
        </tr>
      </thead>
      <tbody id="laporan-body"></tbody>
    </table>
  </div>
</section>

<?php echo form_open('simrs/aplikasi/selesai'); ?>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <!-- Modal Content -->
    <div class="modal-content">
      <!-- Modal Panel Header -->
      <div class="modal-header">
        <p class="lead" style="color:black">Update Status Permintaan Data</p>
      </div>
      <!-- Modal Panel Content -->
      <div class="modal-body">
        <!-- Kode Permintaan -->
        <div class="form-group">
          <label for="uuid" class="form-label">Kode Permintaan Data</label>
          <input type="text" name="uuid" id="uuid" class="form-control" readonly>
        </div>
        <!-- Update Status -->
        <div class="form-group">
          <label for="status" class="form-label">Status Permintaan Data</label>
          <select name="status" id="status" class="form-control">
            <option value="Pending" selected>Usulan Aplikasi Pending</option>
            <option value="Kondisional">Usulan Aplikasi Kondisional</option>
            <option value="Terima">Usulan Aplikasi Terima</option>
          </select>
        </div>
        <!-- Alasan -->
        <div class="form-group" style="display: none;" id="alasan_section">
          <label for="alasan" class="form-label">Alasan Kondisional</label>
          <input type="text" name="alasan" id="alasan" class="form-control" readonly>
        </div>
      </div>
      <!-- Modal Panel Footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">Tutup</button>
        <button class="btn btn-dark" type="submit">
          <i class="fas fa-plus-circle"></i>&nbsp;&nbsp;<span>OK</span>
        </button>
      </div>
    </div>
  </div>
</div>
<?php echo form_close(); ?>

<script>
  // Insert Table to Our Script
  $(document).ready(function () {
    // Tanggal Awal dan Akhir
    const today = new Date();
    const sevenDaysAgo = new Date();
    sevenDaysAgo.setDate(today.getDate() - 7);
    const formatDate = (date) => date.toISOString().split("T")[0];
    $('#start_date').val(formatDate(sevenDaysAgo));
    $('#final_date').val(formatDate(today));
    // Auto on Ready
    loadLaporan();
    // Perform Submit Filter
    $('#laporanForm').submit(function (e) {
      e.preventDefault();
      loadLaporan();
    });
    // Load Laporan Function
    function loadLaporan() {
      const start = $('#start_date').val();
      const final = $('#final_date').val();
      // Controller
      $.ajax({
        url: "<?= base_url('simrs/aplikasi/tabel_historia') ?>",
        type: "GET",
        data: {start: start, final: final},
        dataType: "json",
        success: function (data) {
          const $laporanBody = $('#laporan-body');
          // Check Data & Handle Empty
          if (!data || data.length === 0) {
            const emptyRow = `
              <tr>
                <td colspan="7" class="text-center">
                  Data Permintaan Aplikasi Pada Instalasi ini Tidak Tersedia !
                </td>
              </tr>`;
            $laporanBody.html(emptyRow);
            return;
          }
          // Data Available
          const createRow = (row) => {
            let actions = '';
            // Detail Minta Aplikasi
            actions += `
              <a href="<?= base_url('user/aplikasi/detail/'); ?>${row.uuid}" class="btn btn-warning btn-circle icon">
                <i class="fas fa-eye"></i>
              </a>
            `;
            // Fitur Edit Selagi Belum Terima (Pending & Kondisional)
            if (row.status != "Terima") {
              actions += `
              <a href="#" class="btn btn-circle icon btn-success" data-toggle="modal" data-target="#exampleModal" data-uuid="${row.uuid}">
                <i class="fas fa-pen"></i>
              </a>
              `;
            }
            // Define Modal & Delete Option
            if (row.status === 'Pengajuan') {
              actions += `
                <a href="<?= base_url('user/aplikasi/delete/'); ?>${row.uuid}"
                  class="btn btn-circle icon btn-danger"
                  onclick="return confirm('Yakin Ingin Menghapus Permintaan Aplikasi ?')">
                  <i class="fa fa-trash"></i>
                </a>
              `;
            }
            // Return Complete Row
            return `
              <tr class="text-center">
                <td>${row.tanggal_pengajuan}</td>
                <td>${row.unit}</td>
                <td>${row.pengusul}</td>
                <td>${row.judul}</td>
                <td>
                  <a href="<?= base_url('uploads/aplikasi/aplikasi/surat/'); ?>${row.surat}"
                    class="btn btn-circle icon btn-info"
                    target="_blank">
                    <i class="fas fa-file"></i>
                  </a>
                </td>
                <td>
                  <a href="<?= base_url('uploads/aplikasi/aplikasi/alur/'); ?>${row.alur}"
                    class="btn btn-circle icon btn-info"
                    target="_blank">
                    <i class="fas fa-file"></i>
                  </a>
                </td>
                <td>${actions}</td>
              </tr>
            `;
          };
          const allRows = data.map(row => createRow(row)).join('');
          $laporanBody.html(allRows);
        },
        error: function (jqXHR, textStatus, errorThrown) {
          Swal.fire({
            type: 'error',
            title: 'Operasi Gagal !',
            text: "Terjadi Kegagalan Pada Aplikasi ! Hubungi Pihak SIMRS !",
            confirmButtonText: 'OK'
          });
        }
      })
    }
    // ?
    $('#exampleModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget); 
      var uuid = button.data('uuid');
      var modalInput = $(this).find('#uuid');
      modalInput.val(uuid);
    });
    // ?
    $('#exampleModal').on('shown.bs.modal', function () {
      $('#status').select2({
        dropdownParent: $('#exampleModal')
      });
    });
    // ?
    $('#status').on('change', function() {
      var selectedStatus = $(this).val();
      if (selectedStatus === 'Kondisional') {
        $('#alasan_section').show();
        $('#alasan').prop('readonly', false);
      } else {
        $('#alasan_section').hide();
        $('#alasan').prop('readonly', true);
      }
    });
    // Status as Select 2
    $('#status').select2({
      width: '100%'
    });
  });
</script>