<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_Cetak extends CI_Model
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

  //-------------START MODEL Cetak------------------

  public function get_data($bulan,$tahun){
    $data ="SELECT keterangan,tanggal,sum(pendapatan) as pendapatan,sum(pengeluaran) as pengeluaran FROM(
            SELECT CONCAT('Sumbangan Donatur dari Sdr/i ', nama_donatur) as keterangan,tanggal_pemberian as tanggal, SUM(jumlah_pemberian) AS pendapatan, 0 as pengeluaran FROM keu_pendapatan_donatur as p left join keu_donatur as d on p.id_donatur = d.id_donatur union all
            SELECT keterangan_pl as keterangan, tanggal_pl as tanggal, SUM(jumlah_pl) AS pendapatan,0 as pengeluaran FROM keu_pendapatan_lainnya union all
            SELECT CONCAT('Pembayaran iuran keu_pengurus dari ', nama) as keterangan ,tanggal_pembayaran as tanggal, SUM(jumlah_pembayaran) AS pendapatan,0 as pengeluaran FROM keu_riwayat_pembayaran_iuran p LEFT JOIN keu_pengurus as k ON k.id_pengurus = p.id_pengurus union all
            SELECT keterangan_pgl as keterangan, tanggal_pgl as tanggal, 0 as pendapatan,SUM(jumlah_pgl) AS pengeluaran FROM keu_pengeluaran_lainnya union all
            SELECT CONCAT('Pengeluaran Dana Program Kerja ',nama_progja) as keterangan, tanggal_terlaksana as tanggal, 0 as pendapatan,SUM(estimasi_biaya) AS pengeluaran FROM keu_timeline_progja tp join keu_program_kerja pk on tp.id_progja = pk.id_progja )x
            WHERE  MONTH(tanggal) = $bulan and YEAR(tanggal) = $tahun GROUP BY keterangan,tanggal";
    return $this->db->query($data)->result();
  }

  //-------------START MODEL Cetak------------------


  public function ambil_tahun(){
    $data = "SELECT year(mulai) as mulai,year(akhir) as akhir from keu_tahun_kepengurusan
             WHERE aktif = 'Y' ";
    return $this->db->query($data)->result();
  }

}
?>
