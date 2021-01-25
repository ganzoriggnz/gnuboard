
-- 작성날짜 : 2014년 01월 21일 화요일 오전 10시 55분, 날씨 쌀쌀하다

-- 피리 > 피리 출석체크 FREE G5 > 출석체크 DB SCHEMA 화일

-- --------------------------------------------------------

--
-- Table structure for table `g5__piree_760003_attend_list`
--

DROP TABLE IF EXISTS `g5__piree_760003_attend_list`;
CREATE TABLE IF NOT EXISTS `g5__piree_760003_attend_list` (
  `num` int unsigned NOT NULL auto_increment,
  `date_n` int unsigned NOT NULL DEFAULT '0',
  `seq_n` int unsigned NOT NULL DEFAULT '0',
  `mem_mn` int unsigned NOT NULL DEFAULT '0',
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  `mb_nick` varchar(255) NOT NULL DEFAULT '',
  `conti_n` smallint unsigned NOT NULL DEFAULT '0',
  `select_n` tinyint unsigned NOT NULL default '0',
  `cont_s` varchar(255) NOT NULL DEFAULT '',
  `attend_ip` varchar(255) NOT NULL DEFAULT '',
  `regi_time_n` int unsigned NOT NULL default '0',
  PRIMARY KEY  (`num`),
  UNIQUE KEY `dat_mn` (`date_n`, `mem_mn`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------
