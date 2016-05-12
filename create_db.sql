# create database
create database internet_subscribers_manager;

use internet_subscribers_manager;

# create table goi_cuoc
CREATE TABLE `goi_cuoc` (
  `ma_goi_cuoc` int(3) NOT NULL AUTO_INCREMENT,
  `ten_goi_cuoc` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `mo_ta` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `cuoc_phi` int(8) NOT NULL,
  PRIMARY KEY (`ma_goi_cuoc`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

# create table khach_hang
CREATE TABLE `khach_hang` (
  `so_thue_bao` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `hoten` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `dia_chi` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `so_dien_thoai` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `ma_goi_cuoc` int(3) NOT NULL,
  `cmnd` int(15) NOT NULL,
  `noi_cap_cmnd` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `ngay_cap_cmnd` date NOT NULL,
  `ngay_dang_ki` date NOT NULL,
  `username` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `mat_khau` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`so_thue_bao`),
  KEY `fk_ma_goi_cuoc` (`ma_goi_cuoc`),
  CONSTRAINT `fk_ma_goi_cuoc` FOREIGN KEY (`ma_goi_cuoc`)
  REFERENCES `goi_cuoc` (`ma_goi_cuoc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
