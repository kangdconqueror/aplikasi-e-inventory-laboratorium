<?php 
if($this->uri->segment(3)!=""){
	$date = $this->uri->segment(3);
}else{
	$date = date("Y-m-d");
}
$hari = date('l', strtotime($date));

	switch($hari){
		case 'Sunday':
			$hari_ini = "Minggu";
		break;
 
		case 'Monday':			
			$hari_ini = "Senin";
		break;
 
		case 'Tuesday':
			$hari_ini = "Selasa";
		break;
 
		case 'Wednesday':
			$hari_ini = "Rabu";
		break;
 
		case 'Thursday':
			$hari_ini = "Kamis";
		break;
 
		case 'Friday':
			$hari_ini = "Jumat";
		break;
 
		case 'Saturday':
			$hari_ini = "Sabtu";
		break;
		
		default:
			$hari_ini = "Tidak di ketahui";		
		break;
	}
?> 
  <div class="content-wrapper ">
    <section class="content-header">
      <h3>
        Data Peminjaman Ruangan Labor
      </h3>
    </section>
    <!-- Main content -->
    <section class="content" >
      <div class="row">
		<div class="col-xs-12">
			<div class="box">
				<!-- /.box-header -->
				<div class="box-header">
					<label>
					<a class="btn-sm btn-primary" href="<?php echo base_url("dosen/peminjamanruang_tambah");?>"><i class="fa fa-plus"></i> <span>Tambah Peminjaman Ruangan</span></a>
					</label>
					<label>Pilih Tanggal : </label> <label> <?php echo $hari_ini;?>, </label> <label><input type="date" value="<?php echo $date;?>" onchange="handler(event);"></label>
				</div>
				<div class="box-body">
				<table id="datatable" class="table table-bordered table-striped display responsive nowrap" cellspacing="0" width="100%">
					<thead>
					<tr>
						<th>No</th>
						<th>ID Peminjaman</th>
						<th>ID Peminjam</th>
						<th>Nama Peminjam</th>
						<th>ID Ruangan</th>
						<th>Nama Ruangan</th>
						<th>Waktu</th>
						<th>Keterangan</th>
						<th width="150px"> Action</th>
					</tr>
					</thead>
					<tbody>
					</tbody>
				  </table>
				</div>
				<!-- /.box-body -->
			  </div>
		</div>
      </div>
    </section>
  </div>
<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script>
var myTable =  $('#datatable').DataTable({
			"processing": true,
			"serverSide": true,
			"autoWidth": true,
			"paging": true,
			"info": true,
			'order': [[0, 'asc']],
			"ajax": "<?php echo base_url('dosen/get_data_master_peminjamanruang/'.$date);?>" ,
			columnDefs: [{
				   targets: [8],
				   data: null,
				   render: function ( data, type, row, meta ) {                   
					if(row[7]=="Menunggu Konfirmasi"){
						var ubah = "<a href='<?php echo base_url();?>dosen/peminjamanruang_ubah/"+row[8]+"'> <button type='button' class='btn btn-xs btn-warning'><i class='fa fa-pencil'></i> Aksi</button></a>";
					}else{
						var ubah = "";
					}
					
					if(row[7]=="Terjadwal"){
						var hapus = "";
					}else{
						var hapus = "<a onclick=\"return confirm('Yakin untuk menghapus Peminjaman ini ?')\" href='<?php echo base_url();?>dosen/peminjamanruang_aksi_hapus/"+row[8]+"/"+row[9]+"'> <button type='button' class='btn btn-xs btn-danger'><i class='fa fa-trash'></i> Hapus</button></a>";
					}
					
					return hapus+ubah;
				   }
				},],
		});
setInterval( function () {
    myTable.ajax.reload();
}, 4000 );

function handler(e){
	  window.location.href = '<?php echo base_url()."dosen/peminjamanruang/"; ?>'+e.target.value;
	}
</script>