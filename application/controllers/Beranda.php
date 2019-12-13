<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH . 'third_party/ssp.php';
class Beranda extends CI_Controller {
	function __construct()
	{
		parent::__construct();		
		$this->load->model('m_general');
	}	
	
	public function index()
	{
		$data['tbl_inventaris'] = $this->db->query("select count(a.id_kategori) as jumlah, a.id_kategori, b.nama_kategori from tbl_inventaris a LEFT JOIN tbl_kategori b ON a.id_kategori=b.id_kategori WHERE a.ketersediaan_inventaris='1' GROUP BY a.id_kategori, b.nama_kategori")->result();
		$data['tbl_ruangan'] = $this->db->query("select * from tbl_ruangan order by id_ruangan ASC")->result();
		$this->load->view("v_beranda_header");
		$this->load->view('v_beranda_index',$data);
		$this->load->view("v_beranda_footer");
	}
	
	public function get_data_master_konsultasi()
	{
		$table = "
        (
            SELECT
                *
            FROM tbl_konsultasi
        )temp";
		
        $primaryKey = 'konsultasi_id';
        $columns = array(
        array( 'db' => 'konsultasi_namapengirim',     'dt' => 0 ),
        array( 'db' => 'konsultasi_pesan',     'dt' => 1 ),
        array( 'db' => 'konsultasi_balasan',     'dt' => 2 ),
        array( 'db' => 'konsultasi_created',     'dt' => 3 ),
        array( 'db' => 'konsultasi_updated',     'dt' => 4 ),
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
	
	public function konsultasi()
	{
		$order = "konsultasi_created DESC";
		$data['tbl_konsultasi'] = $this->m_general->view_order("tbl_konsultasi", $order);
		$this->load->view("v_beranda_header");
		$this->load->view('v_beranda_konsultasi',$data);
		$this->load->view("v_beranda_footer");
	}
	
	public function konsultasi_aksi_tambah()
    {
			if($_POST['konsultasi_namapengirim']!=""){
				
				$primary_key = $this->m_general->bacaidterakhir("tbl_konsultasi", "konsultasi_id");
				$_POST['konsultasi_id'] = $primary_key;
				$this->m_general->add("tbl_konsultasi", $_POST);
			}
			redirect('beranda/konsultasi');
    }	
	
}