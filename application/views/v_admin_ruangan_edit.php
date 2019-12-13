  <div class="content-wrapper" >
    <section class="content-header">
      <h3>
        Ubah Ruangan
      </h3>
    </section>
 <!-- Main content -->
    <section class="content" >
      <div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">
						<span>Silahkan melengkapi form berikut</span>
					</h3>
					<?php 
					if($err==1){
							$kode_ruangan = $kode_ruangan;
							$nama_ruangan = $nama_ruangan;
							$keterangan_ruangan = $keterangan_ruangan;
					?>
						<p style="color:red;"><i>ID Ruangan sudah digunakan, silahkan coba yang lain.</i></p>
					<?php 
					}else{
							$kode_ruangan = $tbl_ruangan->kode_ruangan;
							$nama_ruangan = $tbl_ruangan->nama_ruangan;
							$keterangan_ruangan = $tbl_ruangan->keterangan_ruangan;
					}?>
				</div>
				<div class="box-body">
				  <div class="row">
				  <?php echo form_open_multipart("admin/ruangan_aksi_ubah/$tbl_ruangan->id_ruangan"); ?>
					<div class="col-md-4">
					  <div class="form-group">
						<label>ID Ruangan</label>
						<input type="text" class="form-control" name="kode_ruangan[]" placeholder="ID Ruangan, Contoh : Labor01" value="<?php echo $kode_ruangan;?>" required>
						<input type="hidden" class="form-control" name="kode_ruangan[]" value="<?php echo $tbl_ruangan->kode_ruangan;?>" >
					  </div>
					  <div class="form-group">
						<label>Nama Ruangan</label>
						<input type="text" class="form-control" name="nama_ruangan" placeholder="Nama Ruangan, Contoh : Labor Komputer A" value="<?php echo $nama_ruangan;?>" required>
					  </div>
					  <div class="form-group">
						<label>Keterangan</label>
						<input type="text" class="form-control" name="keterangan_ruangan" placeholder="Keterangan Ruangan, Contoh : Kelengkapan.........." value="<?php echo $keterangan_ruangan;?>" required>
					  </div>
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