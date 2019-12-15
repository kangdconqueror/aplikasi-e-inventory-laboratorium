  <div class="content-wrapper" >
    <section class="content-header">
      <h3>
        Aksi Peminjaman Inventaris
      </h3>
    </section>
 <!-- Main content -->
    <section class="content" >
      <div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-body">
				  <div class="row">
				  <?php echo form_open_multipart("dosen/peminjamaninv_aksi_ubah/$tbl_peminjaman_inventaris->id_peminjaman"); ?>
					<div class="col-md-6">
						<table class="table table-bordered">
							<tr>
								<th>ID Peminjaman</th>
								<th>:</th>
								<th><?php echo $tbl_peminjaman_inventaris->kode_peminjaman;?></th>
							</tr>
							<tr>
								<td>ID Peminjam</td>
								<td>:</td>
								<td><?php echo $tbl_peminjaman_inventaris->kodepeminjam_user;?></td>
							</tr>
							<tr>
								<td>Nama Peminjam</td>
								<td>:</td>
								<td><?php echo $tbl_peminjaman_inventaris->nama_user;?></td>
							</tr>
							<tr>
								<td>Nama Inventaris</td>
								<td>:</td>
								<td><select name="kode_inventaris[]" class="form-control select2" data-placeholder="Pilih Inventaris" required width="100%">
										<option value="<?php echo $tbl_peminjaman_inventaris->kode_inventaris;?>"><?php echo $tbl_peminjaman_inventaris->kode_inventaris;?> - <?php echo $tbl_peminjaman_inventaris->nama_inventaris;?></option>
										<?php foreach($tbl_inventaris as $inventaris){?>
										<option value="<?php echo $inventaris->kode_inventaris;?>"><?php echo $inventaris->kode_inventaris;?> - <?php echo $inventaris->nama_inventaris;?></option>
										<?php } ?>
									</select>
									<input type="hidden" name="kode_inventaris[]" value="<?php echo $tbl_peminjaman_inventaris->kode_inventaris;?>">
									</td>
							</tr>
							<tr>
								<td>Keterangan</td>
								<td>:</td>
								<td><?php echo $tbl_peminjaman_inventaris->keterangan;?></td>
							</tr>
							<tr>
								<td>Konfirmasi Peminjaman</td>
								<td>:</td>
								<td>
									<input type="radio" name="konfirmasi_peminjaman" value="0"  required /> Batal Pinjam
									<input type="radio" name="konfirmasi_peminjaman" value="1"  required /> Konfirmasi
								</td>
							</tr>
						</table>
					  <div class="form-group">
						<input type="submit" value="Submit" class="btn btn-success">
					  </div>
					</div>
					<?php echo form_close(); ?>
				  </div>
				</div>
			</div>
		</div>
      </div>
    </section>
  </div>