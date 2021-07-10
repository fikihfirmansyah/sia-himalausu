<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kepengurusan extends CI_Controller {
  function __construct(){
    parent::__construct();

    if($this->session->userdata('status') != "usr_is_login"){
      redirect(base_url("keluar"));
    }
  }

  public function thnkepengurusan($param){
    $data['namaweb'] = "Sistem Keuangan";
    $data['judul'] = "tahunkepengurusan";
    /////////////START CODE WAJIB BAGI FUNCTION DENGAN VIEW/////////////
    $nim = $this->session->userdata('nim');
    $data['data_user'] =  $this->M_User->ambil_user($nim);
    $fkt =  $this->M_User->ambil_univ();
    $data['thnkepengurusan'] = $this->M_Kepengurusan->getAll('keu_tahun_kepengurusan');
    foreach ($fkt as $fk ){
      $data['keu_univ'] = $fk->nama_univ;
      $data['org'] = $fk->nama_org;
      $data['logo_org'] = $fk->logo_org;
    }
    /////////////END CODE WAJIB BAGI FUNCTION DENGAN VIEW/////////////

    if($param == 'data') {
        $this->load->view('admin/kepengurusan/thnkepengurusan',$data);
    }
    else if($param == 'tambah'){
        $this->load->view('admin/kepengurusan/tambah_thnkepengurusan',$data);
    }
    else if($param == 'tambah_aksi'){
      $keterangan = $_POST['keterangan'];
      $tglawal = $_POST['tglawal'];
      $tglakhir = $_POST['tglakhir'];
      $data = array(
        'keterangan' => $keterangan,
        'mulai' => $tglawal,
        'akhir' => $tglakhir,
        'aktif' => 'N'
      );
      $this->M_Kepengurusan->insert('keu_tahun_kepengurusan',$data);
      redirect(base_url("kepengurusan/thnkepengurusan/tambah/?info=1 Tahun Kepengurusan Telah Ditambah."));
    }
    else if($param == 'edit'){
      $id = $_GET['id'];
      $data['thn_kepengurusan'] = $this->M_Kepengurusan->getByID('keu_tahun_kepengurusan','id_thnkepengurusan',$id);
      $this->load->view('admin/kepengurusan/edit_thnkepengurusan',$data);
    }
    else if($param == 'edit_aksi'){
      $id = $_GET['id'];
      $keterangan = $_POST['keterangan'];
      $tglawal = $_POST['tglawal'];
      $tglakhir = $_POST['tglakhir'];
      $status = $_POST['status'];
      $data = array(
        'keterangan' => $keterangan,
        'mulai' => $tglawal,
        'akhir' => $tglakhir,
        'aktif' => $status
      );
      $this->M_Kepengurusan->update('keu_tahun_kepengurusan',array('aktif' => 'N'),'aktif','Y');
      $this->M_Kepengurusan->update('keu_tahun_kepengurusan',$data,'id_thnkepengurusan',$id);
      redirect(base_url("kepengurusan/thnkepengurusan/data/?info=1 Tahun Kepengurusan Berhasil Diperbarui."));
    }
    else if($param == 'hapus_aksi'){
      $id = $_GET['id'];
      $this->M_Kepengurusan->delete('keu_tahun_kepengurusan','id_thnkepengurusan',$id);
      redirect(base_url("kepengurusan/thnkepengurusan/data/?info=1 Tahun Kepengurusan Telah Dihapus."));
    }
  }


}
