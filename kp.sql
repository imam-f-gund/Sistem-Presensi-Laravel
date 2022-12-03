-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2019 at 05:19 AM
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
-- Database: `kp`
--

-- --------------------------------------------------------

--
-- Table structure for table `krs`
--

CREATE TABLE `krs` (
  `nim` int(11) DEFAULT NULL,
  `id_matkul` bigint(11) DEFAULT NULL,
  `Jurusan` varchar(255) NOT NULL,
  `id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `krs`
--

INSERT INTO `krs` (`nim`, `id_matkul`, `Jurusan`, `id`) VALUES
(170602050, 1, 'informatika', 1),
(170602050, 3, 'infprmatika', 2),
(170602020, 7, 'informatika', 3),
(170602020, 3, 'informatika', 4),
(170602050, 5, 'informatika', 5),
(170602020, 4, 'informatika', 6);

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` bigint(20) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nim` int(11) NOT NULL,
  `jurusan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_matkul` bigint(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `name`, `nim`, `jurusan`, `created_at`, `updated_at`, `id_matkul`) VALUES
(2, 'budi', 170602001, 'informatika', NULL, NULL, 1),
(3, 'nur m', 170602002, 'informatika', NULL, NULL, NULL),
(5, 'juni r', 170602003, 'informatika', NULL, NULL, NULL),
(6, 'imam f', 170602020, 'informatika', '2019-09-16 22:10:11', '2019-09-16 23:42:06', NULL),
(1, 'aldi r', 170602050, 'informatika', NULL, '2019-09-16 22:10:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mata_kuliah`
--

CREATE TABLE `mata_kuliah` (
  `id` bigint(11) NOT NULL,
  `matkul` varchar(20) NOT NULL,
  `jurusan` varchar(20) NOT NULL,
  `nim` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mata_kuliah`
--

INSERT INTO `mata_kuliah` (`id`, `matkul`, `jurusan`, `nim`) VALUES
(1, 'rekayasa perangkat l', 'informatika', NULL),
(2, 'basis data lanjut', 'informatika', NULL),
(3, 'web', 'informatika', NULL),
(4, 'statistik', 'informatika', NULL),
(5, 'bahasa', 'pgsd', NULL),
(6, 'matematika', 'pgsd', NULL),
(7, 'agama', 'pgsd', NULL),
(8, 'bahasa arab', 'pgsd', NULL),
(9, 'seni budaya', 'pgsd', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_09_12_144229_create_mahasiswa_table', 1),
(4, '2019_09_12_144303_create_parkiran_table', 1),
(5, '2019_09_12_144325_create_perpus_table', 1),
(6, '2016_06_01_000001_create_oauth_auth_codes_table', 2),
(7, '2016_06_01_000002_create_oauth_access_tokens_table', 2),
(8, '2016_06_01_000003_create_oauth_refresh_tokens_table', 2),
(9, '2016_06_01_000004_create_oauth_clients_table', 2),
(10, '2016_06_01_000005_create_oauth_personal_access_clients_table', 2),
(11, '2019_09_18_184502_create_user_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('00d95d872960642f4a6edd90d8a7b481de7fa9d286ab5eca5a0f92bb4f9e848b86a82ee31e6f9d1c', 3, 1, 'MyApp', '[]', 0, '2019-09-19 04:47:03', '2019-09-19 04:47:03', '2020-09-19 11:47:03'),
('04009d14949de35a6608301c5021333d0d02f4a6427605b086ef9cf692e62c29597626a4d9b91c1f', 2, 1, 'MyApp', '[]', 0, '2019-09-20 11:30:05', '2019-09-20 11:30:05', '2020-09-20 18:30:05'),
('0f6618c92b5eec5a8125efb08f3dbb0329c5170f8769bfa600d5654547a0c690abfefaed696c9072', 3, 1, 'MyApp', '[]', 0, '2019-09-19 04:37:53', '2019-09-19 04:37:53', '2020-09-19 11:37:53'),
('0fd4d461c4d9f54804d804784f03875c2ec3def08ec838a081155f5e5cd254af750f5ef338d0028e', 3, 1, 'MyApp', '[]', 0, '2019-09-19 06:04:39', '2019-09-19 06:04:39', '2020-09-19 13:04:39'),
('164e7e2ff2ab0ad7f56bb8653f2e5f6f6d5d700fda6f7ab632e6c460030c79eaf3424f81fed85768', 3, 1, 'MyApp', '[]', 0, '2019-09-19 08:46:11', '2019-09-19 08:46:11', '2020-09-19 15:46:11'),
('19cce0c0494ec1a5807aad64aabe6359afa313035cebbee32d230b6e343e9da961924d692693a55e', 3, 1, 'MyApp', '[]', 0, '2019-09-20 10:49:08', '2019-09-20 10:49:08', '2020-09-20 17:49:08'),
('1ad9de43ce288bc2d7eb533ec43d56ce4819517c0174b1153c97b0a893e91a274a4aa5bd9cf6b364', 3, 1, 'MyApp', '[]', 0, '2019-09-19 05:49:57', '2019-09-19 05:49:57', '2020-09-19 12:49:57'),
('1dbb1a99d47cab475497135a71f852a79ae45154a85ec05dff1620dda353c609b0a63596be2a66db', 2, 1, 'MyApp', '[]', 0, '2019-09-19 02:11:30', '2019-09-19 02:11:30', '2020-09-19 09:11:30'),
('21b244af6dbd086fe71a760614e6af91f7785574e0f9b23da643738e571052eb28c5c2940d504c07', 3, 1, 'MyApp', '[]', 0, '2019-09-19 04:47:37', '2019-09-19 04:47:37', '2020-09-19 11:47:37'),
('2a689429e6d461165eb58b8315932e37875f4c6eab89415b9207780fa2838e31402ed116581f846a', 3, 1, 'MyApp', '[]', 0, '2019-09-19 04:51:04', '2019-09-19 04:51:04', '2020-09-19 11:51:04'),
('2bc3766498f31a5dcdee6154a200082d64e626e90aacef3303c946965da0ffbe3d8f6479192a7cc8', 3, 1, 'MyApp', '[]', 0, '2019-09-19 04:32:17', '2019-09-19 04:32:17', '2020-09-19 11:32:17'),
('2e1a8d971a5229099bbcd4e02fce14658bb9067e1fa64c8ceb4fb6da0203db2a03a0747fb5fbf3a8', 3, 1, 'MyApp', '[]', 0, '2019-09-20 07:21:48', '2019-09-20 07:21:48', '2020-09-20 14:21:48'),
('3795e1fe65b193b1ca255602de9261e5c8d195b14a8a6b6b6601ad99095a3a3a1a1872afc0766705', 1, 1, 'MyApp', '[]', 0, '2019-09-18 18:12:55', '2019-09-18 18:12:55', '2020-09-19 01:12:55'),
('3b7b1494f488485a4eebf41bd775795779fca73bc936235cb0d915d8daed5f48f30e2243bcfe603c', 3, 1, 'MyApp', '[]', 0, '2019-09-19 04:34:26', '2019-09-19 04:34:26', '2020-09-19 11:34:26'),
('438389d5c0c88cbd86c4bb358f1206545893928023806171284fe78e4eb218eba2499e242a612965', 2, 1, 'MyApp', '[]', 0, '2019-09-20 07:17:17', '2019-09-20 07:17:17', '2020-09-20 14:17:17'),
('46b12e0f21bb3f375198ceb55f7e267d00df01505d8336a0bcaad90a5e9300f0f1e9ca72ea72c40c', 3, 1, 'MyApp', '[]', 0, '2019-09-19 04:39:52', '2019-09-19 04:39:52', '2020-09-19 11:39:52'),
('48d36b8edbb65451edfb7be7cc3d64d5566a2acfa68aa2e61484f8048f5bc730a7ddec729a64fb3d', 3, 1, 'MyApp', '[]', 0, '2019-09-19 06:01:23', '2019-09-19 06:01:23', '2020-09-19 13:01:23'),
('4f894da55619381b7ac53e39e9087d46f1b567bd4d17f45ef223c3808ebc4ed87d6a9c2060a93ac0', 3, 1, 'MyApp', '[]', 0, '2019-09-19 04:31:32', '2019-09-19 04:31:32', '2020-09-19 11:31:32'),
('577014a66645abb2d9fbd62117b63f43d02e97c6b32ca0b8e9e71136f935f1b29b17848471bf1743', 3, 1, 'MyApp', '[]', 0, '2019-09-19 05:15:48', '2019-09-19 05:15:48', '2020-09-19 12:15:48'),
('59360a3d3134c33a7c53202f182d2466f22c825f9cb523ba4ee9f7c0999deae8307ee3bd625ba021', 2, 1, 'MyApp', '[]', 0, '2019-09-19 01:04:36', '2019-09-19 01:04:36', '2020-09-19 08:04:36'),
('5d4d92947b2630c179b9e230ccce0ccf9c026b95b6ba39d7ec706332e67f8bc4931a76050635160f', 3, 1, 'MyApp', '[]', 0, '2019-09-19 05:47:06', '2019-09-19 05:47:06', '2020-09-19 12:47:06'),
('602a03efbccfb590cf76aafd80cb39ea7f9b2da6f37d9458de10fabb1d7c18b472f8480dd8c516e4', 4, 1, 'MyApp', '[]', 0, '2019-09-20 11:33:52', '2019-09-20 11:33:52', '2020-09-20 18:33:52'),
('653cf7640cf90fdfd007b73501f1b6f4f02913f5a3defe742431d01aff63df4327e05cad1ee98859', 3, 1, 'MyApp', '[]', 0, '2019-09-20 10:49:29', '2019-09-20 10:49:29', '2020-09-20 17:49:29'),
('67d7e775a37144df1b56e38644322c0a42c381094ee41ae8d8162cc437464ca16c093cf8cb96dbcd', 3, 1, 'MyApp', '[]', 0, '2019-09-20 20:14:49', '2019-09-20 20:14:49', '2020-09-21 03:14:49'),
('6c9b4d83ced14dc20de6270944270f025b169b7c15f9dee1b6a21dd37234587053007997eb191c50', 3, 1, 'MyApp', '[]', 0, '2019-09-20 07:19:45', '2019-09-20 07:19:45', '2020-09-20 14:19:45'),
('70380cfd27f1f2922b55dbbacfd65b17107794cee477e80b79bab4dd861d9538a5a6b9b6676a0521', 3, 1, 'MyApp', '[]', 0, '2019-09-19 06:36:01', '2019-09-19 06:36:01', '2020-09-19 13:36:01'),
('735a26ef984393f4423c397475ae1e4d5997ca257e8c3e326eb7251b707b55b082b193a05c7c4542', 3, 1, 'MyApp', '[]', 0, '2019-09-19 06:35:59', '2019-09-19 06:35:59', '2020-09-19 13:35:59'),
('7d500780a6421cfefb5bd0d8a6f36e68d7ddfd13d95caec46ae4e8f5cb6837ea5e28fce342a180e3', 3, 1, 'MyApp', '[]', 0, '2019-09-19 05:11:52', '2019-09-19 05:11:52', '2020-09-19 12:11:52'),
('7fa0d3d758eb991f925198b1cc70501dcd13a2e6e8812889a0a97cb4dff67d5164902987ab7a0c73', 2, 1, 'MyApp', '[]', 0, '2019-09-19 02:05:53', '2019-09-19 02:05:53', '2020-09-19 09:05:53'),
('7ff1e31d29b9dc28633a4e21514419c9bfd3da79af348883c925d959d3a031a7e94ef0af79090dcb', 4, 1, 'MyApp', '[]', 0, '2019-09-20 11:44:09', '2019-09-20 11:44:09', '2020-09-20 18:44:09'),
('839f1018f882572a7e811117a7cfb3056ca238a9ce835eccfcd5f2127dcc8f43663c0d53ee2d29ed', 3, 1, 'MyApp', '[]', 0, '2019-09-19 06:00:54', '2019-09-19 06:00:54', '2020-09-19 13:00:54'),
('962d78bb37194f9a21930badfb72279a425ff29ba518c707e68f79cae2d63dae7d111b399e0a0657', 3, 1, 'MyApp', '[]', 0, '2019-09-19 04:45:49', '2019-09-19 04:45:49', '2020-09-19 11:45:49'),
('a0d35e4e5556590f9505e8d8a5117f0cbccf6dd46e59586361eac6af67f352ca58daec92ea6a399e', 1, 1, 'MyApp', '[]', 0, '2019-09-18 20:06:32', '2019-09-18 20:06:32', '2020-09-19 03:06:32'),
('a3354478b7e46f0eea4f62abb29f75829979298ff11526ca1dbdd246fb71c8cc9dae14ec6c4d5205', 2, 1, 'MyApp', '[]', 0, '2019-09-19 04:06:25', '2019-09-19 04:06:25', '2020-09-19 11:06:25'),
('aa1a7d77225d66d90088f3aeba064af65db50819efba027ff3a2fc7b0cc3833bf4a0444dd8906150', 3, 1, 'MyApp', '[]', 0, '2019-09-20 06:57:12', '2019-09-20 06:57:12', '2020-09-20 13:57:12'),
('b39b42d6e47077572e31a2d90fcc0202cdb817d632e79390e9fa239b2aae36a1ce34f533fec677b0', 3, 1, 'MyApp', '[]', 0, '2019-09-19 05:59:12', '2019-09-19 05:59:12', '2020-09-19 12:59:12'),
('b99a51c0c05f4ff773c93fbfe6a877fa5fb517db1131cd1b2cc04a4d3a4c9bb72f65394cb731dcee', 2, 1, 'MyApp', '[]', 0, '2019-09-19 02:11:23', '2019-09-19 02:11:23', '2020-09-19 09:11:23'),
('bb797fb0f4a86abf855abbc8cc7fc8d613c828a0e0c94ef9be79bc161f59ccf665b5f4c79568f1c4', 2, 1, 'MyApp', '[]', 0, '2019-09-20 07:20:47', '2019-09-20 07:20:47', '2020-09-20 14:20:47'),
('c550f1377fbad83177c9677fbc62256fc2cf8f70faf5135c51e6863e113bd360bef7a5e033aa73c5', 1, 1, 'MyApp', '[]', 0, '2019-09-18 18:13:36', '2019-09-18 18:13:36', '2020-09-19 01:13:36'),
('c9d553e410101ffb1005f39a0538da30f346f85969f39c4c5249ee287b11aef1f7a2a572e0df5508', 3, 1, 'MyApp', '[]', 0, '2019-09-19 04:31:33', '2019-09-19 04:31:33', '2020-09-19 11:31:33'),
('d7e39acacad7c650471d233fcdc63f1758264cda6ec6641dc3b46494d2d10bc14704bd018d49579b', 3, 1, 'MyApp', '[]', 0, '2019-09-19 06:04:40', '2019-09-19 06:04:40', '2020-09-19 13:04:40'),
('d9c6a3baf386769255d907efacbc5f10893b5ee4dd0b5c318390b40c19d082219e758025f6c3bd26', 3, 1, 'MyApp', '[]', 0, '2019-09-19 04:35:52', '2019-09-19 04:35:52', '2020-09-19 11:35:52'),
('de286af964673d0f2fc261da831b7e9b6903282ea3c72c5f12fe9e8a069c879fbc163a5cc8b46429', 2, 1, 'MyApp', '[]', 0, '2019-09-18 20:46:10', '2019-09-18 20:46:10', '2020-09-19 03:46:10'),
('e5c762180744565cf25c5fc48cbcdbff1b57ca5cd0e972e062768adb1fd568a0adc6125d636c5a95', 3, 1, 'MyApp', '[]', 0, '2019-09-19 04:40:32', '2019-09-19 04:40:32', '2020-09-19 11:40:32'),
('e718ac7fec8e3c7767db303d968cb0a1c8f4556678fe54d80d69fea4736ccc202a0bc4a819942386', 3, 1, 'MyApp', '[]', 0, '2019-09-20 11:23:15', '2019-09-20 11:23:15', '2020-09-20 18:23:15'),
('e748768b06fd7cbef46a24fd6864700951c389ee154b5f4cc3a25497beca4476fe4a20c7a1e2935d', 2, 1, 'MyApp', '[]', 0, '2019-09-20 07:12:32', '2019-09-20 07:12:32', '2020-09-20 14:12:32'),
('e81838f3f3aaf6ce3055d0b45b28d6d4f29a3c81b8c2f6a458a6b6ee507c7a23a3cb56b772ade262', 3, 1, 'MyApp', '[]', 0, '2019-09-19 05:47:08', '2019-09-19 05:47:08', '2020-09-19 12:47:08'),
('fcdd5f13065f692b5d4141080e2e451f09d90929b99a2c2a3b81258abf86b25312a3a307fbec4fba', 2, 1, 'MyApp', '[]', 0, '2019-09-19 02:11:29', '2019-09-19 02:11:29', '2020-09-19 09:11:29'),
('fd2114ebd6feb9651ab5ea56c78f2efb1e01b0250936be8f72d04b6c16b52a3800954ab89f3525ce', 2, 1, 'MyApp', '[]', 0, '2019-09-20 11:28:38', '2019-09-20 11:28:38', '2020-09-20 18:28:38'),
('ffbe831ec7f49fcc76939c4782ddc5a139ea8236f4b7be6027dce37b5e32e9415bfcc2d18638cbd8', 3, 1, 'MyApp', '[]', 0, '2019-09-19 04:38:42', '2019-09-19 04:38:42', '2020-09-19 11:38:42');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'jFxQbXrByKo8DK2uieOsXvUyeW7qtZMYYdsgV4eF', 'http://localhost', 1, 0, 0, '2019-09-18 14:14:11', '2019-09-18 14:14:11'),
(2, NULL, 'Laravel Password Grant Client', 'TEygC5gXMTlfHmzlri75r3KSz2E2iAg8e01FPYC9', 'http://localhost', 0, 1, 0, '2019-09-18 14:14:11', '2019-09-18 14:14:11');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2019-09-18 14:14:11', '2019-09-18 14:14:11');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `parkiran`
--

CREATE TABLE `parkiran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nim` int(11) NOT NULL,
  `nopol` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `motor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `parkiran`
--

INSERT INTO `parkiran` (`id`, `name`, `nim`, `nopol`, `motor`, `created_at`, `updated_at`) VALUES
(1, 'imam f', 170602020, 's 0001 wl', 'yamaha vixion', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `perpus`
--

CREATE TABLE `perpus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nim` int(11) NOT NULL,
  `jurusan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `buku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `perpus`
--

INSERT INTO `perpus` (`id`, `name`, `nim`, `jurusan`, `buku`, `created_at`, `updated_at`) VALUES
(1, 'imam fakhruddin', 170602020, 'informatika', 'mkp', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `presensi`
--

CREATE TABLE `presensi` (
  `id` bigint(11) NOT NULL,
  `nim` int(20) NOT NULL,
  `generate` varchar(50) DEFAULT NULL,
  `validasi` varchar(50) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_matkul` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `presensi`
--

INSERT INTO `presensi` (`id`, `nim`, `generate`, `validasi`, `updated_at`, `id_matkul`, `created_at`) VALUES
(11, 170602020, '234567890', NULL, '2019-09-20 11:43:05', 3, '2019-09-20 11:43:05'),
(12, 170602020, '857727687060', NULL, '2019-09-20 11:44:20', 4, '2019-09-20 11:44:20'),
(13, 170602050, '216029479320', NULL, '2019-09-20 20:15:38', 3, '2019-09-20 20:15:38');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nim` int(11) NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `nim`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'coba', 1234567, '$2y$10$AJdlrnPZGgI4glMRAtNSS.cTPeWPZiMomCkFePozsb4k9yxWUSIES', NULL, '2019-09-18 11:59:07', '2019-09-18 11:59:07'),
(2, 'imam', 17060204, '$2y$10$ZGl4WVc/tQiC3n7MYTNWQeDEGChCp3O7PrVjMNnuwfCVfCchy5F1G', NULL, '2019-09-18 12:18:34', '2019-09-18 12:18:34'),
(3, 'aaa', 0, '$2y$10$sUiu9k.kUBlKUUNp8dLnYOv/oafi4ykN936/lZd8kcYlgpF8ZpoCy', NULL, '2019-09-18 12:22:28', '2019-09-18 12:22:28'),
(4, 'oooo', 1234567890, '$2y$10$OvnowdpA..jqm3HDDFZZAOdRCyawD7t1tDAIgqc5KQ6d0V42qmb1S', NULL, '2019-09-18 13:20:43', '2019-09-18 13:20:43');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `password_resets` timestamp NULL DEFAULT NULL,
  `nim` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `remember_token`, `updated_at`, `password_resets`, `nim`) VALUES
(1, 'aaa', 'imamf0000@gmail.com', '$2y$10$gYJ6IIF3voIjAbGBnwIAdOJuQySE73r.fF/inm2VUYzgDBMB5r8a2', '2019-09-18 18:00:13', NULL, '2019-09-18 18:00:13', NULL, NULL),
(2, 'tes', 'imameks02@gmail.com', '$2y$10$kJfiyty3ITiP9RueM88HKOgsKocfZzikXfaci7dlmFWkfH4ov6qCq', '2019-09-18 20:44:51', NULL, '2019-09-18 20:44:51', NULL, '123456789'),
(3, 'ojooo', 'coba@gmail.com', '$2y$10$Z.qMVpKLyAPRtr4UQ6MYB.RgIGQl4ncjU01VidfVI5R.FPccqXMre', '2019-09-19 04:31:15', NULL, '2019-09-19 04:31:15', NULL, '170602050'),
(4, 'imam', 'imameks03@gmail.com', '$2y$10$bsFdkaG6NPIiaITVoENj2.ETloWgqA1P.CTZ43VbWyG5wdWryUenW', '2019-09-20 11:33:37', NULL, '2019-09-20 11:33:37', NULL, '170602020');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `krs`
--
ALTER TABLE `krs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mhs` (`nim`),
  ADD KEY `matkul` (`id_matkul`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nim`),
  ADD KEY `matkul` (`id_matkul`);

--
-- Indexes for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mhs` (`nim`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_personal_access_clients_client_id_index` (`client_id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `parkiran`
--
ALTER TABLE `parkiran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `perpus`
--
ALTER TABLE `perpus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `presensi`
--
ALTER TABLE `presensi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nim` (`nim`),
  ADD KEY `id_matkul` (`id_matkul`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_nim_unique` (`nim`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `krs`
--
ALTER TABLE `krs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `parkiran`
--
ALTER TABLE `parkiran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `perpus`
--
ALTER TABLE `perpus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `presensi`
--
ALTER TABLE `presensi`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `krs`
--
ALTER TABLE `krs`
  ADD CONSTRAINT `matkul` FOREIGN KEY (`id_matkul`) REFERENCES `mata_kuliah` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mhs` FOREIGN KEY (`nim`) REFERENCES `mahasiswa` (`nim`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `presensi`
--
ALTER TABLE `presensi`
  ADD CONSTRAINT `presensi_ibfk_1` FOREIGN KEY (`nim`) REFERENCES `mahasiswa` (`nim`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `presensi_ibfk_2` FOREIGN KEY (`id_matkul`) REFERENCES `mata_kuliah` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
