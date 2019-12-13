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

-- Dumping database structure for mule7148_laboratorium
CREATE DATABASE IF NOT EXISTS `mule7148_laboratorium` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `mule7148_laboratorium`;


-- Dumping structure for table mule7148_laboratorium.tbl_inbox
CREATE TABLE IF NOT EXISTS `tbl_inbox` (
  `id_inbox` int(11) NOT NULL AUTO_INCREMENT,
  `isi_inbox` text NOT NULL,
  `kodepeminjam_user` varchar(50) NOT NULL,
  `created_user` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_inbox`),
  KEY `FK_kodepeminjam_user_inbox` (`kodepeminjam_user`),
  CONSTRAINT `FK_kodepeminjam_user_inbox` FOREIGN KEY (`kodepeminjam_user`) REFERENCES `tbl_user` (`kodepeminjam_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.


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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.


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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.


-- Dumping structure for table mule7148_laboratorium.tbl_kategori
CREATE TABLE IF NOT EXISTS `tbl_kategori` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(50) NOT NULL,
  `created_kategori` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_kategori` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.


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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.


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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Data exporting was unselected.


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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Data exporting was unselected.


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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
