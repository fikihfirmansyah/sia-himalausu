<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
  function __construct(){
    parent::__construct();

    if($this->session->userdata('status') != "usr_is_login"){
      redirect(base_url("keluar"));
    }
  }

  //halaman dashboard
  public function index(){
    $data['namaweb'] = "Sistem Keuangan";
    $data['judul'] = "dashboard";

    /////////////START CODE WAJIB BAGI FUNCTION DENGAN VIEW/////////////
    $nim = $this->session->userdata('nim');
    $data['data_user'] =  $this->M_User->ambil_user($nim);
    $fkt =  $this->M_User->ambil_univ();
    foreach ($fkt as $fk ){
      $data['keu_univ'] = $fk->nama_univ;
      $data['org'] = $fk->nama_org;
      $data['logo_org'] = $fk->logo_org;
    }
    ///////////END CODE WAJIB BAGI FUNCTION DENGAN VIEW/////////////
    $data['jml_pengurus'] = $this->M_User->ambil_jlpengurus();
    $data['jml_donatur'] = $this->M_User->ambil_jldonatur();
    $tahunkepengurusan = $this->M_User->getWhere(['aktif'=>'Y'],'keu_tahun_kepengurusan');
    $data['tahunkepengurusan'] = $tahunkepengurusan;
    if($tahunkepengurusan >0){
      $saldo = $this->M_User->ambil_saldo();
      foreach ($saldo as $sld){
        $data['kas'] = $sld->saldo_kas;
        $data['saldo'] = $sld->saldo_kas;
      }
      $total_iuran = $this->M_User->ambil_piuran();
      foreach ($total_iuran as $iuran){
        $data['kas'] += $iuran->jumlah;
        $data['pendapatan'] = array('Pendapatan Iuran'=>$iuran->jumlah);
      }
      $total_pd = $this->M_User->ambil_pdonatur();
      foreach ($total_pd as $pd){
        $data['kas'] += $pd->jumlah;
        $data['pendapatan'] += array('Pendapatan Donatur' => $pd->jumlah);
      }
      $total_pl = $this->M_User->ambil_plainnya();
      foreach ($total_pl as $pl){
        $data['kas'] += $pl->jumlah;
        $data['pendapatan'] += array('Pendapatan Lainnya' => $pl->jumlah);
      }
      $total_pengb = $this->M_User->ambil_pengdepartemen();
      foreach($total_pengb as $pengb){
        $data['kas'] -= $pengb->jumlah;
        $data['pengeluaran'] = array('Pengeluaran Departemen' =>$pengb->jumlah);
      }
      $total_pengl = $this->M_User->ambil_penglainnya();
      foreach ($total_pengl as $pengl){
        $data['kas'] -= $pengl->jumlah;
        $data['pengeluaran'] += array('Pengeluaran Lainnya' =>$pengl->jumlah);
      }
      $data['pendapatan_per_bulan'] = $this->M_User->ambil_pendapatan_per_bulan();
      $data['tgl_awal'] = $this->M_User->ambil_bulan_awal();
    }
    $this->load->view('admin/dashboard/dashboard',$data);
  }
  
  public function load_grafik(){
    $grafik = $_GET['grafik'];
    $data['pendapatan_per_bulan'] = $this->M_User->ambil_pendapatan_per_bulan();
    if($grafik == 'saldo'){
      $this->load->view('admin/dashboard/konten/grafiksaldo_konten.php',$data);
    }
    else{
      $this->load->view('admin/dashboard/konten/grafikpendapatan_konten.php',$data);
    }
  }

}
