<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengeluaran extends CI_Controller {
  function __construct(){
    parent::__construct();

    if($this->session->userdata('status') != "usr_is_login"){
      redirect(base_url("keluar"));
    }
  }

  //--------------------START LAINNYA-------------------
  
  public function lainnya($param){
    $data['namaweb'] = "Sistem Keuangan";
    $data['judul'] = "pengeluaranlainnya";
    /////////////START CODE WAJIB BAGI FUNCTION DENGAN VIEW/////////////
    $nim = $this->session->userdata('nim');
    $data['data_user'] =  $this->M_User->ambil_user($nim);
    $fkt =  $this->M_User->ambil_univ();
    foreach ($fkt as $fk ){
      $data['keu_univ'] = $fk->nama_univ;
      $data['org'] = $fk->nama_org;
      $data['logo_org'] = $fk->logo_org;
    }
    $data['tahun'] = $this->M_Pengurus->getWhere(array('aktif'=>'Y'),'keu_tahun_kepengurusan');
    /////////////END CODE WAJIB BAGI FUNCTION DENGAN VIEW/////////////
    if($param == 'data'){
      $data['keu_pengeluaran_lainnya'] = $this->M_Pengeluaran->ambil_pengeluaran_l();
      $this->load->view('admin/pengeluaran/pengeluaran_l',$data);
    }
    else if($param == 'tambah'){
      $thnkepengurusan = $this->M_Pengeluaran->get_Where(['aktif' => "Y"],'keu_tahun_kepengurusan');
      foreach($thnkepengurusan as $r){
        $id_thnkepengurusan = $r->id_thnkepengurusan;
        $data['tglawal'] = $r->mulai;
        $data['tglakhir'] = $r->akhir;
      }
      $this->load->view('admin/pengeluaran/tambahpengeluaran_l',$data);
    }
    else if($param == 'tambahpengeluaran_aksi'){
      $thnkepengurusan = $this->M_Pengeluaran->ambil_idtahun("keu_tahun_kepengurusan","Y");
      foreach($thnkepengurusan as $r){
        $id_thnkepengurusan = $r->id_thnkepengurusan;
      }
      $tanggal = $_POST['t_tanggal'];
      $keterangan = $_POST['t_keterangan'];
      $jumlah = $_POST['t_jumlah'];
      $pattern = '/([^0-9]+)/';
      $jlh = preg_replace($pattern,'',$jumlah);
      $data = array(
        'tanggal_pgl' => $tanggal,
        'keterangan_pgl' => $keterangan,
        'jumlah_pgl' => $jlh,
        'thnkepengurusan_id' => $id_thnkepengurusan
      );
      $this->M_Pengeluaran->insert('keu_pengeluaran_lainnya',$data);
      redirect(base_url("pengeluaran/lainnya/tambah/?info=1 Pengeluaran Lainnya Telah Ditambah."));
    }
    else if($param == 'edit'){
      $id = $_GET['id'];
      $thnkepengurusan = $this->M_Pengeluaran->get_Where(['aktif' => "Y"],'keu_tahun_kepengurusan');
      foreach($thnkepengurusan as $r){
        $id_thnkepengurusan = $r->id_thnkepengurusan;
        $data['tglawal'] = $r->mulai;
        $data['tglakhir'] = $r->akhir;
      }
      $data['keu_pengeluaran_lainnya'] = $this->M_Pengeluaran->getByID('keu_pengeluaran_lainnya','id_peng_lainnya',$id);
      $this->load->view('admin/pengeluaran/editpengeluaran_l',$data);
    }
    else if($param == 'editpengeluaran_aksi'){
      $id = $_GET['id'];
      $tanggal = $_POST['t_tanggal'];
      $keterangan = $_POST['t_keterangan'];
      $jumlah = $_POST['t_jumlah'];
      $pattern = '/([^0-9]+)/';
      $jlh = preg_replace($pattern,'',$jumlah);
      $data = array(
        'tanggal_pgl' => $tanggal,
        'keterangan_pgl' => $keterangan,
        'jumlah_pgl' => $jlh,
      );
      $this->M_Pengeluaran->update('keu_pengeluaran_lainnya',$data,'id_peng_lainnya',$id);
      redirect(base_url("pengeluaran/lainnya/data/?info=1 Pengeluaran Lainnya Berhasil Diubah."));
    }
    else if($param == 'hapuspengeluaran_aksi'){
      $id = $_GET['id'];
      $this->M_Pengeluaran->delete('keu_pengeluaran_lainnya','id_peng_lainnya', $id);
      redirect(base_url("pengeluaran/lainnya/data/?info=1 Pengeluaran Lainnya Dihapus."));
    }
  }

  //--------------------END LAINNYA-------------------

  public function keu_departemen($param){
    $data['namaweb'] = "Sistem Keuangan";
    $data['judul'] = "pengeluarandepartemen";
    /////////////START CODE WAJIB BAGI FUNCTION DENGAN VIEW/////////////
    $nim = $this->session->userdata('nim');
    $data['data_user'] =  $this->M_User->ambil_user($nim);
    $fkt =  $this->M_User->ambil_univ();
    foreach ($fkt as $fk ){
      $data['keu_univ'] = $fk->nama_univ;
      $data['org'] = $fk->nama_org;
      $data['logo_org'] = $fk->logo_org;
    }
    /////////////END CODE WAJIB BAGI FUNCTION DENGAN VIEW/////////////
    if($param == 'data'){
      $data['tahun'] = $this->M_Pengeluaran->ambil_tahun();
      $this->load->view('admin/pengeluaran/pengeluaran_b',$data);
    }
    else if($param == 'load_data'){
      $bulan = $_GET['bulan'];
      $tahun = $_GET['tahun'];
      $thnkepengurusan = $this->M_Pengeluaran->get_Where(['aktif' => "Y"],'keu_tahun_kepengurusan');
      foreach($thnkepengurusan as $r){
        $id_thnkepengurusan = $r->id_thnkepengurusan;
        $data['tglawal'] = $r->mulai;
        $data['tglakhir'] = $r->akhir;
      }
      $data['pengeluaran_departemen'] = $this->M_Pengeluaran->ambil_pengeluaran_b($bulan,$tahun);
      $this->load->view('admin/pengeluaran/konten/tampil_pengeluaranb_konten.php',$data);

    }
    else if($param == 'edit_aksi'){
      $id = $_GET['id_timeline'];
      $status = $_GET['status'];
      $tanggal = $_GET['tanggal'];
      if($tanggal == '')$tanggal = NULL;
      $data = array(
        'status' => $status,
        'tanggal_terlaksana' => $tanggal
      );
      $update = $this->M_Pengeluaran->update('keu_timeline_progja',$data,'id_timeline_progja',$id);
    }
  }
}
