<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cetak extends CI_Controller {
  function __construct(){
		parent::__construct();
    if($this->session->userdata('status') != "usr_is_login"){
      redirect(base_url("keluar"));
    }
    else{
      $data['namaweb'] = "Sistem Keuangan";
    }
  }

  public function index($param)
  {
    $data['namaweb'] = "Sistem Keuangan";
    $data['judul'] = "cetak";

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
    if($param == 'data'){
      $thnkepengurusan = $this->M_Pengeluaran->get_Where(['aktif' => "Y"],'keu_tahun_kepengurusan');
      $tahun = $this->M_Cetak->ambil_tahun();
      foreach ($tahun as $row) {
        $data['mulai'] = $row->mulai;
        $data['akhir'] = $row->akhir;
      }
      $this->load->view('admin/cetak/index.php',$data);
    }
    else if($param == 'load_data'){
      $bulan = $_GET['bulan'];
      $tahun = $_GET['tahun'];
      $data['laporan'] = $this->M_Cetak->get_data($bulan,$tahun);
      $this->load->view('admin/cetak/konten/tampil_laporan_konten.php',$data);
    }
    else if($param == 'link_laporan'){
      $bulan = $_GET['bulan'];
      $tahun = $_GET['tahun'];
      $data['laporan'] = $this->M_Cetak->get_data($bulan,$tahun);
      if(!empty($data['laporan'])){
        echo '<a target="_blank" class="btn btn-warning" href='.base_url("cetak/index/cetak_laporan/?bulan=$bulan&tahun=$tahun").'><i class="fa fa-print"></i> Cetak Laporan</a>';
      }
    }
    else if($param == 'cetak_laporan'){
      $bulan = $_GET['bulan'];
      $tahun = $_GET['tahun'];
      $data['bulan'] = $bulan;
      $data['tahun'] = $tahun;
      $data['laporan'] = $this->M_Cetak->get_data($bulan,$tahun);
      // $saldo['saldo'] = $this->M_Cetak->get_saldo($buan,$tahun);
      $this->load->library('mypdf');
      $this->mypdf->generate('admin/cetak/konten/dokumen_konten', $data, 'Laporan Keuangan HIMALA USU', 'A4', 'portrait');
    }
  }

}
