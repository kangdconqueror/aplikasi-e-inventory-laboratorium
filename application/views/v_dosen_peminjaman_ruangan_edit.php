  <div class="content-wrapper" >
    <section class="content-header">
      <h3>
        Aksi Peminjaman Ruangan
      </h3>
    </section>
 <!-- Main content -->
    <section class="content" >
      <div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-body">
				  <div class="row">
				  <?php echo form_open_multipart("dosen/peminjamanruang_aksi_ubah/$tbl_peminjaman_ruangan->id_peminjaman/$tbl_peminjaman_ruangan->tanggal_peminjaman"); ?>
					<div class="col-md-6">
						<table class="table table-bordered">
							<tr>
								<th>ID Peminjaman</th>
								<th>:</th>
								<th><?php echo $tbl_peminjaman_ruangan->kode_peminjaman;?></th>
							</tr>
							<tr>
								<td>ID Peminjam</td>
								<td>:</td>
								<td><?php echo $tbl_peminjaman_ruangan->kodepeminjam_user;?></td>
							</tr>
							<tr>
								<td>Nama Peminjam</td>
								<td>:</td>
								<td><?php echo $tbl_peminjaman_ruangan->nama_user;?></td>
							</tr>
							<tr>
								<td>ID Ruangan</td>
								<td>:</td>
								<td><?php echo $tbl_peminjaman_ruangan->kode_ruangan;?><input type="hidden" name="kode_ruangan" value="<?php echo $tbl_peminjaman_ruangan->kode_ruangan;?>"></td>
							</tr>
							<tr>
								<td>Nama Ruangan</td>
								<td>:</td>
								<td><?php echo $tbl_peminjaman_ruangan->nama_ruangan;?></td>
							</tr>
							<tr>
								<td>Keterangan</td>
								<td>:</td>
								<td><?php echo $tbl_peminjaman_ruangan->keterangan;?></td>
							</tr>
							<tr>
								<td>Tanggal Peminjaman</td>
								<td>:</td>
								<td><?php echo $tbl_peminjaman_ruangan->tanggal_peminjaman;?></td>
							</tr>
							<tr>
								<td>Waktu</td>
								<td>:</td>
								<td><?php echo $tbl_peminjaman_ruangan->jadwal;?></td>
							</tr>
							<tr>
								<td>Konfirmasi Peminjaman</td>
								<td>:</td>
								<td>
									<input type="radio" name="status_peminjaman" value="2"  /> Batal Pinjam
									<input type="radio" name="status_peminjaman" value="0" checked /> Konfirmasi
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