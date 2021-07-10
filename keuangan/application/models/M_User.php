<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_user extends CI_Model
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


  public function cekpassword_user($tabel,$where){
    return $this->db->get_where($tabel,$where);
  }

  public function ambil_user($nim){
    $data = "SELECT * FROM one_admin where nim = '$nim'";
    return $this->db->query($data)->result();
  }
  public function ambil_univ(){
    $data = "SELECT * FROM keu_univ";
    return $this->db->query($data)->result();
  }
  public function ambil_setting(){
    $data = "SELECT * FROM keu_setting s
             JOIN keu_tahun_kepengurusan tk ON s.thnkepengurusan_id = tk.id_thnkepengurusan
             WHERE tk.aktif = 'Y'";
    return $this->db->query($data)->result();
  }
  public function ambil_bulan_awal(){
    $data = "SELECT MONTH(tanggal_awal) as bulan,YEAR(tanggal_awal) as tahun FROM keu_setting s
             JOIN keu_tahun_kepengurusan tk ON s.thnkepengurusan_id = tk.id_thnkepengurusan
             WHERE tk.aktif = 'Y'";
    return $this->db->query($data)->result();
  }

  public function ambil_jlpengurus(){
    $data = "SELECT count(nim) as jmlpengurus FROM keu_pengurus p
              JOIN keu_tahun_kepengurusan tk ON p.thnkepengurusan_id = tk.id_thnkepengurusan
              WHERE tk.aktif = 'Y'";
    return $this->db->query($data)->result();
  }

  public function ambil_jldonatur(){
    $data = "SELECT count(id_donatur) as jmldonatur FROM keu_donatur d
              JOIN keu_tahun_kepengurusan tk ON d.thnkepengurusan_id = tk.id_thnkepengurusan
              WHERE tk.aktif = 'Y'";
    return $this->db->query($data)->result();
  }

  public function ambil_saldo(){
    $data = "SELECT saldo_kas from keu_setting s
              JOIN keu_tahun_kepengurusan tk ON s.thnkepengurusan_id = tk.id_thnkepengurusan
              WHERE tk.aktif = 'Y'";
    return $this->db->query($data)->result();
  }

  public function ambil_piuran(){
    $data = "SELECT sum(i.total_iuran) as jumlah
             FROM keu_iuran_pengurus as i
             JOIN keu_pengurus as p on i.id_pengurus = p.id_pengurus
             JOIN keu_tahun_kepengurusan tk ON p.thnkepengurusan_id = tk.id_thnkepengurusan
             WHERE tk.aktif = 'Y'";
    return $this->db->query($data)->result();
  }

  public function ambil_pdonatur(){
    $data = "SELECT sum(pd.jumlah_pemberian) as jumlah FROM keu_pendapatan_donatur pd
              JOIN keu_donatur d ON pd.id_donatur = d.id_donatur
              JOIN keu_tahun_kepengurusan tk ON d.thnkepengurusan_id = tk.id_thnkepengurusan
              WHERE tk.aktif = 'Y'";
    return $this->db->query($data)->result();
  }

  public function ambil_plainnya(){
    $data = "SELECT sum(pl.jumlah_pl) as jumlah FROM keu_pendapatan_lainnya pl
              JOIN keu_tahun_kepengurusan tk ON pl.thnkepengurusan_id = tk.id_thnkepengurusan
              WHERE tk.aktif = 'Y'";
    return $this->db->query($data)->result();
  }

  public function ambil_penglainnya(){
    $data = "SELECT sum(pgl.jumlah_pgl) as jumlah FROM keu_pengeluaran_lainnya pgl
              JOIN keu_tahun_kepengurusan tk ON pgl.thnkepengurusan_id = tk.id_thnkepengurusan
              WHERE tk.aktif = 'Y'";
    return $this->db->query($data)->result();
  }

  public function ambil_pengdepartemen(){
    $data = "SELECT sum(pk.estimasi_biaya) as jumlah FROM keu_program_kerja pk
            JOIN keu_timeline_progja tp on pk.id_progja = tp.id_progja
            JOIN keu_departemen b on pk.id_departemen = b.id_departemen
            JOIN keu_tahun_kepengurusan tk ON b.thnkepengurusan_id = tk.id_thnkepengurusan
            WHERE tk.aktif = 'Y'";
    return $this->db->query($data)->result();
  }

  public function ambil_pendapatan_per_bulan(){
    $data = "SELECT bulan,tahun,sum(pendapatan) as pendapatan,sum(pengeluaran) as pengeluaran
             FROM(
              SELECT MONTH(tanggal_pemberian) AS bulan, YEAR(tanggal_pemberian) AS tahun, SUM(jumlah_pemberian) AS pendapatan, 0 as pengeluaran
              FROM keu_pendapatan_donatur AS p LEFT JOIN keu_donatur d ON p.id_donatur = d.id_donatur
              JOIN keu_tahun_kepengurusan tk ON d.thnkepengurusan_id = tk.id_thnkepengurusan
              WHERE aktif = 'Y'
              GROUP BY YEAR(tanggal_pemberian), MONTH(tanggal_pemberian) union all
              SELECT MONTH(tanggal_pl) AS bulan, YEAR(tanggal_pl) AS tahun, SUM(jumlah_pl) AS pendapatan,0 as pengeluaran
              FROM keu_pendapatan_lainnya AS pl
              JOIN keu_tahun_kepengurusan tk ON pl.thnkepengurusan_id = tk.id_thnkepengurusan
              WHERE aktif = 'Y'
              GROUP BY YEAR(tanggal_pl), MONTH(tanggal_pl) union all
              SELECT MONTH(tanggal_pembayaran) AS bulan, YEAR(tanggal_pembayaran) AS tahun, SUM(jumlah_pembayaran) AS pendapatan,0 as pengeluaran
              FROM keu_riwayat_pembayaran_iuran AS rp JOIN keu_pengurus p ON p.id_pengurus = rp.id_pengurus
              JOIN keu_tahun_kepengurusan tk ON p.thnkepengurusan_id = tk.id_thnkepengurusan
              WHERE aktif = 'Y'
              GROUP BY YEAR(tanggal_pembayaran), MONTH(tanggal_pembayaran)  union all
              SELECT MONTH(tanggal_pgl) AS bulan, YEAR(tanggal_pgl) AS tahun, 0 as pendapatan,SUM(jumlah_pgl) AS pengeluaran
              FROM keu_pengeluaran_lainnya AS pgl JOIN keu_tahun_kepengurusan tk ON pgl.thnkepengurusan_id = tk.id_thnkepengurusan
              WHERE aktif = 'Y'
              GROUP BY YEAR(tanggal_pgl), MONTH(tanggal_pgl)
              union all
              SELECT MONTH(tanggal_terlaksana) AS bulan, YEAR(tanggal_terlaksana) AS tahun, 0 as pendapatan,SUM(estimasi_biaya) AS pengeluaran
              FROM keu_timeline_progja AS tp join keu_program_kerja pk on tp.id_progja = pk.id_progja
              JOIN keu_tahun_kepengurusan tk ON pk.thnkepengurusan_id = tk.id_thnkepengurusan
              WHERE status='Y' AND aktif ='Y'
              GROUP BY YEAR(tanggal_terlaksana), MONTH(tanggal_terlaksana)
              )x GROUP by bulan,tahun order by tahun,bulan asc";
    return $this->db->query($data)->result();
  }
  
}
