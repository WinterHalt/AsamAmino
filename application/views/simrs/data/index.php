<!-- Final Version of Main File -->
<!-- Custom Styling -->
<style>
  .table th, .table td {
    vertical-align: middle !important;
  }
  .dt-buttons, #table-export_filter, div.dataTables_wrapper div.dataTables_paginate {
    display: none !important;
  }
  .select2-container .select2-selection { height: 38px; }
  .select2-container--default .select2-selection--single .select2-selection__rendered { margin-top: 3px; }
  .select2-container--default .select2-selection--single .select2-selection__arrow { display: none; }
</style>
<!-- Wrapper Panel on User Table to Support Minta Data -->
<section class="panel">
  <!-- Tabel Panel -->
  <div class="table-responsive" style="margin: 10px">
    <!-- Tabel Histori User Minta Data -->
    <table class="table table-bordered table-hover table-condensed" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th class="text-center">Tanggal</th>
          <th class="text-center">User</th>
          <th class="text-center">Telephone</th>
          <th class="text-center">Status</th>
          <th class="text-center">File</th>
          <th class="text-center">Detail</th>
        </tr>
      </thead>
      <!-- Tabel Body -->
      <tbody>
        <?php foreach ($result as $row): ?>
          <tr>
            <td class="text-center"><?php echo html_escape($row['tanggal']); ?></td>
            <td class="text-center"><?php echo html_escape($row['name']); ?></td>
            <td class="text-center"><?php echo html_escape($row['telephone']); ?></td>
            <td class="text-center"><?php echo html_escape($row['status']); ?></td>
            <!-- File Upload -->
            <td class="text-center">
              <a href="<?= base_url('uploads/aplikasi/data/' . $row['uploadfiles']); ?>" class="btn btn-circle icon btn-info" target="_blank">
                <i class="fas fa-file"></i>
              </a>
            </td>
            <!-- Multi Variable -->
            <td class="text-center">
              <!-- Modal Merubah Status Permintaan -->
              <?php if ($row['status'] == 'Pending'): ?>
              <a href="#" class="btn btn-circle icon btn-success" data-toggle="modal" data-target="#exampleModal" data-uuid="<?= html_escape($row['uuid']); ?>">
                <i class="fas fa-pen"></i>
              </a>
              <?php endif; ?>
              <!-- Detail Kegiatan -->
              <a href="<?= base_url('simrs/data/detail/' . $row['uuid']); ?>" class="btn btn-circle icon btn-warning">
                <i class="fas fa-eye"></i>
              </a>
              <!-- Delete if Status is Pending -->
              <?php if ($row['status'] == 'Pending'): ?>
                <?= btn_delete('simrs/data/delete/' . $row['uuid']); ?>
              <?php endif; ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</section>

<!-- Modal to Perform Status Update -->
<?php echo form_open('simrs/data/selesai'); ?>
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
            <option value="Pending">Pending</option>
            <option value="Tolak">Penolakan</option>
            <option value="Terima">Penerimaan</option>
          </select>
        </div>
        <!-- Alasan -->
        <div class="form-group" style="display: none;" id="alasan_section">
          <label for="alasan" class="form-label">Alasan Penolakan</label>
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
$(document).ready(function() {
  // Show Modal
  $('#exampleModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); 
    var uuid = button.data('uuid');
    var modalInput = $(this).find('#uuid');
    modalInput.val(uuid);
  });
  // Show Alasan if Status is Tolak
  $('#status').on('change', function() {
    var selectedStatus = $(this).val();
    if (selectedStatus === 'Tolak') {
      $('#alasan_section').show();
      $('#alasan').prop('readonly', false);
    } else {
      $('#alasan_section').hide();
      $('#alasan').prop('readonly', true);
    }
  });
  // Status as Select 2
  $('#status').select2({
    width: '100%',
    dropdownParent: $('#exampleModal')
  });
});
</script>