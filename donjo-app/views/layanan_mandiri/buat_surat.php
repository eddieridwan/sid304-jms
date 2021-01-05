<script type='text/javascript'>
	const LOKASI_DOKUMEN = '<?= base_url().LOKASI_DOKUMEN ?>';
</script>

<div class="box box-solid">
	<form id="validasi" action="<?= site_url("layanan_mandiri/surat/form/$permohonan[id]"); ?>" method="POST" enctype="multipart/form-data">

		<div class="box-header with-border bg-green">
			<h4 class="box-title">Surat</h4>
		</div>
		<div class="box-body box-line">
			<h4><b>LAYANAN PERMOHONAN SURAT</b></h4>
			<input type="hidden" id="id_permohonan" name="id_permohonan" value="<?= $permohonan['id']?>"/>
		</div>
		<div class="box-body box-line">
			<?php if ($permohonan): ?>
				<div class="alert alert-warning" role="alert">
					<span style="font-size: larger;">Lengkapi permohonan surat tanggal <?= $permohonan['updated_at']; ?></span>
				</div>
			<?php endif; ?>
			<div class="form-group">
				<label for="nama_surat" class="col-sm-3 control-label">Jenis Surat Yang Dimohon</label>
				<div class="col-sm-9">
					<select class="form-control select2 required" name="id_surat" id="id_surat">
						<option value=""> -- Pilih Jenis Surat -- </option>
						<?php foreach ($menu_surat_mandiri AS $data): ?>
							<option value="<?= $data['id']?>" <?= selected($data['id'], $permohonan['id_surat'])?>><?= $data['nama']?></option>
						<?php endforeach;?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="keterangan_tambahan" class="col-sm-3 control-label">Keterangan Tambahan</label>
				<div class="col-sm-9 form-group">
					<textarea class="form-control <?= jecho($cek_anjungan['keyboard'] == 1, TRUE, 'kbvtext'); ?>" name="keterangan" id="keterangan" placeholder="Ketik di sini untuk memberikan keterangan tambahan."><?= $permohonan['keterangan']; ?></textarea>
				</div>
			</div>
			<div class="form-group">
				<label for="no_hp_aktif" class="col-sm-3 control-label">No. HP aktif</label>
				<div class="col-sm-9">
					<input class="form-control bilangan_spasi required <?= jecho($cek_anjungan['keyboard'] == 1, TRUE, 'kbvnumber'); ?>" type="text" name="no_hp_aktif" id="no_hp_aktif" placeholder="Ketik No. HP" maxlength="14" value="<?= 979789797//$permohonan['no_hp_aktif']; ?>" />
				</div>
			</div>
		</div>

		<!-- Kelengkapan Dokumen Yang Dibutuhkan -->
		<div class="box-body box-line">
			<h4><b>DOKUMEN / KELENGKAPAN PENDUDUK YANG DIBUTUHKAN</b></h4>
		</div>
		<div class="box-body box-line">
			<div class="table-responsive">
				<table class="table table-bordered table-hover table-data" id="syarat_surat">
					<thead>
						<tr>
							<th><center>No</center></th>
							<th><center>Syarat</center></th>
							<th><center>Dokumen Melengkapi Syarat</center></th>
						</tr>
					</thead>
				</table>
			</div>
			<div class="col-xs-12">
				<button type="reset" class="btn btn-social btn-sm btn-danger"><i class="fa fa-times"></i> Batal</button>
				<button type="submit" class="btn btn-social btn-primary btn-sm pull-right" id="isi_form"><i class="fa fa-sign-in"></i>Isi Form</button>
			</div>
		</div>
	</form>

	<!-- Kelengkapan Dokumen Yang Dimiliki -->
	<div class="box-body box-line">
		<h4><b>DOKUMEN / KELENGKAPAN PENDUDUK YANG DIBUTUHKAN</b></h4>
	</div>
	<div class="box-body box-line">
		<button type="button" title="Tambah Dokumen" data-remote="false" data-toggle="modal" data-target="#modal" data-title="Tambah Dokumen" class="btn btn-social bg-olive btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" id="tambah_dokumen"><i class='fa fa-plus'></i>Tambah Dokumen</button>
	</div>
	<div class="box-body box-line">
		<div class="table-responsive">
			<table class="table table-bordered table-hover table-data" id="dokumen">
				<thead>
					<tr>
						<th>No</th>
						<th>Aksi</th>
						<th>Judul Dokumen</th>
						<th>Jenis Dokumen</th>
						<th width="20%" nowrap>Tanggal Upload</th>
					</tr>
				</thead>
				<tbody id="list_dokumen">
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="modal fade in" id="dialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header btn-danger">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
				<h4 class="modal-title" id="myModalLabel"><i class="fa fa-exclamation-triangle"></i> &nbsp;Peringatan</h4>
			</div>
			<div class="modal-body">
				<p id="kata_peringatan"></p>
			</div>
			<div class="modal-footer">
				<button class="btn btn-social btn-danger btn-sm" data-dismiss="modal"><i class='fa fa-sign-out'></i> Tutup</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class='modal-dialog'>
		<div class='modal-content'>
			<div class='modal-header'>
				<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
				<h4 class='modal-title' id='myModalLabel'>Tambah dokumen</h4>
			</div>
			<form id="unggah_dokumen" action="" method="POST" enctype="multipart/form-data">
				<div class='modal-body'>
					<div class="form-group">
						<label for="nama_dokumen">Nama / Jenis Dokumen</label>
						<input id="nama_dokumen" name="nama" class="form-control input-sm required <?= jecho($cek_anjungan['keyboard'] == 1, TRUE, 'kbvtext'); ?>" type="text" placeholder="Nama Dokumen" value=""/>
						<input type="text" class="hidden" name="id" id="id_dokumen" value=""/>
					</div>
					<div class="form-group">
						<select class="form-control required input-sm" name="id_syarat" id="id_syarat">
							<option> -- Pilih Jenis Dokumen -- </option>
							<?php foreach ($menu_dokumen_mandiri AS $data): ?>
								<option value="<?= $data['ref_syarat_id']?>" ><?= $data['ref_syarat_nama']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<label for="file" >Pilih File:</label>
						<div class="input-group input-group-sm">
							<input type="text" class="form-control" id="file_path" name="satuan">
							<input type="file" class="hidden" id="file" name="satuan">
							<span class="input-group-btn">
								<button type="button" class="btn btn-info btn-flat btn-sm" id="file_browser"><i class="fa fa-search"></i> Browse</button>
							</span>
						</div>
						<span class="help-block"><code>Kosongkan jika tidak ingin mengubah dokumen.</code></span>
					</div>
					<?php if (!empty($kk)): ?>
						<hr>
						<span class="help-block"><code>Centang jika dokumen yang diupload berlaku juga untuk anggota keluarga di bawah ini.</code></span>
						<table class="table table-striped table-bordered table-responsive">
							<thead>
								<tr>
									<th scope="col">#</th>
									<th scope="col">NIK</th>
									<th scope="col">Nama</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($kk as $item): ?>
									<?php if ($item['nik'] != $penduduk['nik']): ?>
										<tr>
											<td><input class='anggota_kk' id="anggota_<?=$item['id']?>" type='checkbox' name='anggota_kk[]' value="<?=$item['id']?>"></td>
											<td><?=$item['nik']?></td>
											<td><?=$item['nama']?></td>
										</tr>
									<?php endif; ?>
								<?php endforeach; ?>
							</tbody>
						</table>
					<?php endif ?>
				</div>
				<div class="modal-footer">
					<button type="reset" class="btn btn-social btn-flat btn-danger btn-sm"><i class='fa fa-times'></i> Tutup</button>
					<button type="submit" class="btn btn-social btn-flat btn-info btn-sm" id="upload_btn"><i class='fa fa-check'></i> Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script type='text/javascript'>
	function cek_perhatian(elem) {
		if ($(elem).val() == '-1') {
			$(elem).next('.perhatian').show();
		} else {
			$(elem).next('.perhatian').hide();
		}
	}

	$(document).ready(function(){
		// var id_surat = 0;
		var url = "<?= base_url('layanan_mandiri/surat/cek_syarat'); ?>";
		table = $('#syarat_surat').DataTable({
			'processing': true,
			'serverSide': true,
			'paging': false,
			'info': false,
			'ordering': false,
			'searching': false,
			"ajax": {
				"url": url,
				"type": "POST",
				data: function ( d ) {
					d.id_surat = $("#id_surat").val();
					d.id_permohonan = $("#id_permohonan").val();
				}
			},
			//Set column definition initialisation properties.
			"columnDefs": [
			{
				"targets": [ 0 ], //first column / numbering column
				"orderable": false, //set not orderable
			},
			],
			'language': {
				'url': BASE_URL + '/assets/bootstrap/js/dataTables.indonesian.lang'
			},
			'drawCallback': function (){
				$('.dataTables_paginate > .pagination').addClass('pagination-sm no-margin');
			}
		});

		$('#id_surat').change(function(){
			table.ajax.reload();
		});

		// Perbaharui daftar pilihan dokumen setelah ada perubahan daftar dokumen yg tersedia
		// Beri tenggang waktu supaya database dokumen selesai di-initialise
		setTimeout(function() {
			// Ambil instance dari datatable yg sudah ada
			var dokumen = $('#dokumen').DataTable({"retrieve": true});
			dokumen.on( 'draw', function () {
				table.ajax.reload();
			} );
		}, 500);

		if ($('input[name=id_permohonan]').val()) {
			$('#id_surat').attr('disabled','disabled');
			$('#id_surat').change();
		}

		$('#validasi').submit(function() {
			var validator = $("#validasi").validate();
			var syarat = $("select[name='syarat[]']");
			var i;
			for (i = 0; i < syarat.length; i++) {
				if (!validator.element(syarat[i])) {
					$("#kata_peringatan").text('Syarat belum dilengkapi');
					$("#dialog").modal('show');
					return false;
				}
			};
		});
	});
</script>
