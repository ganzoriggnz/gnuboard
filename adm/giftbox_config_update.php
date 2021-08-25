<?php
$sub_menu = "700600";
include_once("./_common.php");

auth_check($auth[$sub_menu], "w");

check_demo();

check_admin_token();

$g5['title'] = "선물상자 설정";

$res = sql_fetch("select * from {$g5['giftbox_config_table']} limit 1");

if (!$res)
    $sql = "insert into ";
else
    $sql = "update ";

$sql = $sql."{$g5['giftbox_config_table']}
            set point_min_1		= '$point_min_1',
                 point_max_1		= '$point_max_1',
                 point_percent_1	= '$point_percent_1',
                 point_min_2		= '$point_min_2',
                 point_max_2		= '$point_max_2',
                 point_percent_2	= '$point_percent_2',
                 point_min_3		= '$point_min_3',
                 point_max_3		= '$point_max_3',
                 point_percent_3	= '$point_percent_3',
                 point_min_4		= '$point_min_4',
                 point_max_4		= '$point_max_4',
                 point_percent_4	= '$point_percent_4',
                 point_min_5		= '$point_min_5',
                 point_max_5		= '$point_max_5',
                 point_percent_5	= '$point_percent_5',
                 sale_limit			= '$sale_limit',
                 sale_percent		= '$sale_percent',
                 free_limit			= '$free_limit',
                 free_percent		= '$free_percent',
                 sorry_point			= '$sorry_point'";
sql_query($sql);

goto_url("./giftbox_config.php");
?>