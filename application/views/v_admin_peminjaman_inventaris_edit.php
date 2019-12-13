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
				  <?php echo form_open_multipart("admin/peminjamaninv_aksi_ubah/$tbl_peminjaman_inventaris->id_peminjaman"); ?>
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
								<td>ID Inventaris</td>
								<td>:</td>
								<td><?php echo $tbl_peminjaman_inventaris->kode_inventaris;?></td>
							</tr>
							<tr>
								<td>Nama Inventaris</td>
								<td>:</td>
								<td><?php echo $tbl_peminjaman_inventaris->nama_inventaris;?></td>
							</tr>
							<tr>
								<td>Keterangan</td>
								<td>:</td>
								<td><?php echo $tbl_peminjaman_inventaris->keterangan;?></td>
							</tr>
							<?php if($this->uri->segment(4)=="konfirmasi"){?>
							<tr>
								<td>Tanggal Peminjaman</td>
								<td>:</td>
								<td><input type="text" name="tanggal_peminjaman" class="form-control" value="" /></td>
							</tr>
							<tr>
								<td>Konfirmasi Peminjaman</td>
								<td>:</td>
								<td>
									<input type="radio" name="konfirmasi_peminjaman" class="flat-red" value="0"  /> Batal Pinjam
									<input type="radio" name="konfirmasi_peminjaman" class="flat-red" value="1" checked /> Konfirmasi
								</td>
							</tr>
							<?php } ?>
							
							<?php if($this->uri->segment(4)=="kembali"){?>
							<tr>
								<td>Tanggal Kembali</td>
								<td>:</td>
								<td><input type="text" name="tanggal_kembali" class="form-control" value="" /></td>
							</tr>
							<tr>
								<td>Konfirmasi Peminjaman</td>
								<td>:</td>
								<td>
									<input type="radio" name="konfirmasi_kembali" class="flat-red" value="0"  /> Batal Pinjam
									<input type="radio" name="konfirmasi_kembali" class="flat-red" value="1"  checked /> Sudah Kembali
								</td>
							</tr>
							<?php } ?>
						</table>
					  <div class="form-group">
						<input type="submit" value="Submit" class="btn btn-success">
					  </div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						<label>Foto User</label>
						<img width="220px" class="img img-responsive user-image" src="<?php echo base_url();?>assets/dist/img/avatar/<?php echo $tbl_peminjaman_inventaris->foto_user."?".strtotime("now");?>">
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