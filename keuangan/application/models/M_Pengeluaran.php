<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_Pengeluaran extends CI_Model
{
  //-------------START MODEL UMUM----------

  // menampilkan semua data dari sebuah tabel.
  public function getAll($tables){
      return $this->db->get($tables)->result();
  }
  //menampilkan satu record brdasarkan parameter.
  public  function getByID($tables,$pk,$id){
      $this->db->where($pk,$id);
      return $this->db->get($tables)->result();
  }
  //menampilkan data berdasarkan where
  public function get_Where($data,$tables){
    return $this->db->get_where($tables,$data)->result();
  }
  //menampilkan jumlah record berdasarkan where
  public function getWhere($data,$tables){
    return $this->db->get_where($tables,$data)->num_rows();
  }
  // memasukan data ke database.
  public function insert($tables,$data){
      $this->db->insert($tables,$data);
  }
  // update data kedalalam sebuah tabel
  public function update($tables,$data,$pk,$id){
      $this->db->where($pk,$id);
      $this->db->update($tables,$data);
  }
  // menghapus data dari sebuah tabel
  public function delete($tables,$pk,$id){
      $this->db->where($pk,$id);
      $this->db->delete($tables);
  }

  //-------------END MODEL UMUM----------

  //-------------START PENGELUARAN LAINNYA----------

  public function ambil_pengeluaran_l(){
    $data = "SELECT * from keu_pengeluaran_lainnya pgl
              JOIN keu_tahun_kepengurusan tk ON pgl.thnkepengurusan_id = tk.id_thnkepengurusan
              WHERE tk.aktif = 'Y'";
    return $this->db->query($data)->result();
  }

  //-------------END PENGELUARAN LAINNYA----------

  //-------------START PENGELUARAN BIDANG----------

  public function ambil_pengeluaran_b($bulan,$tahun){
    $data = "SELECT p.*,t.*,b.nama_departemen FROM  keu_program_kerja as p
              left join keu_departemen as b on b.id_departemen = p.id_departemen
              left join keu_timeline_progja as t on p.id_progja = t.id_progja
              where t.bulan = $bulan and t.tahun = $tahun
              order by t.tahun,t.bulan,t.minggu";
    return $this->db->query($data)->result();
  }

  //-------------END PENGELUARAN BIDANG----------


  public function ambil_idtahun($tabel,$status){
    $data = "SELECT id_thnkepengurusan from $tabel where aktif = '$status'";
    return $this->db->query($data)->result();
  }

  public function ambil_tahun(){
    $data = "SELECT tahun from keu_timeline_progja group by tahun order by tahun asc";
    return $this->db->query($data)->result();
  }
}
