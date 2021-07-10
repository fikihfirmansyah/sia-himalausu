<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_Pengurus extends CI_Model
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

  // -----------------END MODEL UMUM -------------------------------

  // -----------------START MODEL KADER ----------------------------

  public function ambil_setting(){
    $data = "SELECT * FROM keu_setting s
             JOIN keu_tahun_kepengurusan tk ON s.thnkepengurusan_id = tk.id_thnkepengurusan
             WHERE tk.aktif = 'Y'";
    return $this->db->query($data)->result();
  }

  public function ambil_pengurus(){
    $data = "SELECT p.nim,p.nama,a.nama_amanah,b.nama_departemen from keu_pengurus p
              INNER JOIN keu_amanah a ON p.keu_amanah = a.id_amanah
              LEFT JOIN keu_departemen b ON p.keu_departemen = b.id_departemen
              JOIN keu_tahun_kepengurusan tk ON p.thnkepengurusan_id = tk.id_thnkepengurusan
              WHERE tk.aktif = 'Y'
              order by b.id_departemen,a.id_amanah";
    return $this->db->query($data)->result();
  }

  public function ambil_pengurus_dimana($nim){
  $data = "SELECT p.id_pengurus,p.nim,p.nama,
            a.nama_amanah,p.keu_amanah,
            p.keu_departemen,b.nama_departemen from keu_pengurus p
            INNER JOIN keu_amanah a ON p.keu_amanah = a.id_amanah
            LEFT JOIN keu_departemen b ON p.keu_departemen = b.id_departemen
            JOIN keu_tahun_kepengurusan tk ON p.thnkepengurusan_id = tk.id_thnkepengurusan
            where tk.aktif = 'Y' and nim = '$nim'";
  return $this->db->query($data)->result();
  }

  // -----------------END MODEL KADER ----------------------------

  // ------------------START MODEL IURAN KADER------------------------

  public function ambil_iuran(){
    $data = "SELECT p.*,i.total_iuran as jumlah from keu_pengurus p
              LEFT JOIN keu_iuran_pengurus i ON p.id_pengurus = i.id_pengurus
              INNER JOIN keu_amanah a ON p.keu_amanah = a.id_amanah
              LEFT JOIN keu_departemen b ON p.keu_departemen = b.id_departemen
              JOIN keu_tahun_kepengurusan tk ON p.thnkepengurusan_id = tk.id_thnkepengurusan
              WHERE tk.aktif = 'Y'
              GROUP BY p.nim
              order by b.id_departemen,a.id_amanah";
    return $this->db->query($data)->result();
  }
  public function ambil_riwayat_iuran($nim,$id_thnkepengurusan){
    $data = "SELECT p.id_pengurus,p.nim,p.nama,r.id_rpi,r.tanggal_pembayaran as tanggal,r.jumlah_pembayaran as jumlah from keu_pengurus p
              LEFT JOIN keu_riwayat_pembayaran_iuran as r ON p.id_pengurus = r.id_pengurus
              WHERE p.thnkepengurusan_id = $id_thnkepengurusan and p.nim = '$nim'
              order by r.tanggal_pembayaran asc";
    return $this->db->query($data)->result();
  }
  public function ambil_idtahun($tabel,$status){
    $data = "SELECT id_thnkepengurusan from $tabel where aktif = '$status'";
    return $this->db->query($data)->result();
  }

  //-------------END MODEL IURAN KADER------------------


}
