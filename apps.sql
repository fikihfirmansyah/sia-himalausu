-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2021 at 01:42 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u6545692_apps`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`u6545692`@`localhost` PROCEDURE `ambil_iuran_byuniv` (IN `id_univ` INT)  begin
SELECT sum(i.total_iuran) as jumlah from keu_iuran_pengurus as i join keu_pengurus as p on i.nim = p.nim where p.id_univ = id_univ;
end$$

CREATE DEFINER=`u6545692`@`localhost` PROCEDURE `ambil_jldonatur_byuniv` (IN `id_univ` INT(2))  NO SQL
SELECT count(id_donatur) as jmldonatur FROM keu_donatur where id_univ = id_univ$$

CREATE DEFINER=`u6545692`@`localhost` PROCEDURE `ambil_jlpengurus_byuniv` (IN `id_univ` INT(2))  NO SQL
SELECT count(nim) as jmlpengurus FROM keu_pengurus where id_univ = id_univ$$

CREATE DEFINER=`u6545692`@`localhost` PROCEDURE `ambil_pdonatur_byuniv` (IN `id` INT)  begin
SELECT sum(jumlah_pemberian) as jumlah FROM keu_pendapatan_donatur where id_univ = id;
end$$

CREATE DEFINER=`u6545692`@`localhost` PROCEDURE `ambil_penglainnya_byuniv` (IN `id` INT(2))  NO SQL
begin
SELECT sum(jumlah_pgl) as jumlah FROM keu_pengeluaran_lainnya where id_univ = id;
end$$

CREATE DEFINER=`u6545692`@`localhost` PROCEDURE `ambil_plainnya_byuniv` (IN `id` INT(2))  NO SQL
begin
SELECT sum(jumlah_pl) as jumlah FROM keu_pendapatan_lainnya where id_univ = id;
end$$

CREATE DEFINER=`u6545692`@`localhost` PROCEDURE `ambil_saldo_byuniv` (IN `id_univ` INT)  begin
SELECT saldo_kas from keu_setting where id_univ = id_univ;
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `keu_amanah`
--

CREATE TABLE `keu_amanah` (
  `id_amanah` int(11) NOT NULL,
  `nama_amanah` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keu_amanah`
--

INSERT INTO `keu_amanah` (`id_amanah`, `nama_amanah`) VALUES
(1, 'Ketua Umum'),
(2, 'Wakil Ketua I'),
(3, 'Wakil Ketua II'),
(4, 'Sekretaris Umum'),
(5, 'Wakil Sekretaris Umum'),
(6, 'Bendahara Umum'),
(7, 'Wakil Bendahara Umum'),
(8, 'Kepala Departemen'),
(9, 'Sekretaris Departemen'),
(10, 'nama_amanah');

-- --------------------------------------------------------

--
-- Table structure for table `keu_departemen`
--

CREATE TABLE `keu_departemen` (
  `id_departemen` int(11) NOT NULL,
  `nama_departemen` varchar(100) NOT NULL,
  `thnkepengurusan_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keu_departemen`
--

INSERT INTO `keu_departemen` (`id_departemen`, `nama_departemen`, `thnkepengurusan_id`) VALUES
(1, 'BPH', 1),
(2, 'Agama dan Pendidikan', 1),
(3, 'Organisasi dan Keanggotaan', 1),
(4, 'Pengembangan SDM dan SDA', 1),
(5, 'Olahraga Seni dan Budaya', 1),
(6, 'Sosial dan Lingkungan Hidup', 1),
(7, 'Media dan Informasi', 1),
(9, 'Bendahara Umum', 0),
(10, 'Bendahara Umum', 0),
(11, 'Bendahara Umum', 0),
(12, 's', 0);

-- --------------------------------------------------------

--
-- Table structure for table `keu_donatur`
--

CREATE TABLE `keu_donatur` (
  `id_donatur` int(11) NOT NULL,
  `nama_donatur` varchar(50) NOT NULL,
  `alamat_donatur` text NOT NULL,
  `thnkepengurusan_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `keu_iuran_pengurus`
--

CREATE TABLE `keu_iuran_pengurus` (
  `id_pengurus` int(11) NOT NULL,
  `total_iuran` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keu_iuran_pengurus`
--

INSERT INTO `keu_iuran_pengurus` (`id_pengurus`, `total_iuran`) VALUES
(101, 0);

-- --------------------------------------------------------

--
-- Table structure for table `keu_pendapatan_donatur`
--

CREATE TABLE `keu_pendapatan_donatur` (
  `id_p_donatur` int(11) NOT NULL,
  `id_donatur` int(2) NOT NULL,
  `tanggal_pemberian` date NOT NULL,
  `jumlah_pemberian` bigint(20) NOT NULL,
  `resi_donatur` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `keu_pendapatan_lainnya`
--

CREATE TABLE `keu_pendapatan_lainnya` (
  `id_p_lainnya` int(11) NOT NULL,
  `tanggal_pl` date NOT NULL,
  `keterangan_pl` text NOT NULL,
  `jumlah_pl` bigint(20) NOT NULL,
  `thnkepengurusan_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `keu_pengeluaran_lainnya`
--

CREATE TABLE `keu_pengeluaran_lainnya` (
  `id_peng_lainnya` int(11) NOT NULL,
  `tanggal_pgl` date NOT NULL,
  `keterangan_pgl` text NOT NULL,
  `jumlah_pgl` bigint(20) NOT NULL,
  `thnkepengurusan_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `keu_pengurus`
--

CREATE TABLE `keu_pengurus` (
  `id_pengurus` int(11) NOT NULL,
  `nim` varchar(9) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `keu_amanah` int(10) DEFAULT NULL,
  `keu_departemen` int(5) DEFAULT NULL,
  `thnkepengurusan_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `keu_pengurus`
--
DELIMITER $$
CREATE TRIGGER `insert_iuran_pengurus` AFTER INSERT ON `keu_pengurus` FOR EACH ROW BEGIN
insert into keu_iuran_pengurus SET
id_pengurus = NEW.id_pengurus, total_iuran = 0;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `keu_program_kerja`
--

CREATE TABLE `keu_program_kerja` (
  `id_progja` int(11) NOT NULL,
  `id_departemen` int(2) NOT NULL,
  `nama_progja` varchar(100) NOT NULL,
  `estimasi_biaya` int(11) NOT NULL,
  `thnkepengurusan_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `keu_riwayat_pembayaran_iuran`
--

CREATE TABLE `keu_riwayat_pembayaran_iuran` (
  `id_rpi` int(11) NOT NULL,
  `id_pengurus` int(11) NOT NULL,
  `tanggal_pembayaran` date NOT NULL,
  `jumlah_pembayaran` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `keu_riwayat_pembayaran_iuran`
--
DELIMITER $$
CREATE TRIGGER `insert_iuran_pengurus2` AFTER INSERT ON `keu_riwayat_pembayaran_iuran` FOR EACH ROW BEGIN
UPDATE keu_iuran_pengurus SET
total_iuran = total_iuran + NEW.jumlah_pembayaran WHERE id_pengurus = NEW.id_pengurus;
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_iuran_pengurus` AFTER DELETE ON `keu_riwayat_pembayaran_iuran` FOR EACH ROW BEGIN
UPDATE keu_iuran_pengurus
SET total_iuran = total_iuran-OLD.jumlah_pembayaran WHERE id_pengurus = OLD.id_pengurus;
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_iuran_pengurus2` AFTER UPDATE ON `keu_riwayat_pembayaran_iuran` FOR EACH ROW BEGIN
UPDATE keu_iuran_pengurus
SET total_iuran = total_iuran-OLD.jumlah_pembayaran+NEW.jumlah_pembayaran WHERE id_pengurus = OLD.id_pengurus;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `keu_setting`
--

CREATE TABLE `keu_setting` (
  `id_setting` int(11) NOT NULL,
  `tanggal_awal` date DEFAULT NULL,
  `keu_iuran_pengurus` int(11) DEFAULT NULL,
  `saldo_kas` int(11) DEFAULT NULL,
  `thnkepengurusan_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keu_setting`
--

INSERT INTO `keu_setting` (`id_setting`, `tanggal_awal`, `keu_iuran_pengurus`, `saldo_kas`, `thnkepengurusan_id`) VALUES
(1, '2021-03-12', 10000, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `keu_tahun_kepengurusan`
--

CREATE TABLE `keu_tahun_kepengurusan` (
  `id_thnkepengurusan` int(11) NOT NULL,
  `keterangan` varchar(15) NOT NULL,
  `mulai` date NOT NULL,
  `akhir` date NOT NULL,
  `aktif` varchar(1) NOT NULL COMMENT 'Y = aktif dan N = tidak'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keu_tahun_kepengurusan`
--

INSERT INTO `keu_tahun_kepengurusan` (`id_thnkepengurusan`, `keterangan`, `mulai`, `akhir`, `aktif`) VALUES
(1, '2021/2022', '2021-03-12', '2022-03-12', 'Y');

--
-- Triggers `keu_tahun_kepengurusan`
--
DELIMITER $$
CREATE TRIGGER `delete_setting` BEFORE DELETE ON `keu_tahun_kepengurusan` FOR EACH ROW BEGIN
	DELETE FROM keu_setting where thnkepengurusan_id = old.id_thnkepengurusan;    
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insert_setting` AFTER INSERT ON `keu_tahun_kepengurusan` FOR EACH ROW BEGIN
insert into keu_setting SET 
thnkepengurusan_id = NEW.id_thnkepengurusan;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `keu_timeline_progja`
--

CREATE TABLE `keu_timeline_progja` (
  `id_timeline_progja` int(11) NOT NULL,
  `id_progja` int(3) NOT NULL,
  `minggu` int(1) NOT NULL,
  `bulan` int(2) NOT NULL,
  `tahun` year(4) NOT NULL,
  `tanggal_terlaksana` date DEFAULT NULL,
  `status` text NOT NULL COMMENT 'Y = terselenggara , N = belum/tidak terselenggara'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `keu_univ`
--

CREATE TABLE `keu_univ` (
  `id_univ` int(5) NOT NULL,
  `nama_univ` varchar(100) NOT NULL,
  `nama_org` varchar(100) NOT NULL,
  `logo_org` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keu_univ`
--

INSERT INTO `keu_univ` (`id_univ`, `nama_univ`, `nama_org`, `logo_org`) VALUES
(1, 'Ilmu Komputer dan Teknologi Informasi', 'HIMALA USU', '1024.png');

-- --------------------------------------------------------

--
-- Table structure for table `one_admin`
--

CREATE TABLE `one_admin` (
  `id` int(5) NOT NULL,
  `nim` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(75) NOT NULL,
  `nip` varchar(25) NOT NULL,
  `level` enum('Super Sekretaris','Sekretaris','Wakil Sekretaris','Bendahara','Wakil Bendahara') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `one_admin`
--

INSERT INTO `one_admin` (`id`, `nim`, `nama`, `jabatan`, `username`, `password`, `nip`, `level`) VALUES
(1, '', 'Admin Sekretaris', '', 'admin', 'E68834F7ACF151EB5D9464DAC099C61CB10C361A', '-', 'Super Sekretaris'),
(2, '181401010', 'Fikih Firmansyah', 'Sekretaris Umum', '181401010', '414BBB54288794ECD574C453B4F13F37DBDBD888', '-', 'Sekretaris'),
(3, '180200089', 'Friska Nadia Ananda', 'Wakil Sekretaris Umum', '180200089', '56EA283C9D473407480D4F74AEE36171856275FD', '-', 'Sekretaris'),
(4, '180200095', 'Lily Ariska Rahayu', 'Bendahara Umum', '180200095', 'B68456FC751E4CB314766DDE20BD78B9FB1D2D04', '-', ''),
(5, '181501026', 'Ummu Fachriah Hutasuhut', 'Wakil Bendahara Umum', '181501026', '5A41CFEA88FE3B65DE75B552B342642EB617A69D', '-', '');

-- --------------------------------------------------------

--
-- Table structure for table `srt_disposisi`
--

CREATE TABLE `srt_disposisi` (
  `id` int(6) NOT NULL,
  `id_surat` int(6) NOT NULL,
  `kpd_yth` varchar(250) NOT NULL,
  `isi_disposisi` varchar(250) NOT NULL,
  `sifat` enum('Biasa','Segera','Perlu Perhatian Khusus','Perhatian Batas Waktu') NOT NULL,
  `batas_waktu` date NOT NULL,
  `catatan` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `srt_disposisi`
--

INSERT INTO `srt_disposisi` (`id`, `id_surat`, `kpd_yth`, `isi_disposisi`, `sifat`, `batas_waktu`, `catatan`) VALUES
(1, 1, 'Kepala TU', 'ditindaklanjuti', 'Biasa', '2015-05-27', '');

-- --------------------------------------------------------

--
-- Table structure for table `srt_instansi`
--

CREATE TABLE `srt_instansi` (
  `id` int(1) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `kepsek` varchar(100) NOT NULL,
  `nip_kepsek` varchar(100) NOT NULL,
  `logo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `srt_instansi`
--

INSERT INTO `srt_instansi` (`id`, `nama`, `alamat`, `kepsek`, `nip_kepsek`, `logo`) VALUES
(1, 'Arsip Surat HIMALA USU', 'Jalan Pembangunan USU No.122, Padang Bulan, Kec. Medan Baru, Kota Medan.', 'NAUFAL HISYAM', '181401010', '10241.png');

-- --------------------------------------------------------

--
-- Table structure for table `srt_klasifikasi`
--

CREATE TABLE `srt_klasifikasi` (
  `id` int(4) NOT NULL,
  `kode` varchar(50) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `uraian` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `srt_klasifikasi`
--

INSERT INTO `srt_klasifikasi` (`id`, `kode`, `nama`, `uraian`) VALUES
(1, 'A/SK/SEKUM', 'A - Surat Keputusan  /  Keterangan - Sekretaris Umum', 'USU dan HIMALA - Dikeluarkan Oleh Sekretaris Umum - Surat keputusan merupakan surat yang dibuat oleh organisasi terbentuknya pada saat tercapainya keputusan yang telah disepakati bersama atas pertimbangan yang matang, dan berdasarkan konstitusi atau AD/ART sehingga sifatnya sah. Surat ini merupakan hasil pertimbangan objektif yang dilakukan oleh pengambil keputusan organisasi dalam sebuah organisasi atau lembaga (PK HIMALA USU). Sifat surat ini sangat mengikat bagi lingkup internal seperti pembentukan agenda, rapat tertinggi, keputusan forum, serta hasil kebijakan-kebijakan yang akan ditetapkan. Penomoran surat selanjutnya mengikuti jumlah surat yang telah dikeluarkan.'),
(2, 'A/ST/SEKUM', 'A - Surat Tugas  -  Delegasi - Sekretaris Umum', 'USU dan HIMALA - Dikeluarkan Oleh Sekretaris Umum - Surat Tugas adalah surat yang ditujukan pada seseorang untuk didelegasikan sebagai representasi organisasi (PK HIMALA USU) untuk kepentingan internal maupun eksternal, keabsahan surat ini ditandatangani untuk disetujui oleh jajaran tertinggi organisasi (PK HIMALA USU) yaitu Ketua Umum menjabat dan mengetahui oleh Ketua Departemen terkait. Penomoran surat selanjutnya mengikuti jumlah surat yang telah dikeluarkan.'),
(3, 'A/SP/SEKUM', 'A - Surat Peringatan - Sekretaris Umum', 'USU dan HIMALA - Dikeluarkan Oleh Sekretaris Umum - Surat peringatan adalah surat yang dikeluarkan oleh organisasi khusus dikeluarkan oleh pengambil keputusan di organisasi (PK HIMALA USU) dalam menentukan kebijakan tertentu dan sifat dari surat ini adalah organisatoris. Surat ini dikeluarkan apabila ada pelanggaran yang dilakukan oleh anggota struktural organisasi (PK HIMALA USU). Surat peringatan juga memiliki tahapan yaitu teguran I bersifat lunak, teguran II bersifat agak keras, teguran III bersifat keras terkadang dapat berupa pemanggilan. Penomoran surat selanjutnya mengikuti jumlah surat yang telah dikeluarkan.'),
(4, 'A/SPM/SEKUM', 'A - Surat Undangan - Sekretaris Umum', 'USU dan HIMALA - Dikeluarkan Oleh Sekretaris Umum - Surat Permohonan yang dikeluarkan oleh organisasi / lembaga (PK HIMALA USU) yang dibuat oleh panitia program tertentu dengan tujuan dan maksud tertentu yang berkaitan dengan agenda yang akan diselenggarakan. Surat permohonan ini pada umumnya ditujukan untuk meminta seseorang menjadi pembicara, moderator, peminjaman alat, mengirimkan delegasi, dll. Semua yang berkaitan dengan kegiatan organisasi PK HIMALA USU baik untuk internal maupul eksternal harus mengeluarkan surat permohonan. Penomoran surat selanjutnya mengikuti jumlah surat yang telah dikeluarkan.'),
(5, 'A/SPB/SEKUM', 'A - Surat Pemberitahuan - Sekretaris Umum', 'USU dan HIMALA - Dikeluarkan Oleh Sekretaris Umum - Surat Pemberitahuan dibuat untuk diberikan kepada seseorang (pejabat terkait) atau lembaga (sekertariatan atau komisariat) terkait yang masih dalam jalur kordinasi PK HIMALA USU. Yang dimaksud dengan jalur kordinasi adalah lingkup suratnya adalah internal, surat ini tujuannya adalah memberikan informasi kepada seseorang atau lembaga mengenai agenda kerja dan pelaksanaan agenda kegiatan. Penomoran surat selanjutnya mengikuti jumlah surat yang telah dikeluarkan.'),
(6, 'A/SU/SEKUM', 'A - Surat Undangan - Sekretaris Umum', 'USU dan HIMALA - Dikeluarkan Oleh Sekretaris Umum - Surat Undangan adalah surat yang dibuat oleh lembaga atau organisasi untuk mengundang narasumber atau lembaga yang akan dihadirkan. Surat ini dikeluarkan sesuai dengan agenda yang telah dibuat oleh organisasi (PK HIMALA USU) agar sesuai dengan perencanaan agenda. Penomoran surat selanjutnya mengikuti jumlah surat yang telah dikeluarkan, dan terkait dengan banyaknya surat undangan yang dibuat penomorannya bersifat tetap sesuai dengan nomor surat yang saat itu dikeluarkan.'),
(7, 'A/SRT/SEKUM', 'A - Sertifikat - Sekretaris Umum', 'USU dan HIMALA - Dikeluarkan Oleh Sekretaris Umum - Surat Piagam atau Sertifikat adalah surat yang dibuat oleh lembaga atau organisasi untuk memberikan apresiasi terhadap partisipasi dari peserta di sebuah kegiatan oleh organisasi (PK HIMALA USU).Penomoran surat selanjutnya mengikuti jumlah surat yang telah dikeluarkan, dan terkait dengan banyaknya surat undangan yang dibuat penomorannya bersifat tetap sesuai dengan nomor sertifikat yang saat itu dikeluarkan.'),
(8, 'A/SK/SEKPAN', 'A - Surat Keputusan  /  Keterangan - Sekretaris Panitia', 'USU dan HIMALA - Dikeluarkan Oleh Sekretaris Panitia - Surat keputusan merupakan surat yang dibuat oleh organisasi terbentuknya pada saat tercapainya keputusan yang telah disepakati bersama atas pertimbangan yang matang, dan berdasarkan konstitusi atau AD/ART sehingga sifatnya sah. Surat ini merupakan hasil pertimbangan objektif yang dilakukan oleh pengambil keputusan organisasi dalam sebuah organisasi atau lembaga (PK HIMALA USU). Sifat surat ini sangat mengikat bagi lingkup internal seperti pembentukan agenda, rapat tertinggi, keputusan forum, serta hasil kebijakan-kebijakan yang akan ditetapkan. Penomoran surat selanjutnya mengikuti jumlah surat yang telah dikeluarkan.'),
(9, 'A/ST/SEKPAN', 'A - Surat Tugas  -  Delegasi - Sekretaris Panitia', 'USU dan HIMALA - Dikeluarkan Oleh Sekretaris Panitia - Surat Tugas adalah surat yang ditujukan pada seseorang untuk didelegasikan sebagai representasi organisasi (PK HIMALA USU) untuk kepentingan internal maupun eksternal, keabsahan surat ini ditandatangani untuk disetujui oleh jajaran tertinggi organisasi (PK HIMALA USU) yaitu Ketua Umum menjabat dan mengetahui oleh Ketua Departemen terkait. Penomoran surat selanjutnya mengikuti jumlah surat yang telah dikeluarkan.'),
(10, 'A/SP/SEKPAN', 'A - Surat Peringatan - Sekretaris Panitia', 'USU dan HIMALA - Dikeluarkan Oleh Sekretaris Panitia - Surat peringatan adalah surat yang dikeluarkan oleh organisasi khusus dikeluarkan oleh pengambil keputusan di organisasi (PK HIMALA USU) dalam menentukan kebijakan tertentu dan sifat dari surat ini adalah organisatoris. Surat ini dikeluarkan apabila ada pelanggaran yang dilakukan oleh anggota struktural organisasi (PK HIMALA USU). Surat peringatan juga memiliki tahapan yaitu teguran I bersifat lunak, teguran II bersifat agak keras, teguran III bersifat keras terkadang dapat berupa pemanggilan. Penomoran surat selanjutnya mengikuti jumlah surat yang telah dikeluarkan.'),
(11, 'A/SPM/SEKPAN', 'A - Surat Undangan - Sekretaris Panitia', 'USU dan HIMALA - Dikeluarkan Oleh Sekretaris Panitia - Surat Permohonan yang dikeluarkan oleh organisasi / lembaga (PK HIMALA USU) yang dibuat oleh panitia program tertentu dengan tujuan dan maksud tertentu yang berkaitan dengan agenda yang akan diselenggarakan. Surat permohonan ini pada umumnya ditujukan untuk meminta seseorang menjadi pembicara, moderator, peminjaman alat, mengirimkan delegasi, dll. Semua yang berkaitan dengan kegiatan organisasi PK HIMALA USU baik untuk internal maupul eksternal harus mengeluarkan surat permohonan. Penomoran surat selanjutnya mengikuti jumlah surat yang telah dikeluarkan.'),
(12, 'A/SPB/SEKPAN', 'A - Surat Pemberitahuan - Sekretaris Panitia', 'USU dan HIMALA - Dikeluarkan Oleh Sekretaris Panitia - Surat Pemberitahuan dibuat untuk diberikan kepada seseorang (pejabat terkait) atau lembaga (sekertariatan atau komisariat) terkait yang masih dalam jalur kordinasi PK HIMALA USU. Yang dimaksud dengan jalur kordinasi adalah lingkup suratnya adalah internal, surat ini tujuannya adalah memberikan informasi kepada seseorang atau lembaga mengenai agenda kerja dan pelaksanaan agenda kegiatan. Penomoran surat selanjutnya mengikuti jumlah surat yang telah dikeluarkan.'),
(13, 'A/SU/SEKPAN', 'A - Surat Undangan - Sekretaris Panitia', 'USU dan HIMALA - Dikeluarkan Oleh Sekretaris Panitia - Surat Undangan adalah surat yang dibuat oleh lembaga atau organisasi untuk mengundang narasumber atau lembaga yang akan dihadirkan. Surat ini dikeluarkan sesuai dengan agenda yang telah dibuat oleh organisasi (PK HIMALA USU) agar sesuai dengan perencanaan agenda. Penomoran surat selanjutnya mengikuti jumlah surat yang telah dikeluarkan, dan terkait dengan banyaknya surat undangan yang dibuat penomorannya bersifat tetap sesuai dengan nomor surat yang saat itu dikeluarkan.'),
(14, 'A/SRT/SEKPAN', 'A - Sertifikat - Sekretaris Panitia', 'USU dan HIMALA - Dikeluarkan Oleh Sekretaris Panitia - Surat Piagam atau Sertifikat adalah surat yang dibuat oleh lembaga atau organisasi untuk memberikan apresiasi terhadap partisipasi dari peserta di sebuah kegiatan oleh organisasi (PK HIMALA USU).Penomoran surat selanjutnya mengikuti jumlah surat yang telah dikeluarkan, dan terkait dengan banyaknya surat undangan yang dibuat penomorannya bersifat tetap sesuai dengan nomor sertifikat yang saat itu dikeluarkan.'),
(15, 'A/SK/RAKER', 'A - Surat Keputusan  /  Keterangan - Rapat Kerja', 'USU dan HIMALA - Dikeluarkan Oleh Presidium Sidang RAKER - Surat keputusan merupakan surat yang dibuat oleh organisasi terbentuknya pada saat tercapainya keputusan yang telah disepakati bersama atas pertimbangan yang matang, dan berdasarkan konstitusi atau AD/ART sehingga sifatnya sah. Surat ini merupakan hasil pertimbangan objektif yang dilakukan oleh pengambil keputusan organisasi dalam sebuah organisasi atau lembaga (PK HIMALA USU). Sifat surat ini sangat mengikat bagi lingkup internal seperti pembentukan agenda, rapat tertinggi, keputusan forum, serta hasil kebijakan-kebijakan yang akan ditetapkan. Penomoran surat selanjutnya mengikuti jumlah surat yang telah dikeluarkan.'),
(16, 'A/ST/RAKER', 'A - Surat Tugas  -  Delegasi - Rapat Kerja', 'USU dan HIMALA - Dikeluarkan Oleh Presidium Sidang RAKER - Surat Tugas adalah surat yang ditujukan pada seseorang untuk didelegasikan sebagai representasi organisasi (PK HIMALA USU) untuk kepentingan internal maupun eksternal, keabsahan surat ini ditandatangani untuk disetujui oleh jajaran tertinggi organisasi (PK HIMALA USU) yaitu Ketua Umum menjabat dan mengetahui oleh Ketua Departemen terkait. Penomoran surat selanjutnya mengikuti jumlah surat yang telah dikeluarkan.'),
(17, 'A/SP/RAKER', 'A - Surat Peringatan - Rapat Kerja', 'USU dan HIMALA - Dikeluarkan Oleh Presidium Sidang RAKER - Surat peringatan adalah surat yang dikeluarkan oleh organisasi khusus dikeluarkan oleh pengambil keputusan di organisasi (PK HIMALA USU) dalam menentukan kebijakan tertentu dan sifat dari surat ini adalah organisatoris. Surat ini dikeluarkan apabila ada pelanggaran yang dilakukan oleh anggota struktural organisasi (PK HIMALA USU). Surat peringatan juga memiliki tahapan yaitu teguran I bersifat lunak, teguran II bersifat agak keras, teguran III bersifat keras terkadang dapat berupa pemanggilan. Penomoran surat selanjutnya mengikuti jumlah surat yang telah dikeluarkan.'),
(18, 'A/SPM/RAKER', 'A - Surat Undangan - Rapat Kerja', 'USU dan HIMALA - Dikeluarkan Oleh Presidium Sidang RAKER - Surat Permohonan yang dikeluarkan oleh organisasi / lembaga (PK HIMALA USU) yang dibuat oleh panitia program tertentu dengan tujuan dan maksud tertentu yang berkaitan dengan agenda yang akan diselenggarakan. Surat permohonan ini pada umumnya ditujukan untuk meminta seseorang menjadi pembicara, moderator, peminjaman alat, mengirimkan delegasi, dll. Semua yang berkaitan dengan kegiatan organisasi PK HIMALA USU baik untuk internal maupul eksternal harus mengeluarkan surat permohonan. Penomoran surat selanjutnya mengikuti jumlah surat yang telah dikeluarkan.'),
(19, 'A/SPB/RAKER', 'A - Surat Pemberitahuan - Rapat Kerja', 'USU dan HIMALA - Dikeluarkan Oleh Presidium Sidang RAKER - Surat Pemberitahuan dibuat untuk diberikan kepada seseorang (pejabat terkait) atau lembaga (sekertariatan atau komisariat) terkait yang masih dalam jalur kordinasi PK HIMALA USU. Yang dimaksud dengan jalur kordinasi adalah lingkup suratnya adalah internal, surat ini tujuannya adalah memberikan informasi kepada seseorang atau lembaga mengenai agenda kerja dan pelaksanaan agenda kegiatan. Penomoran surat selanjutnya mengikuti jumlah surat yang telah dikeluarkan.'),
(20, 'A/SU/RAKER', 'A - Surat Undangan - Rapat Kerja', 'USU dan HIMALA - Dikeluarkan Oleh Presidium Sidang RAKER - Surat Undangan adalah surat yang dibuat oleh lembaga atau organisasi untuk mengundang narasumber atau lembaga yang akan dihadirkan. Surat ini dikeluarkan sesuai dengan agenda yang telah dibuat oleh organisasi (PK HIMALA USU) agar sesuai dengan perencanaan agenda. Penomoran surat selanjutnya mengikuti jumlah surat yang telah dikeluarkan, dan terkait dengan banyaknya surat undangan yang dibuat penomorannya bersifat tetap sesuai dengan nomor surat yang saat itu dikeluarkan.'),
(21, 'A/SRT/RAKER', 'A - Sertifikat - Rapat Kerja', 'USU dan HIMALA - Dikeluarkan Oleh Presidium Sidang RAKER - Surat Piagam atau Sertifikat adalah surat yang dibuat oleh lembaga atau organisasi untuk memberikan apresiasi terhadap partisipasi dari peserta di sebuah kegiatan oleh organisasi (PK HIMALA USU).Penomoran surat selanjutnya mengikuti jumlah surat yang telah dikeluarkan, dan terkait dengan banyaknya surat undangan yang dibuat penomorannya bersifat tetap sesuai dengan nomor sertifikat yang saat itu dikeluarkan.'),
(22, 'A/SK/MUSKOM', 'A - Surat Keputusan  /  Keterangan - Musyawarah Komisariat', 'USU dan HIMALA - Dikeluarkan Oleh Presidium Sidang MUSKOM - Surat keputusan merupakan surat yang dibuat oleh organisasi terbentuknya pada saat tercapainya keputusan yang telah disepakati bersama atas pertimbangan yang matang, dan berdasarkan konstitusi atau AD/ART sehingga sifatnya sah. Surat ini merupakan hasil pertimbangan objektif yang dilakukan oleh pengambil keputusan organisasi dalam sebuah organisasi atau lembaga (PK HIMALA USU). Sifat surat ini sangat mengikat bagi lingkup internal seperti pembentukan agenda, rapat tertinggi, keputusan forum, serta hasil kebijakan-kebijakan yang akan ditetapkan. Penomoran surat selanjutnya mengikuti jumlah surat yang telah dikeluarkan.'),
(23, 'A/ST/MUSKOM', 'A - Surat Tugas  -  Delegasi - Musyawarah Komisariat', 'USU dan HIMALA - Dikeluarkan Oleh Presidium Sidang MUSKOM - Surat Tugas adalah surat yang ditujukan pada seseorang untuk didelegasikan sebagai representasi organisasi (PK HIMALA USU) untuk kepentingan internal maupun eksternal, keabsahan surat ini ditandatangani untuk disetujui oleh jajaran tertinggi organisasi (PK HIMALA USU) yaitu Ketua Umum menjabat dan mengetahui oleh Ketua Departemen terkait. Penomoran surat selanjutnya mengikuti jumlah surat yang telah dikeluarkan.'),
(24, 'A/SP/MUSKOM', 'A - Surat Peringatan - Musyawarah Komisariat', 'USU dan HIMALA - Dikeluarkan Oleh Presidium Sidang MUSKOM - Surat peringatan adalah surat yang dikeluarkan oleh organisasi khusus dikeluarkan oleh pengambil keputusan di organisasi (PK HIMALA USU) dalam menentukan kebijakan tertentu dan sifat dari surat ini adalah organisatoris. Surat ini dikeluarkan apabila ada pelanggaran yang dilakukan oleh anggota struktural organisasi (PK HIMALA USU). Surat peringatan juga memiliki tahapan yaitu teguran I bersifat lunak, teguran II bersifat agak keras, teguran III bersifat keras terkadang dapat berupa pemanggilan. Penomoran surat selanjutnya mengikuti jumlah surat yang telah dikeluarkan.'),
(25, 'A/SPM/MUSKOM', 'A - Surat Undangan - Musyawarah Komisariat', 'USU dan HIMALA - Dikeluarkan Oleh Presidium Sidang MUSKOM - Surat Permohonan yang dikeluarkan oleh organisasi / lembaga (PK HIMALA USU) yang dibuat oleh panitia program tertentu dengan tujuan dan maksud tertentu yang berkaitan dengan agenda yang akan diselenggarakan. Surat permohonan ini pada umumnya ditujukan untuk meminta seseorang menjadi pembicara, moderator, peminjaman alat, mengirimkan delegasi, dll. Semua yang berkaitan dengan kegiatan organisasi PK HIMALA USU baik untuk internal maupul eksternal harus mengeluarkan surat permohonan. Penomoran surat selanjutnya mengikuti jumlah surat yang telah dikeluarkan.'),
(26, 'A/SPB/MUSKOM', 'A - Surat Pemberitahuan - Musyawarah Komisariat', 'USU dan HIMALA - Dikeluarkan Oleh Presidium Sidang MUSKOM - Surat Pemberitahuan dibuat untuk diberikan kepada seseorang (pejabat terkait) atau lembaga (sekertariatan atau komisariat) terkait yang masih dalam jalur kordinasi PK HIMALA USU. Yang dimaksud dengan jalur kordinasi adalah lingkup suratnya adalah internal, surat ini tujuannya adalah memberikan informasi kepada seseorang atau lembaga mengenai agenda kerja dan pelaksanaan agenda kegiatan. Penomoran surat selanjutnya mengikuti jumlah surat yang telah dikeluarkan.'),
(27, 'A/SU/MUSKOM', 'A - Surat Undangan - Musyawarah Komisariat', 'USU dan HIMALA - Dikeluarkan Oleh Presidium Sidang MUSKOM - Surat Undangan adalah surat yang dibuat oleh lembaga atau organisasi untuk mengundang narasumber atau lembaga yang akan dihadirkan. Surat ini dikeluarkan sesuai dengan agenda yang telah dibuat oleh organisasi (PK HIMALA USU) agar sesuai dengan perencanaan agenda. Penomoran surat selanjutnya mengikuti jumlah surat yang telah dikeluarkan, dan terkait dengan banyaknya surat undangan yang dibuat penomorannya bersifat tetap sesuai dengan nomor surat yang saat itu dikeluarkan.'),
(28, 'A/SRT/MUSKOM', 'A - Sertifikat - Musyawarah Komisariat', 'USU dan HIMALA - Dikeluarkan Oleh Presidium Sidang MUSKOM - Surat Piagam atau Sertifikat adalah surat yang dibuat oleh lembaga atau organisasi untuk memberikan apresiasi terhadap partisipasi dari peserta di sebuah kegiatan oleh organisasi (PK HIMALA USU).Penomoran surat selanjutnya mengikuti jumlah surat yang telah dikeluarkan, dan terkait dengan banyaknya surat undangan yang dibuat penomorannya bersifat tetap sesuai dengan nomor sertifikat yang saat itu dikeluarkan.'),
(29, 'B/SK/SEKUM', 'B - Surat Keputusan  /  Keterangan - Sekretaris Umum', 'NON USU dan NON HIMALA - Dikeluarkan Oleh Sekretaris Umum - Surat keputusan merupakan surat yang dibuat oleh organisasi terbentuknya pada saat tercapainya keputusan yang telah disepakati bersama atas pertimbangan yang matang, dan berdasarkan konstitusi atau AD/ART sehingga sifatnya sah. Surat ini merupakan hasil pertimbangan objektif yang dilakukan oleh pengambil keputusan organisasi dalam sebuah organisasi atau lembaga (PK HIMALA USU). Sifat surat ini sangat mengikat bagi lingkup internal seperti pembentukan agenda, rapat tertinggi, keputusan forum, serta hasil kebijakan-kebijakan yang akan ditetapkan. Penomoran surat selanjutnya mengikuti jumlah surat yang telah dikeluarkan.'),
(30, 'B/ST/SEKUM', 'B - Surat Tugas  -  Delegasi - Sekretaris Umum', 'NON USU dan NON HIMALA - Dikeluarkan Oleh Sekretaris Umum - Surat Tugas adalah surat yang ditujukan pada seseorang untuk didelegasikan sebagai representasi organisasi (PK HIMALA USU) untuk kepentingan internal maupun eksternal, keabsahan surat ini ditandatangani untuk disetujui oleh jajaran tertinggi organisasi (PK HIMALA USU) yaitu Ketua Umum menjabat dan mengetahui oleh Ketua Departemen terkait. Penomoran surat selanjutnya mengikuti jumlah surat yang telah dikeluarkan.'),
(31, 'B/SP/SEKUM', 'B - Surat Peringatan - Sekretaris Umum', 'NON USU dan NON HIMALA - Dikeluarkan Oleh Sekretaris Umum - Surat peringatan adalah surat yang dikeluarkan oleh organisasi khusus dikeluarkan oleh pengambil keputusan di organisasi (PK HIMALA USU) dalam menentukan kebijakan tertentu dan sifat dari surat ini adalah organisatoris. Surat ini dikeluarkan apabila ada pelanggaran yang dilakukan oleh anggota struktural organisasi (PK HIMALA USU). Surat peringatan juga memiliki tahapan yaitu teguran I bersifat lunak, teguran II bersifat agak keras, teguran III bersifat keras terkadang dapat berupa pemanggilan. Penomoran surat selanjutnya mengikuti jumlah surat yang telah dikeluarkan.'),
(32, 'B/SPM/SEKUM', 'B - Surat Undangan - Sekretaris Umum', 'NON USU dan NON HIMALA - Dikeluarkan Oleh Sekretaris Umum - Surat Permohonan yang dikeluarkan oleh organisasi / lembaga (PK HIMALA USU) yang dibuat oleh panitia program tertentu dengan tujuan dan maksud tertentu yang berkaitan dengan agenda yang akan diselenggarakan. Surat permohonan ini pada umumnya ditujukan untuk meminta seseorang menjadi pembicara, moderator, peminjaman alat, mengirimkan delegasi, dll. Semua yang berkaitan dengan kegiatan organisasi PK HIMALA USU baik untuk internal maupul eksternal harus mengeluarkan surat permohonan. Penomoran surat selanjutnya mengikuti jumlah surat yang telah dikeluarkan.'),
(33, 'B/SPB/SEKUM', 'B - Surat Pemberitahuan - Sekretaris Umum', 'NON USU dan NON HIMALA - Dikeluarkan Oleh Sekretaris Umum - Surat Pemberitahuan dibuat untuk diberikan kepada seseorang (pejabat terkait) atau lembaga (sekertariatan atau komisariat) terkait yang masih dalam jalur kordinasi PK HIMALA USU. Yang dimaksud dengan jalur kordinasi adalah lingkup suratnya adalah internal, surat ini tujuannya adalah memberikan informasi kepada seseorang atau lembaga mengenai agenda kerja dan pelaksanaan agenda kegiatan. Penomoran surat selanjutnya mengikuti jumlah surat yang telah dikeluarkan.'),
(34, 'B/SU/SEKUM', 'B - Surat Undangan - Sekretaris Umum', 'NON USU dan NON HIMALA - Dikeluarkan Oleh Sekretaris Umum - Surat Undangan adalah surat yang dibuat oleh lembaga atau organisasi untuk mengundang narasumber atau lembaga yang akan dihadirkan. Surat ini dikeluarkan sesuai dengan agenda yang telah dibuat oleh organisasi (PK HIMALA USU) agar sesuai dengan perencanaan agenda. Penomoran surat selanjutnya mengikuti jumlah surat yang telah dikeluarkan, dan terkait dengan banyaknya surat undangan yang dibuat penomorannya bersifat tetap sesuai dengan nomor surat yang saat itu dikeluarkan.'),
(35, 'B/SRT/SEKUM', 'B - Sertifikat - Sekretaris Umum', 'NON USU dan NON HIMALA - Dikeluarkan Oleh Sekretaris Umum - Surat Piagam atau Sertifikat adalah surat yang dibuat oleh lembaga atau organisasi untuk memberikan apresiasi terhadap partisipasi dari peserta di sebuah kegiatan oleh organisasi (PK HIMALA USU).Penomoran surat selanjutnya mengikuti jumlah surat yang telah dikeluarkan, dan terkait dengan banyaknya surat undangan yang dibuat penomorannya bersifat tetap sesuai dengan nomor sertifikat yang saat itu dikeluarkan.'),
(36, 'B/SK/SEKPAN', 'B - Surat Keputusan  /  Keterangan - Sekretaris Panitia', 'NON USU dan NON HIMALA - Dikeluarkan Oleh Sekretaris Panitia - Surat keputusan merupakan surat yang dibuat oleh organisasi terbentuknya pada saat tercapainya keputusan yang telah disepakati bersama atas pertimbangan yang matang, dan berdasarkan konstitusi atau AD/ART sehingga sifatnya sah. Surat ini merupakan hasil pertimbangan objektif yang dilakukan oleh pengambil keputusan organisasi dalam sebuah organisasi atau lembaga (PK HIMALA USU). Sifat surat ini sangat mengikat bagi lingkup internal seperti pembentukan agenda, rapat tertinggi, keputusan forum, serta hasil kebijakan-kebijakan yang akan ditetapkan. Penomoran surat selanjutnya mengikuti jumlah surat yang telah dikeluarkan.'),
(37, 'B/ST/SEKPAN', 'B - Surat Tugas  -  Delegasi - Sekretaris Panitia', 'NON USU dan NON HIMALA - Dikeluarkan Oleh Sekretaris Panitia - Surat Tugas adalah surat yang ditujukan pada seseorang untuk didelegasikan sebagai representasi organisasi (PK HIMALA USU) untuk kepentingan internal maupun eksternal, keabsahan surat ini ditandatangani untuk disetujui oleh jajaran tertinggi organisasi (PK HIMALA USU) yaitu Ketua Umum menjabat dan mengetahui oleh Ketua Departemen terkait. Penomoran surat selanjutnya mengikuti jumlah surat yang telah dikeluarkan.'),
(38, 'B/SP/SEKPAN', 'B - Surat Peringatan - Sekretaris Panitia', 'NON USU dan NON HIMALA - Dikeluarkan Oleh Sekretaris Panitia - Surat peringatan adalah surat yang dikeluarkan oleh organisasi khusus dikeluarkan oleh pengambil keputusan di organisasi (PK HIMALA USU) dalam menentukan kebijakan tertentu dan sifat dari surat ini adalah organisatoris. Surat ini dikeluarkan apabila ada pelanggaran yang dilakukan oleh anggota struktural organisasi (PK HIMALA USU). Surat peringatan juga memiliki tahapan yaitu teguran I bersifat lunak, teguran II bersifat agak keras, teguran III bersifat keras terkadang dapat berupa pemanggilan. Penomoran surat selanjutnya mengikuti jumlah surat yang telah dikeluarkan.'),
(39, 'B/SPM/SEKPAN', 'B - Surat Undangan - Sekretaris Panitia', 'NON USU dan NON HIMALA - Dikeluarkan Oleh Sekretaris Panitia - Surat Permohonan yang dikeluarkan oleh organisasi / lembaga (PK HIMALA USU) yang dibuat oleh panitia program tertentu dengan tujuan dan maksud tertentu yang berkaitan dengan agenda yang akan diselenggarakan. Surat permohonan ini pada umumnya ditujukan untuk meminta seseorang menjadi pembicara, moderator, peminjaman alat, mengirimkan delegasi, dll. Semua yang berkaitan dengan kegiatan organisasi PK HIMALA USU baik untuk internal maupul eksternal harus mengeluarkan surat permohonan. Penomoran surat selanjutnya mengikuti jumlah surat yang telah dikeluarkan.'),
(40, 'B/SPB/SEKPAN', 'B - Surat Pemberitahuan - Sekretaris Panitia', 'NON USU dan NON HIMALA - Dikeluarkan Oleh Sekretaris Panitia - Surat Pemberitahuan dibuat untuk diberikan kepada seseorang (pejabat terkait) atau lembaga (sekertariatan atau komisariat) terkait yang masih dalam jalur kordinasi PK HIMALA USU. Yang dimaksud dengan jalur kordinasi adalah lingkup suratnya adalah internal, surat ini tujuannya adalah memberikan informasi kepada seseorang atau lembaga mengenai agenda kerja dan pelaksanaan agenda kegiatan. Penomoran surat selanjutnya mengikuti jumlah surat yang telah dikeluarkan.'),
(41, 'B/SU/SEKPAN', 'B - Surat Undangan - Sekretaris Panitia', 'NON USU dan NON HIMALA - Dikeluarkan Oleh Sekretaris Panitia - Surat Undangan adalah surat yang dibuat oleh lembaga atau organisasi untuk mengundang narasumber atau lembaga yang akan dihadirkan. Surat ini dikeluarkan sesuai dengan agenda yang telah dibuat oleh organisasi (PK HIMALA USU) agar sesuai dengan perencanaan agenda. Penomoran surat selanjutnya mengikuti jumlah surat yang telah dikeluarkan, dan terkait dengan banyaknya surat undangan yang dibuat penomorannya bersifat tetap sesuai dengan nomor surat yang saat itu dikeluarkan.'),
(42, 'B/SRT/SEKPAN', 'B - Sertifikat - Sekretaris Panitia', 'NON USU dan NON HIMALA - Dikeluarkan Oleh Sekretaris Panitia - Surat Piagam atau Sertifikat adalah surat yang dibuat oleh lembaga atau organisasi untuk memberikan apresiasi terhadap partisipasi dari peserta di sebuah kegiatan oleh organisasi (PK HIMALA USU).Penomoran surat selanjutnya mengikuti jumlah surat yang telah dikeluarkan, dan terkait dengan banyaknya surat undangan yang dibuat penomorannya bersifat tetap sesuai dengan nomor sertifikat yang saat itu dikeluarkan.'),
(43, 'B/SK/RAKER', 'B - Surat Keputusan  /  Keterangan - Rapat Kerja', 'NON USU dan NON HIMALA - Dikeluarkan Oleh Presidium Sidang RAKER - Surat keputusan merupakan surat yang dibuat oleh organisasi terbentuknya pada saat tercapainya keputusan yang telah disepakati bersama atas pertimbangan yang matang, dan berdasarkan konstitusi atau AD/ART sehingga sifatnya sah. Surat ini merupakan hasil pertimbangan objektif yang dilakukan oleh pengambil keputusan organisasi dalam sebuah organisasi atau lembaga (PK HIMALA USU). Sifat surat ini sangat mengikat bagi lingkup internal seperti pembentukan agenda, rapat tertinggi, keputusan forum, serta hasil kebijakan-kebijakan yang akan ditetapkan. Penomoran surat selanjutnya mengikuti jumlah surat yang telah dikeluarkan.'),
(44, 'B/ST/RAKER', 'B - Surat Tugas  -  Delegasi - Rapat Kerja', 'NON USU dan NON HIMALA - Dikeluarkan Oleh Presidium Sidang RAKER - Surat Tugas adalah surat yang ditujukan pada seseorang untuk didelegasikan sebagai representasi organisasi (PK HIMALA USU) untuk kepentingan internal maupun eksternal, keabsahan surat ini ditandatangani untuk disetujui oleh jajaran tertinggi organisasi (PK HIMALA USU) yaitu Ketua Umum menjabat dan mengetahui oleh Ketua Departemen terkait. Penomoran surat selanjutnya mengikuti jumlah surat yang telah dikeluarkan.'),
(45, 'B/SP/RAKER', 'B - Surat Peringatan - Rapat Kerja', 'NON USU dan NON HIMALA - Dikeluarkan Oleh Presidium Sidang RAKER - Surat peringatan adalah surat yang dikeluarkan oleh organisasi khusus dikeluarkan oleh pengambil keputusan di organisasi (PK HIMALA USU) dalam menentukan kebijakan tertentu dan sifat dari surat ini adalah organisatoris. Surat ini dikeluarkan apabila ada pelanggaran yang dilakukan oleh anggota struktural organisasi (PK HIMALA USU). Surat peringatan juga memiliki tahapan yaitu teguran I bersifat lunak, teguran II bersifat agak keras, teguran III bersifat keras terkadang dapat berupa pemanggilan. Penomoran surat selanjutnya mengikuti jumlah surat yang telah dikeluarkan.'),
(46, 'B/SPM/RAKER', 'B - Surat Undangan - Rapat Kerja', 'NON USU dan NON HIMALA - Dikeluarkan Oleh Presidium Sidang RAKER - Surat Permohonan yang dikeluarkan oleh organisasi / lembaga (PK HIMALA USU) yang dibuat oleh panitia program tertentu dengan tujuan dan maksud tertentu yang berkaitan dengan agenda yang akan diselenggarakan. Surat permohonan ini pada umumnya ditujukan untuk meminta seseorang menjadi pembicara, moderator, peminjaman alat, mengirimkan delegasi, dll. Semua yang berkaitan dengan kegiatan organisasi PK HIMALA USU baik untuk internal maupul eksternal harus mengeluarkan surat permohonan. Penomoran surat selanjutnya mengikuti jumlah surat yang telah dikeluarkan.'),
(47, 'B/SPB/RAKER', 'B - Surat Pemberitahuan - Rapat Kerja', 'NON USU dan NON HIMALA - Dikeluarkan Oleh Presidium Sidang RAKER - Surat Pemberitahuan dibuat untuk diberikan kepada seseorang (pejabat terkait) atau lembaga (sekertariatan atau komisariat) terkait yang masih dalam jalur kordinasi PK HIMALA USU. Yang dimaksud dengan jalur kordinasi adalah lingkup suratnya adalah internal, surat ini tujuannya adalah memberikan informasi kepada seseorang atau lembaga mengenai agenda kerja dan pelaksanaan agenda kegiatan. Penomoran surat selanjutnya mengikuti jumlah surat yang telah dikeluarkan.'),
(48, 'B/SU/RAKER', 'B - Surat Undangan - Rapat Kerja', 'NON USU dan NON HIMALA - Dikeluarkan Oleh Presidium Sidang RAKER - Surat Undangan adalah surat yang dibuat oleh lembaga atau organisasi untuk mengundang narasumber atau lembaga yang akan dihadirkan. Surat ini dikeluarkan sesuai dengan agenda yang telah dibuat oleh organisasi (PK HIMALA USU) agar sesuai dengan perencanaan agenda. Penomoran surat selanjutnya mengikuti jumlah surat yang telah dikeluarkan, dan terkait dengan banyaknya surat undangan yang dibuat penomorannya bersifat tetap sesuai dengan nomor surat yang saat itu dikeluarkan.'),
(49, 'B/SRT/RAKER', 'B - Sertifikat - Rapat Kerja', 'NON USU dan NON HIMALA - Dikeluarkan Oleh Presidium Sidang RAKER - Surat Piagam atau Sertifikat adalah surat yang dibuat oleh lembaga atau organisasi untuk memberikan apresiasi terhadap partisipasi dari peserta di sebuah kegiatan oleh organisasi (PK HIMALA USU).Penomoran surat selanjutnya mengikuti jumlah surat yang telah dikeluarkan, dan terkait dengan banyaknya surat undangan yang dibuat penomorannya bersifat tetap sesuai dengan nomor sertifikat yang saat itu dikeluarkan.'),
(50, 'B/SK/MUSKOM', 'B - Surat Keputusan  /  Keterangan - Musyawarah Komisariat', 'NON USU dan NON HIMALA - Dikeluarkan Oleh Presidium Sidang MUSKOM - Surat keputusan merupakan surat yang dibuat oleh organisasi terbentuknya pada saat tercapainya keputusan yang telah disepakati bersama atas pertimbangan yang matang, dan berdasarkan konstitusi atau AD/ART sehingga sifatnya sah. Surat ini merupakan hasil pertimbangan objektif yang dilakukan oleh pengambil keputusan organisasi dalam sebuah organisasi atau lembaga (PK HIMALA USU). Sifat surat ini sangat mengikat bagi lingkup internal seperti pembentukan agenda, rapat tertinggi, keputusan forum, serta hasil kebijakan-kebijakan yang akan ditetapkan. Penomoran surat selanjutnya mengikuti jumlah surat yang telah dikeluarkan.'),
(51, 'B/ST/MUSKOM', 'B - Surat Tugas  -  Delegasi - Musyawarah Komisariat', 'NON USU dan NON HIMALA - Dikeluarkan Oleh Presidium Sidang MUSKOM - Surat Tugas adalah surat yang ditujukan pada seseorang untuk didelegasikan sebagai representasi organisasi (PK HIMALA USU) untuk kepentingan internal maupun eksternal, keabsahan surat ini ditandatangani untuk disetujui oleh jajaran tertinggi organisasi (PK HIMALA USU) yaitu Ketua Umum menjabat dan mengetahui oleh Ketua Departemen terkait. Penomoran surat selanjutnya mengikuti jumlah surat yang telah dikeluarkan.'),
(52, 'B/SP/MUSKOM', 'B - Surat Peringatan - Musyawarah Komisariat', 'NON USU dan NON HIMALA - Dikeluarkan Oleh Presidium Sidang MUSKOM - Surat peringatan adalah surat yang dikeluarkan oleh organisasi khusus dikeluarkan oleh pengambil keputusan di organisasi (PK HIMALA USU) dalam menentukan kebijakan tertentu dan sifat dari surat ini adalah organisatoris. Surat ini dikeluarkan apabila ada pelanggaran yang dilakukan oleh anggota struktural organisasi (PK HIMALA USU). Surat peringatan juga memiliki tahapan yaitu teguran I bersifat lunak, teguran II bersifat agak keras, teguran III bersifat keras terkadang dapat berupa pemanggilan. Penomoran surat selanjutnya mengikuti jumlah surat yang telah dikeluarkan.'),
(53, 'B/SPM/MUSKOM', 'B - Surat Undangan - Musyawarah Komisariat', 'NON USU dan NON HIMALA - Dikeluarkan Oleh Presidium Sidang MUSKOM - Surat Permohonan yang dikeluarkan oleh organisasi / lembaga (PK HIMALA USU) yang dibuat oleh panitia program tertentu dengan tujuan dan maksud tertentu yang berkaitan dengan agenda yang akan diselenggarakan. Surat permohonan ini pada umumnya ditujukan untuk meminta seseorang menjadi pembicara, moderator, peminjaman alat, mengirimkan delegasi, dll. Semua yang berkaitan dengan kegiatan organisasi PK HIMALA USU baik untuk internal maupul eksternal harus mengeluarkan surat permohonan. Penomoran surat selanjutnya mengikuti jumlah surat yang telah dikeluarkan.'),
(54, 'B/SPB/MUSKOM', 'B - Surat Pemberitahuan - Musyawarah Komisariat', 'NON USU dan NON HIMALA - Dikeluarkan Oleh Presidium Sidang MUSKOM - Surat Pemberitahuan dibuat untuk diberikan kepada seseorang (pejabat terkait) atau lembaga (sekertariatan atau komisariat) terkait yang masih dalam jalur kordinasi PK HIMALA USU. Yang dimaksud dengan jalur kordinasi adalah lingkup suratnya adalah internal, surat ini tujuannya adalah memberikan informasi kepada seseorang atau lembaga mengenai agenda kerja dan pelaksanaan agenda kegiatan. Penomoran surat selanjutnya mengikuti jumlah surat yang telah dikeluarkan.'),
(55, 'B/SU/MUSKOM', 'B - Surat Undangan - Musyawarah Komisariat', 'NON USU dan NON HIMALA - Dikeluarkan Oleh Presidium Sidang MUSKOM - Surat Undangan adalah surat yang dibuat oleh lembaga atau organisasi untuk mengundang narasumber atau lembaga yang akan dihadirkan. Surat ini dikeluarkan sesuai dengan agenda yang telah dibuat oleh organisasi (PK HIMALA USU) agar sesuai dengan perencanaan agenda. Penomoran surat selanjutnya mengikuti jumlah surat yang telah dikeluarkan, dan terkait dengan banyaknya surat undangan yang dibuat penomorannya bersifat tetap sesuai dengan nomor surat yang saat itu dikeluarkan.'),
(56, 'B/SRT/MUSKOM', 'B - Sertifikat - Musyawarah Komisariat', 'NON USU dan NON HIMALA - Dikeluarkan Oleh Presidium Sidang MUSKOM - Surat Piagam atau Sertifikat adalah surat yang dibuat oleh lembaga atau organisasi untuk memberikan apresiasi terhadap partisipasi dari peserta di sebuah kegiatan oleh organisasi (PK HIMALA USU).Penomoran surat selanjutnya mengikuti jumlah surat yang telah dikeluarkan, dan terkait dengan banyaknya surat undangan yang dibuat penomorannya bersifat tetap sesuai dengan nomor sertifikat yang saat itu dikeluarkan.');

-- --------------------------------------------------------

--
-- Table structure for table `srt_surat_keluar`
--

CREATE TABLE `srt_surat_keluar` (
  `id` int(6) NOT NULL,
  `kode` varchar(20) NOT NULL,
  `no_agenda` varchar(7) NOT NULL,
  `isi_ringkas` mediumtext NOT NULL,
  `tujuan` varchar(250) NOT NULL,
  `no_surat` varchar(100) NOT NULL,
  `tgl_surat` date NOT NULL,
  `tgl_catat` date NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  `file` varchar(200) NOT NULL,
  `pengolah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `srt_surat_keluar`
--

INSERT INTO `srt_surat_keluar` (`id`, `kode`, `no_agenda`, `isi_ringkas`, `tujuan`, `no_surat`, `tgl_surat`, `tgl_catat`, `keterangan`, `file`, `pengolah`) VALUES
(1, 'HM', '0001', 'Permintaan data masjid bersejarah di Kota Yogyakarta', 'Kantor Kemenag Kota Yogyakartas', '800/1221', '2015-05-24', '2015-05-24', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `srt_surat_keputusan`
--

CREATE TABLE `srt_surat_keputusan` (
  `id` int(6) NOT NULL,
  `nomor` varchar(20) NOT NULL,
  `tahun` varchar(7) NOT NULL,
  `tentang` mediumtext NOT NULL,
  `tgl_surat` date NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  `file` varchar(200) NOT NULL,
  `pengolah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `srt_surat_masuk`
--

CREATE TABLE `srt_surat_masuk` (
  `id` int(6) NOT NULL,
  `kode` varchar(50) NOT NULL,
  `no_agenda` varchar(7) NOT NULL,
  `indek_berkas` varchar(100) NOT NULL,
  `isi_ringkas` mediumtext NOT NULL,
  `dari` varchar(250) NOT NULL,
  `no_surat` varchar(100) NOT NULL,
  `tgl_surat` date NOT NULL,
  `tgl_diterima` date NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  `file` varchar(200) NOT NULL,
  `pengolah` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `srt_surat_masuk`
--

INSERT INTO `srt_surat_masuk` (`id`, `kode`, `no_agenda`, `indek_berkas`, `isi_ringkas`, `dari`, `no_surat`, `tgl_surat`, `tgl_diterima`, `keterangan`, `file`, `pengolah`) VALUES
(1, 'HM', '	0001', 'data', 'Permintaan data kunjungan wisatawan semester 1 tahun 2015', 'Dinas Pariwisata DIY', 'Par/HM.01/100/2015', '2015-05-22', '2015-05-24', '', 'Tes_Upload_file1.docx', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `keu_amanah`
--
ALTER TABLE `keu_amanah`
  ADD PRIMARY KEY (`id_amanah`);

--
-- Indexes for table `keu_departemen`
--
ALTER TABLE `keu_departemen`
  ADD PRIMARY KEY (`id_departemen`);

--
-- Indexes for table `keu_donatur`
--
ALTER TABLE `keu_donatur`
  ADD PRIMARY KEY (`id_donatur`);

--
-- Indexes for table `keu_iuran_pengurus`
--
ALTER TABLE `keu_iuran_pengurus`
  ADD KEY `iuran_pengurus_ibfk_1` (`id_pengurus`);

--
-- Indexes for table `keu_pendapatan_donatur`
--
ALTER TABLE `keu_pendapatan_donatur`
  ADD PRIMARY KEY (`id_p_donatur`),
  ADD KEY `id_donatur` (`id_donatur`);

--
-- Indexes for table `keu_pendapatan_lainnya`
--
ALTER TABLE `keu_pendapatan_lainnya`
  ADD PRIMARY KEY (`id_p_lainnya`);

--
-- Indexes for table `keu_pengeluaran_lainnya`
--
ALTER TABLE `keu_pengeluaran_lainnya`
  ADD PRIMARY KEY (`id_peng_lainnya`);

--
-- Indexes for table `keu_pengurus`
--
ALTER TABLE `keu_pengurus`
  ADD PRIMARY KEY (`id_pengurus`),
  ADD KEY `keu_amanah` (`keu_amanah`),
  ADD KEY `keu_departemen` (`keu_departemen`);

--
-- Indexes for table `keu_program_kerja`
--
ALTER TABLE `keu_program_kerja`
  ADD PRIMARY KEY (`id_progja`),
  ADD KEY `id_departemen` (`id_departemen`);

--
-- Indexes for table `keu_riwayat_pembayaran_iuran`
--
ALTER TABLE `keu_riwayat_pembayaran_iuran`
  ADD PRIMARY KEY (`id_rpi`),
  ADD KEY `riwayat_pembayaran_iuran_ibfk_1` (`id_pengurus`);

--
-- Indexes for table `keu_setting`
--
ALTER TABLE `keu_setting`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indexes for table `keu_tahun_kepengurusan`
--
ALTER TABLE `keu_tahun_kepengurusan`
  ADD PRIMARY KEY (`id_thnkepengurusan`);

--
-- Indexes for table `keu_timeline_progja`
--
ALTER TABLE `keu_timeline_progja`
  ADD PRIMARY KEY (`id_timeline_progja`),
  ADD KEY `id_progja` (`id_progja`);

--
-- Indexes for table `keu_univ`
--
ALTER TABLE `keu_univ`
  ADD PRIMARY KEY (`id_univ`);

--
-- Indexes for table `one_admin`
--
ALTER TABLE `one_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `srt_disposisi`
--
ALTER TABLE `srt_disposisi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `srt_instansi`
--
ALTER TABLE `srt_instansi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `srt_klasifikasi`
--
ALTER TABLE `srt_klasifikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `srt_surat_keluar`
--
ALTER TABLE `srt_surat_keluar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `srt_surat_keputusan`
--
ALTER TABLE `srt_surat_keputusan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `srt_surat_masuk`
--
ALTER TABLE `srt_surat_masuk`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `keu_amanah`
--
ALTER TABLE `keu_amanah`
  MODIFY `id_amanah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `keu_departemen`
--
ALTER TABLE `keu_departemen`
  MODIFY `id_departemen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `keu_donatur`
--
ALTER TABLE `keu_donatur`
  MODIFY `id_donatur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `keu_pendapatan_donatur`
--
ALTER TABLE `keu_pendapatan_donatur`
  MODIFY `id_p_donatur` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `keu_pendapatan_lainnya`
--
ALTER TABLE `keu_pendapatan_lainnya`
  MODIFY `id_p_lainnya` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `keu_pengeluaran_lainnya`
--
ALTER TABLE `keu_pengeluaran_lainnya`
  MODIFY `id_peng_lainnya` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `keu_pengurus`
--
ALTER TABLE `keu_pengurus`
  MODIFY `id_pengurus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `keu_program_kerja`
--
ALTER TABLE `keu_program_kerja`
  MODIFY `id_progja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `keu_riwayat_pembayaran_iuran`
--
ALTER TABLE `keu_riwayat_pembayaran_iuran`
  MODIFY `id_rpi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `keu_setting`
--
ALTER TABLE `keu_setting`
  MODIFY `id_setting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `keu_tahun_kepengurusan`
--
ALTER TABLE `keu_tahun_kepengurusan`
  MODIFY `id_thnkepengurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `keu_timeline_progja`
--
ALTER TABLE `keu_timeline_progja`
  MODIFY `id_timeline_progja` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `keu_univ`
--
ALTER TABLE `keu_univ`
  MODIFY `id_univ` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `one_admin`
--
ALTER TABLE `one_admin`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `srt_disposisi`
--
ALTER TABLE `srt_disposisi`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `srt_instansi`
--
ALTER TABLE `srt_instansi`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `srt_klasifikasi`
--
ALTER TABLE `srt_klasifikasi`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;

--
-- AUTO_INCREMENT for table `srt_surat_keluar`
--
ALTER TABLE `srt_surat_keluar`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `srt_surat_keputusan`
--
ALTER TABLE `srt_surat_keputusan`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `srt_surat_masuk`
--
ALTER TABLE `srt_surat_masuk`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `keu_program_kerja`
--
ALTER TABLE `keu_program_kerja`
  ADD CONSTRAINT `program_kerja_ibfk_1` FOREIGN KEY (`id_departemen`) REFERENCES `keu_departemen` (`id_departemen`);

--
-- Constraints for table `keu_riwayat_pembayaran_iuran`
--
ALTER TABLE `keu_riwayat_pembayaran_iuran`
  ADD CONSTRAINT `riwayat_pembayaran_iuran_ibfk_1` FOREIGN KEY (`id_pengurus`) REFERENCES `keu_pengurus` (`id_pengurus`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
