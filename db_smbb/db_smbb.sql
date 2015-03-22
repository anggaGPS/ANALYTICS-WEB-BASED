-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 01 Mar 2015 pada 15.21
-- Versi Server: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_googlemap`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `NIP` int(11) NOT NULL,
  `password` varchar(11) NOT NULL,
  PRIMARY KEY (`NIP`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`NIP`, `password`) VALUES
(1102110088, 'angga');

-- --------------------------------------------------------

--
-- Struktur dari tabel `country_map`
--

CREATE TABLE IF NOT EXISTS `country_map` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `provinsi` char(52) COLLATE utf8_unicode_ci NOT NULL,
  `jenis` varchar(53) COLLATE utf8_unicode_ci NOT NULL,
  `Jumlah_Pengungsi` int(11) NOT NULL DEFAULT '0',
  `Coords` char(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT '-7,109',
  `tahun` enum('2011','2012','2013','2014','2015') COLLATE utf8_unicode_ci DEFAULT '2011',
  `rangking` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=280 ;

--
-- Dumping data untuk tabel `country_map`
--

INSERT INTO `country_map` (`id`, `provinsi`, `jenis`, `Jumlah_Pengungsi`, `Coords`, `tahun`, `rangking`) VALUES
(1, 'Sumatera Utara', 'Gunung Meletus', 170664, '3.155599509,98.41140747', '2015', 0.1),
(2, 'Nusa Tenggara Timur', 'Kekerangan', 151135, '-9.102096739,119.0039063', '2011', 0.4),
(4, 'Jawa Barat', 'Banjir', 77265, '-6.22793393,107.4902344', '2011', 0.5),
(5, 'Aceh', 'Tsunami', 0, '2.926426847,106.6113281', '2011', 1),
(6, 'Aceh', 'banjir', 132493, '-6.402648406,108.1933594', '2011', 0.1),
(9, 'jawa barat', 'BAnjir', 11, '6.402648406,108.1933594', '2011', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_ujian`
--

CREATE TABLE IF NOT EXISTS `tbl_ujian` (
  `id_ujian` int(2) NOT NULL,
  `nama_ujian` varchar(50) NOT NULL,
  PRIMARY KEY (`id_ujian`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_ujian`
--

INSERT INTO `tbl_ujian` (`id_ujian`, `nama_ujian`) VALUES
(1, 'UTG-1'),
(2, 'UTG-2'),
(3, 'UTG-3'),
(4, 'JPPA-N'),
(5, 'JPPA-U'),
(6, 'USM-1'),
(7, 'USM-2'),
(8, 'CBT'),


-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_informasi`
--

CREATE TABLE IF NOT EXISTS `tbl_informasi` (
  `id_info` int(12) NOT NULL,
  `id_prov` int(4) NOT NULL,
  `id_ujian` int(2) NOT NULL,
  `tgl` date NOT NULL,
  `waktu` time NOT NULL,
  `lokasi` text NOT NULL,
  `penyebab` text NOT NULL,
  `korban` varchar(100) NOT NULL,
  `pin` int(200) NOT NULL,
  `penanganan` varchar(200) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `bantuan` text NOT NULL,
  `pengungsi` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_informasi`
--

INSERT INTO `tbl_informasi` (`id_info`, `id_prov`, `id_ujian`, `tgl`, `waktu`, `lokasi`, `penyebab`, `korban`, `pin`, `penanganan`, `foto`, `jenis`, `lat`, `lng`, `bantuan`, `pengungsi`) VALUES
(1, 1200, 4, '2013-09-22', '00:00:00', '', 'Tekanan Gas Tinggi', '4 meninggal', 4, '', '', 'gunung', 3.155599509242843, 98.41140747070312, 'Pangan, Papan, Pakian, Obat-obatan, Uang, Seragam dan alat tulis sekolah, dan lain-lain', 3000),
(1, 5300, 8, '2014-11-08', '00:00:00', '', 'Suhu Tinggi', '0', 1000000, '', '', 'kekeringan', -9.10209673872643, 119.00390625, 'Makanan, Air, Uang', 0),
(0, 7100, 6, '2014-11-17', '00:00:00', '', 'Gempa Tektonik Pergesaran antara Phlipina', '5 orang meninggal, 1 luka luka', 2147483647, '', '', 'gempa', 1.2303741774326145, 125.4638671875, 'tenda darurat', 300),
(0, 3200, 10, '2014-11-21', '00:00:00', '', 'hujan lebat', '200', 20000, '', '', 'banjir', -6.227933930268672, 107.490234375, 'selimut', 5000),
(3, 1100, 12, '2014-11-06', '00:00:00', '', 'gempa tektonik', '200', 2147483647, '', '', 'tsunami', -6.926426847059551, 106.611328125, '-', 2000000000000),
(0, 1100, 2, '2014-12-10', '00:00:00', '', '1', '11', 1, '', '', 'banjir', -6.402648405963884, 108.193359375, '11', 1),
(1, 3100, 10, '2014-12-01', '00:00:00', '', 'Katulampa Jebol', '0', 2147483647, '', '', 'banjir', -6.24158561380969, 106.85302734375, 'xxxxxxxxxxxx', 4000),
(1, 0, 2, '0000-00-00', '00:00:00', '', '1', '1', 1, '', '', 'banjir', 1, 1, '1', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_provinsi`
--

CREATE TABLE IF NOT EXISTS `tbl_provinsi` (
  `id_prov` int(4) NOT NULL,
  `nama_prov` varchar(50) NOT NULL,
  `ibu_kota` varchar(50) NOT NULL,
  PRIMARY KEY (`id_prov`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_provinsi`
--

INSERT INTO `tbl_provinsi` (`id_prov`, `nama_prov`, `ibu_kota`) VALUES
(1100, 'Aceh', 'Banda Aceh'),
(1200, 'Sumatera Utara', 'Medan'),
(1300, 'Sumatera Barat', 'Padang'),
(1400, 'Riau', 'Pakanbaru'),
(1500, 'Jambi', 'Jambi'),
(1600, 'Sumatera Selatan', 'Palembang'),
(1700, 'Bengkulu', 'Bengkulu'),
(1800, 'Lampung', 'Bandar Lampung'),
(1900, 'Kepulauan Bangka Belitung', 'Pangkal Pinang'),
(2100, 'Kepulauan Riau', 'Tanjungpinang'),
(3100, 'DKI Jakarta', 'Jakarta'),
(3200, 'Jawa Barat', 'Bandung'),
(3300, 'Jawa Tengah', 'Semarang'),
(3400, 'D I Yogyakarta', 'Yogyakarta'),
(3500, 'Jawa Timur', 'Surabaya'),
(3600, 'Banten', 'Serang'),
(5100, 'Bali', 'Denpasar'),
(5200, 'Nusa Tenggara Barat', 'Mataram'),
(5300, 'Nusa Tenggara Timur', 'Kupang'),
(6100, 'Kalimantan Barat', 'Pontianak'),
(6200, 'Kalimantan Tengah', 'Palangkaraya'),
(6300, 'Kalimantan Selatan', 'Banjarmasin'),
(6400, 'Kalimantan Timur', 'Samarinda'),
(6500, 'Kalimantan Utara', 'Tarakan'),
(7100, 'Sulawesi Utara', 'Manado'),
(7200, 'Sulawesi Tengah', 'Palu'),
(7300, 'Sulawesi Selatan', 'Makassar'),
(7400, 'Sulawesi Tenggara', 'Kendari'),
(7500, 'Gorontalo', 'Gorontalo'),
(7600, 'Sulawesi Barat', 'Mamuju'),
(8100, 'Maluku', 'Ambon'),
(8200, 'Maluku Utara', 'Sofifi/Ternate'),
(9100, 'Papua Barat', 'Manokwari'),
(9400, 'Papua', 'Jayapura');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `NIP` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `contact` varchar(20) NOT NULL,
  PRIMARY KEY (`NIP`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`NIP`, `password`, `alamat`, `contact`) VALUES
('1102110082', 'pendidikan', '', ''),
('1102110084', 'pendidikan', '', ''),
('1102110086', 'pendidikan', 'jalan telekomunikasi gg pga', '08811710224'),
('1102110088', 'pendidikan', '', ''),
('11111111', '12412142', '', ''),
('1223', '123', '', ''),
('anggaGPS', '41cde09309583cd048d69d6e2deb95f8', '', '');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_informasi`
--
CREATE TABLE IF NOT EXISTS `view_informasi` (
`id_info` int(12)
,`nama_prov` varchar(50)
,`nama_ujian` varchar(50)
,`tgl` date
,`waktu` time
,`lokasi` text
,`korban` varchar(100)
,`penyebab` text
,`pin` int(200)
,`penanganan` varchar(200)
,`foto` varchar(50)
,`jenis` varchar(100)
,`lat` double
,`lng` double
);
-- --------------------------------------------------------

--
-- Struktur untuk view `view_informasi`
--
DROP TABLE IF EXISTS `view_informasi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_informasi` AS select `info`.`id_info` AS `id_info`,`tbl_provinsi`.`nama_prov` AS `nama_prov`,`tbl_ujian`.`nama_ujian` AS `nama_ujian`,`info`.`tgl` AS `tgl`,`info`.`waktu` AS `waktu`,`info`.`lokasi` AS `lokasi`,`info`.`korban` AS `korban`,`info`.`penyebab` AS `penyebab`,`info`.`pin` AS `pin`,`info`.`penanganan` AS `penanganan`,`info`.`foto` AS `foto`,`info`.`jenis` AS `jenis`,`info`.`lat` AS `lat`,`info`.`lng` AS `lng` from ((`tbl_informasi` `info` join `tbl_ujian`) join `tbl_provinsi`) where ((`info`.`id_prov` = `tbl_provinsi`.`id_prov`) and (`info`.`id_ujian` = `tbl_ujian`.`id_ujian`));

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
