<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_Departemen extends CI_Model
{
  //-------------START MODEL UMUM----------

  // menampilkan semua data dari sebuah tabel.
  public function getAll($tables){
      return $this->db->get($tables)->result();
  }

  //menampilkan data berdasarkan where
  public function get_Where($data,$tables){
    return $this->db->get_where($tables,$data)->result();
  }

  //menampilkan satu record brdasarkan parameter.
  public  function getByID($tables,$pk,$id){
      $this->db->where($pk,$id);
      return $this->db->get($tables)->result();
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

  //-------------START MODEL BIDANG----------

  public function ambil_departemen(){
    $data =  "SELECT * FROM keu_departemen b
              JOIN keu_tahun_kepengurusan tk ON b.thnkepengurusan_id = tk.id_thnkepengurusan
              WHERE tk.aktif = 'Y'
              ORDER BY nama_departemen";
    return $this->db->query($data)->result();
  }

  //-------------END MODEL BIDANG----------

  //-------------START MODEL PROGJA----------

  public function ambil_progja_departemen(){
    $data = "SELECT b.nama_departemen,b.id_departemen,count(p.id_progja) as jumlah FROM keu_departemen as b
             left join keu_program_kerja as p on b.id_departemen = p.id_departemen
             JOIN keu_tahun_kepengurusan tk ON b.thnkepengurusan_id = tk.id_thnkepengurusan
             WHERE tk.aktif = 'Y'
             GROUP BY b.id_departemen";
    return $this->db->query($data)->result();
  }

  public function ambil_progja_dimana($id){
    $data = "SELECT p.*,b.nama_departemen FROM keu_departemen as b
              left join keu_program_kerja as p on b.id_departemen = p.id_departemen
              WHERE b.id_departemen = $id order by p.nama_progja ";
    return $this->db->query($data)->result();
  }

  //-------------END MODEL PROGJA----------

  //-------------START MODEL TIMELINE PROGJA----------

  public function ambil_timelineprogja_dimana($id){
    $data = "SELECT p.*,t.*,b.nama_departemen FROM  keu_program_kerja as p
              left join keu_departemen as b on b.id_departemen = p.id_departemen
              left join keu_timeline_progja as t on p.id_progja = t.id_progja
              WHERE p.id_departemen = $id order by t.tahun,t.bulan,t.minggu";
    return $this->db->query($data)->result();
  }

  public function ambil_waktuprogja_dimana($id){
    $data = "SELECT t.bulan,t.tahun,t.bulan from keu_program_kerja as p
              join keu_timeline_progja as t on p.id_progja = t.id_progja
              where p.id_departemen = '$id' group by t.tahun,t.bulan";
    return $this->db->query($data)->result();
  }

  //-------------END MODEL TIMELINE PROGJA----------

  public function ambil_tahun(){
    $data = "SELECT year(mulai) as mulai,year(akhir) as akhir from keu_tahun_kepengurusan
             WHERE aktif = 'Y' ";
    return $this->db->query($data)->result();
  }

}
