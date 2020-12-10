<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

/*************************************************/
// 달력
$today  = date('Y-m-d'); // 오늘
$date   = !preg_match('/^[\d]{4}\-[\d]{2}\-[\d]{2}$/', $_GET['date']) ? $today : $_GET['date'];
$d      = explode('-', $date);
$_y     = $d[0];
$_m     = $d[1];
$_d     = $d[2];
$_days  = date('t', strtotime("{$_y}-{$_m}-01")); // Number of days in the given month

// qstr 재정의
$qstr = preg_replace('#(&amp;)?date=[^\&]*#', '', $qstr);
$qstr = ($qstr ? $qstr.'&amp;' : '').'date='.$date;
/*************************************************/
