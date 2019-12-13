  <div class="content-wrapper ">
    <section class="content-header">
      <h3>
        Data Peminjaman Inventaris Labor
      </h3>
    </section>
    <!-- Main content -->
    <section class="content" >
      <div class="row">
		<div class="col-xs-12">
			<div class="box">
				<!-- /.box-header -->
				<div class="box-header">
					<h3 class="box-title"></h3>
				</div>
				<div class="box-body">
				<table id="datatable" class="table table-bordered table-striped display responsive nowrap" cellspacing="0" width="100%">
					<thead>
					<tr>
						<th>No</th>
						<th>ID Peminjaman</th>
						<th>ID Peminjam</th>
						<th>Nama Peminjam</th>
						<th>ID Inventaris</th>
						<th>Waktu Pinjam</th>
						<th>Waktu Kembali</th>
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
			"ajax": "<?php echo base_url('admin/get_data_master_peminjamaninv/');?>" ,
			columnDefs: [{
				   targets: [8],
				   data: null,
				   render: function ( data, type, row, meta ) {                   
					if(row[7]=="Menunggu Konfirmasi"){
						var ubah = "<a href='<?php echo base_url();?>admin/peminjamaninv_ubah/"+row[8]+"/konfirmasi'> <button type='button' class='btn btn-xs btn-warning'><i class='fa fa-pencil'></i> Aksi</button></a>";
					}else if(row[7]=="Belum Kembali"){
						var ubah = "<a href='<?php echo base_url();?>admin/peminjamaninv_ubah/"+row[8]+"/kembali'> <button type='button' class='btn btn-xs btn-success'><i class='fa fa-pencil'></i> Aksi</button></a>";
					}else{
						var ubah = "";
					}

					var hapus = "<a onclick=\"return confirm('Yakin untuk menghapus Peminjaman ini ?')\" href='<?php echo base_url();?>admin/peminjamaninv_aksi_hapus/"+row[8]+"'> <button type='button' class='btn btn-xs btn-danger'><i class='fa fa-trash'></i> Hapus</button></a>";

					return hapus+ubah;
				   }
				},],
		});
</script>