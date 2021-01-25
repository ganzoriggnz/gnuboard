<?php
$sub_menu = "300850";
include_once('./_common.php');
include_once(G5_LIB_PATH."/board_manage_etc_list.class.php");

auth_check($auth[$sub_menu], 'w');

//die($bo_table.'/'.$wr_id.'/'.$what.'/'.$val);

//점검
if(!$bo_table) die('200');
if(!$wr_id) die('201');
if(!in_array($what,array('wr_datetime','wr_last','wr_hit'))) die('202');

//설정
$board_manage_etc_list = new board_manage_etc_list;
$board_manage_etc_list->set_bo_table($bo_table);

//변경
unset($opt);
$opt['wr_id'] = $wr_id;
$opt[$what] = $val;
$board_manage_etc_list->write($opt);

//성공
die('200');