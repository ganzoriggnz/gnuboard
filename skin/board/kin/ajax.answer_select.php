<<<<<<< HEAD
<?php
include_once($_SERVER["DOCUMENT_ROOT"].'/common.php');
header('Content-Type: text/plain; charset=utf-8');

$wr_id = $_GET['wr_id'];
$comment_id = $_GET['comment_id'];
$c_mb_id = $_GET['c_mb_id'];
$bo_table = $_GET['bo_table'];
$write_table = 'g5_write_'.$bo_table;

$sql = " select * from {$g5['member_table']} where mb_id = TRIM('$c_mb_id') ";
$c_member = sql_fetch($sql);

if($c_member['mb_id'] && $comment_id && $c_mb_id) 
{
	sql_query(" update $write_table set wr_2 = '1' where wr_id = '$comment_id' "); //ä�ô亯 �ڸ�Ʈ �Ϸ��߰�
	sql_query(" update $write_table set wr_2 = '1' where wr_id = '$wr_id' "); //ä�ô亯 �Խù� �Ϸ� �߰�
		
	$res = sql_fetch(" select wr_1 from $write_table where wr_parent = '$wr_id' "); //ä�� ����Ʈ   

	
	///////////  �亯 ä�ý� ���� ����Ʈ ���� ///////////

	$wr_1 = $res['wr_1']; //���� ����Ʈ 
	$mb_point = $c_member['mb_point'] + $res['wr_1'];  //����Ʈ �հ�

	//����Ʈ ���̺� �߰� 
	$sql = " insert into $g5[point_table] 
			set mb_id = '$c_member[mb_id]', 
			po_datetime = '".G5_TIME_YMDHIS."', 
			po_content = '$wr_id-������ �亯ä�� ����Ʈ ȹ��',
			po_point = '$wr_1', 
			po_mb_point = '$mb_point',  
			po_rel_table = '$bo_table', 
			po_rel_id = '$wr_id',
			po_rel_action = '������ �亯ä��' 
		"; 
	sql_query($sql); 

	//��� ���̺� ����Ʈ ������Ʈ  
	sql_query(" update $g5[member_table] set mb_point = '$mb_point' where mb_id = '$c_member[mb_id]' ");
}

echo 'TRUE';
?>
=======
<?php
include_once($_SERVER["DOCUMENT_ROOT"].'/common.php');
header('Content-Type: text/plain; charset=utf-8');

$wr_id = $_GET['wr_id'];
$comment_id = $_GET['comment_id'];
$c_mb_id = $_GET['c_mb_id'];
$bo_table = $_GET['bo_table'];
$write_table = 'g5_write_'.$bo_table;

$sql = " select * from {$g5['member_table']} where mb_id = TRIM('$c_mb_id') ";
$c_member = sql_fetch($sql);

if($c_member['mb_id'] && $comment_id && $c_mb_id) 
{
	sql_query(" update $write_table set wr_2 = '1' where wr_id = '$comment_id' "); //ä�ô亯 �ڸ�Ʈ �Ϸ��߰�
	sql_query(" update $write_table set wr_2 = '1' where wr_id = '$wr_id' "); //ä�ô亯 �Խù� �Ϸ� �߰�
		
	$res = sql_fetch(" select wr_1 from $write_table where wr_parent = '$wr_id' "); //ä�� ����Ʈ   

	
	///////////  �亯 ä�ý� ���� ����Ʈ ���� ///////////

	$wr_1 = $res['wr_1']; //���� ����Ʈ 
	$mb_point = $c_member['mb_point'] + $res['wr_1'];  //����Ʈ �հ�

	//����Ʈ ���̺� �߰� 
	$sql = " insert into $g5[point_table] 
			set mb_id = '$c_member[mb_id]', 
			po_datetime = '".G5_TIME_YMDHIS."', 
			po_content = '$wr_id-������ �亯ä�� ����Ʈ ȹ��',
			po_point = '$wr_1', 
			po_mb_point = '$mb_point',  
			po_rel_table = '$bo_table', 
			po_rel_id = '$wr_id',
			po_rel_action = '������ �亯ä��' 
		"; 
	sql_query($sql); 

	//��� ���̺� ����Ʈ ������Ʈ  
	sql_query(" update $g5[member_table] set mb_point = '$mb_point' where mb_id = '$c_member[mb_id]' ");
}

echo 'TRUE';
?>
>>>>>>> 8e856fb351392b4b7cb50a4ad55a13eb8eac225b
