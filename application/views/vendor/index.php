<?php $currency_symbol = $global_config['currency_symbol']; ?>
<section class="panel">
	<div class="tabs-custom">
		<ul class="nav nav-tabs">
			<li class="<?php echo (!isset($validation_error) ? 'active' : ''); ?>">
				<a href="#menu_list" data-toggle="tab" id="tab_list" name="tab_list"><i class="fas fa-list-ul"></i> Vendor <?php echo translate('list'); ?></a>
			</li>
			<?php if (get_permission('vendor', 'is_add')) { ?>
			<li class="<?php echo (isset($validation_error) ? 'active' : ''); ?>">
				<a href="#menu_create" data-toggle="tab" id="tab_create" name="tab_create"><i class="far fa-edit"></i> <?php echo translate('create'); ?> Vendor</a>
			</li>
			<?php } ?>
		</ul>
		<div class="tab-content">
			<div id="menu_list" name="menu_list" class="tab-pane <?php echo (!isset($validation_error) ? 'active' : ''); ?>">
				<div class="table-responsive mb-md">
					<div class="export_title">Vendor <?php echo translate('list'); ?></div>
					<table class="table table-bordered table-hover table-condensed" cellspacing="0" width="100%" id="list_data" name="list_data">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama</th>
								<th>Perusahaan</th>
								<th>Alamat</th>
								<th>Telepon</th>
								<th>Email</th>
								<th>Bank</th>
								<th><?php echo translate('action'); ?></th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
			<?php if (get_permission('vendor', 'is_add') || get_permission('vendor', 'is_edit')) { ?>
			<div class="tab-pane <?php echo (isset($validation_error) ? 'active' : ''); ?>" id="menu_create" name="menu_create">
				<?php echo form_open($this->uri->uri_string(), array('class' => 'form-horizontal form-bordered validate', 'id' => 'form_vendor', 'name' => 'form_vendor')); ?>
					<input type="hidden" class="form-control" id="vendor_id" name="vendor_id" />
					<input type="hidden" class="form-control" id="vendor_uuid" name="vendor_uuid" />
					<div class="form-group <?php if (form_error('name')) echo 'has-error'; ?>">
						<label class="col-md-3 control-label">Informasi Pimpinan/Pemilik</label>
					</div>
					<div class="form-group <?php if (form_error('name')) echo 'has-error'; ?>">
						<label class="col-md-3 control-label">Nama <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" id="vendor_name" name="vendor_name" placeholder="Nama Pimpinan/Pemilik" maxlength="250" required />
							<span class="error"><?php echo form_error('name'); ?></span>
						</div>
					</div>
					<div class="form-group <?php if (form_error('position')) echo 'has-error'; ?>">
						<label class="col-md-3 control-label">Posisi <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" id="position" name="position" placeholder="Posisi" maxlength="250" required />
							<span class="error"><?php echo form_error('position'); ?></span>
						</div>
					</div>
					<div class="form-group <?php if (form_error('name')) echo 'has-error'; ?>">
						<label class="col-md-3 control-label">Informasi Perusahaan</label>
					</div>
					<div class="form-group <?php if (form_error('company_name')) echo 'has-error'; ?>">
						<label class="col-md-3 control-label">Nama <span class="required">*</span></label>
						<div class="col-md-2">
							<select class="form-control" id="jenis_usaha" name="jenis_usaha"></select>
							<span class="error"><?php echo form_error('jenis_usaha'); ?></span>
						</div>
						<div class="col-md-4">
							<input type="text" class="form-control" id="company_name" name="company_name" placeholder="Nama Perusahaan" maxlength="250" required />
							<span class="error"><?php echo form_error('company_name'); ?></span>
						</div>
					</div>
					<div class="form-group <?php if (form_error('address')) echo 'has-error'; ?>">
						<label class="col-md-3 control-label">Alamat <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" id="address" name="address" placeholder="Alamat required" maxlength="250" required />
							<span class="error"><?php echo form_error('address'); ?></span>
						</div>
					</div>
					<div class="form-group <?php if (form_error('mobileno')) echo 'has-error'; ?>">
						<label class="col-md-3 control-label">No Telepon/Email <span class="required">*</span></label>
						<div class="col-md-2">
							<input type="number" class="form-control" id="mobileno" name="mobileno" placeholder="No Telepon" maxlength="25" required />
							<span class="error"><?php echo form_error('mobileno'); ?></span>
						</div>
						<div class="col-md-4">
							<input type="email" class="form-control" id="email" name="email" placeholder="Email" maxlength="100" required />
							<span class="error"><?php echo form_error('email'); ?></span>
						</div>
					</div>
					<div class="form-group <?php if (form_error('bank')) echo 'has-error'; ?>">
						<label class="col-md-3 control-label">Bank <span class="required">*</span></label>
						<div class="col-md-2">
							<select class="form-control" id="bank" name="bank"></select>
							<span class="error"><?php echo form_error('bank'); ?></span>
						</div>
						<div class="col-md-4">
							<input type="text" class="form-control" id="bank_acc" name="bank_acc" placeholder="No Rekening" maxlength="25" required />
							<span class="error"><?php echo form_error('bank_acc'); ?></span>
						</div>
					</div>
					<footer class="panel-footer">
						<div class="row">
							<div class="col-md-2 col-md-offset-3">
								<button type="submit" class="btn btn-default btn-block" id="vendor_save" name="vendor_save" value="1">
									<i class="fas fa-plus-circle"></i> <?php echo translate('save'); ?>
								</button>
							</div>
						</div>	
					</footer>
				<?php echo form_close(); ?>
			</div>
			<?php } ?>
		</div>
	</div>
</section>

<script type="text/javascript" language="javascript">
	$(document).ready(function() {
		vendor_list();
		
		<?php if (get_permission('vendor', 'is_add') || get_permission('vendor', 'is_edit')) { ?>
		$(document).on('click', '#tab_create', function(e) {
			e.preventDefault();
			$('#form_vendor :input').removeAttr('disabled');
			document.getElementById('vendor_save').style.display = 'block';
			$('#form_vendor')[0].reset();
		});
		
		$("#jenis_usaha").select2({
			placeholder: "Pilih Jenis Usaha",
			width: '100%',
			ajax: {
				url: '<?= base_url('refferal/get_jenis_usaha') ?>',
				type: "GET",
				dataType: 'JSON',
				async: false,
				encode: true,
				beforeSend: function(e) {
					if (e && e.overrideMimeType) {
						e.overrideMimeType('application/json;charset=UTF-8');
					}
				},
				cache: false,
				delay: 250,
				data: function(params) {
					return {
						searchTerm: params.term
					};
				},
				processResults: function(response) {
					return {
						results: response
					};
				}
			}
		});
		
		$("#bank").select2({
			placeholder: "Pilih Bank",
			width: '100%',
			ajax: {
				url: '<?= base_url('refferal/get_bank') ?>',
				type: "GET",
				dataType: 'JSON',
				async: false,
				encode: true,
				beforeSend: function(e) {
					if (e && e.overrideMimeType) {
						e.overrideMimeType('application/json;charset=UTF-8');
					}
				},
				cache: false,
				delay: 250,
				data: function(params) {
					return {
						searchTerm: params.term
					};
				},
				processResults: function(response) {
					return {
						results: response
					};
				}
			}
		});
		
		$(document).on('submit', '#form_vendor', function(e) {
			e.preventDefault();
			$.ajax({
				url: '<?= base_url('vendor/vendor_save') ?>',
				type: 'POST',
				dataType: 'JSON',
				async: false,
				encode: true,
				beforeSend: function(e) {
					if (e && e.overrideMimeType) {
						e.overrideMimeType('application/json;charset=UTF-8');
					}
				},
				cache: false,
				data: new FormData(this),
				contentType: false,
				processData: false,
				success: function(data) {
					if (data.status == 'success') {
						$('#form_vendor')[0].reset();
						vendor_list();
						$('a[href="#menu_list"]').tab('show');
						Swal.fire({
							title: 'Success!',
							text: data.message,
							type: 'success',
							confirmButtonText: 'OK'
						});
					} else {
						Swal.fire({
							title: 'Error!',
							html: data.message,
							type: 'error',
							confirmButtonText: 'OK'
						});
					}
				}
			});
		});
		
		$(document).on('click', '#edit_vendor', function(e) {
			e.preventDefault();
			var data_edit_vendor = $(this).attr('data_edit_vendor');
			document.getElementById('vendor_save').style.display = 'block';
			$('#form_vendor :input').removeAttr('disabled');
			$('#form_vendor')[0].reset();
			$.ajax({
				url: '<?= base_url('vendor/vendor_detil') ?>',
				type: 'POST',
				data: {
					data_edit_vendor: data_edit_vendor
				},
				dataType: 'JSON',
				async: false,
				encode: true,
				beforeSend: function(e) {
					if (e && e.overrideMimeType) {
						e.overrideMimeType('application/json;charset=UTF-8');
					}
				},
				cache: false,
				success: function(data) {
					$('#vendor_id').val(data.penyedia_id);
					$('#vendor_uuid').val(data_edit_vendor);
					$('#vendor_name').val(data.penyedia_name);
					$('#position').val(data.penyedia_position);
					let $jenis_usaha = $("<option selected='selected'></option>").val(data.jenis_usaha_id).text(data.jenis_usaha_name);
					$("#jenis_usaha").append($jenis_usaha).trigger('change');
					$('#company_name').val(data.penyedia_company_name);
					$('#address').val(data.penyedia_address);
					$('#mobileno').val(data.penyedia_mobileno);
					$('#email').val(data.penyedia_email);
					let $bank = $("<option selected='selected'></option>").val(data.bank_id).text(data.bank_name);
					$("#bank").append($bank).trigger('change');
					$('#bank_acc').val(data.penyedia_bank_acc);
					$('a[href="#menu_create"]').tab('show');
				}
			});
		});
		
		$(document).on('click', '#view_vendor', function(e) {
			e.preventDefault();
			var data_view_vendor = $(this).attr('data_view_vendor');
			$('#form_vendor')[0].reset();
			document.getElementById('vendor_save').style.display = 'none';
			$('#form_vendor :input').attr('disabled', 'disabled');
			$.ajax({
				url: '<?= base_url('vendor/vendor_detil') ?>',
				type: 'POST',
				data: {
					data_edit_vendor: data_view_vendor
				},
				dataType: 'JSON',
				async: false,
				encode: true,
				beforeSend: function(e) {
					if (e && e.overrideMimeType) {
						e.overrideMimeType('application/json;charset=UTF-8');
					}
				},
				cache: false,
				success: function(data) {
					$('#vendor_id').val(data.penyedia_id);
					$('#vendor_uuid').val(data_view_vendor);
					$('#vendor_name').val(data.penyedia_name);
					$('#position').val(data.penyedia_position);
					let $jenis_usaha = $("<option selected='selected'></option>").val(data.jenis_usaha_id).text(data.jenis_usaha_name);
					$("#jenis_usaha").append($jenis_usaha).trigger('change');
					$('#company_name').val(data.penyedia_company_name);
					$('#address').val(data.penyedia_address);
					$('#mobileno').val(data.penyedia_mobileno);
					$('#email').val(data.penyedia_email);
					let $bank = $("<option selected='selected'></option>").val(data.bank_id).text(data.bank_name);
					$("#bank").append($bank).trigger('change');
					$('#bank_acc').val(data.penyedia_bank_acc);
					$('a[href="#menu_create"]').tab('show');
				}
			});
		});
		<?php } ?>
		
		$(document).on('click', '#tab_list', function(e) {
			vendor_list();
		});
		
		function vendor_list() {
			$('#list_data').DataTable().destroy();
			var list_data = $('#list_data').DataTable({
				processing: true,
				serverSide: false,
				deferRender: true,
				ajax: {
					url: '<?= base_url('vendor/vendor_list') ?>',
					type: 'POST',
					dataType: 'JSON',
					encode: true,
					beforeSend: function(e) {
						if (e && e.overrideMimeType) {
							e.overrideMimeType('application/json;charset=UTF-8');
						}
					},
					cache: false,
					dataSrc: function(json) {
						return json.data;
					}
				},
				columnDefs: [{
					className: 'text-center',
					targets: [0, 7]
				}],
				order: [
					[2, 'asc']
				],
				pagingType: 'full_numbers',
				dom: 'Bfrtip',
				buttons: ['pageLength', 'copy', 'excel', 'pdf', 'print'],
				'bDestroy': true
			});
			list_data.on('draw.list_data', function() {
				var PageInfo = $('#list_data').DataTable().page.info();
				list_data.column(0, {
					page: 'current'
				}).nodes().each(function(cell, i) {
					cell.innerHTML = i + 1 + PageInfo.start;
				});
			});
		}
	});
</script>