<style>
select + .select2-container {
  width: 100% !important;
}
</style> 
  <div class="content-wrapper" >
    <section class="content-header">
      <h3>
        Tambah Peminjaman Ruangan
      </h3>
    </section>
 <!-- Main content -->
    <section class="content" >
      <div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-body">
				  <div class="row">
				  <?php echo form_open_multipart("admin/peminjamanruang_aksi_tambah/"); ?>
					<div class="col-md-6">
						<table class="table table-bordered">
							<tr>
								<th>ID Peminjaman</th>
								<th>:</th>
								<th><?php echo $kode_peminjaman;?></th>
							</tr>
							<tr>
								<td>ID Peminjam</td>
								<td>:</td>
								<td>
									<select onchange="getval(this);" name="kodepeminjam_user" class="form-control select2" data-placeholder="Pilih Peminjam" required>
										<option></option>
										<?php foreach($tbl_user as $user){?>
										<option value="<?php echo $user->kodepeminjam_user;?>"><?php echo $user->kodepeminjam_user;?> - <?php echo $user->nama_user;?></option>
										<?php } ?>
									</select>
								</td>
							</tr>
							<tr>
								<td>ID Ruangan</td>
								<td>:</td>
								<td>
									<select name="kode_ruangan" class="form-control select2" data-placeholder="Pilih Ruangan" required width="100%">
										<option></option>
										<?php foreach($tbl_ruangan as $ruangan){?>
										<option value="<?php echo $ruangan->kode_ruangan;?>"><?php echo $ruangan->kode_ruangan;?> - <?php echo $ruangan->nama_ruangan;?></option>
										<?php } ?>
									</select>
								</td>
							</tr>
							<tr>
								<td>Tanggal Peminjaman</td>
								<td>:</td>
								<td><input type="date" class="form-control" name="tanggal_peminjaman" required > </td>
							</tr>
							<tr>
								<td>Waktu</td>
								<td>:</td><td>
									<select name="kode_jadwal" class="form-control select2" data-placeholder="Pilih Jadwal" required width="100%">
										<option></option>
										<?php foreach($tbl_jadwal as $jadwal){?>
										<option value="<?php echo $jadwal->kode_jadwal;?>"><?php echo $jadwal->jam1_jadwal;?> - <?php echo $jadwal->jam2_jadwal;?></option>
										<?php } ?>
									</select>
								</td>
							</tr>
						</table>
					  <div class="form-group">
						<input type="submit" value="Submit" class="btn btn-success">
					  </div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						<label>Foto User</label>
						<img width="220px" class="img img-responsive user-image" id="blah" src="<?php echo base_url();?>assets/dist/img/avatar/<?php echo "default/user.png"."?".strtotime("now");?>">
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
<script>
function getval(sel)
{
    var kodepeminjam_user = sel.value;
	var xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", "<?php echo base_url('admin/cekuser/');?>"+kodepeminjam_user, false ); // false for synchronous request
    xmlHttp.send( null );
    var link = xmlHttp.responseText;
	document.getElementById("blah").src= '<?php echo base_url()."assets/dist/img/avatar/";?>'+link+'<?php echo "?".strtotime("now");?>';
}
</script>