<?php
$sql_common = " gr_id               = '$board['gr_id']',
                bo_subject          = '��ٱ���',
                bo_mobile_subject   = '��ٱ���',
                bo_device           = '{$_POST['bo_device']}',
                bo_admin            = '{$_POST['bo_admin']}',
                bo_list_level       = '2',
                bo_read_level       = '2',
                bo_write_level      = '2',
                bo_reply_level      = '5',
                bo_comment_level    = '2',
                bo_html_level       = '2',
                bo_link_level       = '2',
                bo_count_modify     = '{$_POST['bo_count_modify']}',
                bo_count_delete     = '{$_POST['bo_count_delete']}',
                bo_upload_level     = '2',
                bo_download_level   = '2',
                bo_read_point       = '0',
                bo_write_point      = '0',
                bo_comment_point    = '0',
                bo_download_point   = '0',
                bo_use_category     = '0',
                bo_category_list    = '',
                bo_use_sideview     = '0',
                bo_use_file_content = '0',
                bo_use_secret       = '2',
                bo_use_dhtml_editor = '0',
                bo_use_rss_view     = '0',
                bo_use_good         = '0',
                bo_use_nogood       = '0',
                bo_use_name         = '0',
                bo_use_signature    = '0',
                bo_use_ip_view      = '0',
                bo_use_list_view    = '0',
                bo_use_list_file    = '0',
                bo_use_list_content = '0',
                bo_use_email        = '0',
                bo_use_cert         = '',
                bo_use_sns          = '0',
                bo_table_width      = '99',
                bo_subject_len      = '60',
                bo_mobile_subject_len      = '30',
                bo_page_rows        = '15',
                bo_mobile_page_rows = '15',
                bo_new              = '24',
                bo_hot              = '100',
                bo_image_width      = '600',
                bo_skin             = 'basket',
                bo_mobile_skin      = 'basket',
                bo_include_head     = '_head.php',
                bo_include_tail     = '_tail.php',
                bo_content_head     = '',
                bo_content_tail     = '',
                bo_mobile_content_head     = '',
                bo_mobile_content_tail     = '',
                bo_insert_content   = '',
                bo_gallery_cols     = '4',
                bo_gallery_width    = '',
                bo_gallery_height   = '',
                bo_mobile_gallery_width = '',
                bo_mobile_gallery_height= '',
                bo_upload_count     = '0',
                bo_upload_size      = '0',
                bo_reply_order      = '1',
                bo_use_search       = '1',
                bo_order            = '1',
                bo_write_min        = '0',
                bo_write_max        = '0',
                bo_comment_min      = '0',
                bo_comment_max      = '0',
                bo_sort_field       = '',
                bo_1_subj           = '',
                bo_2_subj           = '',
                bo_3_subj           = '',
                bo_4_subj           = '',
                bo_5_subj           = '',
                bo_6_subj           = '',
                bo_7_subj           = '',
                bo_8_subj           = '',
                bo_9_subj           = ''',
                bo_10_subj          = '',
                bo_1                = '',
                bo_2                = '',
                bo_3                = '',
                bo_4                = '',
                bo_5                = '',
                bo_6                = '',
                bo_7                = '',
                bo_8                = '',
                bo_9                = '',
                bo_10               = '' ";

    $row = sql_fetch(" select count(*) as cnt from g5_board where bo_table = '{$bo_table}' ");
    if ($row['cnt'])
        alert($bo_table.' ��(��) �̹� �����ϴ� TABLE �Դϴ�.');

    $sql = " insert into g5_board
                set bo_table = '{$bo_table}',
                    bo_count_write = '0',
                    bo_count_comment = '0',
                    $sql_common ";
    sql_query($sql);

    $file = file('./sql_write.sql');
    $sql = implode($file, "\n");

    $create_table = $g5['write_prefix'] . $bo_table;

    // sql_board.sql ������ ���̺����� ��ȯ
    $source = array('/__TABLE_NAME__/', '/;/');
    $target = array($create_table, '');
    $sql = preg_replace($source, $target, $sql);
    sql_query($sql, FALSE);
 ?>