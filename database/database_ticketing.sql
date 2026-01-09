USE djamil_ticketing;

DROP TABLE IF EXISTS `tabel_minta_data`;
CREATE TABLE `tabel_minta_data` (
  `uuid` VARCHAR(36) NOT NULL UNIQUE PRIMARY KEY,
  `user` VARCHAR(10) NOT NULL,
  `tanggal` DATE NOT NULL,
  `tujuan` VARCHAR(100) NOT NULL,
  `uploadfiles` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `telephone` VARCHAR(15) NOT NULL,
  `status` ENUM('Pending', 'Terima', 'Tolak') NOT NULL DEFAULT 'Pending',
  `alasan` VARCHAR(255) NULL,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS `tabel_minta_aplikasi`;
CREATE TABLE `tabel_minta_aplikasi` (
  `uuid` VARCHAR(36) NOT NULL PRIMARY KEY,
  `unit` VARCHAR(255) NOT NULL,
  `pengusul` VARCHAR(255) NOT NULL,
  `judul` VARCHAR(255) NOT NULL,
  `deskripsi` TEXT NOT NULL,
  `pic` VARCHAR(255) NOT NULL,
  `surat` TEXT NOT NULL,
  `alur` TEXT NOT NULL,
  `status` ENUM('Pending','Kondisional','Terima') DEFAULT 'Pending' NOT NULL,
  `tanggal_pengajuan` DATE NOT NULL,
  `alasan` TEXT NULL,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS `tabel_pelaporan_issue`;
CREATE TABLE `tabel_pelaporan_issue` (
  `uuid` VARCHAR(36) NOT NULL PRIMARY KEY,
  `unit` VARCHAR(255) NOT NULL,
  `pelapor` VARCHAR(10) NOT NULL,
  `telephone` VARCHAR(15) NOT NULL,
  `deskripsi` TEXT NOT NULL,
  `tanggal_pelaporan` DATE NOT NULL,
  `kategorikal` ENUM('Aplikasi', 'Perangkat', 'Jaringan') NOT NULL,
  `lampiran` VARCHAR(100) NOT NULL,
  `status` ENUM('Pending','Di Tindak Lanjuti','Selesai') NOT NULL DEFAULT 'Pending',
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS `tabel_issue_logtime`;
CREATE TABLE `tabel_issue_logtime` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `uuid` VARCHAR(36) NOT NULL,
  `pending` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userp` VARCHAR(100) NOT NULL,
  `lanjut` DATETIME DEFAULT NULL,
  `userl` VARCHAR(100) DEFAULT NULL,
  `selesai` DATETIME DEFAULT NULL,
  `users` VARCHAR(100) DEFAULT NULL,
  CONSTRAINT `tabel_issue_logtime_ibfk_1` 
  FOREIGN KEY (`uuid`) 
  REFERENCES `tabel_pelaporan_issue` (`uuid`) ON DELETE CASCADE
);
