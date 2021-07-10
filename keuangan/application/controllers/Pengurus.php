<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengurus extends CI_Controller {
  function __construct(){
    parent::__construct();

    if($this->session->userdata('status') != "usr_is_login"){
      redirect(base_url("keluar"));
    }
  }
      //----------------------START CONROLLER KADER ---------------------

    public function daftarpengurus($param){
        $data['namaweb'] = "Sistem Keuangan";
        $data['judul'] = "daftarpengurus";
        /////////////START CODE WAJIB BAGI FUNCTION DENGAN VIEW/////////////
        $nim = $this->session->userdata('nim');
        $data['data_user'] =  $this->M_User->ambil_user($nim);
        $fkt =  $this->M_User->ambil_univ();
        $data['keu_pengurus'] = $this->M_Pengurus->ambil_pengurus();
        foreach ($fkt as $fk ){
          $data['keu_univ'] = $fk->nama_univ;
          $data['org'] = $fk->nama_org;
          $data['logo_org'] = $fk->logo_org;
        }
        $data['tahun'] = $this->M_Pengurus->getWhere(array('aktif'=>'Y'),'keu_tahun_kepengurusan');
        /////////////END CODE WAJIB BAGI FUNCTION DENGAN VIEW/////////////

        if($param == 'data') {
            $this->load->view('admin/keu_pengurus/keu_pengurus',$data);
        }
        else if($param == 'tambah') {
          $data['keu_amanah'] = $this->M_Pengurus->getAll('keu_amanah');
          $data['keu_departemen'] = $this->M_Pengurus->getAll('keu_departemen');
          $this->load->view('admin/keu_pengurus/tambahpengurus',$data);
        }
        else if($param == 'tambahpengurus_aksi'){
          $thnkepengurusan = $this->M_Pengurus->ambil_idtahun("keu_tahun_kepengurusan","Y");
          foreach($thnkepengurusan as $r){
            $id_thnkepengurusan = $r->id_thnkepengurusan;
          }
          $i = 0; // untuk loopingnya
          $nimm = $_POST['t_nim'];
          $nama = $_POST['t_nama'];
          $keu_amanah = $_POST['o_amanah'];
          $keu_departemen = $_POST['o_departemen'];
          if($nimm[0] != null)
          {
            foreach ($nimm as $row)
            {
              $data = [
                'nim' => $row,
                'nama' => $nama[$i],
                'keu_amanah' => $keu_amanah[$i],
                'keu_departemen' => $keu_departemen[$i],
                'thnkepengurusan_id' => $id_thnkepengurusan
              ];
              $data_cek = array(
                'nim' => $row,
                'thnkepengurusan_id' => $id_thnkepengurusan
              );
              $cek =  $this->M_Pengurus->getWhere($data_cek,'keu_pengurus');
              if($cek==0){
                $insert = $this->M_Pengurus->insert('keu_pengurus',$data);
                  $i++;
              }
              else{
                $i++;
              }
            }
          }
            $arr['success'] = true;
            $arr['notif']  = '<div class="alert alert-success">
            <i class="fa fa-check"></i> Data Berhasil Disimpan
            </div>';
            return $this->output->set_output(json_encode($arr));
        }
        else if($param == 'edit'){
            $nim = $_GET['nim'];
            $data['keu_amanah'] = $this->M_Pengurus->getAll('keu_amanah');
            $data['keu_departemen'] = $this->M_Pengurus->getAll('keu_departemen');
            $data['data_pengurus'] = $this->M_Pengurus->ambil_pengurus_dimana($nim);
            $this->load->view('admin/keu_pengurus/editpengurus',$data);
        }
        else if($param == 'editpengurus_aksi'){
              $id = $_POST['id'];
              $nim = $_POST['t_nim'];
              $nama = $_POST['t_nama'];
              $keu_amanah = $_POST['o_amanah'];
              $keu_departemen = $_POST['o_departemen'];
              if($nim==""){
                redirect(base_url("pengurus/daftarpengurus/edit/?error=NIM Tidak Boleh Kosong!&nim=$nim"));
              }else if($nama==""){
                redirect(base_url("pengurus/daftarpengurus/edit/?error=Nama Tidak Boleh Kosong!&nim=$nim"));
              }
              else{
                $data = array(
                  'nim' => $nim,
                  'nama' => $nama,
                  'keu_amanah' => $keu_amanah,
                  'keu_departemen' => $keu_departemen,
                );
                $this->M_Pengurus->update('keu_pengurus',$data,'id_pengurus',$id);
                redirect(base_url("pengurus/daftarpengurus/data/?info=1 Pengurus Berhasil Diperbarui."));
              }
        }
        else if($param == 'hapuspengurus_aksi'){
            $nim = $_GET['nim'];
            $this->M_Pengurus->delete("keu_pengurus",'nim',$nim);
            redirect(base_url("pengurus/daftarpengurus/data/?info=1 Pengurus Dihapus."));
        }

    }

      //----------------------END CONTROLLER KADER ---------------------

      //----------------------START CONTROLLER IURAN KADER ---------------------
    public function iuranpengurus($param){
        $data['namaweb'] = "Sistem Keuangan";
        $data['judul'] = "iuranpengurus";
        /////////////START CODE WAJIB BAGI FUNCTION DENGAN VIEW/////////////
        $nim = $this->session->userdata('nim');
        $data['data_user'] =  $this->M_User->ambil_user($nim);
        $data['iuranpengurus'] = $this->M_Pengurus->ambil_iuran();
        $data['keu_setting'] = $this->M_Pengurus->ambil_setting();
        $fkt =  $this->M_User->ambil_univ();

        foreach ($fkt as $fk ){
          $data['keu_univ'] = $fk->nama_univ;
          $data['org'] = $fk->nama_org;
          $data['logo_org'] = $fk->logo_org;
        }
        /////////////END CODE WAJIB BAGI FUNCTION DENGAN VIEW/////////////
        if($param == 'data'){
          $thnkepengurusan = $this->M_Pengurus->get_Where(['aktif' => "Y"],'keu_tahun_kepengurusan');
          foreach($thnkepengurusan as $r){
            $id_thnkepengurusan = $r->id_thnkepengurusan;
            $data['tglawal'] = $r->mulai;
            $data['tglakhir'] = $r->akhir;
          }
          $this->load->view('admin/iuranpengurus/iuranpengurus',$data);
        }
        else if ($param == 'bayariuran_aksi') {
            $id = $_POST['id'];
            $tanggal = $_POST['t_tanggal'];
            $jumlah = $_POST['t_jumlah'];
            $pattern = '/([^0-9]+)/';
            $jlh = preg_replace($pattern,'',$jumlah);
            $data = array(
              'id_pengurus' => $id,
              'tanggal_pembayaran' => $tanggal,
              'jumlah_pembayaran' => $jlh
            );
          $this->M_Pengurus->insert('keu_riwayat_pembayaran_iuran',$data);
          redirect(base_url("pengurus/iuranpengurus/data/?info=1 Pengurus Membayar Iuran."));
        }
        else if($param == 'detail'){
          $nim = $_GET['nim'];
          $thnkepengurusan = $this->M_Pengurus->ambil_idtahun("keu_tahun_kepengurusan","Y");
          $thnkepengurusan = $this->M_Pengurus->get_Where(['aktif' => "Y"],'keu_tahun_kepengurusan');
          foreach($thnkepengurusan as $r){
            $id_thnkepengurusan = $r->id_thnkepengurusan;
            $data['tglawal'] = $r->mulai;
            $data['tglakhir'] = $r->akhir;
          }
          $data['data_pengurus'] = $this->M_Pengurus->ambil_pengurus_dimana($nim);
          $data['riwayat_iuran'] = $this->M_Pengurus->ambil_riwayat_iuran($nim,$id_thnkepengurusan);
          var_dump($id_thnkepengurusan);
          $this->load->view('admin/iuranpengurus/detail_iuran',$data);
        }
        else if($param == 'editriwayat_aksi'){
          $id = $_GET['id'];
          $id_pengurus = $_POST['id'];
          $nim = $_POST['t_nim'];
          $tanggal = $_POST['t_tanggal'];
          $jumlah = $_POST['t_jumlah'];
          $pattern = '/([^0-9]+)/';
          $jlh = preg_replace($pattern,'',$jumlah);
          $data = array(
            'id_pengurus' => $id_pengurus,
            'tanggal_pembayaran' => $tanggal,
            'jumlah_pembayaran' => $jlh
          );
          $this->M_Pengurus->update('keu_riwayat_pembayaran_iuran',$data,'id_rpi',$id);
          redirect(base_url("pengurus/iuranpengurus/detail/?info=1 Riwayat Pembayaran Iuran Berhasil Diperbarui&nim=$nim"));
        }
        else if($param == 'hapusriwayat_aksi'){
          $id = $_GET['id'];
          $nim = $_GET['nim'];
          $this->M_Pengurus->delete("keu_riwayat_pembayaran_iuran",'id_rpi',$id);
          redirect(base_url("pengurus/iuranpengurus/detail/?info=1 Riwayat Pembayaran Iuran Dihapus&nim=$nim"));
        }
    }

    //----------------------END CONTROLLER IURAN KADER ---------------------

}
