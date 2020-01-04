-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2020 at 03:24 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sipsen`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(255) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` text NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(55, '2019-10-20-114056', 'App\\Database\\Migrations\\AddJurusan', 'default', 'App', 1572009349, 1),
(56, '2019-10-20-114150', 'App\\Database\\Migrations\\AddKelas', 'default', 'App', 1572009349, 1),
(57, '2019-10-20-114358', 'App\\Database\\Migrations\\AddGuru', 'default', 'App', 1572009349, 1),
(58, '2019-10-20-114439', 'App\\Database\\Migrations\\AddAdmin', 'default', 'App', 1572009350, 1),
(59, '2019-10-20-114527', 'App\\Database\\Migrations\\AddWali', 'default', 'App', 1572009350, 1),
(60, '2019-10-20-114616', 'App\\Database\\Migrations\\AddPerangkat', 'default', 'App', 1572009350, 1),
(61, '2019-10-20-114726', 'App\\Database\\Migrations\\AddSiswa', 'default', 'App', 1572009350, 1),
(62, '2019-10-20-115248', 'App\\Database\\Migrations\\AddKeluhan', 'default', 'App', 1572009351, 1),
(63, '2019-10-20-115453', 'App\\Database\\Migrations\\AddJenisPresensi', 'default', 'App', 1572009351, 1),
(64, '2019-10-20-115518', 'App\\Database\\Migrations\\AddPresensi', 'default', 'App', 1572009351, 1),
(65, '2019-10-20-115758', 'App\\Database\\Migrations\\AddIzin', 'default', 'App', 1572009351, 1),
(66, '2019-10-25-120250', 'App\\Database\\Migrations\\AddJam', 'default', 'App', 1572009352, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`username`, `password`) VALUES
('admin', 'e64b78fc3bc91bcbc7dc232ba8ec59e0');

-- --------------------------------------------------------

--
-- Table structure for table `tb_alat`
--

CREATE TABLE `tb_alat` (
  `id` int(11) NOT NULL,
  `kd_alat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_antrian_siswa`
--

CREATE TABLE `tb_antrian_siswa` (
  `id_antrian` int(11) NOT NULL,
  `NIS` varchar(50) NOT NULL,
  `waktu` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_bimbingan`
--

CREATE TABLE `tb_bimbingan` (
  `id_bimbingan` int(11) NOT NULL,
  `NIS` varchar(50) NOT NULL,
  `NUPTK` varchar(50) DEFAULT NULL,
  `bimbingan` varchar(255) DEFAULT NULL,
  `saran` text DEFAULT NULL,
  `tgl_kirim` datetime DEFAULT NULL,
  `tgl_balas` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_bimbingan`
--

INSERT INTO `tb_bimbingan` (`id_bimbingan`, `NIS`, `NUPTK`, `bimbingan`, `saran`, `tgl_kirim`, `tgl_balas`) VALUES
(9, '12345678', NULL, 'zz', NULL, '2019-12-30 23:13:50', NULL),
(10, '12345678', NULL, 'zz', NULL, '2019-12-30 23:16:39', NULL),
(11, '12345678', NULL, 'zz!@#!@$@#5', NULL, '2020-01-01 05:19:11', NULL),
(12, '12345678', '12345678', 'zz!@#!@$@#5', 'zz!@#!@$@#5', '2020-01-01 05:51:54', '2020-01-01 06:09:22');

-- --------------------------------------------------------

--
-- Table structure for table `tb_guru`
--

CREATE TABLE `tb_guru` (
  `NUPTK` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `jk` varchar(5) NOT NULL,
  `status_bk` varchar(5) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_guru`
--

INSERT INTO `tb_guru` (`NUPTK`, `nama`, `alamat`, `no_hp`, `email`, `jk`, `status_bk`, `password`, `token`) VALUES
('1234567', 'Morgan', 'Kp Haregem', '0812-3456-8384', 'morgan123', '1', '1', '9310f83135f238b04af729fec041cca8', NULL),
('12345678', 'Fiqri', 'Kp Hargem', '0812345678', 'Email', '1', '1', '$2y$10$cH0aBjyAixhHNU1BYVxBNuA2vt4Mf.9FcnfxVewEoVccrcphj56Me', 'e2RXlE3Rhj0:APA91bEEET4KuB1VRdic3LEM4MAfEthH2mejMuFOBqJuZ7aQDfYhWt9V0o4mEGZG3KHp0irclcg115M4C7-vyb9c5s2u1tvWv8Nwlvg_rI1wpTGnBrRV4FhVEmXz8nus5lAK4bBwS7CX');

-- --------------------------------------------------------

--
-- Table structure for table `tb_izin`
--

CREATE TABLE `tb_izin` (
  `id_izin` int(11) NOT NULL,
  `NIS` varchar(50) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `jenis_izin` varchar(3) NOT NULL,
  `bukti` varchar(255) NOT NULL,
  `tanggal_dikirim` datetime DEFAULT NULL,
  `status` int(5) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_izin`
--

INSERT INTO `tb_izin` (`id_izin`, `NIS`, `tgl_mulai`, `tgl_selesai`, `jenis_izin`, `bukti`, `tanggal_dikirim`, `status`, `keterangan`) VALUES
(31, '12345678', '2019-02-02', '2019-02-02', '4', '1574538196', '2019-11-24 02:24:54', 0, 'jjafs'),
(32, '1705011', '2019-11-26', '2019-11-25', '4', '1574555743', '2019-11-24 07:35:43', 1, 'ket'),
(43, '12345678', '2019-11-26', '2019-11-25', '4', '1574693286', '2019-11-25 21:48:06', 0, 'ket');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jam`
--

CREATE TABLE `tb_jam` (
  `id_jam` int(11) NOT NULL,
  `jam_masuk` time NOT NULL,
  `jam_pulang` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_jam`
--

INSERT INTO `tb_jam` (`id_jam`, `jam_masuk`, `jam_pulang`) VALUES
(1, '19:19:00', '22:38:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jenis_presensi`
--

CREATE TABLE `tb_jenis_presensi` (
  `id_jenis_presensi` int(5) NOT NULL,
  `jenis_presensi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_jenis_presensi`
--

INSERT INTO `tb_jenis_presensi` (`id_jenis_presensi`, `jenis_presensi`) VALUES
(1, 'Hadir'),
(2, 'Tidak Hadir'),
(3, 'Hadir/Pulang tanpa izin'),
(4, 'Izin'),
(5, 'Sakit');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jurusan`
--

CREATE TABLE `tb_jurusan` (
  `id_jurusan` int(11) NOT NULL,
  `nama_jurusan` varchar(50) NOT NULL,
  `singkatan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_jurusan`
--

INSERT INTO `tb_jurusan` (`id_jurusan`, `nama_jurusan`, `singkatan`) VALUES
(1, 'Teknik Komputer dan Jaringan', 'TKJ'),
(5, 'Teknik Otomotif Kendaraan Ringan', 'TOKR');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kelas`
--

CREATE TABLE `tb_kelas` (
  `id_kelas` int(11) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  `tingkat` varchar(3) NOT NULL,
  `nama` varchar(3) NOT NULL,
  `kd_alat` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_kelas`
--

INSERT INTO `tb_kelas` (`id_kelas`, `id_jurusan`, `tingkat`, `nama`, `kd_alat`) VALUES
(1, 1, 'XII', '1', '123'),
(2, 1, 'XI', '1', '123');

-- --------------------------------------------------------

--
-- Table structure for table `tb_libur`
--

CREATE TABLE `tb_libur` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_libur`
--

INSERT INTO `tb_libur` (`id`, `tanggal`, `keterangan`) VALUES
(1, '2019-11-16', 'libur pahlawan');

-- --------------------------------------------------------

--
-- Table structure for table `tb_perangkat`
--

CREATE TABLE `tb_perangkat` (
  `id_perangkat` int(11) NOT NULL,
  `id_kelas` varchar(5) NOT NULL,
  `kode` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_presensi`
--

CREATE TABLE `tb_presensi` (
  `id_presensi` int(11) NOT NULL,
  `NIS` varchar(50) NOT NULL,
  `id_jenis_presensi` int(5) NOT NULL,
  `tanggal` date NOT NULL,
  `masuk` time DEFAULT NULL,
  `keluar` time DEFAULT NULL,
  `keterlambatan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_presensi`
--

INSERT INTO `tb_presensi` (`id_presensi`, `NIS`, `id_jenis_presensi`, `tanggal`, `masuk`, `keluar`, `keterlambatan`) VALUES
(170, '12345677', 3, '2019-11-21', '20:14:35', '00:00:00', 0),
(175, '1705011', 3, '2019-11-21', '23:10:57', '00:00:00', 0),
(177, '1705011', 1, '2019-03-22', '09:16:26', '14:00:00', 10),
(178, '12345677', 3, '2019-11-22', '10:50:40', '00:00:00', 0),
(179, '12345678', 3, '2019-03-22', '21:11:34', '00:00:00', 0),
(180, '1705011', 3, '2019-11-23', '00:00:00', '00:00:00', 0),
(181, '1705011', 3, '2019-11-23', '16:45:29', '00:00:00', 0),
(192, '12345678', 3, '2019-11-30', '07:41:20', '00:00:00', 1),
(193, '12345677', 3, '2019-11-30', '07:42:08', '00:00:00', 2),
(214, '1705011', 1, '2019-12-07', '22:04:59', NULL, 13),
(223, '12345677', 1, '2019-12-07', '22:19:37', NULL, 28),
(224, '12345678', 1, '2019-12-07', '22:19:43', NULL, 28),
(225, '12345678', 1, '2019-12-08', '08:18:56', '16:07:37', 0),
(226, '12345677', 1, '2019-12-08', '08:19:03', '16:12:58', 0),
(228, '1705011', 2, '2019-12-08', NULL, NULL, NULL),
(251, '1705011', 1, '2019-12-09', '19:42:55', '21:03:37', 0),
(252, '12345678', 1, '2019-12-09', '19:43:03', '21:03:10', 0),
(253, '12345677', 1, '2019-12-09', '19:43:08', '21:03:20', 0),
(264, '1705011', 1, '2019-12-10', '22:57:04', NULL, 2),
(267, '12345677', 1, '2019-12-11', '22:43:13', NULL, 0),
(270, '1705011', 1, '2019-12-11', '21:59:00', '23:08:43', 0),
(271, '12345678', 2, '2019-12-11', NULL, NULL, NULL),
(272, '1705011', 1, '2019-12-12', '10:58:41', NULL, 13),
(273, '12345677', 2, '2019-12-12', NULL, NULL, NULL),
(275, '1705011', 1, '2019-12-26', '09:40:22', NULL, 0),
(276, '12345677', 2, '2019-12-26', NULL, NULL, NULL),
(277, '12345678', 2, '2019-12-26', NULL, NULL, NULL),
(287, '1705011', 3, '2019-12-27', '09:48:07', NULL, 29),
(288, '12345677', 2, '2019-12-27', NULL, NULL, NULL),
(289, '12345678', 2, '2019-12-27', NULL, NULL, NULL),
(291, '12345677', 3, '2020-01-01', '18:17:08', NULL, 0),
(298, '12345678', 3, '2020-01-01', '19:07:46', NULL, 0),
(299, '1705011', 2, '2020-01-01', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `NIS` varchar(50) NOT NULL,
  `NISN` varchar(50) NOT NULL,
  `nama_siswa` varchar(50) NOT NULL,
  `jk` varchar(15) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `nama_ayah` varchar(50) NOT NULL,
  `nama_ibu` varchar(50) NOT NULL,
  `id_wali` int(11) DEFAULT NULL,
  `id_fp` varchar(5) NOT NULL,
  `password` varchar(100) NOT NULL,
  `token` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_siswa`
--

INSERT INTO `tb_siswa` (`NIS`, `NISN`, `nama_siswa`, `jk`, `id_kelas`, `tgl_lahir`, `no_hp`, `email`, `alamat`, `nama_ayah`, `nama_ibu`, `id_wali`, `id_fp`, `password`, `token`) VALUES
('12345677', '123455', 'Ronaldo Wati', '1', 2, '1999-01-27', '0812-3456', 'madridistafiqri@gmail.com', 'Kp Hargem', 'udin', 'ujang', NULL, '2', '$2y$12$TFpUMINmY3cUuK7k4Gr.oePIKCjOkAedIbNc5MhI238XKegjwYzDq', NULL),
('12345678', '123456', 'Fiqri Rahardian', '1', 1, '1999-01-27', '0812345678', 'madridistafiqri@gmail.com', 'Kp Hargem', 'Syarifuddin', 'Eko Iriantuti', NULL, '3', '$2y$12$l3oF.uPpmjNWIrcQ/sH/E.XInGIetb.aCE62jIE2mtvWfJGLhoWe2', 'cesVwwuCbZ8:APA91bF_S10oTGN60uOF-gaggORzrImpWKOr_IHanxe8-dwasvXiN7amN11JIG_ME-S4MF_JewUYsAzvyelQLgRpUQVNsPfxI8Z8zJzIL6kF_f0_hRFJq2pvVwPmKLAYKWsbpO5oNkB0'),
('1705011', '1705011', 'Afgan', '1', 1, '1999-01-23', '0812-3456', 'afgan@gmail.com', 'jakarta', 'ayah', 'ibu', 1, '5', '$2y$10$u7qCdJRUDAjT2zHg9S4fW.3rt6GlUVv53H1hdJFCaGqxM5zlOBQtm', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_wali`
--

CREATE TABLE `tb_wali` (
  `id_wali` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_wali`
--

INSERT INTO `tb_wali` (`id_wali`, `username`, `nama`, `email`, `password`, `token`) VALUES
(1, 'Wali123', 'Udin', 'udin@gmail.com', '$2y$10$vNj3oUPly3QU6lzgmHcc6.VfPdrB.rru/CAuN8VcJ5KJWJR2Rc3ki', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `tb_alat`
--
ALTER TABLE `tb_alat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_antrian_siswa`
--
ALTER TABLE `tb_antrian_siswa`
  ADD PRIMARY KEY (`id_antrian`),
  ADD KEY `NIS` (`NIS`);

--
-- Indexes for table `tb_bimbingan`
--
ALTER TABLE `tb_bimbingan`
  ADD PRIMARY KEY (`id_bimbingan`),
  ADD KEY `tb_keluhan_NIS_foreign` (`NIS`),
  ADD KEY `tb_keluhan_NUPTK_foreign` (`NUPTK`);

--
-- Indexes for table `tb_guru`
--
ALTER TABLE `tb_guru`
  ADD PRIMARY KEY (`NUPTK`);

--
-- Indexes for table `tb_izin`
--
ALTER TABLE `tb_izin`
  ADD PRIMARY KEY (`id_izin`),
  ADD KEY `tb_izin_NIS_foreign` (`NIS`);

--
-- Indexes for table `tb_jam`
--
ALTER TABLE `tb_jam`
  ADD PRIMARY KEY (`id_jam`);

--
-- Indexes for table `tb_jenis_presensi`
--
ALTER TABLE `tb_jenis_presensi`
  ADD PRIMARY KEY (`id_jenis_presensi`);

--
-- Indexes for table `tb_jurusan`
--
ALTER TABLE `tb_jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indexes for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD PRIMARY KEY (`id_kelas`),
  ADD KEY `tb_kelas_id_jurusan_foreign` (`id_jurusan`);

--
-- Indexes for table `tb_libur`
--
ALTER TABLE `tb_libur`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_perangkat`
--
ALTER TABLE `tb_perangkat`
  ADD PRIMARY KEY (`id_perangkat`);

--
-- Indexes for table `tb_presensi`
--
ALTER TABLE `tb_presensi`
  ADD PRIMARY KEY (`id_presensi`),
  ADD KEY `tb_presensi_NIS_foreign` (`NIS`),
  ADD KEY `tb_presensi_id_jenis_presensi_foreign` (`id_jenis_presensi`);

--
-- Indexes for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`NIS`),
  ADD KEY `tb_siswa_id_kelas_foreign` (`id_kelas`),
  ADD KEY `tb_siswa_id_wali_foreign` (`id_wali`);

--
-- Indexes for table `tb_wali`
--
ALTER TABLE `tb_wali`
  ADD PRIMARY KEY (`id_wali`),
  ADD UNIQUE KEY `id_wali` (`id_wali`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `tb_alat`
--
ALTER TABLE `tb_alat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_antrian_siswa`
--
ALTER TABLE `tb_antrian_siswa`
  MODIFY `id_antrian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table `tb_bimbingan`
--
ALTER TABLE `tb_bimbingan`
  MODIFY `id_bimbingan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_izin`
--
ALTER TABLE `tb_izin`
  MODIFY `id_izin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `tb_jam`
--
ALTER TABLE `tb_jam`
  MODIFY `id_jam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_jenis_presensi`
--
ALTER TABLE `tb_jenis_presensi`
  MODIFY `id_jenis_presensi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_jurusan`
--
ALTER TABLE `tb_jurusan`
  MODIFY `id_jurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_libur`
--
ALTER TABLE `tb_libur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_perangkat`
--
ALTER TABLE `tb_perangkat`
  MODIFY `id_perangkat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_presensi`
--
ALTER TABLE `tb_presensi`
  MODIFY `id_presensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=300;

--
-- AUTO_INCREMENT for table `tb_wali`
--
ALTER TABLE `tb_wali`
  MODIFY `id_wali` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_bimbingan`
--
ALTER TABLE `tb_bimbingan`
  ADD CONSTRAINT `tb_keluhan_NIS_foreign` FOREIGN KEY (`NIS`) REFERENCES `tb_siswa` (`NIS`),
  ADD CONSTRAINT `tb_keluhan_NUPTK_foreign` FOREIGN KEY (`NUPTK`) REFERENCES `tb_guru` (`NUPTK`);

--
-- Constraints for table `tb_izin`
--
ALTER TABLE `tb_izin`
  ADD CONSTRAINT `tb_izin_NIS_foreign` FOREIGN KEY (`NIS`) REFERENCES `tb_siswa` (`NIS`);

--
-- Constraints for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD CONSTRAINT `tb_kelas_id_jurusan_foreign` FOREIGN KEY (`id_jurusan`) REFERENCES `tb_jurusan` (`id_jurusan`);

--
-- Constraints for table `tb_presensi`
--
ALTER TABLE `tb_presensi`
  ADD CONSTRAINT `tb_presensi_NIS_foreign` FOREIGN KEY (`NIS`) REFERENCES `tb_siswa` (`NIS`),
  ADD CONSTRAINT `tb_presensi_id_jenis_presensi_foreign` FOREIGN KEY (`id_jenis_presensi`) REFERENCES `tb_jenis_presensi` (`id_jenis_presensi`);

--
-- Constraints for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD CONSTRAINT `tb_siswa_id_kelas_foreign` FOREIGN KEY (`id_kelas`) REFERENCES `tb_kelas` (`id_kelas`),
  ADD CONSTRAINT `tb_siswa_id_wali_foreign` FOREIGN KEY (`id_wali`) REFERENCES `tb_wali` (`id_wali`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
