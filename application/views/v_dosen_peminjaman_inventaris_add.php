<style>
select + .select2-container {
  width: 100% !important;
}
</style> 
  <div class="content-wrapper" >
    <section class="content-header">
      <h3>
        Tambah Peminjaman Inventaris
      </h3>
    </section>
 <!-- Main content -->
    <section class="content" >
      <div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-body">
				  <div class="row">
				  <?php echo form_open_multipart("dosen/peminjamaninv_aksi_tambah/"); ?>
					<div class="col-md-6">
						<table class="table table-bordered">
							<tr>
								<th>ID Peminjaman</th>
								<th>:</th>
								<th><?php echo $kode_peminjaman;?>
								<input type="hidden" name="kodepeminjam_user" class="form-control" value="<?php echo $tbl_user->kodepeminjam_user;?>" readonly></th>
							</tr>
							<tr>
								<td>ID Inventaris</td>
								<td>:</td>
								<td>
									<select name="kode_inventaris" class="form-control select2" data-placeholder="Pilih Inventaris" required width="100%">
										<option></option>
										<?php foreach($tbl_inventaris as $inventaris){?>
										<option value="<?php echo $inventaris->kode_inventaris;?>"><?php echo $inventaris->kode_inventaris;?> - <?php echo $inventaris->nama_inventaris;?></option>
										<?php } ?>
									</select>
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