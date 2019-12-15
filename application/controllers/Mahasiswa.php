<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH . 'third_party/ssp.php';
class Mahasiswa extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('status') != "login" or $this->session->userdata('level') != "mahasiswa"){
			redirect(base_url("login"));
		}
		$this->load->model('m_general');
	}
	
	////////////////////////////////////
	
	public function index()
    {
		$data['tbl_inventaris'] = $this->db->query("select count(a.id_kategori) as jumlah, a.id_kategori, b.nama_kategori from tbl_inventaris a LEFT JOIN tbl_kategori b ON a.id_kategori=b.id_kategori WHERE a.ketersediaan_inventaris='1' GROUP BY a.id_kategori, b.nama_kategori")->result();
		$data['tbl_ruangan'] = $this->db->query("select * from tbl_ruangan order by id_ruangan ASC")->result();
		$data['tbl_user'] = $this->db->query("select * from tbl_user where level_user='administrator' order by nama_user ASC")->result();
		$this->load->view("v_admin_header");
        $this->load->view("v_mahasiswa_index", $data);
        $this->load->view("v_admin_footer");
    }
	
	public function profile()
    {
		$where = array("id_user" => $this->session->userdata('userid'));
		$data['tbl_user'] = $this->m_general->view_by("tbl_user",$where);
		$data['err'] = "";
		$this->load->view("v_admin_header");
        $this->load->view("v_mahasiswa_profile", $data);
        $this->load->view("v_admin_footer");
    }
	
	public function profile_aksi_ubah($id_user)
    {
			$where['id_user'] = $id_user;
			$data['tbl_user'] = $this->m_general->view_by("tbl_user",$where);
			$tbl_user = $this->m_general->view_by("tbl_user",$where);
			
			$kodepeminjam_user = $this->input->post('kodepeminjam_user')[0];
			$kodepeminjam_user_old = $this->input->post('kodepeminjam_user')[1];
			$user_password = $this->input->post('user_password')[0];
			$user_password_old = $this->input->post('user_password')[1];
			$nama_user = $this->input->post('nama_user');
			$tempatlahir_user = $this->input->post('tempatlahir_user');
			$tanggallahir_user = $this->input->post('tanggallahir_user');
			$notelp_user = $this->input->post('notelp_user');
			$alamat_user = $this->input->post('alamat_user');
			$foto_user = $this->input->post('foto_user');
			
			if($kodepeminjam_user!=$kodepeminjam_user_old){
				$check_user = $this->m_general->countdata("tbl_user", array("kodepeminjam_user" => $kodepeminjam_user));
				$_POST['kodepeminjam_user'] = $kodepeminjam_user;
			}else{
				$check_user = 0;
				$_POST['kodepeminjam_user'] = $kodepeminjam_user;
			}
			
			if($check_user==0){
				if($user_password!=$user_password_old){
					$_POST['user_password'] = md5($user_password);
				}else{
					$_POST['user_password'] = $user_password;
				}
					$folder = "avatar";
					$file_upload = $_FILES['userfiles'];
					$files = $file_upload;
					
					if($files['name'] != "" OR $files['name'] != NULL){
						$file = './assets/dist/img/avatar/'.$tbl_user->foto_user;
						if($tbl_user->foto_user!="default/user.png" && is_readable($file)){
							unlink($file);
						}
						$_POST['foto_user'] = $this->m_general->file_upload($files, $folder);
					}else{
						$_POST['foto_user'] = $foto_user;
					}
					$_POST['user_name'] = $kodepeminjam_user;
					$this->m_general->edit("tbl_user", $where, $_POST);
					$url = base_url("mahasiswa/profile");
					echo "<script language='javascript'>";
					echo "alert('Profile Berhasil diubah');";
					echo "window.location = '$url';";
					echo "</script>";
			}else{
					$data['err'] = 1;
					$data['kodepeminjam_user'] = $kodepeminjam_user;
					$data['user_password'] = $user_password;
					$data['nama_user'] = $nama_user;
					$data['tempatlahir_user'] = $tempatlahir_user;
					$data['tanggallahir_user'] = $tanggallahir_user;
					$data['notelp_user'] = $notelp_user;
					$data['alamat_user'] = $alamat_user;
					$this->load->view("v_admin_header");
					$this->load->view("v_mahasiswa_profile",$data);
					$this->load->view("v_admin_footer");
			}
    }	
	
	public function inbox()
    {
		$this->load->view("v_admin_header");
        $this->load->view("v_mahasiswa_inbox");
        $this->load->view("v_admin_footer");
    }
	
	public function get_data_master_inbox()
	{
		$where = array("id_user" => $this->session->userdata('userid'));
		$tbl_user = $this->m_general->view_by("tbl_user",$where);
		
		$table = "
        (
            SELECT * FROM tbl_inbox where kodepeminjam_user='$tbl_user->kodepeminjam_user'
        )temp";
		
        $primaryKey = 'id_inbox';
        $columns = array(
        array( 'db' => 'created_inbox',     'dt' => 0 ),
        array( 'db' => 'isi_inbox',     'dt' => 1 ),
        array( 'db' => 'kodepeminjam_user',     'dt' => 2 ),
        );

        $sql_details = array(
            'user' => $this->db->username,
            'pass' => $this->db->password,
            'db'   => $this->db->database,
            'host' => $this->db->hostname
        );
        echo json_encode(
            SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns)
        );
	}
	
	////////////////////////////////////
	
	////////////////////////////////////
	
	public function get_data_master_peminjamaninv()
	{
		$where = array("id_user" => $this->session->userdata('userid'));
		$tbl_user = $this->m_general->view_by("tbl_user",$where);
		
		$table = "
        (
            SELECT (@cnt := @cnt + 1) AS rowNumber, a.id_peminjaman, 
			a.kode_peminjaman, a.kodepeminjam_user, c.nama_user, a.kode_inventaris, a.tanggal_peminjaman, a.tanggal_kembali,
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
			CROSS JOIN (SELECT @cnt := 0) AS dummy
			WHERE a.kodepeminjam_user='$tbl_user->kodepeminjam_user'
			order by created_peminjaman DESC
        )temp";
		
        $primaryKey = 'id_peminjaman';
        $columns = array(
        array( 'db' => 'rowNumber',     'dt' => 0 ),
        array( 'db' => 'kode_peminjaman',     'dt' => 1 ),
        array( 'db' => 'kodepeminjam_user',        'dt' => 2 ),
        array( 'db' => 'nama_user',       'dt' => 3 ),
        array( 'db' => 'kode_inventaris',       'dt' => 4 ),
        array( 'db' => 'tanggal_peminjaman',       'dt' => 5 ),
        array( 'db' => 'tanggal_kembali',       'dt' => 6 ),
        array( 'db' => 'keterangan',       'dt' => 7 ),
        array( 'db' => 'id_peminjaman',     'dt' => 8 )
        );

        $sql_details = array(
            'user' => $this->db->username,
            'pass' => $this->db->password,
            'db'   => $this->db->database,
            'host' => $this->db->hostname
        );
        echo json_encode(
            SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns)
        );
	}	
	
	public function peminjamaninv()
    {
		$this->load->view("v_admin_header");
        $this->load->view("v_mahasiswa_peminjaman_inventaris");
        $this->load->view("v_admin_footer");
    }		
	
	public function peminjamaninv_tambah()
    {
		$data['kode_peminjaman'] = $this->m_general->last_peminjaman("tbl_peminjaman_inventaris");
		$where = array("id_user" => $this->session->userdata('userid'));
		$data['tbl_user'] = $this->m_general->view_by("tbl_user",$where);
		$data['tbl_inventaris'] = $this->m_general->view_where("tbl_inventaris", array("ketersediaan_inventaris" => 1), "nama_inventaris ASC");
		$this->load->view("v_admin_header");
        $this->load->view("v_mahasiswa_peminjaman_inventaris_add", $data);
        $this->load->view("v_admin_footer");
    }

	public function peminjamaninv_aksi_tambah()
    {
			$_POST['id_peminjaman'] = $this->m_general->bacaidterakhir("tbl_peminjaman_inventaris", "id_peminjaman");
			$_POST['kode_peminjaman'] = $this->m_general->last_peminjaman("tbl_peminjaman_inventaris");
			$this->m_general->add("tbl_peminjaman_inventaris", $_POST);
			
			//update tabel inventaris untuk inventaris yang dipinjam menjadi status ketersediannya 0
			$where2['kode_inventaris'] = $_POST['kode_inventaris'];
			$data = array(
				'ketersediaan_inventaris'=>0
			);
			$this->m_general->edit("tbl_inventaris", $where2, $data);
			
			$inventaris = $this->m_general->view_by("tbl_inventaris",$where2);
			$pesan = "Anda telah melakukan peminjaman Inventaris { $inventaris->kode_inventaris } { $inventaris->nama_inventaris },mohon untuk mengembalikan sesuai jadwal yang telah ditentukan, Terimakasih.";
			$id_inbox = $this->m_general->bacaidterakhir("tbl_inbox", "id_inbox");
			$inbox = array(
				'id_inbox' => $id_inbox,
				'isi_inbox' => $pesan,
				'kodepeminjam_user' => $_POST['kodepeminjam_user']
			);
			$this->m_general->add("tbl_inbox", $inbox);
			
			redirect('mahasiswa/peminjamaninv');
    }	
	
	public function peminjamaninv_ubah($id_peminjaman)
	{
		$where['id_peminjaman'] = $id_peminjaman;
		$tbl_peminjaman_inventaris = $this->m_general->view_by("tbl_peminjaman_inventaris",$where);
		$data['tbl_inventaris'] = $this->m_general->view_where("tbl_inventaris", array("ketersediaan_inventaris" => 1, "kode_inventaris !=" => $tbl_peminjaman_inventaris->kode_inventaris), "nama_inventaris ASC");
		$data['tbl_peminjaman_inventaris'] = $this->db->query("SELECT a.id_peminjaman, 
			a.kode_peminjaman, a.kodepeminjam_user, c.nama_user, a.kode_inventaris, b.nama_inventaris, a.tanggal_peminjaman, a.tanggal_kembali,
			CASE 
				WHEN a.konfirmasi_peminjaman='0' AND a.konfirmasi_kembali='0' THEN 'Menunggu Konfirmasi'
				WHEN a.konfirmasi_peminjaman='1' AND a.konfirmasi_kembali='0' THEN 'Belum Kembali'
			END as keterangan, c.foto_user
			FROM tbl_peminjaman_inventaris a 
			LEFT JOIN tbl_inventaris b ON a.kode_inventaris=b.kode_inventaris
			LEFT JOIN tbl_user c ON a.kodepeminjam_user=c.kodepeminjam_user WHERE id_peminjaman='$id_peminjaman'")->row();
		$this->load->view("v_admin_header");
		$this->load->view('v_mahasiswa_peminjaman_inventaris_edit', $data);
		$this->load->view("v_admin_footer");
	}	
	
	public function peminjamaninv_aksi_ubah($id_peminjaman)
    {
			$whereis = array("id_user" => $this->session->userdata('userid'));
			$tbl_user = $this->m_general->view_by("tbl_user",$whereis);
		
			$kode_inventaris = $this->input->post('kode_inventaris')[0];
			$kode_inventaris_old = $this->input->post('kode_inventaris')[1];
			$konfirmasi_peminjaman = $this->input->post('konfirmasi_peminjaman');
			$where['id_peminjaman'] = $id_peminjaman;
			
			if($konfirmasi_peminjaman==0){
					$_POST['konfirmasi_peminjaman'] = 0;
					$_POST['konfirmasi_kembali'] = 1;
					$ketersediaan_inventaris = 1;
					
					$tbl_peminjaman_inventaris = $this->m_general->view_by("tbl_peminjaman_inventaris",$where);
					$where2['kode_inventaris'] = $tbl_peminjaman_inventaris->kode_inventaris;
					$inventaris = $this->m_general->view_by("tbl_inventaris",$where2);
					$pesan = "Anda telah melakukan pembatalan peminjaman Inventaris { $inventaris->kode_inventaris } { $inventaris->nama_inventaris }, Terimakasih.";
					$id_inbox = $this->m_general->bacaidterakhir("tbl_inbox", "id_inbox");
					$inbox = array(
						'id_inbox' => $id_inbox,
						'isi_inbox' => $pesan,
						'kodepeminjam_user' => $tbl_user->kodepeminjam_user
					);
					$this->m_general->add("tbl_inbox", $inbox);
			}else if($konfirmasi_peminjaman==1){
					$_POST['konfirmasi_peminjaman'] = 0;
					$_POST['konfirmasi_kembali'] = 0;
					$ketersediaan_inventaris = 0;
			}
			
			if($kode_inventaris==$kode_inventaris_old){
				$tbl_peminjaman_inventaris = $this->m_general->view_by("tbl_peminjaman_inventaris",$where);
				//update tabel inventaris untuk inventaris yang dipinjam menjadi status ketersediannya
				$where2['kode_inventaris'] = $tbl_peminjaman_inventaris->kode_inventaris;
				$data = array(
					'ketersediaan_inventaris'=>$ketersediaan_inventaris
				);
				$this->m_general->edit("tbl_inventaris", $where2, $data);
				$_POST['kode_inventaris'] = $kode_inventaris;
				$this->m_general->edit("tbl_peminjaman_inventaris", $where, $_POST);
			}else{
				$tbl_peminjaman_inventaris = $this->m_general->view_by("tbl_peminjaman_inventaris",$where);
				$where2['kode_inventaris'] = $tbl_peminjaman_inventaris->kode_inventaris;
				$data = array(
					'ketersediaan_inventaris'=>$ketersediaan_inventaris
				);
				
				$this->m_general->edit("tbl_inventaris", $where2, $data);
				
				if($konfirmasi_peminjaman==0){
					$_POST['kode_inventaris'] = $kode_inventaris_old;
				}else{
					$_POST['kode_inventaris'] = $kode_inventaris;
				}
				
				$this->m_general->edit("tbl_peminjaman_inventaris", $where, $_POST);
				
				$tbl_peminjaman_inventaris = $this->m_general->view_by("tbl_peminjaman_inventaris",$where);
				$where2['kode_inventaris'] = $tbl_peminjaman_inventaris->kode_inventaris;
				$data = array(
					'ketersediaan_inventaris'=>$ketersediaan_inventaris
				);
				$this->m_general->edit("tbl_inventaris", $where2, $data);
			}
			
			redirect('mahasiswa/peminjamaninv');
    }	
	public function peminjamaninv_aksi_hapus($id_peminjaman){
			$where['id_peminjaman'] = $id_peminjaman;
			$tbl_peminjaman_inventaris = $this->m_general->view_by("tbl_peminjaman_inventaris",$where);
			$where2['kode_inventaris'] = $tbl_peminjaman_inventaris->kode_inventaris;
			$data = array(
				'ketersediaan_inventaris'=>1
			);
			$this->m_general->edit("tbl_inventaris", $where2, $data);
			$this->m_general->hapus("tbl_peminjaman_inventaris", $where); // Panggil fungsi hapus() yang ada di m_general.php
			redirect('mahasiswa/peminjamaninv');
	}
	
	////////////////////////////////////
	
	////////////////////////////////////
	
	public function get_data_master_peminjamanruang($date)
	{
		$where = array("id_user" => $this->session->userdata('userid'));
		$tbl_user = $this->m_general->view_by("tbl_user",$where);
		
		$table = "
        (
            SELECT (@cnt := @cnt + 1) AS rowNumber, a.id_peminjaman, a.kode_jadwal,
			a.kode_peminjaman, a.kodepeminjam_user, c.nama_user, a.kode_ruangan, a.tanggal_peminjaman, b.nama_ruangan,
			CASE 
				WHEN a.status_peminjaman='0' THEN 'Menunggu Konfirmasi'
				WHEN a.status_peminjaman='1' THEN 'Terjadwal'
				WHEN a.status_peminjaman='2' THEN 'Batal'
			END as keterangan,
			CONCAT(jam1_jadwal,' - ',jam2_jadwal) as jadwal
			FROM tbl_peminjaman_ruangan a 
			LEFT JOIN tbl_ruangan b ON a.kode_ruangan=b.kode_ruangan
			LEFT JOIN tbl_user c ON a.kodepeminjam_user=c.kodepeminjam_user
			LEFT JOIN tbl_jadwal d ON a.kode_jadwal=d.kode_jadwal
			CROSS JOIN (SELECT @cnt := 0) AS dummy
			WHERE tanggal_peminjaman='$date' AND a.kodepeminjam_user='$tbl_user->kodepeminjam_user'
			order by created_peminjaman DESC
        )temp";
		
        $primaryKey = 'id_peminjaman';
        $columns = array(
        array( 'db' => 'rowNumber',     'dt' => 0 ),
        array( 'db' => 'kode_peminjaman',     'dt' => 1 ),
        array( 'db' => 'kodepeminjam_user',        'dt' => 2 ),
        array( 'db' => 'nama_user',       'dt' => 3 ),
        array( 'db' => 'kode_ruangan',       'dt' => 4 ),
        array( 'db' => 'nama_ruangan',       'dt' => 5 ),
        array( 'db' => 'jadwal',       'dt' => 6 ),
        array( 'db' => 'keterangan',       'dt' => 7 ),
        array( 'db' => 'id_peminjaman',     'dt' => 8 ),
        array( 'db' => 'tanggal_peminjaman',     'dt' => 9 )
        );

        $sql_details = array(
            'user' => $this->db->username,
            'pass' => $this->db->password,
            'db'   => $this->db->database,
            'host' => $this->db->hostname
        );
        echo json_encode(
            SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns)
        );
	}	
	
	public function peminjamanruang()
    {
		$this->load->view("v_admin_header");
        $this->load->view("v_mahasiswa_peminjaman_ruangan");
        $this->load->view("v_admin_footer");
    }

	public function peminjamanruang_tambah()
    {
		$data['kode_peminjaman'] = $this->m_general->last_peminjaman("tbl_peminjaman_ruangan");
		$where = array("id_user" => $this->session->userdata('userid'));
		$data['tbl_user'] = $this->m_general->view_by("tbl_user",$where);
		$data['tbl_ruangan'] = $this->m_general->view_order("tbl_ruangan", "nama_ruangan ASC");
		$data['tbl_jadwal'] = $this->m_general->view_order("tbl_jadwal", "id_jadwal ASC");
		$this->load->view("v_admin_header");
        $this->load->view("v_mahasiswa_peminjaman_ruangan_add", $data);
        $this->load->view("v_admin_footer");
    }		
	
	public function peminjamanruang_ubah($id_peminjaman)
	{
		$data['tbl_peminjaman_ruangan'] = $this->db->query("SELECT a.id_peminjaman, a.kode_jadwal,
			a.kode_peminjaman, a.kodepeminjam_user, c.nama_user, a.kode_ruangan, a.tanggal_peminjaman, b.nama_ruangan,
			CASE 
				WHEN a.status_peminjaman='0' THEN 'Menunggu Konfirmasi'
				WHEN a.status_peminjaman='1' THEN 'Terjadwal'
				WHEN a.status_peminjaman='2' THEN 'Batal'
			END as keterangan, c.foto_user,
			CONCAT(jam1_jadwal,' - ',jam2_jadwal) as jadwal
			FROM tbl_peminjaman_ruangan a 
			LEFT JOIN tbl_ruangan b ON a.kode_ruangan=b.kode_ruangan
			LEFT JOIN tbl_user c ON a.kodepeminjam_user=c.kodepeminjam_user
			LEFT JOIN tbl_jadwal d ON a.kode_jadwal=d.kode_jadwal WHERE id_peminjaman='$id_peminjaman'")->row();
		$this->load->view("v_admin_header");
		$this->load->view('v_mahasiswa_peminjaman_ruangan_edit', $data);
		$this->load->view("v_admin_footer");
	}	
	
	public function peminjamanruang_aksi_tambah()
    {
			$_POST['id_peminjaman'] = $this->m_general->bacaidterakhir("tbl_peminjaman_ruangan", "id_peminjaman");
			$_POST['kode_peminjaman'] = $this->m_general->last_peminjaman("tbl_peminjaman_ruangan");
			$this->m_general->add("tbl_peminjaman_ruangan", $_POST);
			$where2['kode_ruangan'] = $_POST['kode_ruangan'];
			$ruangan = $this->m_general->view_by("tbl_ruangan",$where2);
			$pesan = "Anda telah melakukan peminjaman Ruangan { $ruangan->kode_ruangan } { $ruangan->nama_ruangan }, Terimakasih.";
			$id_inbox = $this->m_general->bacaidterakhir("tbl_inbox", "id_inbox");
			$inbox = array(
				'id_inbox' => $id_inbox,
				'isi_inbox' => $pesan,
				'kodepeminjam_user' => $_POST['kodepeminjam_user']
			);
			$this->m_general->add("tbl_inbox", $inbox);
			redirect('mahasiswa/peminjamanruang_tambah/'.$_POST['tanggal_peminjaman'].'/'.$_POST['kode_ruangan']);
    }
	public function peminjamanruang_aksi_ubah($id_peminjaman, $tanggal_peminjaman)
    {
			$whereis = array("id_user" => $this->session->userdata('userid'));
			$tbl_user = $this->m_general->view_by("tbl_user",$whereis);
			$where['id_peminjaman'] = $id_peminjaman;
			$this->m_general->edit("tbl_peminjaman_ruangan", $where, $_POST);
			if($_POST['status_peminjaman']==2){
				$where2['kode_ruangan'] = $_POST['kode_ruangan'];
				$ruangan = $this->m_general->view_by("tbl_ruangan",$where2);
				$pesan = "Anda telah melakukan pembatalan peminjaman Ruangan { $ruangan->kode_ruangan } { $ruangan->nama_ruangan }, Terimakasih.";
				$id_inbox = $this->m_general->bacaidterakhir("tbl_inbox", "id_inbox");
				$inbox = array(
					'id_inbox' => $id_inbox,
					'isi_inbox' => $pesan,
					'kodepeminjam_user' => $tbl_user->kodepeminjam_user
				);
				$this->m_general->add("tbl_inbox", $inbox);
			}
			redirect('mahasiswa/peminjamanruang/'.$tanggal_peminjaman);
    }	
	public function peminjamanruang_aksi_hapus($id_peminjaman, $tanggal_peminjaman){
			$where['id_peminjaman'] = $id_peminjaman;
			$this->m_general->hapus("tbl_peminjaman_ruangan", $where); // Panggil fungsi hapus() yang ada di m_general.php
			redirect('mahasiswa/peminjamanruang/'.$tanggal_peminjaman);
	}
	
	////////////////////////////////////
}