
-- 작성날짜 : 2014년 01월 25일 토요일 오전 07시 16분, 날씨 겨울치고 날씨 덜 추움, 맨발로도 안 시려움

-- 피리 > 피리 설정 관리 > 설정 관리 DB SCHEMA 화일

-- --------------------------------------------------------

--
-- Table structure for table `g5__piree__program`
--

DROP TABLE IF EXISTS `g5__piree__program`;
CREATE TABLE IF NOT EXISTS `g5__piree__program` (
  `num` int unsigned NOT NULL auto_increment,
  `grp_n` smallint unsigned NOT NULL DEFAULT '0',
  `user_n` int unsigned NOT NULL DEFAULT '0',
  `prog_n` int unsigned NOT NULL DEFAULT '0',
  `prog_c` varchar(120) NOT NULL,
  `prog_s` varchar(255) NOT NULL,
  `version_s` varchar(60) NOT NULL,

  `prog_key_s` varchar(255) NOT NULL,

	`pp_license_key_1` varchar(255) NOT NULL DEFAULT '',
	`pp_license_key_2` varchar(255) NOT NULL DEFAULT '',

  `prog_memo_s` varchar(255) NOT NULL,
  `domain_s` varchar(255) NOT NULL,
  `is_paid` tinyint unsigned NOT NULL DEFAULT '0',

  `use_pc_c` tinyint unsigned NOT NULL DEFAULT '0',
  `skin_pc_c` varchar(255) NOT NULL DEFAULT '',
  `use_mobile_c` tinyint unsigned NOT NULL DEFAULT '0',
  `skin_mobile_c` varchar(255) NOT NULL DEFAULT '',

  `pp_cf_1_c` varchar(20) NOT NULL,
  `pp_cf_1_m` varchar(255) NOT NULL,
  `pp_cf_1_n` int NOT NULL DEFAULT '0',
  `pp_cf_1_s` varchar(12) NOT NULL,

  `pp_cf_2_c` varchar(20) NOT NULL,
  `pp_cf_2_m` varchar(255) NOT NULL,
  `pp_cf_2_n` int NOT NULL DEFAULT '0',
  `pp_cf_2_s` varchar(12) NOT NULL,

  `pp_cf_3_c` varchar(20) NOT NULL,
  `pp_cf_3_m` varchar(255) NOT NULL,
  `pp_cf_3_n` int NOT NULL DEFAULT '0',
  `pp_cf_3_s` varchar(12) NOT NULL,

  `pp_cf_4_c` varchar(20) NOT NULL,
  `pp_cf_4_m` varchar(255) NOT NULL,
  `pp_cf_4_n` int NOT NULL DEFAULT '0',
  `pp_cf_4_s` varchar(12) NOT NULL,

  `pp_cf_5_c` varchar(20) NOT NULL,
  `pp_cf_5_m` varchar(255) NOT NULL,
  `pp_cf_5_n` int NOT NULL DEFAULT '0',
  `pp_cf_5_s` varchar(12) NOT NULL,

  `pp_cf_6_c` varchar(20) NOT NULL,
  `pp_cf_6_m` varchar(255) NOT NULL,
  `pp_cf_6_n` int NOT NULL DEFAULT '0',
  `pp_cf_6_s` varchar(12) NOT NULL,

  `pp_cf_7_c` varchar(20) NOT NULL,
  `pp_cf_7_m` varchar(255) NOT NULL,
  `pp_cf_7_n` int NOT NULL DEFAULT '0',
  `pp_cf_7_s` varchar(12) NOT NULL,

  `pp_cf_8_c` varchar(20) NOT NULL,
  `pp_cf_8_m` varchar(255) NOT NULL,
  `pp_cf_8_n` int NOT NULL DEFAULT '0',
  `pp_cf_8_s` varchar(12) NOT NULL,

  `pp_cf_9_c` varchar(20) NOT NULL,
  `pp_cf_9_m` varchar(255) NOT NULL,
  `pp_cf_9_n` int NOT NULL DEFAULT '0',
  `pp_cf_9_s` varchar(12) NOT NULL,

  `pp_cf_10_c` varchar(20) NOT NULL,
  `pp_cf_10_m` varchar(255) NOT NULL,
  `pp_cf_10_n` int NOT NULL DEFAULT '0',
  `pp_cf_10_s` varchar(12) NOT NULL,

  `pp_cf_11_c` varchar(20) NOT NULL,
  `pp_cf_11_m` varchar(255) NOT NULL,
  `pp_cf_11_n` int NOT NULL DEFAULT '0',
  `pp_cf_11_s` varchar(12) NOT NULL,

  `pp_cf_12_c` varchar(20) NOT NULL,
  `pp_cf_12_m` varchar(255) NOT NULL,
  `pp_cf_12_n` int NOT NULL DEFAULT '0',
  `pp_cf_12_s` varchar(12) NOT NULL,

  `pp_cf_13_c` varchar(20) NOT NULL,
  `pp_cf_13_m` varchar(255) NOT NULL,
  `pp_cf_13_n` int NOT NULL DEFAULT '0',
  `pp_cf_13_s` varchar(12) NOT NULL,

  `pp_cf_14_c` varchar(20) NOT NULL,
  `pp_cf_14_m` varchar(255) NOT NULL,
  `pp_cf_14_n` int NOT NULL DEFAULT '0',
  `pp_cf_14_s` varchar(12) NOT NULL,

  `pp_cf_15_c` varchar(20) NOT NULL,
  `pp_cf_15_m` varchar(255) NOT NULL,
  `pp_cf_15_n` int NOT NULL DEFAULT '0',
  `pp_cf_15_s` varchar(12) NOT NULL,

  `pp_cf_16_c` varchar(20) NOT NULL,
  `pp_cf_16_m` varchar(255) NOT NULL,
  `pp_cf_16_n` int NOT NULL DEFAULT '0',
  `pp_cf_16_s` varchar(12) NOT NULL,

  `pp_cf_17_c` varchar(20) NOT NULL,
  `pp_cf_17_m` varchar(255) NOT NULL,
  `pp_cf_17_n` int NOT NULL DEFAULT '0',
  `pp_cf_17_s` varchar(12) NOT NULL,

  `pp_cf_18_c` varchar(20) NOT NULL,
  `pp_cf_18_m` varchar(255) NOT NULL,
  `pp_cf_18_n` int NOT NULL DEFAULT '0',
  `pp_cf_18_s` varchar(12) NOT NULL,

  `pp_cf_19_c` varchar(20) NOT NULL,
  `pp_cf_19_m` varchar(255) NOT NULL,
  `pp_cf_19_n` int NOT NULL DEFAULT '0',
  `pp_cf_19_s` varchar(12) NOT NULL,

  `pp_cf_20_c` varchar(20) NOT NULL,
  `pp_cf_20_m` varchar(255) NOT NULL,
  `pp_cf_20_n` int NOT NULL DEFAULT '0',
  `pp_cf_20_s` varchar(12) NOT NULL,

  `pp_cf_21_c` varchar(20) NOT NULL,
  `pp_cf_21_m` varchar(255) NOT NULL,
  `pp_cf_21_n` int NOT NULL DEFAULT '0',
  `pp_cf_21_s` varchar(12) NOT NULL,

  `pp_cf_22_c` varchar(20) NOT NULL,
  `pp_cf_22_m` varchar(255) NOT NULL,
  `pp_cf_22_n` int NOT NULL DEFAULT '0',
  `pp_cf_22_s` varchar(12) NOT NULL,

  `pp_cf_23_c` varchar(20) NOT NULL,
  `pp_cf_23_m` varchar(255) NOT NULL,
  `pp_cf_23_n` int NOT NULL DEFAULT '0',
  `pp_cf_23_s` varchar(12) NOT NULL,

  `pp_cf_24_c` varchar(20) NOT NULL,
  `pp_cf_24_m` varchar(255) NOT NULL,
  `pp_cf_24_n` int NOT NULL DEFAULT '0',
  `pp_cf_24_s` varchar(12) NOT NULL,

  `pp_cf_25_c` varchar(20) NOT NULL,
  `pp_cf_25_m` varchar(255) NOT NULL,
  `pp_cf_25_n` int NOT NULL DEFAULT '0',
  `pp_cf_25_s` varchar(12) NOT NULL,

  `pp_cf_26_c` varchar(20) NOT NULL,
  `pp_cf_26_m` varchar(255) NOT NULL,
  `pp_cf_26_n` int NOT NULL DEFAULT '0',
  `pp_cf_26_s` varchar(12) NOT NULL,

  `pp_cf_27_c` varchar(20) NOT NULL,
  `pp_cf_27_m` varchar(255) NOT NULL,
  `pp_cf_27_n` int NOT NULL DEFAULT '0',
  `pp_cf_27_s` varchar(12) NOT NULL,

  `pp_cf_28_c` varchar(20) NOT NULL,
  `pp_cf_28_m` varchar(255) NOT NULL,
  `pp_cf_28_n` int NOT NULL DEFAULT '0',
  `pp_cf_28_s` varchar(12) NOT NULL,

  `pp_cf_29_c` varchar(20) NOT NULL,
  `pp_cf_29_m` varchar(255) NOT NULL,
  `pp_cf_29_n` int NOT NULL DEFAULT '0',
  `pp_cf_29_s` varchar(12) NOT NULL,

  `pp_cf_30_c` varchar(20) NOT NULL,
  `pp_cf_30_m` varchar(255) NOT NULL,
  `pp_cf_30_n` int NOT NULL DEFAULT '0',
  `pp_cf_30_s` varchar(12) NOT NULL,

  `regi_time_n` int unsigned NOT NULL DEFAULT '0',
  `modi_time_n` int unsigned NOT NULL DEFAULT '0',

  PRIMARY KEY (`num`),
  UNIQUE KEY `date_Ymd` (`prog_n`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5__piree__calendar`
--

DROP TABLE IF EXISTS `g5__piree__calendar`;
CREATE TABLE IF NOT EXISTS `g5__piree__calendar` (
  `num` int unsigned NOT NULL auto_increment,
  `date_n` int unsigned NOT NULL DEFAULT '0',
  `date_Y` smallint unsigned NOT NULL DEFAULT '0',
  `date_m` tinyint unsigned NOT NULL DEFAULT '0',
  `date_d` tinyint unsigned NOT NULL DEFAULT '0',
  `date_Ymd` date NOT NULL,
  `yoil_n` tinyint unsigned NOT NULL DEFAULT '0',
  `yoil_seq` tinyint unsigned NOT NULL DEFAULT '0',
  `lunar_Ymd` date NOT NULL,
  `kor_gapja_s` varchar(10) NOT NULL,
  `cha_gapja_s` varchar(12) NOT NULL,
  `is_holiday` tinyint unsigned NOT NULL DEFAULT '0',
  `is_24_jeolki` varchar(12) NOT NULL,
  `memo_s` varchar(255) NOT NULL,
  `member_all_t` int unsigned NOT NULL DEFAULT '0',
  `member_join_t` int unsigned NOT NULL DEFAULT '0',
  `visit_t` int unsigned NOT NULL DEFAULT '0',
  `arti_all_t` int unsigned NOT NULL DEFAULT '0',
  `arti_new_t` int unsigned NOT NULL DEFAULT '0',
  `comm_all_t` int unsigned NOT NULL DEFAULT '0',
  `comm_new_t` int unsigned NOT NULL DEFAULT '0',
  `attend_t` int unsigned NOT NULL DEFAULT '0',
  `regi_time_n` int unsigned NOT NULL DEFAULT '0',
  `relo_time_n` int unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`num`),
  UNIQUE KEY `date_Ymd` (`date_Y`, `date_m`, `date_d`),
  KEY `kd_Yn` (`date_Y`,`date_n`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5__piree__member_active_stat`
--

DROP TABLE IF EXISTS `g5__piree__member_active_stat`;
CREATE TABLE IF NOT EXISTS `g5__piree__member_active_stat` (
  `num` int NOT NULL auto_increment,
  `mem_mn` int NOT NULL DEFAULT '0',
  `point_n` int UNSIGNED NOT NULL DEFAULT '0',
  `total_rank_n` int UNSIGNED NOT NULL DEFAULT '0',
  `total_arti_t` int UNSIGNED NOT NULL DEFAULT '0',
  `total_comm_t` int UNSIGNED NOT NULL DEFAULT '0',
  `total_attend_t` smallint UNSIGNED NOT NULL DEFAULT '0',
  `total_piriji_t` int UNSIGNED NOT NULL DEFAULT '0',
  `people_regi_t` smallint UNSIGNED NOT NULL default '0',
  `item_regi_t` smallint UNSIGNED NOT NULL default '0',
  `pireeji_regi_t` int UNSIGNED NOT NULL default '0',
  `level_up_rank_n` int UNSIGNED NOT NULL DEFAULT '0',
  `level_up_arti_t` int UNSIGNED NOT NULL DEFAULT '0',
  `level_up_comm_t` int UNSIGNED NOT NULL DEFAULT '0',
  `level_up_attend_t` smallint UNSIGNED NOT NULL DEFAULT '0',
  `level_up_piriji_t` int UNSIGNED NOT NULL DEFAULT '0',
  `is_auto_n` tinyint(4) UNSIGNED NOT NULL default '0',
  `is_end_n` tinyint(4) UNSIGNED NOT NULL default '0',
  `active_s` varchar(20) NOT NULL default '',
  `active_m` varchar(600) NOT NULL default '',
  `requ_time_n` int NOT NULL DEFAULT '0',
  `view_time_n` int NOT NULL DEFAULT '0',
  `chng_time_n` int NOT NULL DEFAULT '0',
  PRIMARY KEY  (`num`),
  KEY `mnlv` (`mem_mn`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------
