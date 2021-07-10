<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Donatur extends CI_Controller {
  function __construct(){
		parent::__construct();

		if($this->session->userdata('status') != "usr_is_login"){
			redirect(base_url("keluar"));
		}
	}
  
  public function daftardonatur($param){
      $data['namaweb'] = "Sistem Keuangan";
      $data['judul'] = "keu_donatur";

      /////////////START CODE WAJIB BAGI FUNCTION DENGAN VIEW/////////////
      $nim = $this->session->userdata('nim');
      $data['data_user'] =  $this->M_User->ambil_user($nim);
      $fkt =  $this->M_User->ambil_univ();
      $data['keu_donatur'] = $this->M_Donatur->ambil_donatur();
      foreach ($fkt as $fk ){
        $data['keu_univ'] = $fk->nama_univ;
        $data['org'] = $fk->nama_org;
        $data['logo_org'] = $fk->logo_org;
      }
      $data['tahun'] = $this->M_Pengurus->getWhere(array('aktif'=>'Y'),'keu_tahun_kepengurusan');
      /////////////END CODE WAJIB BAGI FUNCTION DENGAN VIEW/////////////

      if($param == 'data') {
          $this->load->view('admin/keu_donatur/keu_donatur',$data);
      }
      else if($param == 'tambah') {
        $this->load->view('admin/keu_donatur/tambahdonatur',$data);
      }
      else if($param == 'tambahdonatur_aksi'){
        $thnkepengurusan = $this->M_Donatur->ambil_idtahun("keu_tahun_kepengurusan","Y");
        foreach($thnkepengurusan as $r){
          $id_thnkepengurusan = $r->id_thnkepengurusan;
        }
        $nama = $_POST['t_nama'];
        $alamat = $_POST['t_alamat'];
        $data = array(
          'nama_donatur' => $nama,
          'alamat_donatur' => $alamat,
          'thnkepengurusan_id' => $id_thnkepengurusan
        );
        $this->M_Donatur->insert('keu_donatur',$data);
        redirect(base_url("donatur/daftardonatur/tambah/?info=1 Donatur Telah Ditambah."));
      }
      else if($param == 'edit'){
        $id = $_GET['id'];
        $data['data_donatur'] = $this->M_Donatur->getByID('keu_donatur','id_donatur',$id);
        $this->load->view('admin/keu_donatur/editdonatur',$data);
      }
      else if($param == 'editdonatur_aksi'){
        $id= $_GET['id'];
        $nama = $_POST['t_nama'];
        $alamat = $_POST['t_alamat'];
        $data = array(
          'nama_donatur' => $nama,
          'alamat_donatur' => $alamat,
        );
        $this->M_Donatur->update('keu_donatur',$data,'id_donatur',$id);
        redirect(base_url("donatur/daftardonatur/data/?info=1 Donatur Berhasil Diperbarui."));
      }
      else if($param == 'hapusdonatur_aksi'){
          $id = $_GET['id'];
          $this->M_Donatur->delete("keu_donatur", 'id_donatur',$id);
          redirect(base_url("donatur/daftardonatur/data/?info=1 Donatur Dihapus."));
      }

  }





}
