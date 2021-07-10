<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log extends CI_Controller {
  function __construct(){
    parent::__construct();

    if($this->session->userdata('status') != "usr_is_login"){
      redirect(base_url("keluar"));
    }
  }
  //halaman dashboard
  public function index(){
    $data['namaweb'] = "Sistem Keuangan";
    $data['judul'] = "log";

    /////////////START CODE WAJIB BAGI FUNCTION DENGAN VIEW/////////////
    $nim = $this->session->userdata('nim');
    $id_univ = $this->session->userdata('iduniv');
    $data['data_user'] =  $this->M_User->ambil_user($nim);
    $fkt =  $this->M_User->ambil_univ($id_univ);
    foreach ($fkt as $fk ){
      $data['keu_univ'] = $fk->nama_univ;
      $data['org'] = $fk->nama_org;
      $data['logo_org'] = $fk->logo_org;
    }
    /////////////END CODE WAJIB BAGI FUNCTION DENGAN VIEW/////////////
    $this->load->view('admin/log',$data);
  }


}
