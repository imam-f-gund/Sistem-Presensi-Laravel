-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 01, 2020 at 03:27 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `presensi`
--

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `id_dosen` int(15) NOT NULL,
  `name` varchar(50) NOT NULL,
  `id_prodi` int(15) NOT NULL,
  `user_id` int(15) DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `id_jabatan` int(15) DEFAULT NULL,
  `nip` bigint(255) DEFAULT NULL,
  `nidn` int(25) DEFAULT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan') DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`id_dosen`, `name`, `id_prodi`, `user_id`, `updated_at`, `id_jabatan`, `nip`, `nidn`, `jenis_kelamin`, `alamat`) VALUES
(1, 'INDRA GITA ANUGRAH, S.Kom., M.Kom', 6, 19, NULL, 1, 6211707206, NULL, 'Laki-Laki', 'Gresik'),
(2, 'UMI CHOTIJAH, S.Kom., M.Kom\r\n', 6, 20, NULL, 1, 6211709199, NULL, 'Perempuan', 'Gresik'),
(6, 'HENNY DWI BHAKTI, S.Si., M.Si.', 6, 25, NULL, 1, 6211709200, NULL, 'Perempuan', 'Gresik'),
(7, 'FARID SUKMANA, S.Kom., M.MT', 6, 26, NULL, 1, 6211802207, NULL, 'Laki-Laki', 'Gresik'),
(9, 'PUTRI AISYIYAH RAHMA DEVI, S.Pd., M.Kom', 6, 27, NULL, 1, 6231409387, NULL, 'Perempuan', 'Gresik'),
(10, 'DARMAWAN ADITAMA, S.Kom, M.T', 6, 28, NULL, 1, 6231503411, NULL, 'Laki-Laki', 'Gresik'),
(11, 'HARUNUR ROSYID, ST., M.Kom', 6, 24, NULL, 1, 6210408106, NULL, 'Laki-Laki', 'Gresik'),
(12, 'SOFFIANA AGUSTIN, S.Kom., M.Kom', 6, 23, NULL, 1, 6210310091, NULL, 'Perempuan', 'Gresik'),
(13, 'ARFA M SPDI., M PDI', 5, 29, NULL, 1, 6100001, NULL, 'Laki-Laki', 'Gresik');

-- --------------------------------------------------------

--
-- Table structure for table `fakultas`
--

CREATE TABLE `fakultas` (
  `id_fakultas` int(15) NOT NULL,
  `nama_fakultas` varchar(25) NOT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fakultas`
--

INSERT INTO `fakultas` (`id_fakultas`, `nama_fakultas`, `updated_at`) VALUES
(4, 'pendidikan', NULL),
(62, 'teknik', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(15) NOT NULL,
  `nama_jabatan` varchar(30) NOT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`, `updated_at`) VALUES
(1, 'Dosen', NULL),
(2, 'Karyawan', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int(15) NOT NULL,
  `name` varchar(50) NOT NULL,
  `id_prodi` int(15) DEFAULT NULL,
  `user_id` int(15) DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `nip` int(15) NOT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan') NOT NULL,
  `alamat` text NOT NULL,
  `tgl_bekerja` date DEFAULT NULL,
  `id_jabatan` int(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `name`, `id_prodi`, `user_id`, `updated_at`, `nip`, `jenis_kelamin`, `alamat`, `tgl_bekerja`, `id_jabatan`) VALUES
(1, 'nunik', NULL, 14, '0000-00-00', 20001, 'Perempuan', 'Gresik', NULL, 2),
(2, 'rudi', NULL, 15, '0000-00-00', 20002, 'Laki-Laki', 'Gresik', NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `krs`
--

CREATE TABLE `krs` (
  `nim` int(15) NOT NULL,
  `id_matkul` int(15) NOT NULL,
  `id_krs` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `krs`
--

INSERT INTO `krs` (`nim`, `id_matkul`, `id_krs`) VALUES
(170602050, 23, 10),
(170602020, 23, 12);

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nim` int(15) NOT NULL,
  `created_at` date DEFAULT NULL,
  `id_prodi` int(15) NOT NULL,
  `user_id` int(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`name`, `nim`, `created_at`, `id_prodi`, `user_id`) VALUES
('rosyid amruloh', 170202001, NULL, 5, NULL),
('imam fakhruddin', 170602020, NULL, 6, 16),
('aldi rifai', 170602050, NULL, 6, 17);

-- --------------------------------------------------------

--
-- Table structure for table `mata_kuliah`
--

CREATE TABLE `mata_kuliah` (
  `id_matkul` int(15) NOT NULL,
  `nama_matkul` varchar(50) NOT NULL,
  `id_dosen` int(15) DEFAULT NULL,
  `kode_matkul` varchar(50) DEFAULT NULL,
  `id_prodi` int(15) NOT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mata_kuliah`
--

INSERT INTO `mata_kuliah` (`id_matkul`, `nama_matkul`, `id_dosen`, `kode_matkul`, `id_prodi`, `updated_at`) VALUES
(23, 'SISTEM INFORMASI MANAJEMEN', 2, '14625331', 6, NULL),
(27, 'MKP. SISTEM TEMU KEMBALI INFORMASI', 1, '14629422', 6, NULL),
(28, 'PEMROGRAMAN JARINGAN', 1, '14625323', 6, NULL),
(29, 'REKAYASA PERANGKAT LUNAK', 7, '14625330', 6, NULL),
(30, 'PENGOLAHAN CITRA DIGITAL', 12, '14625327	', 6, NULL),
(31, 'TECHNOPRENEURSHIP', 6, '14624314	', 6, NULL),
(32, 'INTERAKSI MANUSIA DAN KOMPUTER', 10, '14626318', 6, NULL),
(33, 'BAHASA DAN SASTRA', 13, '6101231', 5, NULL),
(34, 'PBO', 1, '12345', 6, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `presensi_dosen`
--

CREATE TABLE `presensi_dosen` (
  `id_presensi_dosen` int(15) NOT NULL,
  `id_dosen` int(15) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `days` varchar(75) NOT NULL,
  `generate` varchar(75) NOT NULL,
  `validasi` varchar(75) DEFAULT NULL,
  `history` varchar(75) DEFAULT NULL,
  `time` varchar(75) DEFAULT NULL,
  `jumlah_masuk` time DEFAULT NULL,
  `keterangan` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `presensi_dosen`
--

INSERT INTO `presensi_dosen` (`id_presensi_dosen`, `id_dosen`, `created_at`, `updated_at`, `days`, `generate`, `validasi`, `history`, `time`, `jumlah_masuk`, `keterangan`) VALUES
(423, 1, '2018-11-05 17:00:00', NULL, 'senin', '888', 'success', 'masuk', '08:00:00', NULL, NULL),
(424, 1, '2019-11-28 12:36:26', '2019-12-05 12:36:26', 'kamis', '1331446421568', 'success', 'masuk', '19:37:7', NULL, NULL),
(425, 1, '2019-11-28 12:38:14', '2019-12-05 12:38:14', 'kamis', '837837065136', 'success', 'pulang', '19:38:55', NULL, NULL),
(426, 1, '2019-11-29 06:39:17', '2019-12-08 06:39:17', 'jumat', '855248828022', 'success', 'masuk', '13:39:16', NULL, NULL),
(427, 1, '2019-11-29 06:41:23', '2019-12-08 06:41:23', 'jumat', '1285559993413', 'success', 'pulang', '13:41:16', NULL, NULL),
(428, 1, '2019-11-30 06:43:42', '2019-12-08 06:43:42', 'sabtu', '1096967685593', 'success', 'masuk', '13:43:39', NULL, NULL),
(429, 1, '2019-11-30 06:44:54', '2019-12-08 06:44:54', 'sabtu', '1120780852134', 'success', 'pulang', '13:44:51', NULL, 'kjhjkhkj'),
(430, 1, '2019-12-01 23:00:00', '2019-12-08 06:46:07', 'senin', '181501595883', 'success', 'masuk', '13:46:5', NULL, 'sakit'),
(431, 1, '2019-12-02 03:00:00', '2019-12-08 06:47:52', 'senin', '961056076934', 'success', 'pulang', '13:47:49', NULL, 'sakit'),
(432, 1, '2019-12-03 07:09:35', '2019-12-08 07:09:35', 'selasa', '255793563629', 'success', 'masuk', '14:9:32', NULL, 'xaki'),
(433, 1, '2019-12-03 07:32:13', '2019-12-08 07:32:13', 'selasa', '352551505761', 'success', 'pulang', '14:32:12', NULL, NULL),
(434, 1, '2019-12-04 07:32:27', '2019-12-08 07:32:27', 'rabu', '645128450915', 'success', 'masuk', '14:32:26', NULL, NULL),
(435, 1, '2019-12-04 07:39:44', '2019-12-08 07:39:44', 'rabu', '1334413973052', 'success', 'pulang', '14:39:42', NULL, 'Jin'),
(436, 1, '2019-12-05 07:43:13', '2019-12-08 07:43:13', 'kamis', '926785496690', 'success', 'masuk', '14:43:12', NULL, NULL),
(437, 1, '2019-12-05 07:47:01', '2019-12-08 07:47:01', 'kamis', '17855551580', 'success', 'pulang', '14:47:0', NULL, 'Kdk'),
(438, 1, '2019-12-06 13:52:49', '2019-12-10 13:52:49', 'jumat', '480403623', 'success', 'masuk', '20:52:47', NULL, 'yfhjhjgjgjgj'),
(439, 1, '2019-12-06 14:03:47', '2019-12-10 14:03:47', 'jumat', '1465055541760', 'success', 'pulang', '21:3:46', '07:51:00', NULL),
(440, 1, '2019-12-07 14:04:08', '2019-12-10 14:04:08', 'sabtu', '1456285755270', 'success', 'masuk', '21:4:6', NULL, NULL),
(441, 1, '2019-12-07 14:04:28', '2019-12-10 14:04:28', 'sabtu', '819920406157', 'success', 'pulang', '21:4:27', NULL, NULL),
(442, 1, '2019-12-09 14:04:56', '2019-12-10 14:04:56', 'senin', '634794611296', 'success', 'masuk', '21:4:55', NULL, NULL),
(443, 1, '2019-12-09 14:05:13', '2019-12-10 14:05:13', 'senin', '1322689742261', 'success', 'pulang', '21:5:11', NULL, NULL),
(444, 1, '2019-12-10 14:05:30', '2019-12-10 14:05:30', 'selasa', '262186400929', 'success', 'masuk', '21:5:29', NULL, NULL),
(445, 1, '2019-12-09 17:00:00', '2019-12-10 14:06:42', 'selasa', '794902078584', 'success', 'pulang', '21:6:40', '00:01:00', NULL),
(446, 1, '2019-12-11 14:06:56', '2019-12-10 14:06:56', 'rabu', '224054097961', 'success', 'sakit', '21:6:55', NULL, NULL),
(447, 2, '2019-12-11 13:08:49', '2019-12-11 13:08:49', 'rabu', '1454345244289', 'success', 'masuk', '20:8:48', NULL, NULL),
(448, 2, '2019-12-11 13:10:21', '2019-12-11 13:10:21', 'rabu', '799404434772', 'success', 'pulang', '20:10:20', '00:02:00', NULL),
(449, 2, '2019-12-10 13:21:39', '2019-12-11 13:21:39', 'selasa', '1013919970091', 'success', 'masuk', '20:21:38', NULL, NULL),
(452, 2, '2019-12-10 13:22:19', '2019-12-11 13:22:19', 'selasa', '131692917952', 'success', 'pulang', '20:22:18', '00:01:00', NULL),
(453, 2, '2019-12-08 17:00:00', '2019-12-11 13:26:46', 'senin', '834818443135', 'success', 'masuk', '20:26:45', NULL, NULL),
(454, 2, '2019-12-09 13:28:47', '2019-12-11 13:28:47', 'senin', '59289352862', 'success', 'pulang', '20:28:46', '00:02:00', NULL),
(458, 1, '2019-12-22 14:56:23', '2019-12-22 14:56:23', 'minggu', '833850788971', 'success', 'masuk', '21:56:23', NULL, NULL),
(459, 2, '2019-12-22 15:00:47', '2019-12-22 15:00:47', 'minggu', '167292885608', 'success', 'masuk', '22:0:47', NULL, NULL),
(460, 12, '2019-12-22 15:27:37', '2019-12-22 15:27:37', 'minggu', '1331477149022', 'success', 'masuk', '22:27:36', NULL, NULL),
(461, 7, '2019-12-22 15:35:18', '2019-12-22 15:35:18', 'minggu', '457567721527', 'success', 'masuk', '22:35:18', NULL, NULL),
(462, 1, '2019-12-22 15:45:42', '2019-12-22 15:45:42', 'minggu', '1158424114939', 'success', 'pulang', '22:45:42', '00:49:00', NULL),
(463, 2, '2019-12-22 15:46:52', '2019-12-22 15:46:52', 'minggu', '1473183088446', 'success', 'pulang', '22:46:52', '00:46:00', NULL),
(464, 7, '2019-12-22 15:47:43', '2019-12-22 15:47:43', 'minggu', '932417598965', 'success', 'pulang', '22:47:42', '00:12:00', NULL),
(465, 12, '2019-12-22 15:48:59', '2019-12-22 15:48:59', 'minggu', '24605415769', 'success', 'pulang', '22:48:58', '00:21:00', NULL),
(467, 12, '2019-12-23 04:19:06', '2019-12-23 04:19:06', 'senin', '1086210316492', 'success', 'masuk', '11:19:5', NULL, NULL),
(468, 11, '2019-12-23 04:22:41', '2019-12-23 04:22:41', 'senin', '946076287605', 'success', 'masuk', '11:22:40', NULL, NULL),
(469, 1, '2019-12-23 04:24:12', '2019-12-23 04:24:12', 'senin', '1503582374363', 'success', 'masuk', '11:24:11', NULL, NULL),
(470, 2, '2019-12-23 04:25:16', '2019-12-23 04:25:16', 'senin', '810537734995', 'success', 'masuk', '11:25:15', NULL, NULL),
(471, 6, '2019-12-23 04:26:57', '2019-12-23 04:26:57', 'senin', '1498919463994', 'success', 'izin', '11:26:56', NULL, 'tugas ke luar kota'),
(472, 7, '2019-12-23 04:27:58', '2019-12-23 04:27:58', 'senin', '400523180105', 'success', 'masuk', '11:27:57', NULL, NULL),
(473, 9, '2019-12-23 04:28:45', '2019-12-23 04:28:45', 'senin', '228398993570', 'success', 'masuk', '11:28:44', NULL, NULL),
(474, 10, '2019-12-23 04:29:33', '2019-12-23 04:29:33', 'senin', '1286079164072', 'success', 'masuk', '11:29:32', NULL, NULL),
(475, 13, '2019-12-23 04:59:20', '2019-12-23 04:59:20', 'senin', '1337795231133', 'success', 'masuk', '11:59:20', NULL, NULL),
(476, 13, '2019-12-23 08:27:50', '2019-12-23 08:27:50', 'senin', '1137534750083', 'success', 'pulang', '15:27:49', '03:28:00', NULL),
(477, 12, '2019-12-23 08:28:51', '2019-12-23 08:28:51', 'senin', '108388122320', 'success', 'pulang', '15:28:50', '04:09:00', NULL),
(478, 11, '2019-12-23 08:29:37', '2019-12-23 08:29:37', 'senin', '647669654570', 'success', 'pulang', '15:29:36', NULL, NULL),
(479, 1, '2019-12-23 08:30:13', '2019-12-23 08:30:13', 'senin', '1141804557512', 'success', 'pulang', '15:30:12', '04:06:00', NULL),
(480, 2, '2019-12-23 08:31:15', '2019-12-23 08:31:15', 'senin', '1401518135229', 'success', 'pulang', '15:31:14', NULL, NULL),
(481, 6, '2019-12-23 08:31:55', '2019-12-23 08:31:55', 'senin', '308197471944', 'success', 'pulang', '15:31:54', '04:05:00', NULL),
(482, 7, '2019-12-23 08:32:44', '2019-12-23 08:32:44', 'senin', '1150636358382', 'success', 'pulang', '15:32:43', NULL, NULL),
(483, 9, '2019-12-23 08:33:28', '2019-12-23 08:33:28', 'senin', '870698382256', 'success', 'pulang', '15:33:27', NULL, NULL),
(484, 10, '2019-12-23 08:34:11', '2019-12-23 08:34:11', 'senin', '802170344923', 'success', 'pulang', '15:34:11', NULL, NULL),
(485, 1, '2019-12-23 12:19:27', '2019-12-23 12:19:27', 'senin', '591485966917', 'success', 'masuk', '19:19:25', NULL, NULL),
(486, 1, '2019-12-23 12:21:08', '2019-12-23 12:21:08', 'senin', '301327916026', 'success', 'masuk', '19:21:6', NULL, NULL),
(487, 1, '2019-12-24 13:47:56', '2019-12-24 13:47:56', 'selasa', '1550523602315', 'success', 'masuk', '20:47:55', NULL, NULL),
(488, 1, '2019-12-24 14:19:33', '2019-12-24 14:19:33', 'selasa', '439638431698', 'success', 'pulang', '21:19:32', '00:32:00', NULL),
(489, 1, '2019-12-27 06:12:11', '2019-12-27 06:12:11', 'jumat', '1083662703234', 'success', 'masuk', '13:12:7', NULL, NULL),
(490, 2, '2019-12-27 06:14:39', '2019-12-27 06:14:39', 'jumat', '8731605297', 'success', 'masuk', '13:14:35', NULL, NULL),
(491, 2, '2019-12-27 06:16:26', '2019-12-27 06:16:26', 'jumat', '1463693489542', 'success', 'pulang', '13:16:23', '00:02:00', NULL),
(492, 1, '2019-12-27 06:32:43', '2019-12-27 06:32:43', 'jumat', '269299393464', 'success', 'pulang', '13:32:40', NULL, NULL),
(493, 1, '2019-12-27 06:35:11', '2019-12-27 06:35:11', 'jumat', '1245348447078', 'success', 'pulang', '13:35:7', NULL, NULL),
(494, 1, '2019-12-27 06:46:11', '2019-12-27 06:46:11', 'jumat', '267678098377', 'null', 'pulang', '13:46:7', NULL, NULL),
(495, 1, '2019-12-27 06:50:28', '2019-12-27 06:50:28', 'jumat', '165842164866', 'success', 'pulang', '13:50:24', NULL, NULL),
(496, 1, '2019-12-27 06:51:40', '2019-12-27 06:51:40', 'jumat', '984214692451', 'success', 'masuk', '13:51:36', NULL, NULL),
(497, 1, '2020-01-01 14:00:43', '2020-01-01 14:00:43', 'rabu', '1231264779167', 'success', 'masuk', '21:0:40', NULL, NULL),
(498, 2, '2020-01-01 14:03:01', '2020-01-01 14:03:01', 'rabu', '1524163662502', 'success', 'masuk', '21:2:57', NULL, NULL),
(500, 2, '2020-01-01 14:18:49', '2020-01-01 14:18:49', 'rabu', '986585941464', 'success', 'pulang', '21:18:47', '00:16:00', NULL),
(501, 1, '2020-01-01 14:20:58', '2020-01-01 14:20:58', 'rabu', '34837893538', 'success', 'pulang', '21:20:56', '00:20:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `presensi_karyawan`
--

CREATE TABLE `presensi_karyawan` (
  `id_presensi_karyawan` int(15) NOT NULL,
  `id_karyawan` int(15) NOT NULL,
  `generate` varchar(75) NOT NULL,
  `device` varchar(75) DEFAULT NULL,
  `validasi` varchar(75) DEFAULT NULL,
  `days` varchar(75) NOT NULL,
  `history` varchar(75) DEFAULT NULL,
  `time` varchar(75) DEFAULT NULL,
  `jumlah_masuk` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `keterangan` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `presensi_karyawan`
--

INSERT INTO `presensi_karyawan` (`id_presensi_karyawan`, `id_karyawan`, `generate`, `device`, `validasi`, `days`, `history`, `time`, `jumlah_masuk`, `created_at`, `updated_at`, `keterangan`) VALUES
(106, 1, '999', NULL, 'success', 'sabtu', NULL, NULL, NULL, NULL, NULL, NULL),
(107, 1, '1328983462112', 'null', 'success', 'selasa', 'masuk', '0:10:22', NULL, '2019-11-25 10:10:23', '2019-11-25 10:10:23', NULL),
(108, 1, '670511723173', 'null', 'success', 'selasa', 'pulang', '0:22:16', '00:12:00', '2019-11-25 10:22:17', '2019-11-25 10:22:17', NULL),
(109, 1, '881894337023', 'null', 'success', 'jumat', 'masuk', '20:9:7', NULL, '2019-11-29 06:09:09', '2019-11-29 06:09:09', NULL),
(110, 2, '239877725772', 'null', 'success', 'jumat', 'masuk', '20:16:13', NULL, '2019-11-29 06:16:14', '2019-11-29 06:16:14', NULL),
(111, 1, '1293322477593', 'null', 'success', 'minggu', 'masuk', '20:39:33', NULL, '2019-12-01 06:39:36', '2019-12-01 06:39:36', NULL),
(112, 2, '1266891060426', 'null', 'success', 'minggu', 'masuk', '20:40:28', NULL, '2019-12-01 06:40:31', '2019-12-01 06:40:31', NULL),
(114, 2, '833192426041', 'null', 'success', 'minggu', 'pulang', '20:44:49', '00:04:00', '2019-12-01 06:44:52', '2019-12-01 06:44:52', NULL),
(115, 1, '245412752769', 'null', 'success', 'rabu', 'masuk', '15:49:59', NULL, '2019-12-04 01:49:59', '2019-12-04 01:49:59', NULL),
(116, 1, '1195404452926', 'null', 'success', 'rabu', 'pulang', '15:50:31', NULL, '2019-12-04 01:50:31', '2019-12-04 01:50:31', NULL),
(117, 1, '527908586666', 'null', 'success', 'rabu', 'masuk', '17:33:52', NULL, '2019-12-04 03:33:53', '2019-12-04 03:33:53', NULL),
(118, 1, '1380251592013', 'null', 'success', 'rabu', 'pulang', '17:34:53', '00:01:00', '2019-12-04 03:34:55', '2019-12-04 03:34:55', NULL),
(119, 2, '32767078808', 'null', 'success', 'rabu', 'masuk', '17:41:38', NULL, '2019-12-04 10:41:40', '2019-12-04 10:41:40', NULL),
(120, 2, '1009364531764', 'null', 'success', 'rabu', 'pulang', '17:42:22', '00:01:00', '2019-12-04 10:42:24', '2019-12-04 10:42:24', NULL),
(121, 1, '1448705563984', 'null', 'success', 'minggu', 'null', '14:2:51', NULL, '2019-12-08 07:02:52', '2019-12-08 07:02:52', 'ijin'),
(122, 2, '1101220780704', 'null', 'success', 'minggu', 'null', '14:6:14', NULL, '2019-12-08 07:06:15', '2019-12-08 07:06:15', 'sakit'),
(123, 2, '712621600304', 'null', 'success', 'minggu', 'null', '14:6:55', NULL, '2019-12-08 07:06:56', '2019-12-08 07:06:56', 'sakit'),
(124, 2, '236083079107', 'null', 'success', 'minggu', 'izin', '14:8:41', NULL, '2019-12-08 07:08:42', '2019-12-08 07:08:42', 'sakit'),
(125, 1, '1040125107380', 'null', 'success', 'minggu', 'izin', '14:33:46', NULL, '2019-12-08 07:33:47', '2019-12-08 07:33:47', 'Ojin'),
(126, 2, '250034563140', 'null', 'success', 'minggu', 'masuk', '14:48:26', NULL, '2019-12-08 07:48:27', '2019-12-08 07:48:27', NULL),
(127, 2, '160900189611', 'null', 'success', 'minggu', 'izin', '14:48:40', NULL, '2019-12-08 07:48:41', '2019-12-08 07:48:41', NULL),
(128, 2, '1003699657494', 'null', 'success', 'minggu', 'izin', '14:48:46', NULL, '2019-12-08 07:48:47', '2019-12-08 07:48:47', 'Yyh'),
(129, 1, '090', NULL, 'success', 'sabtu', 'masuk', '09:00:00', NULL, '2019-12-31 17:00:00', NULL, NULL),
(130, 1, '879', NULL, NULL, 'senin', NULL, NULL, NULL, '2019-11-29 17:00:00', NULL, NULL),
(131, 1, '672295161859', 'null', 'success', 'senin', 'masuk', '12:17:8', '00:00:00', '2019-12-23 05:17:09', '2019-12-23 05:17:09', NULL),
(132, 2, '923225259456', 'null', 'success', 'senin', 'izin', '12:20:31', NULL, '2019-12-23 05:20:32', '2019-12-23 05:20:32', 'ijin keluar kota'),
(135, 1, '735456082290', 'null', 'success', 'senin', 'pulang', '12:33:37', '00:16:00', '2019-12-23 05:33:38', '2019-12-23 05:33:38', NULL),
(136, 1, '1099547839718', 'null', 'success', 'selasa', 'masuk', '21:32:35', NULL, '2019-12-24 14:32:36', '2019-12-24 14:32:36', NULL),
(137, 1, '1236984138593', 'null', 'success', 'selasa', 'pulang', '21:40:39', '00:08:00', '2019-12-24 14:40:40', '2019-12-24 14:40:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `presensi_mahasiswa`
--

CREATE TABLE `presensi_mahasiswa` (
  `id_presensi_mhs` int(15) NOT NULL,
  `nim` int(20) NOT NULL,
  `generate` varchar(75) DEFAULT NULL,
  `device` varchar(75) DEFAULT NULL,
  `aprove` varchar(75) DEFAULT NULL,
  `keterangan` varchar(75) DEFAULT NULL,
  `materi` varchar(75) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_matkul` int(15) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `days` varchar(75) DEFAULT NULL,
  `uniq` int(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `presensi_mahasiswa`
--

INSERT INTO `presensi_mahasiswa` (`id_presensi_mhs`, `nim`, `generate`, `device`, `aprove`, `keterangan`, `materi`, `updated_at`, `id_matkul`, `created_at`, `days`, `uniq`) VALUES
(404, 170602020, '605796214799', 'Lenovo A2010-a55afc206411c2bdc', 'success', NULL, 'materi sim', NULL, 23, NULL, 'selasa', 557),
(405, 170602050, '966352033659', 'Lenovo A2010-a55afc206411c2bdc', 'success', NULL, 'materi sim', NULL, 23, NULL, 'selasa', 557),
(408, 170602020, '283783165544', NULL, 'success', 'Bnnn', 'Cgh', '2019-12-04 00:40:01', 27, '2019-12-04 00:40:01', 'minggu', 562),
(409, 170602020, '829661999031', NULL, 'success', 'Vjjj', 'Bnnn', '2019-12-04 00:54:45', 28, '2019-12-04 00:54:45', 'null', 563),
(410, 170602050, '1540118359276', NULL, 'success', 'Nnnj', 'Bnnn', '2019-12-04 00:55:08', 28, '2019-12-04 00:55:08', 'null', 563),
(411, 170602020, '797320408045', NULL, 'success', 'Hhhhh', 'Kokoko', '2019-12-05 12:35:41', 27, '2019-12-05 12:35:41', 'null', 564),
(412, 170602050, '755365085069', NULL, 'success', 'Hhhhh', 'Kokoko', '2019-12-05 12:35:55', 27, '2019-12-05 12:35:55', 'null', 564),
(413, 170602020, '1390035936191', 'Lenovo A2010-a55afc206411c2bdc', 'success', NULL, 'Steaming Kata', '2019-12-11 15:33:25', 27, '2019-12-11 15:33:25', 'rabu', 567),
(414, 170602050, '1282800756502', 'Lenovo A2010-a55afc206411c2bdc', 'success', NULL, 'Steaming Kata', '2019-12-11 15:34:16', 27, '2019-12-11 15:34:16', 'rabu', 567),
(415, 170602020, '826190881865', NULL, 'success', 'hhhh', 'asa', '2019-12-11 15:38:45', 28, '2019-12-11 15:38:45', 'rabu', 568),
(416, 170602050, '978427541214', NULL, 'success', 'jkhkj', 'mkkmkmmk', '2019-12-11 15:41:05', 27, '2019-12-11 15:41:05', 'null', 569),
(418, 170602020, '20954824698', NULL, 'success', 'jk', 'setting dhcp', '2019-12-22 14:55:49', 27, '2019-12-22 14:55:49', 'null', 571),
(419, 170602050, '592399496782', NULL, 'success', 'ijin', 'CITRA', '2019-12-22 15:32:58', 30, '2019-12-22 15:32:58', 'minggu', 573),
(420, 170602020, '33824975614', NULL, 'success', 'ijin', 'CITRA', '2019-12-22 15:33:14', 30, '2019-12-22 15:33:14', 'minggu', 573),
(421, 170602020, '93968492286', NULL, 'success', 'ijin', 'pembahasan SRS', '2019-12-22 15:36:16', 29, '2019-12-22 15:36:16', 'minggu', 574),
(422, 170602050, '1339513488964', NULL, 'success', 'ijin', 'pembahasan SRS', '2019-12-22 15:36:29', 29, '2019-12-22 15:36:29', 'minggu', 574),
(423, 170602020, '781822771612', NULL, 'success', 'ijin', 'pembahasan DFD', '2019-12-22 15:43:13', 29, '2019-12-22 15:43:13', 'null', 575),
(424, 170602020, '60167184768', NULL, 'success', 'ijin', 'pengertian IMK', '2019-12-23 04:31:57', 32, '2019-12-23 04:31:57', 'null', 576),
(425, 170602050, '1393889121449', NULL, 'success', 'ijin', 'pengertian IMK', '2019-12-23 04:32:18', 32, '2019-12-23 04:32:18', 'null', 576),
(427, 170202001, '738138933167', NULL, 'success', 'ijin', 'pengertian bahasa', '2019-12-23 05:39:58', 33, '2019-12-23 05:39:58', 'null', 577),
(432, 170202001, '763811061699', NULL, 'success', 'ijin', 'silabus', '2019-12-23 05:47:35', 33, '2019-12-23 05:47:35', 'null', 582),
(433, 170602020, '99146368091', NULL, 'success', 'Sakit', 'Hznz', '2019-12-23 12:30:54', 27, '2019-12-23 12:30:54', 'senin', 585),
(434, 170602020, '1502924908314', NULL, 'success', 'Ijin', 'Pengantar', '2019-12-23 12:33:23', 27, '2019-12-23 12:33:23', 'senin', 587),
(435, 170602020, '820799902232', NULL, 'success', 'ijin', 'preogress 1', '2019-12-24 11:17:10', 28, '2019-12-24 11:17:10', 'selasa', 584),
(436, 170602050, '529060876998', NULL, 'success', 'ijin', 'preogress 1', '2019-12-24 11:17:28', 28, '2019-12-24 11:17:28', 'selasa', 584),
(437, 170202001, '894317242005', NULL, 'success', 'ijin', 'preogress 1', '2019-12-24 11:18:26', 28, '2019-12-24 11:18:26', 'selasa', 584),
(438, 170602020, '1533272985205', NULL, 'success', 'ijin', 'res', '2019-12-24 11:28:11', 28, '2019-12-24 11:28:11', 'null', 589),
(439, 170602050, '1353058356113', NULL, 'success', 'ijin', 'tes 1', '2019-12-24 11:30:11', 27, '2019-12-24 11:30:11', 'null', 590),
(440, 170602020, '1108846522587', 'Lenovo A2010-a55afc206411c2bdc', 'success', NULL, 'coba stki', '2019-12-24 13:55:21', 27, '2019-12-24 13:55:21', 'selasa', 591),
(441, 170602050, '1328991580529', 'Lenovo A2010-a55afc206411c2bdc', 'success', NULL, 'coba stki', '2019-12-24 13:56:16', 27, '2019-12-24 13:56:16', 'selasa', 591),
(444, 170602050, '336293237122', 'Lenovo A2010-a55afc206411c2bdc', 'success', NULL, 'COBA STKI 2', '2019-12-24 14:07:25', 27, '2019-12-24 14:07:25', 'selasa', 592),
(445, 170602020, '668246556197', NULL, 'success', 'ijin', 'COBA STKI 2', '2019-12-24 14:08:04', 27, '2019-12-24 14:08:04', 'selasa', 592),
(446, 170602050, '396640832606', NULL, 'success', 'Sakit', 'COBA STKI 3', '2019-12-24 14:14:15', 28, '2019-12-24 14:14:15', 'null', 593),
(447, 170602020, '1025385836034', 'Lenovo A2010-a55afc206411c2bdc', 'success', NULL, 'COBA STKI 3', '2019-12-24 14:14:51', 28, '2019-12-24 14:14:51', 'selasa', 593),
(448, 170602020, '1551172030441', 'Lenovo A2010-a55afc206411c2bdc', 'success', NULL, 'MODELING ICS', '2020-01-01 13:29:54', 27, '2020-01-01 13:29:54', 'rabu', 594),
(449, 170602050, '212341622770', 'Lenovo A2010-a55afc206411c2bdc', 'success', NULL, 'MODELING ICS', '2020-01-01 13:31:38', 27, '2020-01-01 13:31:38', 'rabu', 594),
(450, 170602020, '1162402362024', 'Lenovo A2010-a55afc206411c2bdc', 'success', NULL, 'SETTING SERVER DI LINNUX', '2020-01-01 13:57:17', 28, '2020-01-01 13:57:17', 'rabu', 595),
(451, 170602050, '37179401086', 'Lenovo A2010-a55afc206411c2bdc', 'success', NULL, 'SETTING SERVER DI LINNUX', '2020-01-01 13:57:55', 28, '2020-01-01 13:57:55', 'rabu', 595),
(452, 170602020, '1284590509675', 'Lenovo A2010-a55afc206411c2bdc', 'success', NULL, 'Daring Silabus PBO', '2020-01-01 14:10:21', 34, '2020-01-01 14:10:21', 'rabu', 596),
(453, 170602050, '1284590509675', NULL, 'success', 'ijin', 'Daring Silabus PBO', '2020-01-01 14:11:17', 34, '2020-01-01 14:11:17', 'rabu', 596);

-- --------------------------------------------------------

--
-- Table structure for table `presensi_matkul_dosen`
--

CREATE TABLE `presensi_matkul_dosen` (
  `id_presensi_matkul` int(15) NOT NULL,
  `id_dosen` int(15) NOT NULL,
  `id_matkul` int(15) NOT NULL,
  `generate` varchar(75) NOT NULL,
  `device` varchar(75) DEFAULT NULL,
  `keterangan` varchar(75) DEFAULT NULL,
  `materi` varchar(75) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `presensi_matkul_dosen`
--

INSERT INTO `presensi_matkul_dosen` (`id_presensi_matkul`, `id_dosen`, `id_matkul`, `generate`, `device`, `keterangan`, `materi`, `created_at`, `updated_at`) VALUES
(557, 2, 23, '1552142437499', 'null', 'Regular', 'materi sim', '2019-11-25 10:57:17', '2019-11-25 10:59:33'),
(562, 1, 27, '1453398473591', 'null', 'Regular', 'Cgh', '2019-12-04 00:38:20', '2019-12-04 00:40:04'),
(563, 1, 28, '572805496822', 'null', 'Regular', 'Bnnn', '2019-12-04 00:41:52', '2019-12-04 00:55:12'),
(564, 1, 27, '537246869725', 'null', 'Regular', 'Kokoko', '2019-12-05 12:35:26', '2019-12-05 12:35:58'),
(565, 1, 28, '618571688552', 'null', 'Daring', 'Tes aja', '2019-12-08 07:32:40', '2019-12-08 07:32:40'),
(566, 2, 23, '910054004550', 'null', 'Regular', NULL, '2019-12-11 15:18:50', '2019-12-11 15:26:16'),
(567, 1, 27, '759221868874', 'null', 'Regular', 'Steaming Kata', '2019-12-11 15:32:52', '2019-12-11 15:34:32'),
(568, 1, 28, '826190881865', 'null', 'Daring', 'asa', '2019-12-11 15:38:35', '2019-12-11 15:38:35'),
(569, 1, 27, '978427541214', 'null', 'Daring', 'mkkmkmmk', '2019-12-11 15:40:54', '2019-12-11 15:40:54'),
(570, 2, 23, '99999', NULL, 'regular', 'tes tahun', '2020-03-09 17:00:00', '2020-03-09 17:00:00'),
(571, 1, 27, '116419277484', 'null', 'Regular', 'setting dhcp', '2019-12-21 13:01:06', '2019-12-22 14:55:54'),
(573, 12, 30, '721901185246', 'null', 'Regular', 'CITRA', '2019-12-22 14:55:17', '2019-12-22 15:33:19'),
(574, 7, 29, '317472743235', 'null', 'Regular', 'pembahasan SRS', '2019-12-22 15:32:38', '2019-12-22 15:36:34'),
(575, 7, 29, '1039477956178', 'null', 'Regular', 'pembahasan DFD', '2019-12-22 15:35:57', '2019-12-22 15:43:18'),
(576, 10, 32, '479272608986', 'null', 'Regular', 'pengertian IMK', '2019-12-22 15:37:35', '2019-12-23 04:32:23'),
(577, 13, 33, '121090551232', 'null', 'Regular', 'pengertian bahasa', '2019-12-23 04:31:14', '2019-12-23 05:40:02'),
(582, 13, 33, '763811061699', 'null', 'Daring', 'silabus', '2019-12-23 05:47:27', '2019-12-23 05:47:27'),
(584, 1, 28, '472505630888', 'null', 'Regular', 'preogress 1', '2019-12-23 12:24:19', '2019-12-24 11:18:34'),
(585, 1, 27, '99146368091', 'null', 'Daring', 'Hznz', '2019-12-23 12:30:44', '2019-12-23 12:30:44'),
(587, 1, 27, '1502924908314', 'null', 'Daring', 'Pengantar', '2019-12-23 12:33:14', '2019-12-23 12:33:14'),
(589, 1, 28, '701552216818', 'null', 'Regular', 'res', '2019-12-24 11:27:30', '2019-12-24 11:28:16'),
(590, 1, 27, '367733317522', 'null', 'Regular', 'tes 1', '2019-12-24 11:29:57', '2019-12-24 11:30:16'),
(591, 1, 27, '291320893556', 'null', 'Regular', 'coba stki', '2019-12-24 13:53:35', '2019-12-24 13:56:26'),
(592, 1, 27, '1305116596022', 'null', 'Regular', 'COBA STKI 2', '2019-12-24 14:00:14', '2019-12-24 14:09:12'),
(593, 1, 28, '1480924796601', 'null', 'Regular', 'COBA STKI 3', '2019-12-24 14:11:18', '2019-12-24 14:18:13'),
(594, 1, 27, '257735511840', 'null', 'Regular', 'MODELING ICS', '2020-01-01 13:29:04', '2020-01-01 13:31:51'),
(595, 1, 28, '37179401086', 'null', 'Regular', 'SETTING SERVER DI LINNUX', '2020-01-01 13:56:31', '2020-01-01 13:57:41'),
(596, 1, 34, '1284590509675', 'null', 'Daring', 'Daring Silabus PBO', '2020-01-01 14:10:05', '2020-01-01 14:10:05');

-- --------------------------------------------------------

--
-- Table structure for table `prodi`
--

CREATE TABLE `prodi` (
  `id_prodi` int(15) NOT NULL,
  `nama_prodi` varchar(25) NOT NULL,
  `id_fakultas` int(15) NOT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prodi`
--

INSERT INTO `prodi` (`id_prodi`, `nama_prodi`, `id_fakultas`, `updated_at`) VALUES
(5, 'pendidikan', 4, NULL),
(6, 'informatika', 62, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id_role` int(15) NOT NULL,
  `role_name` varchar(25) NOT NULL,
  `user_role` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id_role`, `role_name`, `user_role`) VALUES
(1, 'eis_dosen', ''),
(2, 'eis_karyawan', ''),
(3, 'eis_mahasiswa', ''),
(7, 'eis_bsdm', ''),
(8, 'eis_tu', '');

-- --------------------------------------------------------

--
-- Table structure for table `tendik`
--

CREATE TABLE `tendik` (
  `id_tendik` int(15) NOT NULL,
  `nip` int(15) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan') NOT NULL,
  `alamat` text NOT NULL,
  `id_jabatan` int(15) NOT NULL,
  `user_id` int(15) NOT NULL,
  `updated_at` date DEFAULT NULL,
  `nidn` int(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(15) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(30) NOT NULL,
  `photo` varchar(30) DEFAULT NULL,
  `role_id` int(15) DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `password_reset_key` varchar(255) DEFAULT NULL,
  `status` enum('Active','Suspend') DEFAULT NULL,
  `login_session_key` varchar(255) DEFAULT NULL,
  `email_status` varchar(20) DEFAULT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `photo`, `role_id`, `updated_at`, `password_reset_key`, `status`, `login_session_key`, `email_status`, `created_at`) VALUES
(14, '20001', '$2y$10$TQEwNMx8dtVbP34UBFNrVexok2/rMnIas2M5FSGf5IEog/MdH76Jq', 'nanik@gmail.com', NULL, 2, '2019-11-25', NULL, NULL, NULL, NULL, '2019-11-25'),
(15, '20002', '$2y$10$tRkYUbSY5ySrxbZ4NU0BUeRV4inyNrtBQGeMF25i4PTEYbmG1Kbae', 'rudi@gmail.com', NULL, 2, '2019-11-25', NULL, NULL, NULL, NULL, '2019-11-25'),
(16, '170602020', '$2y$10$mfo5d6ZCHy/3nc8JANv.eeFcQEWPXn6Vj0J4k99thzBChD4OtDToS', 'imameks03@gmail.com', NULL, 3, '2019-11-25', NULL, NULL, NULL, NULL, '2019-11-25'),
(17, '170602050', '$2y$10$CPK9nd1MpzRM2nfCDf9YluHRqhOirT5Ab.T929LLXP9ucIOmxcSfO', 'aldi@gmail.com', NULL, 3, '2019-11-25', NULL, NULL, NULL, NULL, '2019-11-25'),
(19, '6211707206', '$2y$10$0DYh9CsTaUIJEdiGZCbYfe6jNM4vKlRKvpH25s.oN4mEqwA5Y3rpy', 'indra1@gmail.com', NULL, 1, '2019-12-05', NULL, NULL, NULL, NULL, '2019-12-05'),
(20, '6211709199', '$2y$10$QfvHrZn1eIva982Wkn6qjuMc9hC2VBdoKRIb0XwvSS2lsy2kah.MC', 'umi1@gmail.com', NULL, 1, '2019-12-11', NULL, NULL, NULL, NULL, '2019-12-11'),
(21, 'Bsdm', '$2y$10$TP91fmqGnQ8lX.xJwygfgu4myAMakZe9uq6G3oSjsjYRaSJUZwA6u', 'Bsdm@gmail.com', NULL, 7, '2019-12-19', NULL, NULL, NULL, NULL, '2019-12-19'),
(22, 'TU', '$2y$10$GunlXv158jnAYDugL5zBdeOZrzMP4UsBcbaAj21F2FxLtpn2bnyCm', 'tu@gmail.com', NULL, 8, '2019-12-19', NULL, NULL, NULL, NULL, '2019-12-19'),
(23, '6210310091', '$2y$10$eCHW557W6EGs/3jOlm2nbOxGJ7AUb.N7d1ng6QnW9GZP.2y9GrZEC', 'sofiana@gmail.com', NULL, 1, '2019-12-22', NULL, NULL, NULL, NULL, '2019-12-22'),
(24, '6210408106', '$2y$10$.HyWUENppFQpytDl00xWouLN7oJia3TSpbnMJbrpwd2lHrBtYN1.O', 'harun@gmail.com', NULL, 1, '2019-12-22', NULL, NULL, NULL, NULL, '2019-12-22'),
(25, '6211709200', '$2y$10$zl6mVDiTIuatKLrRToncKOgoPhydogFraibvJ3EtlHZwo8pd3OWau', 'henny@gmail.com', NULL, 1, '2019-12-22', NULL, NULL, NULL, NULL, '2019-12-22'),
(26, '6211802207', '$2y$10$lFgM62/cn.JduZDUHpzeWePRa2Z6uOefPJyW.Dywsl0f6mageBy1m', 'farid@gmail.com', NULL, 1, '2019-12-22', NULL, NULL, NULL, NULL, '2019-12-22'),
(27, '6231409387', '$2y$10$K7BwPNcC9za7zM.cVGY2OuqNV5ZFARnBt8hqx4H6r.CZosZRejacm', 'devi@gmail.com', NULL, 1, '2019-12-22', NULL, NULL, NULL, NULL, '2019-12-22'),
(28, '6231503411', '$2y$10$.K9iMsuEQrUu.8P.nv00weNFywQLXk7DC1PfeUd8lCWbW1zSgF8ci', 'darmawan@gmail.com', NULL, 1, '2019-12-22', NULL, NULL, NULL, NULL, '2019-12-22'),
(29, '6100001', '$2y$10$bMBP7kedDosnh0gOjsh46uwQFrkJLIfSAPJDjrbAJTfkdaxgqwtai', 'arfa@gmail.com', NULL, 1, '2019-12-23', NULL, NULL, NULL, NULL, '2019-12-23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id_dosen`),
  ADD KEY `id_jabatan` (`id_jabatan`),
  ADD KEY `id_prodi` (`id_prodi`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `fakultas`
--
ALTER TABLE `fakultas`
  ADD PRIMARY KEY (`id_fakultas`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`),
  ADD KEY `id_prodi` (`id_prodi`),
  ADD KEY `id_jabatan` (`id_jabatan`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `krs`
--
ALTER TABLE `krs`
  ADD PRIMARY KEY (`id_krs`),
  ADD KEY `mhs` (`nim`),
  ADD KEY `matkul` (`id_matkul`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nim`),
  ADD KEY `id_prodi` (`id_prodi`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  ADD PRIMARY KEY (`id_matkul`),
  ADD KEY `mhs` (`id_dosen`),
  ADD KEY `id_prodi` (`id_prodi`);

--
-- Indexes for table `presensi_dosen`
--
ALTER TABLE `presensi_dosen`
  ADD PRIMARY KEY (`id_presensi_dosen`),
  ADD KEY `nip` (`id_dosen`);

--
-- Indexes for table `presensi_karyawan`
--
ALTER TABLE `presensi_karyawan`
  ADD PRIMARY KEY (`id_presensi_karyawan`),
  ADD KEY `nip` (`id_karyawan`);

--
-- Indexes for table `presensi_mahasiswa`
--
ALTER TABLE `presensi_mahasiswa`
  ADD PRIMARY KEY (`id_presensi_mhs`),
  ADD KEY `nim` (`nim`),
  ADD KEY `id_matkul` (`id_matkul`),
  ADD KEY `uniq` (`uniq`);

--
-- Indexes for table `presensi_matkul_dosen`
--
ALTER TABLE `presensi_matkul_dosen`
  ADD PRIMARY KEY (`id_presensi_matkul`),
  ADD KEY `id_matkul` (`id_matkul`),
  ADD KEY `nip` (`id_dosen`);

--
-- Indexes for table `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`id_prodi`),
  ADD KEY `id_fakultas` (`id_fakultas`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `tendik`
--
ALTER TABLE `tendik`
  ADD PRIMARY KEY (`id_tendik`),
  ADD KEY `id_jabatan` (`id_jabatan`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id_dosen` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `fakultas`
--
ALTER TABLE `fakultas`
  MODIFY `id_fakultas` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `krs`
--
ALTER TABLE `krs`
  MODIFY `id_krs` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  MODIFY `id_matkul` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `presensi_dosen`
--
ALTER TABLE `presensi_dosen`
  MODIFY `id_presensi_dosen` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=502;

--
-- AUTO_INCREMENT for table `presensi_karyawan`
--
ALTER TABLE `presensi_karyawan`
  MODIFY `id_presensi_karyawan` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `presensi_mahasiswa`
--
ALTER TABLE `presensi_mahasiswa`
  MODIFY `id_presensi_mhs` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=454;

--
-- AUTO_INCREMENT for table `presensi_matkul_dosen`
--
ALTER TABLE `presensi_matkul_dosen`
  MODIFY `id_presensi_matkul` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=597;

--
-- AUTO_INCREMENT for table `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id_prodi` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id_role` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tendik`
--
ALTER TABLE `tendik`
  MODIFY `id_tendik` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dosen`
--
ALTER TABLE `dosen`
  ADD CONSTRAINT `dosen_ibfk_1` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dosen_ibfk_2` FOREIGN KEY (`id_prodi`) REFERENCES `prodi` (`id_prodi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dosen_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD CONSTRAINT `karyawan_ibfk_1` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `karyawan_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `krs`
--
ALTER TABLE `krs`
  ADD CONSTRAINT `krs_ibfk_1` FOREIGN KEY (`id_matkul`) REFERENCES `mata_kuliah` (`id_matkul`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `krs_ibfk_2` FOREIGN KEY (`nim`) REFERENCES `mahasiswa` (`nim`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `mahasiswa_ibfk_1` FOREIGN KEY (`id_prodi`) REFERENCES `prodi` (`id_prodi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mahasiswa_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  ADD CONSTRAINT `mata_kuliah_ibfk_2` FOREIGN KEY (`id_prodi`) REFERENCES `prodi` (`id_prodi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mata_kuliah_ibfk_3` FOREIGN KEY (`id_dosen`) REFERENCES `dosen` (`id_dosen`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `presensi_dosen`
--
ALTER TABLE `presensi_dosen`
  ADD CONSTRAINT `presensi_dosen_ibfk_1` FOREIGN KEY (`id_dosen`) REFERENCES `dosen` (`id_dosen`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `presensi_karyawan`
--
ALTER TABLE `presensi_karyawan`
  ADD CONSTRAINT `presensi_karyawan_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `presensi_mahasiswa`
--
ALTER TABLE `presensi_mahasiswa`
  ADD CONSTRAINT `presensi_mahasiswa_ibfk_1` FOREIGN KEY (`nim`) REFERENCES `mahasiswa` (`nim`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `presensi_mahasiswa_ibfk_2` FOREIGN KEY (`id_matkul`) REFERENCES `mata_kuliah` (`id_matkul`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `presensi_mahasiswa_ibfk_3` FOREIGN KEY (`uniq`) REFERENCES `presensi_matkul_dosen` (`id_presensi_matkul`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `presensi_matkul_dosen`
--
ALTER TABLE `presensi_matkul_dosen`
  ADD CONSTRAINT `presensi_matkul_dosen_ibfk_2` FOREIGN KEY (`id_matkul`) REFERENCES `mata_kuliah` (`id_matkul`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `presensi_matkul_dosen_ibfk_3` FOREIGN KEY (`id_dosen`) REFERENCES `dosen` (`id_dosen`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `prodi`
--
ALTER TABLE `prodi`
  ADD CONSTRAINT `prodi_ibfk_1` FOREIGN KEY (`id_fakultas`) REFERENCES `fakultas` (`id_fakultas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tendik`
--
ALTER TABLE `tendik`
  ADD CONSTRAINT `tendik_ibfk_1` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tendik_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
