<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaturan extends CI_Controller {
  function __construct(){
		parent::__construct();

		if($this->session->userdata('status') != "usr_is_login"){
			redirect(base_url("keluar"));
		}
    else{
      $data['namaweb'] = "Sistem Keuangan";
    }
	}

  // ---------START BAGIAN AKUN --------------------
  
  public function akun($param){
    $data['namaweb'] = "Sistem Keuangan";
    $data['judul'] = "akun";

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
    if($param == 'infoakun'){
      $this->load->view('admin/akun/akun',$data);
    }
    if($param == 'editpassword'){
      $this->load->view('admin/akun/editpassword',$data);
    }
    if($param == 'validasi_ep'){
      $password_lama = $_POST['password_lama'];
      $password_baru = $_POST['password_baru'];
      $konfirmasi_password = $_POST['konfirmasi_password'];
      if($password_baru=="")
			{
				redirect(base_url("pengaturan/akun/editpassword/?error=Password Tidak Boleh Kosong!"));
			}

			else if($konfirmasi_password=="" OR $konfirmasi_password!=$password_baru)
			{
				redirect(base_url("pengaturan/akun/editpassword/?error=Konfirmasi Password Tidak Cocok!"));
			}

      $where_user = array(
        'nim' => $this->session->userdata('nim'),
        'password' => sha1($password_lama)
      );
      $cek_password = $this->M_User->cekpassword_user('one_admin',$where_user)->num_rows();
			if($cek_password ==1 ){
			$data = array('Password' => sha1($password_baru));
			$this->db->where('nim', $this->session->userdata('nim'));
			$this->db->update('one_admin', $data);
			session_destroy();
			redirect(base_url("utama/login/?info=Password Anda Berhasil Digantu. Silahkan Login Kembali."));
			}
			else{
				redirect(base_url("pengaturan/akun/editpassword/?error=Password Lama Salah!"));
			}

    }

  }

  //-------------------END BAGIAN AKUN-------------------

  //--------------------START BAGIAN Organisasi --------------------

  public function org($param){
    $data['namaweb'] = "Sistem Keuangan";
    $data['judul'] = "org";

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
    if($param == 'infoorg'){
      $this->load->view('admin/org/org',$data);
    }
    if($param == 'editorg'){
      $this->load->view('admin/org/editorg',$data);
    }
    if($param == 'do_update'){
      $org = $this->input->post('org');
      $keu_univ = $this->input->post('keu_univ');
      $config['upload_path']          = './assets/image/';
      $config['allowed_types']        = "gif|jpg|png|jpeg|pdf";
      $config['max_size']             = 10000;
      $this->load->library('upload', $config);

      if($this->upload->do_upload('fupload'))
      {
        $logo = $data['logo_org'];
        $path = './assets/image/';
          @unlink($path.$logo);
        $data = array(
          'nama_univ' => $keu_univ,
          'nama_org' => $org,
          'logo_org' => $this->upload->data('file_name')
        );
        $this->db->where('id_univ', $id_univ);
        $this->db->update('keu_univ', $data);
      }
      else {
        $data = array(
          'nama_univ' => $keu_univ,
          'nama_org' => $org,
        );
        // $this->db->where('id_univ', $id_univ);
        $this->db->update('keu_univ', $data);
      }
      redirect(base_url("pengaturan/org/infoorg/?info=Data Organisasi Berhasil Diperbarui"));
    }
  }

  //--------------------END BAGIAN Organisasi --------------------

  public function iuranpengurus($param){
    $data['namaweb'] = "Sistem Keuangan";
    $data['judul'] = "settingiuranpengurus";

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

    $data['keu_setting'] = $this->M_User->ambil_setting('keu_setting');
    /////////////END CODE WAJIB BAGI FUNCTION DENGAN VIEW/////////////
    if($param == 'infoiuran'){
      $this->load->view('admin/settingiuran/setting_iuran',$data);
    }
    else if($param == 'edit'){
      $thnkepengurusan = $this->M_User->get_Where(['aktif' => "Y"],'keu_tahun_kepengurusan');
      foreach($thnkepengurusan as $r){
        $id_thnkepengurusan = $r->id_thnkepengurusan;
        $data['tglawal'] = $r->mulai;
        $data['tglakhir'] = $r->akhir;
      }
      $this->load->view('admin/settingiuran/edit_setting_iuran',$data);
    }
    else if($param == 'do_update'){
      $tgl = $_POST['date'];
      $id_kepengurusan = $_POST['id_kepengurusan'];
      $besariuran = $_POST['besariuran'];
      $saldokas = $_POST['saldokas'];
      $pattern = '/([^0-9]+)/';
      $bsr_iuran = preg_replace($pattern,'',$besariuran);
      $saldo = preg_replace($pattern,'',$saldokas);
      $data = array(
        'tanggal_awal' => $tgl,
        'keu_iuran_pengurus' => $bsr_iuran,
        'saldo_kas' => $saldo
      );
      $this->M_Kepengurusan->update('keu_setting', $data,'thnkepengurusan_id',$id_kepengurusan);
      redirect(base_url("pengaturan/iuranpengurus/infoiuran/?info=Data Setting Iuran Pengurus Berhasil Diperbarui."));
    }

  }
}
