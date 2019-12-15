<?php 
$id_user = $this->session->userdata("userid");
$user = $this->db->query("select * from tbl_user where id_user='$id_user'")->row();?>
  <header class="main-header">
    <a href="" class="logo">
      <span class="logo-mini"><b>M</b></span>
      <span class="logo-lg"><b>MENU</b></span>
    </a>
    <nav class="navbar navbar-static-top" >
		<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
			<span class="sr-only">Toggle navigation</span>
		</a>
		
		<div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
		  <!-- User Account: style can be found in dropdown.less -->
			  <li class="dropdown user user-menu">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				  <img src="<?php echo base_url();?>assets/dist/img/avatar/<?php echo $user->foto_user."?".strtotime("now");?>" class="user-image" alt="User Image">
				  <span class="hidden-xs">Hi, { <?php echo $user->nama_user; ?> }</span> [ <span id="clock"></span> ] <?php
$hari = date('l');
/*$new = date('l, F d, Y', strtotime($Today));*/
if ($hari=="Sunday") {
 echo "Minggu";
}elseif ($hari=="Monday") {
 echo "Senin";
}elseif ($hari=="Tuesday") {
 echo "Selasa";
}elseif ($hari=="Wednesday") {
 echo "Rabu";
}elseif ($hari=="Thursday") {
 echo("Kamis");
}elseif ($hari=="Friday") {
 echo "Jum'at";
}elseif ($hari=="Saturday") {
 echo "Sabtu";
}
?>,

<?php
$tgl =date('d');
echo $tgl;
$bulan =date('F');
if ($bulan=="January") {
 echo " Januari ";
}elseif ($bulan=="February") {
 echo " Februari ";
}elseif ($bulan=="March") {
 echo " Maret ";
}elseif ($bulan=="April") {
 echo " April ";
}elseif ($bulan=="May") {
 echo " Mei ";
}elseif ($bulan=="June") {
 echo " Juni ";
}elseif ($bulan=="July") {
 echo " Juli ";
}elseif ($bulan=="August") {
 echo " Agustus ";
}elseif ($bulan=="September") {
 echo " September ";
}elseif ($bulan=="October") {
 echo " Oktober ";
}elseif ($bulan=="November") {
 echo " November ";
}elseif ($bulan=="December") {
 echo " Desember ";
}
$tahun=date('Y');
echo $tahun;
?></small>
				</a>
				<ul class="dropdown-menu">
				  <!-- User image -->
				  <li class="user-header">
					<img src="<?php echo base_url();?>assets/dist/img/avatar/<?php echo $user->foto_user."?".strtotime("now");?>" class="img-circle" alt="User Image">
					<p>
					  <?php echo $user->nama_user; ?>
					  <small>Waktu : [ <span id="clock2"></span> ] <?php
$hari = date('l');
/*$new = date('l, F d, Y', strtotime($Today));*/
if ($hari=="Sunday") {
 echo "Minggu";
}elseif ($hari=="Monday") {
 echo "Senin";
}elseif ($hari=="Tuesday") {
 echo "Selasa";
}elseif ($hari=="Wednesday") {
 echo "Rabu";
}elseif ($hari=="Thursday") {
 echo("Kamis");
}elseif ($hari=="Friday") {
 echo "Jum'at";
}elseif ($hari=="Saturday") {
 echo "Sabtu";
}
?>,

<?php
$tgl =date('d');
echo $tgl;
$bulan =date('F');
if ($bulan=="January") {
 echo " Januari ";
}elseif ($bulan=="February") {
 echo " Februari ";
}elseif ($bulan=="March") {
 echo " Maret ";
}elseif ($bulan=="April") {
 echo " April ";
}elseif ($bulan=="May") {
 echo " Mei ";
}elseif ($bulan=="June") {
 echo " Juni ";
}elseif ($bulan=="July") {
 echo " Juli ";
}elseif ($bulan=="August") {
 echo " Agustus ";
}elseif ($bulan=="September") {
 echo " September ";
}elseif ($bulan=="October") {
 echo " Oktober ";
}elseif ($bulan=="November") {
 echo " November ";
}elseif ($bulan=="December") {
 echo " Desember ";
}
$tahun=date('Y');
echo $tahun;
?></small>
					</p>
					
				  </li>
				  <!-- Menu Footer-->
				  <li class="user-footer">
					<div class="pull-right">
					  <a href="<?php echo base_url(); ?>login/logout" class="btn btn-default btn-flat">Sign out</a>
					</div>
				  </li>
				</ul>
			  </li>
			</ul>
      </div>
    </nav>
  </header>
  <?php
  $geturl = $this->uri->segment(2);
  $beranda = "";
  $profile = "";
  $inbox = "";
  $PeminjamanInventarisLabor = "";
  $PeminjamanInventarisRuangan = "";
  
  if($geturl=="" or strpos($geturl, "index")!== FALSE){
	  $beranda = "active";
  }
  if(strpos($geturl, "profile")!== FALSE){
	  $profile = "active";
  }
  if(strpos($geturl, "inbox")!== FALSE){
	  $inbox = "active";
  }
  if(strpos($geturl, "peminjamaninv")!== FALSE){
	  $PeminjamanInventarisLabor = "active";
  }
  if(strpos($geturl, "peminjamanruang")!== FALSE){
	  $PeminjamanInventarisRuangan = "active";
  }
  
  ?>
  <aside class="main-sidebar">
    <section class="sidebar">
      <ul class="sidebar-menu">
        <li class="<?php echo $beranda;?>">
          <a href="<?php echo base_url(); ?>mahasiswa">
            <span>Home</span>
          </a>
        </li>
		<li class="<?php echo $profile;?>">
          <a href="<?php echo base_url(); ?>mahasiswa/profile">
            <span>Profile</span>
          </a>
        </li>
		<li class="<?php echo $inbox;?>">
          <a href="<?php echo base_url(); ?>mahasiswa/inbox">
            <span>Inbox</span>
          </a>
        </li>
		<li class="<?php echo $PeminjamanInventarisLabor;?>">
          <a href="<?php echo base_url(); ?>mahasiswa/peminjamaninv">
            <span>Peminjaman Inventaris Labor</span>
          </a>
        </li>
		<li class="<?php echo $PeminjamanInventarisRuangan;?>">
          <a href="<?php echo base_url(); ?>mahasiswa/peminjamanruang">
            <span>Peminjaman Ruangan Labor</span>
          </a>
        </li>
		<li class="">
          <a href="<?php echo base_url(); ?>login/logout">
            <span>Logout</span>
          </a>
        </li>
      </ul>
    </section>
  </aside>