USE djamil_ticketing;

INSERT INTO `roles` VALUES(DEFAULT, 'Instalasi Rumah Sakit', 'instalasi', 1);

INSERT INTO `permission_modules` VALUES(DEFAULT, 'Module SIMRS Help Desk', 'ticketing', 1, 6, CURRENT_TIMESTAMP);

INSERT INTO `permission` (`module_id`, `name`, `prefix`) VALUES
  (6, 'Pelaporan Issue Aplikasi', 'laporan'),
  (6, 'Permintaan Data Aplikasi', 'mintadata'),
  (6, 'Permintaan Aplikasi', 'aplikasi'),
  (6, 'Permasalahan Teknis', 'teknisi');
