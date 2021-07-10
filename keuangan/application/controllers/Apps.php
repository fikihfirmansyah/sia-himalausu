<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apps extends CI_Controller {
	function index()
	{
    redirect(base_url("apps/login"));
	}
	
  //----------------------HALAMAN LOGIN--------------------
  public function login()
  {
    if($this->session->userdata('status') == "usr_is_login"){
      redirect(base_url("dashboard"));
    }
    function __construct(){
          parent::__construct();

      if($this->session->userdata('status') == "usr_is_login")
      {
        redirect('dashboard');
      }
    }
    $data['logo'] = $this->db->query('SELECT logo_org from keu_univ')->result();
    $this->load->view('login',$data);
  }

  //------------------VALIDASI LOGIN------------------
  public function loginvalidate(){
    $nim = $_POST['nim'];
    $password = $_POST['pass'];
    $where_user = array(
      'nim' 	=> $nim,
      'password'	=> sha1($password),
    );
    $cek_user = $this->M_Login->cek_login("one_admin",$where_user)->num_rows();

    if ($cek_user > 0) {
      $u1 = $this->M_Login->usr_by_nim($nim);
      foreach ($u1 as $u2 ){
        $nama = $u2->nama;
      }
      $data_session = array(
        'nim' => $nim,
        'nama' => $nama,
        'status' => "usr_is_login",
        );
      $this->session->set_userdata($data_session);
      redirect('dashboard');
    }
    else
    {
      $data['logo'] = $this->db->query('SELECT logo_org from keu_univ')->result();
      if($nim == NULL || $password == NULL){
        $pesan = "Harap Isi NIM dan Password";
      }
      else{
      $pesan = "NIM atau Password salah!";
      }
      redirect(base_url("apps/login/?pesan=$pesan"));
    }
  }
}
