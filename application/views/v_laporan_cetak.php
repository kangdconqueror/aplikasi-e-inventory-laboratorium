
<style>
.laporan{
	width: 100%;
	border: 1px solid black;
	border-collapse: collapse;
}

th,td
{
    font-family: arial;
    font-size: 7pt;
	padding: 10px;
}
</style>
<table width="100%" style="border-bottom:1px solid black;">
<tr>
	<td style="text-align:right; padding:10px;" width="15%">
		<img src="<?php echo base_url(); ?>assets/dist/img/logo.png" width="60px">
	</td>
	<td style="text-align:center;" width="85%">
		<h4 style="text-align:center; font-size:1.1em"><b>Aplikasi e-Inventory Laboratorium <br>
		Fakultas Ilmu Komputer Universitas Lancang Kuning</b></h4>
	</td>
</tr>
</table>
<br>
<label><h4 style="text-align:center;">Laporan</h4></label>
<label><h5>Tanggal Cetak : <?php echo $tanggalcetak;?></h5><label/>
<br>
<?php
if($pilih_data==1 || $pilih_data==0){ ?>
	<table>
		<tr>
			<td>Perihal : Data History Peminjaman Inventaris Labor</td>
		</tr>
		<tr>
			<td> Rentang Waktu Sejak : <?php echo $tanggal_mulai; ?>   Sampai : <?php echo $tanggal_selesai; ?> </td>
		</tr>
	</table>
	<table border="1" class="laporan">
		<tr>
			<th>No</th>
			<th>ID Peminjaman</th>
			<th>ID Peminjam</th>
			<th>Nama Peminjam</th>
			<th>ID Inventaris</th>
			<th width="115px">Waktu Pinjam</th>
			<th width="115px">Waktu Kembali</th>
			<th>Keterangan</th>
		</tr>
	<?php		
		foreach($tbl_peminjaman_inventaris as $peminjaman_inventaris){
			echo "<tr>";
				echo "<td>$peminjaman_inventaris->rowNumber</td>";
				echo "<td>$peminjaman_inventaris->kode_peminjaman</td>";
				echo "<td>$peminjaman_inventaris->kodepeminjam_user</td>";
				echo "<td>$peminjaman_inventaris->nama_user</td>";
				echo "<td>$peminjaman_inventaris->kode_inventaris</td>";
				echo "<td>$peminjaman_inventaris->tanggal_peminjaman</td>";
				echo "<td>$peminjaman_inventaris->tanggal_kembali</td>";
				echo "<td>$peminjaman_inventaris->keterangan</td>";
			echo "</tr>";
		}
	?>
	</table>
<?php		
	}
?>
<br>
<?php
if($pilih_data==2 || $pilih_data==0){ ?>
	<table>
		<tr>
			<td>Perihal : Data History Peminjaman Ruangan Labor</td>
		</tr>
		<tr>
			<td> Rentang Waktu Sejak : <?php echo $tanggal_mulai; ?>   Sampai : <?php echo $tanggal_selesai; ?> </td>
		</tr>
	</table>
	<table border="1" class="laporan">
		<tr>
			<th>No</th>
			<th>ID Peminjaman</th>
			<th>ID Peminjam</th>
			<th>Nama Peminjam</th>
			<th>ID Ruangan</th>
			<th>Nama Ruangan</th>
			<th width="130px">Waktu</th>
			<th>Keterangan</th>
		</tr>
	<?php		
		foreach($tbl_peminjaman_ruangan as $peminjaman_ruangan){
			echo "<tr>";
				echo "<td>$peminjaman_ruangan->rowNumber</td>";
				echo "<td>$peminjaman_ruangan->kode_peminjaman</td>";
				echo "<td>$peminjaman_ruangan->kodepeminjam_user</td>";
				echo "<td>$peminjaman_ruangan->nama_user</td>";
				echo "<td>$peminjaman_ruangan->kode_ruangan</td>";
				echo "<td>$peminjaman_ruangan->nama_ruangan</td>";
				echo "<td>$peminjaman_ruangan->tanggal_peminjaman $peminjaman_ruangan->jadwal</td>";
				echo "<td>$peminjaman_ruangan->keterangan</td>";
			echo "</tr>";
		}
	?>
	</table>
<?php		
	}
?>
<br>
<?php
if($pilih_data==3 || $pilih_data==0){ ?>
	<table>
		<tr>
			<td>Perihal : Data Peminjam yang Terkena Sangsi</td>
		</tr>
	</table>
	<table border="1" class="laporan">
		<tr>
			<th>No</th>
			<th>ID Peminjam</th>
			<th>Nama Peminjam</th>
			<th>Tempat/Tgl Lahir</th>
			<th>No Telp/HP</th>
			<th>Alamat</th>
			<th>Sangsi Peminjaman</th>
		</tr>
	<?php		
		foreach($tbl_user as $user){
			echo "<tr>";
				echo "<td>$user->rowNumber</td>";
				echo "<td>$user->kodepeminjam_user</td>";
				echo "<td>$user->nama_user</td>";
				echo "<td>$user->ttl</td>";
				echo "<td>$user->notelp_user</td>";
				echo "<td>$user->alamat_user</td>";
				echo "<td>$user->sisa</td>";
			echo "</tr>";
		}
	?>
	</table>
<?php		
	}
?>