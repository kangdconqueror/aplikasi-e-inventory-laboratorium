-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.8-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table mule7148_laboratorium.tbl_inbox
CREATE TABLE IF NOT EXISTS `tbl_inbox` (
  `id_inbox` int(11) NOT NULL AUTO_INCREMENT,
  `isi_inbox` text NOT NULL,
  `kodepeminjam_user` varchar(50) NOT NULL,
  `created_inbox` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_inbox`),
  KEY `FK_kodepeminjam_user_inbox` (`kodepeminjam_user`),
  CONSTRAINT `FK_kodepeminjam_user_inbox` FOREIGN KEY (`kodepeminjam_user`) REFERENCES `tbl_user` (`kodepeminjam_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table mule7148_laboratorium.tbl_inbox: ~11 rows (approximately)
/*!40000 ALTER TABLE `tbl_inbox` DISABLE KEYS */;
INSERT INTO `tbl_inbox` (`id_inbox`, `isi_inbox`, `kodepeminjam_user`, `created_inbox`) VALUES
	(1, 'Anda telah melakukan peminjaman Ruangan { Labor01 } { Labor Komputer A }, Terimakasih.', '1955201002', '2019-12-15 12:09:12'),
	(2, 'Anda telah melakukan peminjaman Ruangan { Labor01 } { Labor Komputer A }, Terimakasih.', '1955201002', '2019-12-15 12:14:31'),
	(3, 'Peminjaman Ruangan { Labor01 } { Labor Komputer A } telah dikonfirmasi oleh admin, Terimakasih.', '1955201002', '2019-12-15 12:19:17'),
	(4, 'Peminjaman Ruangan { Labor01 } { Labor Komputer A } telah dibatalkan oleh admin, Terimakasih.', '1955201002', '2019-12-15 12:19:46'),
	(5, 'Anda telah melakukan peminjaman Inventaris { Proyektor001 } { Proyektor Labor 001 },mohon untuk mengembalikan sesuai jadwal yang telah ditentukan, Terimakasih.', '1955201002', '2019-12-15 12:35:56'),
	(6, 'Peminjaman Inventaris { Proyektor001 } { Proyektor Labor 001 } telah dikonfirmasi oleh admin, mohon untuk mengembalikan sesuai jadwal yang telah ditentukan, Terimakasih.', '1955201002', '2019-12-15 12:37:08'),
	(7, 'Peminjaman Inventaris { Proyektor001 } { Proyektor Labor 001 } telah dikonfirmasi oleh admin, mohon untuk mengembalikan sesuai jadwal yang telah ditentukan, Terimakasih.', '1955201002', '2019-12-15 12:46:43'),
	(8, 'Anda sudah mengembalikan peminjaman  inventaris { Proyektor001 } { Proyektor Labor 001 }, Terimakasih.', '1955201002', '2019-12-15 13:07:39'),
	(9, 'Anda terlambat mengembalikan { Proyektor001 } { Proyektor Labor 001 }, Mohon segera untuk menghubungi pihak Labor Komputer FASILKOM UNILAK: {admin - 081365068548},{admin2 - 081365068548}, Terimakasih.', '1955201002', '2019-12-15 13:44:01'),
	(10, 'Anda terlambat mengembalikan { Proyektor001 } { Proyektor Labor 001 }, Mohon segera untuk menghubungi pihak Labor Komputer FASILKOM UNILAK: {admin - 081365068548},{admin2 - 081365068548}, Terimakasih.', '1955201002', '2019-12-15 13:51:49'),
	(11, 'Anda sudah mengembalikan peminjaman  inventaris { Proyektor001 } { Proyektor Labor 001 }, Terimakasih.', '1955201002', '2019-12-15 13:54:21');
/*!40000 ALTER TABLE `tbl_inbox` ENABLE KEYS */;


-- Dumping structure for table mule7148_laboratorium.tbl_inventaris
CREATE TABLE IF NOT EXISTS `tbl_inventaris` (
  `id_inventaris` int(11) NOT NULL AUTO_INCREMENT,
  `kode_inventaris` varchar(50) NOT NULL,
  `nama_inventaris` varchar(50) DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `ketersediaan_inventaris` int(1) NOT NULL DEFAULT 1 COMMENT '0 = Tidak Tersedia, 1 = Tersedia',
  `created_inventaris` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_inventaris` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_inventaris`),
  UNIQUE KEY `kode_inventaris` (`kode_inventaris`),
  KEY `FK_id_kategori_inventaris` (`id_kategori`),
  CONSTRAINT `FK_id_kategori_inventaris` FOREIGN KEY (`id_kategori`) REFERENCES `tbl_kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table mule7148_laboratorium.tbl_inventaris: ~6 rows (approximately)
/*!40000 ALTER TABLE `tbl_inventaris` DISABLE KEYS */;
INSERT INTO `tbl_inventaris` (`id_inventaris`, `kode_inventaris`, `nama_inventaris`, `id_kategori`, `ketersediaan_inventaris`, `created_inventaris`, `updated_inventaris`) VALUES
	(1, 'Laptop001', 'Laptop Labor 001', 1, 1, '2019-12-11 21:14:24', '2019-12-15 11:36:24'),
	(2, 'Laptop002', 'Laptop Labor 002', 1, 1, '2019-12-11 21:15:57', '2019-12-15 11:10:58'),
	(3, 'Laptop003', 'Laptop Labor 003', 1, 1, '2019-12-11 21:15:57', '2019-12-15 11:04:32'),
	(4, 'Proyektor001', 'Proyektor Labor 001', 2, 1, '2019-12-11 21:17:51', '2019-12-15 13:07:39'),
	(5, 'Proyektor002', 'Proyektor Labor 002', 2, 1, '2019-12-11 21:17:51', NULL),
	(6, 'Proyektor003', 'Proyektor Labor 003', 2, 0, '2019-12-11 21:17:51', NULL);
/*!40000 ALTER TABLE `tbl_inventaris` ENABLE KEYS */;


-- Dumping structure for table mule7148_laboratorium.tbl_jadwal
CREATE TABLE IF NOT EXISTS `tbl_jadwal` (
  `id_jadwal` int(11) NOT NULL AUTO_INCREMENT,
  `kode_jadwal` varchar(50) NOT NULL,
  `jam1_jadwal` time NOT NULL,
  `jam2_jadwal` time NOT NULL,
  `created_jadwal` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_jadwal` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_jadwal`),
  UNIQUE KEY `kode_jadwal` (`kode_jadwal`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table mule7148_laboratorium.tbl_jadwal: ~5 rows (approximately)
/*!40000 ALTER TABLE `tbl_jadwal` DISABLE KEYS */;
INSERT INTO `tbl_jadwal` (`id_jadwal`, `kode_jadwal`, `jam1_jadwal`, `jam2_jadwal`, `created_jadwal`, `updated_jadwal`) VALUES
	(1, 'Time1', '08:00:00', '10:30:00', '2019-12-11 21:53:04', '2019-12-11 22:00:58'),
	(2, 'Time2', '10:30:00', '13:00:00', '2019-12-11 21:53:04', '2019-12-11 22:01:00'),
	(3, 'Time3', '13:00:00', '15:30:00', '2019-12-11 21:53:04', '2019-12-11 22:01:01'),
	(4, 'Time4', '15:30:00', '18:00:00', '2019-12-11 21:53:04', '2019-12-11 22:01:03'),
	(5, 'Time5', '19:00:00', '21:30:00', '2019-12-11 21:53:04', '2019-12-11 22:01:04');
/*!40000 ALTER TABLE `tbl_jadwal` ENABLE KEYS */;


-- Dumping structure for table mule7148_laboratorium.tbl_kategori
CREATE TABLE IF NOT EXISTS `tbl_kategori` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(50) NOT NULL,
  `created_kategori` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_kategori` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table mule7148_laboratorium.tbl_kategori: ~2 rows (approximately)
/*!40000 ALTER TABLE `tbl_kategori` DISABLE KEYS */;
INSERT INTO `tbl_kategori` (`id_kategori`, `nama_kategori`, `created_kategori`, `updated_kategori`) VALUES
	(1, 'Laptop', '2019-12-11 21:11:47', NULL),
	(2, 'Proyektor', '2019-12-11 21:11:55', NULL),
	(3, 'Komputer', '2019-12-12 22:15:41', '2019-12-12 22:23:28');
/*!40000 ALTER TABLE `tbl_kategori` ENABLE KEYS */;


-- Dumping structure for table mule7148_laboratorium.tbl_peminjaman_inventaris
CREATE TABLE IF NOT EXISTS `tbl_peminjaman_inventaris` (
  `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT,
  `kode_peminjaman` varchar(50) NOT NULL,
  `kode_inventaris` varchar(50) NOT NULL,
  `kodepeminjam_user` varchar(50) NOT NULL,
  `tanggal_peminjaman` datetime DEFAULT NULL,
  `tanggal_kembali` datetime DEFAULT NULL,
  `konfirmasi_peminjaman` int(1) NOT NULL DEFAULT 0,
  `konfirmasi_kembali` int(1) NOT NULL DEFAULT 0,
  `created_peminjaman` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_peminjaman` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_peminjaman`),
  UNIQUE KEY `kode_peminjaman` (`kode_peminjaman`),
  KEY `FK_kode_inventaris` (`kode_inventaris`),
  KEY `FK_kodepeminjam_user` (`kodepeminjam_user`),
  CONSTRAINT `FK_kode_inventaris` FOREIGN KEY (`kode_inventaris`) REFERENCES `tbl_inventaris` (`kode_inventaris`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_kodepeminjam_user` FOREIGN KEY (`kodepeminjam_user`) REFERENCES `tbl_user` (`kodepeminjam_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table mule7148_laboratorium.tbl_peminjaman_inventaris: ~6 rows (approximately)
/*!40000 ALTER TABLE `tbl_peminjaman_inventaris` DISABLE KEYS */;
INSERT INTO `tbl_peminjaman_inventaris` (`id_peminjaman`, `kode_peminjaman`, `kode_inventaris`, `kodepeminjam_user`, `tanggal_peminjaman`, `tanggal_kembali`, `konfirmasi_peminjaman`, `konfirmasi_kembali`, `created_peminjaman`, `updated_peminjaman`) VALUES
	(1, 'I-002-25112019', 'Laptop001', '1955201003', '2019-11-15 00:00:31', '2019-11-15 00:00:47', 1, 1, '2019-12-13 17:12:42', '2019-12-15 00:00:48'),
	(4, 'I-005-25112019', 'Laptop003', '1955201003', NULL, NULL, 0, 1, '2019-12-13 17:12:42', '2019-12-15 00:01:00'),
	(5, 'I-005-15122019', 'Laptop001', '1955201002', NULL, NULL, 0, 1, '2019-12-15 11:16:14', '2019-12-15 11:16:29'),
	(6, 'I-006-15122019', 'Laptop001', '1955201002', NULL, NULL, 0, 1, '2019-12-15 11:28:42', '2019-12-15 11:35:52'),
	(7, 'I-007-15122019', 'Laptop001', '1955201002', '2019-11-15 11:36:19', '2019-11-15 11:36:23', 1, 1, '2019-12-15 11:36:08', '2019-12-15 11:36:24'),
	(8, 'I-008-15122019', 'Proyektor001', '1955201002', '2019-11-14 12:46:42', '2019-11-15 13:54:20', 1, 1, '2019-12-15 12:35:56', '2019-12-15 13:54:21');
/*!40000 ALTER TABLE `tbl_peminjaman_inventaris` ENABLE KEYS */;


-- Dumping structure for table mule7148_laboratorium.tbl_peminjaman_ruangan
CREATE TABLE IF NOT EXISTS `tbl_peminjaman_ruangan` (
  `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT,
  `kode_peminjaman` varchar(50) NOT NULL,
  `kode_ruangan` varchar(50) NOT NULL,
  `kodepeminjam_user` varchar(50) NOT NULL,
  `kode_jadwal` varchar(50) NOT NULL,
  `tanggal_peminjaman` date DEFAULT NULL,
  `status_peminjaman` int(1) NOT NULL DEFAULT 0,
  `created_peminjaman` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_peminjaman` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_peminjaman`),
  UNIQUE KEY `kode_peminjaman` (`kode_peminjaman`),
  KEY `FK_kode_inventaris` (`kode_ruangan`),
  KEY `FK_kodepeminjam_user` (`kodepeminjam_user`),
  KEY `tbl_peminjaman_ruangan_ibfk_3` (`kode_jadwal`),
  CONSTRAINT `tbl_peminjaman_ruangan_ibfk_1` FOREIGN KEY (`kode_ruangan`) REFERENCES `tbl_ruangan` (`kode_ruangan`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_peminjaman_ruangan_ibfk_2` FOREIGN KEY (`kodepeminjam_user`) REFERENCES `tbl_user` (`kodepeminjam_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_peminjaman_ruangan_ibfk_3` FOREIGN KEY (`kode_jadwal`) REFERENCES `tbl_jadwal` (`kode_jadwal`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Dumping data for table mule7148_laboratorium.tbl_peminjaman_ruangan: ~9 rows (approximately)
/*!40000 ALTER TABLE `tbl_peminjaman_ruangan` DISABLE KEYS */;
INSERT INTO `tbl_peminjaman_ruangan` (`id_peminjaman`, `kode_peminjaman`, `kode_ruangan`, `kodepeminjam_user`, `kode_jadwal`, `tanggal_peminjaman`, `status_peminjaman`, `created_peminjaman`, `updated_peminjaman`) VALUES
	(1, 'I-001-25112019', 'Labor01', '1955201001', 'Time1', '2019-11-25', 1, '2019-12-11 22:05:30', '2019-12-14 01:21:32'),
	(2, 'I-002-25112019', 'Labor01', '1955201001', 'Time2', '2019-11-25', 1, '2019-12-11 22:05:30', '2019-12-14 01:21:33'),
	(3, 'I-003-25112019', 'Labor01', '1955201001', 'Time4', '2019-11-25', 1, '2019-12-11 22:05:30', '2019-12-14 01:21:34'),
	(4, 'I-004-25112019', 'Labor02', '1955201001', 'Time3', '2019-11-25', 2, '2019-12-11 22:05:30', '2019-12-14 01:23:46'),
	(6, 'I-006-25112019', 'Labor02', '1955201002', 'Time3', '2019-11-25', 1, '2019-12-11 22:05:30', '2019-12-14 01:21:36'),
	(7, 'I-007-13122019', 'Labor02', '1955201002', 'Time2', '2019-12-14', 1, '2019-12-14 02:44:55', '2019-12-15 02:49:30'),
	(8, 'I-008-15122019', 'Labor02', '1955201002', 'Time3', '2019-12-14', 2, '2019-12-15 10:13:53', '2019-12-15 10:37:14'),
	(9, 'I-009-15122019', 'Labor02', '1955201002', 'Time3', '2019-12-14', 0, '2019-12-15 10:38:40', NULL),
	(10, 'I-010-15122019', 'Labor02', '1955201002', 'Time1', '2019-12-14', 2, '2019-12-15 11:22:22', '2019-12-15 11:27:39'),
	(11, 'I-011-15122019', 'Labor01', '1955201002', 'Time1', '2019-12-15', 2, '2019-12-15 12:14:31', '2019-12-15 12:19:46');
/*!40000 ALTER TABLE `tbl_peminjaman_ruangan` ENABLE KEYS */;


-- Dumping structure for table mule7148_laboratorium.tbl_ruangan
CREATE TABLE IF NOT EXISTS `tbl_ruangan` (
  `id_ruangan` int(11) NOT NULL AUTO_INCREMENT,
  `kode_ruangan` varchar(50) NOT NULL,
  `nama_ruangan` varchar(50) DEFAULT NULL,
  `keterangan_ruangan` text DEFAULT NULL,
  `created_ruangan` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_ruangan` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_ruangan`),
  UNIQUE KEY `kode_inventaris` (`kode_ruangan`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Dumping data for table mule7148_laboratorium.tbl_ruangan: ~4 rows (approximately)
/*!40000 ALTER TABLE `tbl_ruangan` DISABLE KEYS */;
INSERT INTO `tbl_ruangan` (`id_ruangan`, `kode_ruangan`, `nama_ruangan`, `keterangan_ruangan`, `created_ruangan`, `updated_ruangan`) VALUES
	(1, 'Labor01', 'Labor Komputer A', 'Kelengkapan : PC 30 Unit, AC 2 Unit, Meja dan Kursi 41 Unit, Papan Tulis 2 Unit', '2019-12-11 21:47:56', NULL),
	(2, 'Labor02', 'Labor Komputer B', 'Kelengkapan : PC 30 Unit, AC 2 Unit, Meja dan Kursi 41 Unit, Papan Tulis 2 Unit', '2019-12-11 21:47:56', NULL),
	(3, 'Labor03', 'Labor Komputer C', 'Kelengkapan : PC 30 Unit, AC 2 Unit, Meja dan Kursi 41 Unit, Papan Tulis 2 Unit', '2019-12-11 21:47:56', NULL),
	(4, 'Labor04', 'Labor Komputer D', 'Kelengkapan : PC 30 Unit, AC 2 Unit, Meja dan Kursi 41 Unit, Papan Tulis 2 Unit', '2019-12-11 21:47:56', NULL);
/*!40000 ALTER TABLE `tbl_ruangan` ENABLE KEYS */;


-- Dumping structure for table mule7148_laboratorium.tbl_user
CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `kodepeminjam_user` varchar(50) NOT NULL COMMENT 'nim,nidn',
  `level_user` varchar(50) NOT NULL COMMENT 'administrator,mahasiswa,dosen',
  `user_name` varchar(50) DEFAULT NULL,
  `user_password` varchar(50) DEFAULT NULL,
  `nama_user` varchar(50) DEFAULT NULL,
  `tempatlahir_user` varchar(50) DEFAULT NULL,
  `tanggallahir_user` date DEFAULT NULL,
  `notelp_user` varchar(15) DEFAULT NULL,
  `alamat_user` text DEFAULT NULL,
  `foto_user` varchar(50) NOT NULL DEFAULT 'default/user.png',
  `sangsipeminjaman_user` int(11) NOT NULL DEFAULT 0,
  `tanggalsangsi_user` datetime DEFAULT NULL,
  `created_user` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_user` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `kode_inventaris` (`kodepeminjam_user`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Dumping data for table mule7148_laboratorium.tbl_user: ~4 rows (approximately)
/*!40000 ALTER TABLE `tbl_user` DISABLE KEYS */;
INSERT INTO `tbl_user` (`id_user`, `kodepeminjam_user`, `level_user`, `user_name`, `user_password`, `nama_user`, `tempatlahir_user`, `tanggallahir_user`, `notelp_user`, `alamat_user`, `foto_user`, `sangsipeminjaman_user`, `tanggalsangsi_user`, `created_user`, `updated_user`) VALUES
	(1, '1955201001', 'administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin', 'SGH', '1994-04-24', '081365068548', 'Jakarta', 'default/user.png', 0, NULL, '2019-12-11 21:45:24', '2019-12-15 13:58:11'),
	(2, '1955201002', 'dosen', 'dosen', 'ce28eed1511f631af6b2a7bb0a85d636', 'JengJeng', 'Pekanbaru', '1994-04-24', '081365068548', 'Rumbai Pesisir Pekanbaru', '157634645141b586905e6233e72b076191f8bf9512.png', 5, NULL, '2019-12-11 21:45:24', '2019-12-15 13:42:46'),
	(3, '1955201003', 'mahasiswa', '1955201003', '5787be38ee03a9ae5360f54d9026465f', 'Jabbars', 'Sei Galuh', '1994-04-24', '0808080', 'Jkt48', 'default/user.png', 1, '2019-12-11 21:56:04', '2019-12-13 13:19:51', '2019-12-15 13:59:49'),
	(4, '1955201004', 'administrator', 'admin2', '21232f297a57a5a743894a0e4a801fc3', 'Adminc', 'SGH', '1994-04-24', '081365068548', 'Jakarta', 'default/user.png', 0, NULL, '2019-12-11 21:45:24', '2019-12-15 13:58:12');
/*!40000 ALTER TABLE `tbl_user` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
