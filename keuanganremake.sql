-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table keuanganremake.akun
CREATE TABLE IF NOT EXISTS `akun` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_akun` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table keuanganremake.akun: ~0 rows (approximately)

-- Dumping structure for table keuanganremake.asrama
CREATE TABLE IF NOT EXISTS `asrama` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_musyrif` int DEFAULT NULL,
  `nama_musyrif` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table keuanganremake.asrama: ~3 rows (approximately)
REPLACE INTO `asrama` (`id`, `nama`, `id_musyrif`, `nama_musyrif`) VALUES
	(6, 'Pusat', 6, NULL),
	(7, 'Putra', 7, NULL),
	(8, 'Putri', 8, NULL);

-- Dumping structure for table keuanganremake.jurnal_umum
CREATE TABLE IF NOT EXISTS `jurnal_umum` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tanggal` int NOT NULL DEFAULT '0',
  `ref` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '',
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `debet` decimal(15,2) DEFAULT NULL,
  `kredit` decimal(15,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table keuanganremake.jurnal_umum: ~11 rows (approximately)
REPLACE INTO `jurnal_umum` (`id`, `tanggal`, `ref`, `keterangan`, `debet`, `kredit`) VALUES
	(1, 1725901200, 'bebas', 'untuk jurnal', 300000000.00, 0.00),
	(2, 1723654800, '', 'bebas', 1231.00, 434343.00),
	(3, 1723654800, '', 'bebas', 1231.00, 434231231.00),
	(4, 1723654800, '', 'bebasss', 1231.00, 434231231.00),
	(5, 1721754000, '', 'asa', 21.00, 1241.00),
	(6, 1724290620, '', 'asdasd', 21412.00, 124124.00),
	(7, 1723482000, '', 'bebas', 231.00, 0.00),
	(8, 1726160400, '', 'bebas', 233.00, 0.00),
	(9, 1728838800, '', 'dw', 2313.00, 1.00),
	(10, 1723482000, '', 'bebas', 20000.00, 0.00),
	(12, 1721926800, 'bebas', 'bebas', 21.00, 0.00);

-- Dumping structure for table keuanganremake.menu
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int NOT NULL AUTO_INCREMENT,
  `menu` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `link` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `icon` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `for` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `order` int NOT NULL,
  `status` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table keuanganremake.menu: ~7 rows (approximately)
REPLACE INTO `menu` (`id`, `menu`, `link`, `icon`, `for`, `order`, `status`) VALUES
	(1, 'Dashboard', 'dashboard', 'fa fa-th', '2', 1, 1),
	(2, 'Master', 'admin', 'fas fa-id-badge', '1', 2, 1),
	(3, 'Keuangan', 'keuangan', 'fa fa-wallet', '2', 2, 1),
	(5, 'Logout', 'auth/logout', 'fa fa-sign-out-alt', '2', 100, 1),
	(6, 'Interface', 'auth/logout', 'fas fa-wrench', '1', 99, 1),
	(14, 'Laporan', 'laporan', 'fa fa-book', '3', 5, 1),
	(15, 'Pembukuan', 'buku', 'fas fa-school', '2', 5, 1);

-- Dumping structure for table keuanganremake.neraca_saldo
CREATE TABLE IF NOT EXISTS `neraca_saldo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_pengguna` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ref` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `debit` decimal(15,2) DEFAULT NULL,
  `kredit` decimal(15,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table keuanganremake.neraca_saldo: ~3 rows (approximately)
REPLACE INTO `neraca_saldo` (`id`, `nama_pengguna`, `ref`, `debit`, `kredit`) VALUES
	(1, 'Bank', 'd', 20000.00, 0.00),
	(2, 'Bank', '', 0.00, 300000.00),
	(3, 'Lord Daud', '', 15000.00, 0.00),
	(4, 'Lp31', '', 0.00, 30000.00);

-- Dumping structure for table keuanganremake.pemasukan
CREATE TABLE IF NOT EXISTS `pemasukan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tanggal_masuk` int NOT NULL DEFAULT '0',
  `jumlah` decimal(15,2) NOT NULL,
  `sumber` enum('infaq','donasi','orang tua asuh') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `id_asrama` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table keuanganremake.pemasukan: ~5 rows (approximately)
REPLACE INTO `pemasukan` (`id`, `tanggal_masuk`, `jumlah`, `sumber`, `keterangan`, `id_asrama`) VALUES
	(11, 1722963600, 2000000000.00, 'infaq', 'Bapak Dani', 6),
	(12, 1723136400, 300000.00, 'donasi', 'Bapak Dani', 7),
	(13, 1723827600, 200000.00, 'orang tua asuh', 'Bapak solihin', 8),
	(14, 1723136400, 23131000.00, 'donasi', 'bebas', 6),
	(15, 1723050000, 30000.00, 'orang tua asuh', 'Bapak Dani', 6),
	(16, 1726246800, 20000000.00, 'donasi', 'bebas', 7);

-- Dumping structure for table keuanganremake.pengeluaran
CREATE TABLE IF NOT EXISTS `pengeluaran` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tanggal_keluar` int NOT NULL DEFAULT '0',
  `jumlah` decimal(15,2) NOT NULL,
  `kategori` enum('personalia','operasional','pemeliharaan','konsumsi','lainnya') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `id_asrama` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table keuanganremake.pengeluaran: ~6 rows (approximately)
REPLACE INTO `pengeluaran` (`id`, `tanggal_keluar`, `jumlah`, `kategori`, `keterangan`, `id_asrama`) VALUES
	(2, 1723050000, 25000000.00, 'konsumsi', 'menyambut Habib', 6),
	(3, 1724778000, 24424.00, 'pemeliharaan', 'Service Ac', 8),
	(6, 1723050000, 31231.00, 'operasional', 'Mengantar lomba', 7),
	(8, 1723050000, 300000.00, 'konsumsi', 'Muhadoroh', 6),
	(9, 1723136400, 500000.00, 'pemeliharaan', 'bebas', 8),
	(10, 1723222800, 2000000.00, 'pemeliharaan', 'ganti lampu', 6),
	(11, 1725469200, 12344.00, 'operasional', 'bebas', 7);

-- Dumping structure for table keuanganremake.pengguna
CREATE TABLE IF NOT EXISTS `pengguna` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(154) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `image` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `role` int DEFAULT NULL,
  `no_hp` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jenis_kelamin` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tgl_dibuat` int DEFAULT NULL,
  `terakhir_login` int DEFAULT NULL,
  `status` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `email` (`email`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table keuanganremake.pengguna: ~8 rows (approximately)
REPLACE INTO `pengguna` (`id`, `nama`, `email`, `password`, `image`, `role`, `no_hp`, `jenis_kelamin`, `tgl_dibuat`, `terakhir_login`, `status`) VALUES
	(1, 'ALIF ZULFAHMI YUSUF', 'abahdaud@gmail.com', '$2y$10$dXy5ySWJtvxf9yUluodeguV1WReKdM/mTlfYUMLKpul6hroIBIDmO', '1723547913_53df239a7a21e9d3506d8b13384fae2c1723547913.jpg', 1, '081312157307', 'L', 1658915944, 1723661169, 1),
	(4, 'Lord Daud', 'lorddaud@gmail.com', '$2y$10$I9XGPBlZy77DY6AXZB3U7.npzrpTl2GkPH1CkcuGk7rU703AfKJUS', '70e0040728fb3c66dcb8ba56531ffbbe.png', 2, '081312157307', 'L', 1722941841, NULL, 1),
	(6, 'Kalsi Kirei', 'kalsi@gmail.com', '$2y$10$0.I9YQ6ZT.Lcr5QDj0YkxeCPpEjDVoctKLmF/BH6X7LDo.CHAqPii', 'aa55498b7d5e8c7c578972ff06bb1f36.jpg', 2, '08215761826', 'P', 1723035653, 1723042785, 1),
	(7, 'Abang Sonsad', 'abangsonsad@gmail.com', '$2y$10$fYgxkWFSi2CH2M4FfXZrPOtKiti5dWKaq/PmCupjxDNt8Wk1MCTZG', '1723041993_dd9395923e8e7b0c42c7862cd11c515e1723041993.jpg', 2, '081312157307', 'L', 1723041979, NULL, 1),
	(14, 'Disnaker Tasikmalaya', 'disnaker.kotatasik@gmail.com', '$2y$10$ZP2vzFyeM45JXOCLiZJOQu68htsmRP6Giv6UbviLAxKaEJ952Yy3G', '1723280326_6ef9c175b95b80a95387bda2ff9fe9561723280326.jpg', 3, '-', 'L', 1723280253, NULL, 1),
	(15, 'Lp31', 'lp31@gmail.com', '$2y$10$.UmSxsqZ86ssi2pqUZENAOh8YTkSlrM90eBENZbn9MEGnBUjW/KqC', '1723280410_4c1edf78c8cd5c3d1ec7557f6199ec291723280410.jpg', 3, '-', 'L', 1723280283, NULL, 1),
	(16, 'Putri aulia', 'putri@gmail.com', '$2y$10$jjwraqpEnGC48ueVFaWOF.Nc..j4dClvaq0KmnUSHENfW1tocKQve', '1723280792_cfaebefd0fe978bb93b4d484576975021723280792.png', 3, '-', 'P', 1723280743, NULL, 1),
	(17, 'Shellin', 'shellin22@gmail.com', '$2y$10$cqsWiDpejvturTJl8y.nFu0w2TKWAzD5AZ2NRpaIHfy2w4BZCxVBe', '1723468948_62ed8435896420eed18910a62808e31c1723468948.jpg', 2, '0831285125125', 'P', 1723468925, 1723468951, 1),
	(18, 'Bank', 'bank@gmail.com', '$2y$10$3s8Q3E3tuJeEpPfTYj0NCeLW9mWb8QR1/hNSZ69WJaPz.GtQGmVpG', 'default', 2, '-', 'L', 1723542754, NULL, 1);

-- Dumping structure for table keuanganremake.santri
CREATE TABLE IF NOT EXISTS `santri` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tgl_lahir` int DEFAULT NULL,
  `jk` enum('L','P') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_asrama` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table keuanganremake.santri: ~4 rows (approximately)
REPLACE INTO `santri` (`id`, `nama`, `tgl_lahir`, `jk`, `id_asrama`) VALUES
	(3, 'Ananda Chandra', 1722445200, 'L', 6),
	(4, 'Jajang', 1357578000, 'L', 7),
	(5, 'yuni', 1723050000, 'P', 8),
	(6, 'alif', 1723222800, 'L', 7);

-- Dumping structure for table keuanganremake.submenu
CREATE TABLE IF NOT EXISTS `submenu` (
  `id` int NOT NULL AUTO_INCREMENT,
  `menu_id` int NOT NULL,
  `title` varchar(128) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `url_i` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `url_ii` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `icon` varchar(128) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `status` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `menu_id` (`menu_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table keuanganremake.submenu: ~11 rows (approximately)
REPLACE INTO `submenu` (`id`, `menu_id`, `title`, `url_i`, `url_ii`, `icon`, `status`) VALUES
	(1, 2, 'Pengguna', 'admin/', 'pengguna', '', 1),
	(2, 6, 'Menu', 'ui/', 'menu', NULL, 1),
	(3, 6, 'Submenu', 'ui/', 'submenu', '', 1),
	(8, 3, 'Pemasukan', 'keuangan/', 'pemasukan', NULL, 1),
	(9, 2, 'Santri', 'admin/', 'santri', NULL, 1),
	(10, 2, 'Yayasan', 'admin/', 'yayasan', NULL, 1),
	(12, 2, 'Asrama', 'admin/', 'Asrama', NULL, 1),
	(13, 3, 'Pengeluaran', 'keuangan/', 'pengeluaran', NULL, 1),
	(16, 13, 'Santri', 'ustadz/', 'santri', NULL, 1),
	(18, 15, 'Jurnal Umum', 'keuangan/', 'jurnal', NULL, 1),
	(19, 15, 'Neraca Saldo', 'pembukuan/', 'neraca', NULL, 1),
	(20, 3, 'Laporna Keuangan', 'keuangan/', 'Laporan', NULL, 1);

-- Dumping structure for table keuanganremake.ustadz
CREATE TABLE IF NOT EXISTS `ustadz` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_user` int DEFAULT NULL,
  `id_asrama` int DEFAULT NULL,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `bidang` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jk` enum('L','P') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table keuanganremake.ustadz: ~3 rows (approximately)
REPLACE INTO `ustadz` (`id`, `id_user`, `id_asrama`, `nama`, `bidang`, `jk`) VALUES
	(6, 14, 6, 'Disnaker Tasikmalaya', 'Hadist', 'L'),
	(7, 15, 7, 'Lp31', 'Agama', 'L'),
	(8, 16, 8, 'Putri aulia', 'Hadist', 'P');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
