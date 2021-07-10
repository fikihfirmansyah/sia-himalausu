<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendapatan extends CI_Controller {
  function __construct(){
    parent::__construct();

    if($this->session->userdata('status') != "usr_is_login"){
      redirect(base_url("keluar"));
    }
  }

  //------------------START IURAN --------------------
  public function iuranpengurus($param){
    $data['namaweb'] = "Sistem Keuangan";
    $data['judul'] = "pendapatankas";
    /////////////START CODE WAJIB BAGI FUNCTION DENGAN VIEW/////////////
    $nim = $this->session->userdata('nim');
    $data['data_user'] =  $this->M_User->ambil_user($nim);
    $fkt =  $this->M_User->ambil_univ();
    foreach ($fkt as $fk ){
      $data['keu_univ'] = $fk->nama_univ;
      $data['org'] = $fk->nama_org;
      $data['logo_org'] = $fk->logo_org;
    }
    if($param == 'data'){
      $data['pendapatan_iuran'] = $this->M_Pendapatan->ambil_pendapatan_iuran();
      $this->load->view('admin/pendapatan/pendapatan_i',$data);
    }
  }
    //------------------END IURAN --------------------

  //------------------START LAINNYA --------------------
  public function lainnya($param){
    $data['namaweb'] = "Sistem Keuangan";
    $data['judul'] = "pendapatanlainnya";
    /////////////START CODE WAJIB BAGI FUNCTION DENGAN VIEW/////////////
    $nim = $this->session->userdata('nim');
    $data['data_user'] =  $this->M_User->ambil_user($nim);
    $fkt =  $this->M_User->ambil_univ();
    foreach ($fkt as $fk ){
      $data['keu_univ'] = $fk->nama_univ;
      $data['org'] = $fk->nama_org;
      $data['logo_org'] = $fk->logo_org;
    }
    $data['tahun'] = $this->M_Pendapatan->getWhere(array('aktif'=>'Y'),'keu_tahun_kepengurusan');
    /////////////END CODE WAJIB BAGI FUNCTION DENGAN VIEW/////////////
    if($param == 'data'){
      $data['keu_pendapatan_lainnya'] = $this->M_Pendapatan->ambil_pendapatan_l();
      $this->load->view('admin/pendapatan/pendapatan_l',$data);
    }
    else if($param == 'tambah'){
      $thnkepengurusan = $this->M_Pendapatan->get_Where(['aktif' => "Y"],'keu_tahun_kepengurusan');
      foreach($thnkepengurusan as $r){
        $id_thnkepengurusan = $r->id_thnkepengurusan;
        $data['tglawal'] = $r->mulai;
        $data['tglakhir'] = $r->akhir;
      }
      $this->load->view('admin/pendapatan/tambahpendapatan_l',$data);
    }
    else if($param == 'tambahpendapatan_aksi'){
      $thnkepengurusan = $this->M_Pendapatan->ambil_idtahun("keu_tahun_kepengurusan","Y");
      foreach($thnkepengurusan as $r){
        $id_thnkepengurusan = $r->id_thnkepengurusan;
      }
      $tanggal = $_POST['t_tanggal'];
      $keterangan = $_POST['t_keterangan'];
      $jumlah = $_POST['t_jumlah'];
      $pattern = '/([^0-9]+)/';
      $jlh = preg_replace($pattern,'',$jumlah);
      $data = array(
        'tanggal_pl' => $tanggal,
        'keterangan_pl' => $keterangan,
        'jumlah_pl' => $jlh,
        'thnkepengurusan_id' => $id_thnkepengurusan
      );
      $this->M_Pendapatan->insert('keu_pendapatan_lainnya',$data);
      redirect(base_url("pendapatan/lainnya/tambah/?info=1 Pendapatan Lainnya Telah Ditambah."));
    }
    else if($param == 'edit'){
      $id = $_GET['id'];
      $thnkepengurusan = $this->M_Pendapatan->get_Where(['aktif' => "Y"],'keu_tahun_kepengurusan');
      foreach($thnkepengurusan as $r){
        $id_thnkepengurusan = $r->id_thnkepengurusan;
        $data['tglawal'] = $r->mulai;
        $data['tglakhir'] = $r->akhir;
      }
      $data['keu_pendapatan_lainnya'] = $this->M_Pendapatan->getByID('keu_pendapatan_lainnya','id_p_lainnya',$id);
      $this->load->view('admin/pendapatan/editpendapatan_l',$data);
    }
    else if($param == 'editpendapatan_aksi'){
      $id = $_GET['id'];
      $tanggal = $_POST['t_tanggal'];
      $keterangan = $_POST['t_keterangan'];
      $jumlah = $_POST['t_jumlah'];
      $pattern = '/([^0-9]+)/';
      $jlh = preg_replace($pattern,'',$jumlah);
      $data = array(
        'tanggal_pl' => $tanggal,
        'keterangan_pl' => $keterangan,
        'jumlah_pl' => $jlh,
      );
      $this->M_Pendapatan->update('keu_pendapatan_lainnya',$data,'id_p_lainnya',$id);
      redirect(base_url("pendapatan/lainnya/data/?info=1 Pendapatan Lainnya Berhasil Diperbarui."));
    }
    else if($param == 'hapuspendapatan_aksi'){
      $id = $_GET['id'];
      $this->M_Pendapatan->delete('keu_pendapatan_lainnya','id_p_lainnya', $id);
      redirect(base_url("pendapatan/lainnya/data/?info=1 Pendapatan Lainnya Dihapus."));
    }
  }
  //------------------END LAINNYA --------------------

  //------------------START DONATUR --------------------
  public function keu_donatur($param){
    $data['namaweb'] = "Sistem Keuangan";
    $data['judul'] = "pendapatandonatur";
    /////////////START CODE WAJIB BAGI FUNCTION DENGAN VIEW/////////////
    $nim = $this->session->userdata('nim');
    $data['data_user'] =  $this->M_User->ambil_user($nim);
    $fkt =  $this->M_User->ambil_univ();
    foreach ($fkt as $fk ){
      $data['keu_univ'] = $fk->nama_univ;
      $data['org'] = $fk->nama_org;
      $data['logo_org'] = $fk->logo_org;
    }
    $data['tahun'] = $this->M_Pendapatan->getWhere(array('aktif'=>'Y'),'keu_tahun_kepengurusan');
    /////////////END CODE WAJIB BAGI FUNCTION DENGAN VIEW/////////////
    $data['keu_donatur'] = $this->M_Pendapatan->ambil_tabel_donatur('keu_donatur');
    if($param == 'data'){
      $data['keu_pendapatan_donatur'] = $this->M_Pendapatan->ambil_pendapatan_d();
      $this->load->view('admin/pendapatan/pendapatan_d',$data);
    }
    else if($param == 'tambah'){
      $thnkepengurusan = $this->M_Pendapatan->get_Where(['aktif' => "Y"],'keu_tahun_kepengurusan');
      foreach($thnkepengurusan as $r){
        $id_thnkepengurusan = $r->id_thnkepengurusan;
        $data['tglawal'] = $r->mulai;
        $data['tglakhir'] = $r->akhir;
      }
      $this->load->view('admin/pendapatan/tambahpendapatan_d',$data);
    }
    else if($param == 'tambahpendapatan_aksi'){
      $id_donatur = $_POST['o_donatur'];
      $tanggal = $_POST['t_tanggal'];
      $jumlah = $_POST['t_jumlah'];
      $pattern = '/([^0-9]+)/';
      $jlh = preg_replace($pattern,'',$jumlah);
      $config['upload_path']          = './assets/image/resi_donatur/';
      $config['allowed_types']        = "jpg|png|jpeg";
      $config['max_size']             = 10000;
      $config['file_name']            = base64_encode("" . mt_rand());
      $this->load->library('upload', $config);
      if($this->upload->do_upload('fupload')){
        $data = array(
          'id_donatur' =>$id_donatur,
          'tanggal_pemberian' => $tanggal,
          'jumlah_pemberian' => $jlh,
          'resi_donatur' => $this->upload->data('file_name')
        );
        $this->M_Pendapatan->insert('keu_pendapatan_donatur',$data);
        redirect(base_url("pendapatan/keu_donatur/tambah/?info=1 Pendapatan Donatur Telah Ditambah."));
      }
      else{
        $error = $this->upload->display_errors();
        echo '<div>'.$error.'</div>';
      }
    }
    else if($param == 'edit'){
      $id = $_GET['id'];
      $thnkepengurusan = $this->M_Pendapatan->get_Where(['aktif' => "Y"],'keu_tahun_kepengurusan');
      foreach($thnkepengurusan as $r){
        $id_thnkepengurusan = $r->id_thnkepengurusan;
        $data['tglawal'] = $r->mulai;
        $data['tglakhir'] = $r->akhir;
      }
      $data['keu_pendapatan_donatur'] = $this->M_Pendapatan->getByID('keu_pendapatan_donatur','id_p_donatur',$id);
      $this->load->view('admin/pendapatan/editpendapatan_d',$data);
    }
    else if($param == 'editpendapatan_aksi'){
      $id = $_GET['id'];
      $id_donatur = $_POST['o_donatur'];
      $tanggal = $_POST['t_tanggal'];
      $jumlah = $_POST['t_jumlah'];
      $pattern = '/([^0-9]+)/';
      $jlh = preg_replace($pattern,'',$jumlah);
      $config['upload_path']          = './assets/image/resi_donatur/';
      $config['allowed_types']        = "jpg|png|jpeg";
      $config['max_size']             = 1000;
      $config['file_name']            = base64_encode("" . mt_rand());
      $this->load->library('upload', $config);
      if($this->upload->do_upload('fupload')){
        $resi = $this->db->query("SELECT resi_donatur FROM keu_pendapatan_donatur WHERE id_p_donatur='$id'")->result();
        foreach($resi as $row){
          $resi = $row->resi_donatur;
        }
        $path = './assets/image/resi_donatur/';
          @unlink($path.$resi);
          $data = array(
            'id_donatur' =>$id_donatur,
            'tanggal_pemberian' => $tanggal,
            'jumlah_pemberian' => $jlh,
            'resi_donatur' => $this->upload->data('file_name')
          );
          $this->M_Pendapatan->update('keu_pendapatan_donatur',$data,'id_p_donatur',$id);
          redirect(base_url("pendapatan/keu_donatur/data/?info=1 Pendapatan Donatur Berhasil Diperbarui."));
      }
      else {
        $data = array(
          'id_donatur' =>$id_donatur,
          'tanggal_pemberian' => $tanggal,
          'jumlah_pemberian' => $jlh,
        );
        $this->M_Pendapatan->update('keu_pendapatan_donatur',$data,'id_p_donatur',$id);
        redirect(base_url("pendapatan/keu_donatur/data/?info=1 Pendapatan Donatur Berhasil Diperbarui."));
        }
    }
    else if($param == 'hapuspendapatan_aksi'){
      $id = $_GET['id'];
      $resi = $this->db->query("SELECT resi_donatur FROM keu_pendapatan_donatur WHERE id_p_donatur='$id'")->result();
      foreach($resi as $row){
        $resi = $row->resi_donatur;
      }
      $path = './assets/image/resi_donatur/';
      @unlink($path.$resi);
      $this->M_Pendapatan->delete('keu_pendapatan_donatur','id_p_donatur', $id);
      redirect(base_url("pendapatan/keu_donatur/data/?info=1 Pendapatan Donatur dihapus."));
    }
  }
  //----------------------END DONATUR-------------------------
}
