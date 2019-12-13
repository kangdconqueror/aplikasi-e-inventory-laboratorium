<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>LABORATORIUM</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/all.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/flat/blue.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/select2/select2.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css">
  <style>
	div{
		border-radius: 2px;
	}
  
	td.example { 
		background-image: url(<?php echo base_url(); ?>assets/dist/img/logo.png);
		background-repeat: no-repeat;
		padding:10px;
		background-size: 50px;
		background-position: 5% 50%; 
	}
  </style>
</head>
<body class="hold-transition skin-green layout-top-nav" onload="tampilkanwaktu();setInterval('tampilkanwaktu()', 1000);">
<table width="100%" style="border-bottom:1px solid black;">
<tr>
	<td style="text-align:left;" class="example">
		<h4 style="text-align:center; font-size:1em"><b>Aplikasi e-Inventory Laboratorium <br>
		Fakultas Ilmu Komputer Universitas Lancang Kuning</b></h4>
	</td>
</tr>
</table>
<div class="wrapper">
<?php include ("v_beranda_menu.php");?>