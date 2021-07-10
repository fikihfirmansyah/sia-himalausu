<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_Pendapatan extends CI_Model
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
  //menampilkan jumlah record berdasarkan where
  public function getWhere($data,$tables){
    return $this->db->get_where($tables,$data)->num_rows();
  }
  //menampilkan satu record brdasarkan parameter.
  public  function getByID($tables,$pk,$id){
      $this->db->where($pk,$id);
      return $this->db->get($tables)->result();
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

  //-------------START MODEL PENDAPATAN IURAN----------

  public function ambil_pendapatan_iuran(){
    $data = "SELECT p.nim,p.nama,a.nama_amanah,b.nama_departemen,i.total_iuran from keu_pengurus p
              INNER JOIN keu_amanah a ON p.keu_amanah = a.id_amanah
              LEFT JOIN keu_departemen b ON p.keu_departemen = b.id_departemen
              LEFT JOIN keu_iuran_pengurus as i ON p.id_pengurus = i.id_pengurus
              JOIN keu_tahun_kepengurusan tk ON p.thnkepengurusan_id = tk.id_thnkepengurusan
              WHERE tk.aktif = 'Y'
              order by b.id_departemen,a.id_amanah";
    return $this->db->query($data)->result();
  }

  //-------------END MODEL PENDAPATAN IURAN----------

  //-------------START MODEL PENDAPATAN LAINNYA----------

  public function ambil_pendapatan_l(){
    $data = "SELECT * from keu_pendapatan_lainnya pl
              JOIN keu_tahun_kepengurusan tk ON pl.thnkepengurusan_id = tk.id_thnkepengurusan
              WHERE tk.aktif = 'Y'
              ORDER BY pl.tanggal_pl ASC";
    return $this->db->query($data)->result();

  }

  public function ambil_idtahun($tabel,$status){
    $data = "SELECT id_thnkepengurusan from $tabel where aktif = '$status'";
    return $this->db->query($data)->result();
  }

  //-------------END MODEL PENDAPATAN LAINNYA----------

  //-------------START MODEL PENDAPATAN DONATUR----------
  public function ambil_pendapatan_d(){
    $data = "SELECT d.nama_donatur,p.*
              from keu_pendapatan_donatur as p left join keu_donatur as d on p.id_donatur = d.id_donatur
              JOIN keu_tahun_kepengurusan tk ON d.thnkepengurusan_id = tk.id_thnkepengurusan
              WHERE tk.aktif = 'Y'";
    return $this->db->query($data)->result();
  }

  public function ambil_tabel_donatur($tabel){
    $data = "SELECT d.nama_donatur,d.id_donatur from keu_donatur d
              JOIN keu_tahun_kepengurusan tk ON d.thnkepengurusan_id = tk.id_thnkepengurusan
              WHERE tk.aktif = 'Y' ORDER BY d.nama_donatur";
    return $this->db->query($data)->result();
  }

    //-------------END MODEL PENDAPATAN DONATUR----------
}
