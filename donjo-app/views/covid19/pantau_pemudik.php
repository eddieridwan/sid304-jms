<style>
	.input-sm
	{
		padding: 4px 4px;
	}
</style>
<div class="content-wrapper">
	<section class="content-header">
		<h1>Pantau Isolasi Mandiri Saat Pandemi Covid-19</h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('hom_sid')?>"><i class="fa fa-home"></i> Home</a></li>
			<li class="active">Data Pemudik</li>
		</ol>
	</section>
	
	<section class="content" id="maincontent">
		<div class="row">
			<div class="col-md-3">
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title"><strong>Form Pemantauan</strong></h3>
						
					</div>
					<div class="box-body">
						<form>
							<div class="form-group">
								<label for="nama">Data H+</label>
								<select class="form-control input-sm" name="nama">
									<option>-- Pilih Waktu Pasca Kedatangan --</option>
								</select>
								<small id="nama_msg" class="form-text text-muted"></small>
							</div>
							<div class="form-group">
								<label for="nama">NIK/Nama</label>
								<select class="form-control input-sm" name="nama">
									<option>-- Pilih Warga Pemudik --</option>
								</select>
								<small id="nama_msg" class="form-text text-muted"></small>
							</div>
						  	<div class="form-group">
						    	<label for="tgl_jam">Tanggal/Jam</label>
						    	<input type="text" class="form-control input-sm" name="tgl_jam">
						    	<small id="tgl_jam_msg" class="form-text text-muted"></small>
						  	</div>
						  	<div class="form-group">
						    	<label for="suhu">Suhu Tubuh</label>
						    	<input type="text" class="form-control input-sm" name="suhu">
						    	<small id="suhu_msg" class="form-text text-muted"></small>
						  	</div>
						  	<div class="table-responsive-sm">
						  		<table class="table table-borderless table-sm">
								  	<thead>
								    	<tr>
								      		<th colspan="2" class="text-left">Centang jika mengalami kondisi berikut</th>
							    		</tr>
								  	</thead>
								  	<tbody>
								    	<tr>
								      		<td width="20%" class="text-center">
								      			<input type="checkbox" class="form-check-input" >
								      		</td>
								      		<td>Batuk</td>
							    		</tr>
							    		<tr>
								      		<td width="20%" class="text-center">
								      			<input type="checkbox" class="form-check-input" >
								      		</td>
								      		<td>Flu</td>
							    		</tr>
							    		<tr>
								      		<td width="20%" class="text-center">
								      			<input type="checkbox" class="form-check-input" >
								      		</td>
								      		<td>Sesak nafas</td>
							    		</tr>
									</tbody>
								</table>
							</div>
							<div class="form-group">
						    	<label for="keluhan">Keluhan Lain</label>
						    	<textarea name="keluhan" class="form-control input-sm" rows="2"></textarea>
						    	<small id="keluhan_msg" class="form-text text-muted"></small>
						  	</div>

						</form>
					</div>

					<div class="box-footer">
						<div class="box-tools pull-right">
							<button type="submit" class="btn btn-sm btn-primary">Simpan</button>
						</div>
			 	 	</div>

				</div>
			</div>
			<div class="col-md-9">
				<div class="box box-info">
					<div class="box-header with-border">
						<a href="<?= site_url("covid19/unduhsheet")?>" class="btn btn-social btn-flat bg-navy btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Unduh Data" target="_blank"><i class="fa fa-download"></i> Unduh</a>
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-sm-12">
								<div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
									<form id="mainform" name="mainform" action="" method="post">
										<div class="row">
											<div class="col-sm-12">
												<div class="table-responsive">
													<table class="table table-bordered dataTable table-striped table-hover">
														<thead class="bg-gray disabled color-palette">
															<tr>
																<th>No</th>
																<th>Aksi</th>
																<th>NIK</th>
																<th>Nama</th>
																<th>Usia</th>
																<th>JK</th>
																<th>Kondisi Pemantauan Terakhir</th>
																<th>Status</th>
															</tr>
														</thead>
														<tbody>
														<?php
															$nomer = $paging->offset;
															if (is_array($terdata)):
																foreach ($terdata as $key=>$item):
																	$nomer++;
														?>
															<tr>
																<td align="center" width="2"><?= $nomer; ?></td>
																<td nowrap>
																	<?php if ($this->CI->cek_hak_akses('h')): ?>
																		<a href="<?= site_url("covid19/edit_pemudik_form/$item[id]")?>" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Ubah Data Pemudik" title="Ubah Data Pemudik" class="btn btn-warning btn-flat btn-xs"><i class="fa fa-list"></i></a>
																		<a href="#" data-href="<?= site_url("covid19/hapus_pemudik/$item[id]")?>" class="btn bg-green btn-flat btn-xs" title="Unduh Data" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-download"></i></a>
																	<?php endif; ?>
																</td>
																<td><?= $item["terdata_nama"] ?></td>
																<td nowrap><a href="<?= site_url('covid19/detil_pemudik/'.$item["id"])?>" title="Data terdata"><?= $item['terdata_info'];?></a></td>
																<td><?= $item["umur"] ?></td>
																<?php
																$jk = (strtoupper($item['sex']) === "PEREMPUAN") ? "Pr" : "Lk"; 
																?>
																<td><?= $jk?></td>
																<td><?= $item["tanggal_datang"];?></td>
																<td><?= $item["status_covid"];?></td>
															</tr>
														<?php
															endforeach;
															endif;
														?>
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</form>
									<div class="row">
										<div class="col-sm-6">
											<div class="dataTables_length">
												<form id="paging" action="" method="post" class="form-horizontal">
													<label>
														Tampilkan
														<select name="per_page" class="form-control input-sm" onchange="$('#paging').submit()">
															<option value="10" <?php selected($per_page,10); ?> >10</option>
															<option value="100" <?php selected($per_page,100); ?> >100</option>
															<option value="200" <?php selected($per_page,200); ?> >200</option>
														</select>
														Dari
														<strong><?= $paging->num_rows?></strong>
														Total Data
													</label>
												</form>
											</div>
										</div>
										<div class="col-sm-6">
					                      	<div class="dataTables_paginate paging_simple_numbers">
					                        	<ul class="pagination">
				                        		<?php if ($paging->start_link): ?>
						                            <li>
						                            	<a href="<?=site_url('covid19/data_pemudik/'.$paging->start_link)?>" aria-label="First"><span aria-hidden="true">Awal</span></a>
						                            </li>
					                          	<?php endif; ?>

					                          	<?php if ($paging->prev): ?>
						                            <li>
						                            	<a href="<?=site_url('covid19/data_pemudik/'.$paging->prev)?>" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a>
						                            </li>
					                          	<?php endif; ?>

					                          	<?php for ($i=$paging->start_link;$i<=$paging->end_link;$i++): ?>
						               	            <li <?=jecho($p, $i, "class='active'")?>>
						               	            	<a href="<?= site_url('covid19/data_pemudik/'.$i)?>"><?= $i?></a>
					               	            	</li>
					                          	<?php endfor; ?>

					                          	<?php if ($paging->next): ?>
						                            <li>
						                            	<a href="<?=site_url('covid19/data_pemudik/'.$paging->next)?>" aria-label="Next"><span aria-hidden="true">&raquo;</span></a>
						                            </li>
					                          	<?php endif; ?>

					                          	<?php if ($paging->end_link): ?>
						                            <li>
						                            	<a href="<?=site_url('covid19/data_pemudik/'.$paging->end_link)?>" aria-label="Last"><span aria-hidden="true">Akhir</span></a>
						                            </li>
					                          	<?php endif; ?>
					                         
					                        	</ul>
					                     	 </div>
                    					</div>
                					</div>
                				</div>
                			</div>
                		</div>
                	</div>
				</div>
			</div>
		</div>
	</section>
</div>


<!-- MODAL DIALOG -->
<div class='modal fade' id='confirm-delete' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
	<div class='modal-dialog'>
		<div class='modal-content'>
			<div class='modal-header'>
				<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
				<h4 class='modal-title' id='myModalLabel'><i class='fa fa-exclamation-triangle text-red'></i> Konfirmasi</h4>
			</div>
			<div class='modal-body btn-info'>
				Apakah Anda yakin ingin menghapus data ini?
			</div>
			<div class='modal-footer'>
				<button type="button" class="btn btn-social btn-flat btn-warning btn-sm" data-dismiss="modal"><i class='fa fa-sign-out'></i> Tutup</button>
				<a class='btn-ok'>
					<button type="button" class="btn btn-social btn-flat btn-danger btn-sm" id="ok-delete"><i class='fa fa-trash-o'></i> Hapus</button>
				</a>
			</div>
		</div>
	</div>
</div>

<div  class="modal fade" id="modalBox" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class='modal-dialog'>
		<div class='modal-content'>
			<div class='modal-header'>
				<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
				<h4 class='modal-title' id='myModalLabel'></h4>
			</div>
			<div class="fetched-data"></div>
		</div>
	</div>
</div>