<?php 
if($this->uri->segment(3)!=""){
	$date = $this->uri->segment(3);
}else{
	$date = date("Y-m-d");
}

if($this->uri->segment(4)!=""){
	$kode_ruangan = $this->uri->segment(4);
	$tbl_ruangan_by = $this->db->query("select * from tbl_ruangan a where a.kode_ruangan='$kode_ruangan'")->row();
	$nama_ruangan = " - ".$tbl_ruangan_by->nama_ruangan;
}else{
	$kode_ruangan = "";
	$nama_ruangan = "";
}

$tbl_jadwal_result = $this->db->query("select * from tbl_jadwal a where a.kode_jadwal NOT IN(select b.kode_jadwal from tbl_peminjaman_ruangan b where b.tanggal_peminjaman='$date' and b.kode_ruangan='$kode_ruangan' AND b.status_peminjaman!='2')")->result();

?>
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
				  <?php echo form_open_multipart("dosen/peminjamanruang_aksi_tambah/"); ?>
					<div class="col-md-6">
						<table class="table table-bordered">
							<tr>
								<th>ID Peminjaman</th>
								<th>:</th>
								<th><?php echo $kode_peminjaman;?>
								<input type="hidden" name="kodepeminjam_user" class="form-control" value="<?php echo $tbl_user->kodepeminjam_user;?>" readonly></th>
							</tr>
							<tr>
								<td>Tanggal Peminjaman</td>
								<td>:</td>
								<td><input type="date" class="form-control" name="tanggal_peminjaman" value="<?php echo $date;?>" required onchange="handler(event);" > </td>
							</tr>
							<tr>
								<td>ID Ruangan</td>
								<td>:</td>
								<td>
									<select class="form-control select2" data-placeholder="Pilih Ruangan" required width="100%" onchange="handlerewe(event);">
										<option><?php echo $kode_ruangan.$nama_ruangan;?></option>
										<?php foreach($tbl_ruangan as $ruangan){?>
										<option value="<?php echo $ruangan->kode_ruangan;?>"><?php echo $ruangan->kode_ruangan;?> - <?php echo $ruangan->nama_ruangan;?></option>
										<?php } ?>
									</select>
									<input type="hidden" name="kode_ruangan" class="form-control" value="<?php echo $kode_ruangan;?>" readonly>
								</td>
							</tr>
							<tr><td>Waktu</td>
								<td>:</td><td>
									<select name="kode_jadwal" class="form-control select2" data-placeholder="Pilih Jadwal" required width="100%">
										<option></option>
										<?php foreach($tbl_jadwal_result as $jadwal){?>
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
					<?php echo form_close(); ?>
					<div class="col-md-6">
					<div class="box">
						<div class="bg-green">
							<table style="border:2px solid white; width:100%;">
								<tr>
									<th style="padding:15px;">Jadwal Penggunaan dan Ketersediaan Labor</th>
								</tr>
							</table>
						</div>
					</div>
					<?php if($this->uri->segment(4)!=""){ ?>
						<div class="col-md-12">
							<div class="box">
								<div class="bg-white">
									<table style="border:1px solid black; width:100%;">
										<tr>
											<th colspan="3" style="text-align:center; padding:10px; border:1px solid black;"> 
												<?php echo $tbl_ruangan_by->nama_ruangan;?>
											</th>
										</tr>
										<tr>
											<th style="text-align:center; padding:10px; border:1px solid black;"> 
												Jam
											</th>
											<th style="text-align:center; padding:10px; border:1px solid black;"> 
												Peminjam Labor
											</th>
											<th style="text-align:center; padding:10px; border:1px solid black;"> 
												Status
											</th>
										</tr>
										<?php 
										$tbl_peminjaman_ruangan = $this->db->query("select a.nama_ruangan, c.jam1_jadwal, c.jam2_jadwal, b.kodepeminjam_user,
										CASE WHEN b.status_peminjaman=0 THEN 'Menunggu Konfirmasi' WHEN b.status_peminjaman=1 THEN 'Terjadwal' WHEN b.status_peminjaman=2 THEN 'Batal' ELSE '' END as status
										from tbl_ruangan a right OUTER join tbl_peminjaman_ruangan b ON a.kode_ruangan=b.kode_ruangan right OUTER join tbl_jadwal c ON b.kode_jadwal=c.kode_jadwal and b.tanggal_peminjaman='$date' and a.kode_ruangan='$tbl_ruangan_by->kode_ruangan' order by c.jam1_jadwal ASC")->result();
										foreach($tbl_peminjaman_ruangan as $peminjaman_ruangan){
										?>
										<tr>
											<td style="text-align:center; padding:5px; border:1px solid black;"> 
												<?php echo substr($peminjaman_ruangan->jam1_jadwal,0,5);?> - 
												<?php echo substr($peminjaman_ruangan->jam2_jadwal,0,5);?>
											</td>
											<td style="padding:5px; border:1px solid black;"> 
												<?php
												if($peminjaman_ruangan->kodepeminjam_user!=NULL){
												$tbl_user = $this->db->query("select * from tbl_user where kodepeminjam_user='$peminjaman_ruangan->kodepeminjam_user'")->row();
												echo $tbl_user->nama_user; 
												}
												?>
											</td>
											<td style="text-align:center; padding:5px; border:1px solid black;"> 
												<?php echo $peminjaman_ruangan->status;?> 
											</td>
										</tr>
										<?php } ?>
									</table>
								</div>
							</div>
						</div>
						<?php } ?>
				</div>
				  </div>
				</div>
			</div>
		</div>
      </div>

<script type="text/javascript">        
   function handler(e){
	  window.location.href = '<?php echo base_url()."dosen/peminjamanruang_tambah/";?>'+ e.target.value +'<?php echo "/".$kode_ruangan; ?>';
	}
	
	function handlerewe(e){
	  window.location.href = '<?php echo base_url()."dosen/peminjamanruang_tambah/".$date."/"; ?>'+ e.target.value;
	}
</script>
    </section>
  </div>