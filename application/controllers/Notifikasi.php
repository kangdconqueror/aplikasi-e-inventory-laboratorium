<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Notifikasi extends CI_Controller {
	public function __construct(){
		parent::__construct();
		date_default_timezone_set("Asia/Bangkok");
		$this->load->model('m_general');
	}
	
	// Notifikasi setiap 1 jam
	//0 * * * * curl http://localhost/github/laboratorium/notifikasi/check_peminjaman
	
	public function check_peminjaman(){
		$tbl_peminjaman_inventaris = $this->db->query(" SELECT a.kodepeminjam_user, a.kode_inventaris, 
			CASE 
				WHEN a.konfirmasi_peminjaman='0' AND a.konfirmasi_kembali='0' THEN 'Menunggu Konfirmasi'
				WHEN a.konfirmasi_peminjaman='0' AND a.konfirmasi_kembali='1' THEN 'Batal Pinjam'
				WHEN a.konfirmasi_peminjaman='1' AND a.konfirmasi_kembali='0' AND (UNIX_TIMESTAMP(a.tanggal_kembali) - UNIX_TIMESTAMP() >0) THEN 'Belum Kembali'
				WHEN a.konfirmasi_peminjaman='1' AND a.konfirmasi_kembali='0' AND (UNIX_TIMESTAMP(a.tanggal_kembali) - UNIX_TIMESTAMP() <0) THEN 'Terlambat'
				WHEN a.konfirmasi_peminjaman='1' AND a.konfirmasi_kembali='1' THEN 'Sudah Kembali'
			END as keterangan
			FROM tbl_peminjaman_inventaris a 
			LEFT JOIN tbl_inventaris b ON a.kode_inventaris=b.kode_inventaris
			LEFT JOIN tbl_user c ON a.kodepeminjam_user=c.kodepeminjam_user
			WHERE (CASE 
				WHEN a.konfirmasi_peminjaman='0' AND a.konfirmasi_kembali='0' THEN 'Menunggu Konfirmasi'
				WHEN a.konfirmasi_peminjaman='0' AND a.konfirmasi_kembali='1' THEN 'Batal Pinjam'
				WHEN a.konfirmasi_peminjaman='1' AND a.konfirmasi_kembali='0' AND (UNIX_TIMESTAMP(a.tanggal_kembali) - UNIX_TIMESTAMP() >0) THEN 'Belum Kembali'
				WHEN a.konfirmasi_peminjaman='1' AND a.konfirmasi_kembali='0' AND (UNIX_TIMESTAMP(a.tanggal_kembali) - UNIX_TIMESTAMP() <0) THEN 'Terlambat'
				WHEN a.konfirmasi_peminjaman='1' AND a.konfirmasi_kembali='1' THEN 'Sudah Kembali'
			END)='Terlambat'
			order by created_peminjaman DESC")->result();
		foreach($tbl_peminjaman_inventaris as $peminjaman_inventaris){
			$tbl_user = $this->db->query("select GROUP_CONCAT(CONCAT('{',a.user_name,' - ',a.notelp_user,'}')) as admin from tbl_user a where a.level_user='administrator'")->row();
			$where2['kode_inventaris'] = $peminjaman_inventaris->kode_inventaris;
			$inventaris = $this->m_general->view_by("tbl_inventaris",$where2);
			$pesan = "Anda terlambat mengembalikan { $inventaris->kode_inventaris } { $inventaris->nama_inventaris }, Mohon segera untuk menghubungi pihak Labor Komputer FASILKOM UNILAK: $tbl_user->admin, Terimakasih.";
			$id_inbox = $this->m_general->bacaidterakhir("tbl_inbox", "id_inbox");
			$inbox = array(
					'id_inbox' => $id_inbox,
					'isi_inbox' => $pesan,
					'kodepeminjam_user' => $peminjaman_inventaris->kodepeminjam_user
			);
			$this->m_general->add("tbl_inbox", $inbox);				
		}
	}
}