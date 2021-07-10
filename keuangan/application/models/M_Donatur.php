<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_donatur extends CI_Model
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

  //-------------START MODEL DONATUR------------------

  public function ambil_donatur(){
    $data = "SELECT * from keu_donatur d
             JOIN keu_tahun_kepengurusan tk on d.thnkepengurusan_id = tk.id_thnkepengurusan
             WHERE tk.aktif = 'Y'
             ORDER by nama_donatur ASC";
    return $this->db->query($data)->result();
  }

  public function ambil_idtahun($tabel,$status){
    $data = "SELECT id_thnkepengurusan from $tabel where aktif = '$status'";
    return $this->db->query($data)->result();
  }

  //-------------END MODEL DONATUR------------------
}
