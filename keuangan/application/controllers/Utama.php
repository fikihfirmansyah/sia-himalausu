<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utama extends CI_Controller {
  //---halaman awal berupa biling statement kas keu_pengurus---
	public function index()
	{
		if(isset($_POST['Cek'])){
			$nim = $_POST["nim"];
			$data['nim'] = $nim;
      $data['data_pengurus'] = $this->M_Utama->ambil_pengurus_dimana($nim);
			$data['riwayat_iuran'] = $this->M_Utama->ambil_riwayat_iuran($nim);
			$data['iuranpengurus'] = $this->M_Utama->ambil_iuran_dimana($nim);
			$data['keu_setting'] = $this->M_Utama->ambil_setting();
			$this->load->view('home',$data);
		}
		else{
			$this->load->view('home');
		}
	}
	
	public function ambil_pengurus_dimana($nim){
		$data = "SELECT p.nim,p.nama,p.id_univ,
							a.nama_amanah,p.keu_amanah,
							p.keu_departemen,b.nama_departemen from keu_pengurus p
							INNER JOIN keu_amanah a ON p.keu_amanah = a.id_amanah
							LEFT JOIN keu_departemen b ON p.keu_departemen = b.id_departemen
							JOIN keu_tahun_kepengurusan tp ON p.thnkepengurusan_id = tp.id_thnkepengurusan
							where nim = '$nim' and tp.aktif = 'Y'";
		$query = $this->db->query($data);
		return $query->result();
	}


}
