<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Departemen extends CI_Controller {
  function __construct(){
		parent::__construct();

		if($this->session->userdata('status') != "usr_is_login"){
			redirect(base_url("keluar"));
		}
    else{
      $data['namaweb'] = "Sistem Keuangan";
    }
	}

  public function daftardepartemen($param){
    $data['namaweb'] = "Sistem Keuangan";
    $data['judul'] = "keu_departemen";

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
    $data['keu_departemen'] = $this->M_Departemen->ambil_departemen();
    if($param == 'data'){
      $this->load->view('admin/keu_departemen/keu_departemen',$data);
    }
    else if($param == 'tambahdepartemen'){
      $this->load->view('admin/keu_departemen/tambahdepartemen',$data);
    }
    else if($param == 'tambahdepartemen_aksi'){
      $keu_departemen = $_POST['t_departemen'];
      $data = array(
        'nama_departemen' => $keu_departemen,
      );
      $this->M_Departemen->insert('keu_departemen',$data);
      redirect(base_url("departemen/daftardepartemen/tambahdepartemen/?info=1 Departemen Telah Ditambah."));
    }
    else if($param == 'editdepartemen'){
      $id = $_GET['id'];
      $data['keu_departemen'] = $this->M_Departemen->getByID('keu_departemen','id_departemen',$id);
      $this->load->view('admin/keu_departemen/editdepartemen',$data);
    }
    else if($param == 'editdepartemen_aksi'){
      $id = $_GET['id'];
      $keu_departemen = $_POST['t_departemen'];
      $data = array(
        'nama_departemen' => $keu_departemen
      );
      $this->M_Departemen->update("keu_departemen",$data,'id_departemen',$id);
      redirect(base_url("departemen/daftardepartemen/data/?info=1 Departemen Berhasil Diperbarui."));
    }
    else if($param == 'hapusdepartemen_aksi'){
      $id = $_GET['id'];
      $this->M_Departemen->delete("keu_departemen",'id_departemen',$id);
      redirect(base_url("departemen/daftardepartemen/data/?info=1 Departemen Telah Dihapus."));
    }
  }

  public function progjadepartemen($param){
    $data['namaweb'] = "Sistem Keuangan";
    $data['judul'] = "progjadepartemen";

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
    $data['progja_departemen'] = $this->M_Departemen->ambil_progja_departemen();
    if($param == 'data'){
      $this->load->view('admin/progjadepartemen/progjadepartemen',$data);
    }
    else if($param == 'detail'){
      $id = $_GET['id'];
      $data['data_progja'] = $this->M_Departemen->ambil_progja_dimana($id);
      $this->load->view('admin/progjadepartemen/detail_progja',$data);
    }
    else if($param == 'tambah'){
      $id = $_GET['id'];
      $data['keu_departemen'] = $this->M_Departemen->getByID('keu_departemen','id_departemen',$id);
      $this->load->view('admin/progjadepartemen/tambahprogjadepartemen',$data);
    }
    else if($param == 'tambahprogja_aksi'){
      $id_departemen = $_POST['id_departemen'];
      $progja = $_POST['t_progja'];
      $biaya = $_POST['t_biaya'];
      $pattern = '/([^0-9]+)/';
      $jlh = preg_replace($pattern,'',$biaya);

      $data = array(
        'id_departemen' => $id_departemen,
        'nama_progja' => $progja,
        'estimasi_biaya' => $jlh
      );
      $this->M_Departemen->insert('keu_program_kerja',$data);
      redirect(base_url("departemen/progjadepartemen/tambah/?id=$id_departemen&info=1 Program Kerja Telah Ditambah."));
    }
    else if($param == 'edit'){
      $id = $_GET['id'];
      $id_departemen = $_GET['keu_departemen'];
      $data['progja'] = $this->M_Departemen->getByID('keu_program_kerja','id_progja',$id);
      $data['keu_departemen'] = $this->M_Departemen->getByID('keu_departemen','id_departemen',$id_departemen);
      $this->load->view('admin/progjadepartemen/editprogjadepartemen',$data);
    }
    else if($param == 'editprogja_aksi'){
      $id = $_GET['id'];
      $id_departemen = $_POST['id_departemen'];
      $nama = $_POST['t_nama'];
      $biaya = $_POST['t_biaya'];
      $pattern = '/([^0-9]+)/';
      $jlh = preg_replace($pattern,'',$biaya);
      $data = array(
        'nama_progja' => $nama,
        'estimasi_biaya' => $jlh
      );
      $this->M_Departemen->update("keu_program_kerja",$data,'id_progja',$id);
      redirect(base_url("departemen/progjadepartemen/detail/?id=$id_departemen&info=1 Program Kerja Berhasil Diperbarui."));
    }
    else if($param == 'hapusprogja_aksi'){
      $id = $_GET['id'];
      $id_departemen = $_GET['id_b'];
      $this->M_Departemen->delete("keu_program_kerja",'id_progja', $id);
      redirect(base_url("departemen/progjadepartemen/detail/?id=$id_departemen&info=1 Program Kerja Telah Dihapus."));
    }
  }

  public function timelineprogja($param){
    $data['namaweb'] = "Sistem Keuangan";
    $data['judul'] = "timelineprogja";

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
    $data['progja_departemen'] = $this->M_Departemen->ambil_progja_departemen();
    if($param == 'data'){
      $data['keu_departemen'] = $this->M_Departemen->ambil_departemen();
      $this->load->view('admin/progjadepartemen/timelineprogja',$data);
    }
    else if($param == 'lihat'){
      $id = $_GET['id'];
      $data['keu_departemen'] = $this->M_Departemen->getByID('keu_departemen','id_departemen',$id);
      $data['waktu'] = $this->M_Departemen->ambil_waktuprogja_dimana($id);
      $data['timeline'] = $this->M_Departemen->ambil_timelineprogja_dimana($id);
      $this->load->view('admin/progjadepartemen/lhttimelineprogja',$data);
    }
    else if($param == 'tambah'){
      $id = $_GET['id'];
      $tahun = $this->M_Departemen->ambil_tahun();
      foreach ($tahun as $row) {
        $data['mulai'] = $row->mulai;
        $data['akhir'] = $row->akhir;
      }
      $data['progja'] = $this->M_Departemen->getByID('keu_program_kerja','id_departemen',$id);
      $data['keu_departemen'] = $this->M_Departemen->getByID('keu_departemen','id_departemen',$id);
      $this->load->view('admin/progjadepartemen/tambahtimelineprogja',$data);
    }
    else if($param == 'tambahtimeline_aksi'){
      $i = 0; // untuk loopingnya
      $progja = $_POST['o_progja'];
      $minggu = $_POST['o_minggu'];
      $bulan = $_POST['o_bulan'];
      $tahun = $_POST['o_tahun'];
      $status = 'N';
      if($progja[0] != null)
      {
        foreach ($progja as $row)
        {
          $data = [
            'id_progja' => $row,
            'minggu' => $minggu[$i],
            'bulan' => $bulan[$i],
            'tahun' => $tahun[$i],
            'status' => $status
          ];
            $insert = $this->M_Departemen->insert('keu_timeline_progja',$data);
              $i++;
          }
      }
      $arr['success'] = true;
      $arr['notif']  = '<div class="alert alert-success">
        <i class="fa fa-check"></i> Data Berhasil Disimpan
      </div>';
      return $this->output->set_output(json_encode($arr));
    }
    else if($param == 'edit'){
      $id = $_GET['id'];
      $id_departemen = $_GET['keu_departemen'];
      $data['keu_timeline_progja'] =  $this->M_Departemen->getByID('keu_timeline_progja','id_timeline_progja',$id);
      $data['progja'] =  $this->M_Departemen->getByID('keu_program_kerja','id_departemen',$id_departemen);
      $data['keu_departemen'] = $this->M_Departemen->getByID('keu_departemen','id_departemen',$id_departemen);
      $this->load->view('admin/progjadepartemen/edittimelineprogja',$data);
    }
    else if($param == 'edittimeline_aksi'){
      $id = $_GET['id'];
      $id_departemen = $_POST['id_departemen'];
      $progja = $_POST['o_progja'];
      $minggu = $_POST['o_minggu'];
      $bulan = $_POST['o_bulan'];
      $tahun = $_POST['t_tahun'];
      $data = array(
        'id_progja' => $progja,
        'minggu' => $minggu,
        'bulan' => $bulan,
        'tahun' => $tahun
      );
      $this->M_Departemen->update('keu_timeline_progja',$data,'id_timeline_progja',$id);
      redirect(base_url("departemen/timelineprogja/lihat/?id=$id_departemen&info=1 Timeline Program Kerja Diperbarui."));
    }
    else if($param == 'hapustimeline_aksi'){
      $id = $_GET['id'];
      $id_departemen = $_GET['id_b'];
      $this->M_Departemen->delete("keu_timeline_progja",'id_timeline_progja', $id);
      redirect(base_url("departemen/timelineprogja/lihat/?id=$id_departemen&info=1 Timeline Program Kerja Telah Dihapus."));
    }

}
}
