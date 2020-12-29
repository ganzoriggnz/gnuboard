<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_PLUGIN_PATH."/db/db.class.php");

define('G5_FOLLOW_MEMBER_DIR',        'follow_member');
define('G5_FOLLOW_MEMBER_URL',        G5_PLUGIN_URL.'/'.G5_FOLLOW_MEMBER_DIR);
define('G5_FOLLOW_MEMBER_PATH', G5_PLUGIN_PATH.'/'.G5_FOLLOW_MEMBER_DIR);
define('G5_FOLLOW_MEMBER_IMG_URL',        G5_FOLLOW_MEMBER_URL.'/img');

define('G5_FOLLOW_MEMBER_RUN',  true);  //follow_member 사용여부  true, false

/********************************************************************************
테이블 상수
********************************************************************************/
define("FRIEND", "friend");

class Follow_member{
	var $member = null;
	var $g5 = null;
	var $mylevel = null;
	var $is_member = null;
  var $css = null;
  var $db = null;

	function __construct(){
		$this->Follow_member();
	}

	function __destruct(){
	}

	function Follow_member(){
		$this->init();
	}

  function init(){
		global $member;
		global $g5;
		global $is_member;

		//초기화작업
		$this->member = $member;
		$this->g5 = $g5;
		$this->is_member = $is_member;

    $this->make_table();
    $this->set_css(G5_FOLLOW_MEMBER_URL.'/follow_member.css');
    $this->db = new db();
	}

  function set_css($css){
    $this->css = '<link rel="stylesheet" href="'.$css.'">';
  }
  function get_css(){
      return $this->css;
  }

  function make_table(){
    // 사용옵션타입선택
    if(!sql_query(" desc ".FRIEND , false)) {
        $que = "
                        create table friend(
                      	f_idx int not null auto_increment,
                      	followers varchar(20) not null default '' comment '내가 추가한 친구',
                      	followersdate datetime default '0000-00-00 00:00:00' comment '내가 추가한 친구 날짜',
                      	followersyn char(1) not null default 'N' comment '내가 추가한 친구 수락 여부 : 수락 Y , 취소 N',
                      	following varchar(20) not null default '' comment '나를 추가한 친구',
                      	followingdate datetime default '0000-00-00 00:00:00' comment '나를 추가한 친구 날짜',
                      	followingyn char(1) not null default 'Y' comment '나를 추가한 친구 수락 여부 : 수락 Y , 취소 N',
                      	primary key( f_idx ),
                      	index friend_index1(followers),
                      	index friend_index2(following),
                      	unique friend_unique1(followers, following)
                      	);
                ";
        sql_query( $que , true );
    }
  }

  function get_follow_photo_display($count=5, $mb_level="2,3,4,5,6,26,27,30"){

  	$str = '<ul class="randprofil_box">'.PHP_EOL;
  			$arrphoto = $this->get_follow_photo($count, $mb_level);
  			foreach( $arrphoto as $key => $val ){
  				if( $val['photo'] ){
  					$img = '<img src="'.$val['photo'].'" class="img">';
  				}else{
  					$img = '<span class="img"></span>';
  				}

  				$str .= '<li class="oneprofil">'.PHP_EOL;
  				$str .= '	<span class="prof_photo"><span class="prof_photo"><a href="'.G5_BBS_URL.'/board.php?bo_table=mypage&sfl=mb_id&stx='.$val['mb_id'].'">'.$img.'</a></span></span>'.PHP_EOL;
  				$str .= '	<span class="prof_follow"><a href="'.G5_FOLLOW_MEMBER_URL.'/setfollowers.php?rec_id='.$val['mb_id'].'&'.$_SERVER['QUERY_STRING'].'">'.$val['mb_name'].'</a></span>'.PHP_EOL;
  				$str .= '	<span class="prof_follow1"><a href="'.G5_FOLLOW_MEMBER_URL.'/setfollowers.php?rec_id='.$val['mb_id'].'&'.$_SERVER['QUERY_STRING'].'">Follow</a></span>'.PHP_EOL;
  				$str .= '</li>'.PHP_EOL;
  			}
  	$str .= '</ul>'.PHP_EOL;

  	return $str;
  }

  //회원사진 가져오기
  function get_follow_photo($count=5, $mb_level="2,3,4"){
  	$que = "select a.mb_id, a.mb_name
  	from ".$this->g5['member_table']." a
  	where a.mb_id != '".$this->member['mb_id']."' and a.mb_id != 'admin' and length(a.mb_id) > 0 and a.mb_level in ($mb_level)
  	and a.mb_id not in (select followers from ".FRIEND." where following = '".$member['mb_id']."')
  	order by rand() limit $count";
  	$r = sql_query( $que );

  	$arr = array();

  	for($i=0; $f = sql_fetch_array( $r ); $i++ ){
  		$mb_dir = G5_DATA_URL.'/member/'.substr($f['mb_id'],0,2);
  		$mb_path = G5_DATA_PATH.'/member/'.substr($f['mb_id'],0,2);
  		$arr[$i]['mb_id'] = $f['mb_id'];
  		$arr[$i]['mb_name'] = $f['mb_name'];



  		$arr_ext = array("jpg","JPG","png","PNG","gif","GIF");
  		foreach( $arr_ext as $key => $val ){
  			if( file_exists( $mb_path."/".$f['mb_id'].".".$val )){
  				$arr[$i]['photo'] = $mb_dir."/".$f['mb_id'].".".$val;
  			}
  		}

  		if(!$arr[$i]['photo']){
  			$arr[$i]['photo'] = G5_FOLLOW_MEMBER_IMG_URL."/noimage.png";
  		}
  	}

  	return $arr;
  }

  //친구목록
  function get_friend_list($following="",$followers="", $from_record=0, $rows=10, $followingyn=0, $followersyn=0){
  	$column = " a.* ";
  	$where = " 1 ";
  	if( $following ) {
  		$where .= " and a.following = '$following' ";
  		$column .= " , b.mb_name as followers_name ";
  		$orderby = " b.mb_name ";

  		if( $followingyn ) $where .= " and followingyn = '$followingyn' ";
  	}

  	if( $followers ){
  		$where .= " and a.followers = '$followers' ";
  		$column .= " , c.mb_name as following_name ";
  		$orderby = " c.mb_name ";

  		if( $followersyn ) $where .= " and followersyn = '$followersyn' ";
  	}

  	$que = "select $column from ".FRIEND." a ";
  	if( $following )
  	$que .= " left join ".$this->g5['member_table']." b on a.followers = b.mb_id ";
  	if( $followers )
  	$que .= " left join ".$this->g5['member_table']." c on a.following = c.mb_id ";

  	$que .= " where $where order by $orderby asc limit $from_record, $rows";
  	$r = sql_query( $que );
    echo $que;
  	$arr = array();

  	for($i=0; $f = sql_fetch_array( $r ); $i++ ){
  		$followers_dir = G5_DATA_URL.'/member/'.substr($f['followers'],0,2);
  		$followers_path = G5_DATA_PATH.'/member/'.substr($f['followers'],0,2);

  		$following_dir = G5_DATA_URL.'/member/'.substr($f['following'],0,2);
  		$following_path = G5_DATA_PATH.'/member/'.substr($f['following'],0,2);


  		$arr[$i]['f_idx'] = $f['f_idx'];
  		$arr[$i]['followers'] = $f['followers'];
  		$arr[$i]['followersdate'] = $f['followersdate'];
  		$arr[$i]['followersyn'] = $f['followersyn'];
  		$arr[$i]['following'] = $f['following'];
  		$arr[$i]['followingdate'] = $f['followingdate'];
  		$arr[$i]['followingyn'] = $f['followingyn'];
  		$arr[$i]['following_name'] = $f['following_name'];
  		$arr[$i]['followers_name'] = $f['followers_name'];

  		if( file_exists( $following_path."/".$f['following'].".JPG" )){
  			$arr[$i]['following_photo'] = $following_dir."/".$f['following'].".JPG";
  		}

  		if( file_exists( $followers_path."/".$f['followers'].".JPG" )){
  			$arr[$i]['followers_photo'] = $followers_dir."/".$f['followers'].".JPG";

  		}
  	}


  	return $arr;
  }


  function get_friend_both_list($from_record=0, $rows=10){

  	$que = "select * from ".FRIEND."
  		where ( followers = '".$this->member['mb_id']."'
  		or following = '".$this->member['mb_id']."' ) order by f_idx desc limit $from_record, $rows
  	";

  	$r = sql_query( $que );

  	$arr = array();

  	for($i=0; $f = sql_fetch_array( $r ); $i++ ){
  		$arr[$i]['f_idx'] = $f['f_idx'];
  		$arr[$i]['followers'] = $f['followers'];
  		$arr[$i]['followersdate'] = $f['followersdate'];
  		$arr[$i]['followersyn'] = $f['followersyn'];
  		$arr[$i]['following'] = $f['following'];
  		$arr[$i]['followingdate'] = $f['followingdate'];
  		$arr[$i]['followingyn'] = $f['followingyn'];

  		//자기 자신은 데이터에 넣지 마라.
  		if( $f['followers'] == $this->member['mb_id'] ){
  			$following_dir = G5_DATA_URL.'/member/'.substr($f['following'],0,2);
  			$following_path = G5_DATA_PATH.'/member/'.substr($f['following'],0,2);
  			if( file_exists( $following_path."/".$f['following'].".JPG" )){
  				$arr[$i]['friendphoto'] = $following_dir."/".$f['following'].".JPG";
  			}else{
  				$arr[$i]['friendphoto'] = G5_FOLLOW_MEMBER_IMG_URL."/noimage.png";
  			}


  			$mb = get_member($f['following'], 'mb_name');

  			$arr[$i]['friendname'] = $mb['mb_name'];
  			$arr[$i]['friendid'] = $f['following'];

  		}elseif($f['following'] == $this->member['mb_id']){
  			$followers_dir = G5_DATA_URL.'/member/'.substr($f['followers'],0,2);
  			$followers_path = G5_DATA_PATH.'/member/'.substr($f['followers'],0,2);
  			if( file_exists( $followers_path."/".$f['followers'].".JPG" )){
  				$arr[$i]['friendphoto'] = $followers_dir."/".$f['followers'].".JPG";
  			}else{
  				$arr[$i]['friendphoto'] = G5_FOLLOW_MEMBER_IMG_URL."/noimage.png";
  			}

  			$mb = get_member($f['followers'], 'mb_name');
  			$arr[$i]['friendname'] =  $mb['mb_name'];
  			$arr[$i]['friendid'] = $f['followers'];
  		}

  		//follower가 친구 수락 여부
  		if( $arr[$i]['followers'] == $this->member['mb_id'] && $arr[$i]['followersyn']  == "N"){
  			$arr[$i]['acceptyn'] = "N";
  		}elseif($arr[$i]['followers'] == $this->member['mb_id'] && $arr[$i]['followersyn']  == "Y"){
  			$arr[$i]['acceptyn'] = "Y";
  		}

  		//채팅가느여부
  		if( $arr[$i]['followersyn']  == "Y" && $arr[$i]['followingyn']  == "Y"){
  			$arr[$i]['chatyn'] = "Y";
  		}
  	}

  	return $arr;
  }

  function insert_friend_table($arrset, $debug=false){
    return $this->db->insert_table( 'FRIEND', $arrset, $debug );
  }

  function select_friend_one_table($arrwhere, $column="*"){
    return $this->db->select_one_table('FRIEND', $arrwhere, $column);
  }

  function update_friend_table($arrset, $arrwhere="", $debug=false){
    return $this->update_table( 'FRIEND', $arrset, $arrwhere, $debug );
  }


  function delete_friend($friendid=""){
    if( $friendid ){
  		$f = $this->get_one_friend($friendid);
  		if( $f['f_idx'] ){
  		$que = "delete from ". FRIEND. " where f_idx = '{$f['f_idx']}'";
  			sql_query( $que );
  		}
  	}
  }

  function get_one_friend($friendid=""){
  	$arr = array();
  	if( $friendid ){
  		$que = "select f_idx, followers, following from ".FRIEND."
  			where ( followers = '".$this->member['mb_id']."' and following = '$friendid' ) or (
  			followers = '$friendid' and  following = '".$this->member['mb_id']."' )
  		";
  		$f = sql_fetch( $que );

  		$arr['f_idx'] = $f['f_idx'];
  		$arr['followers'] = $f['followers'];
  		$arr['following'] = $f['following'];
  	}

  	return $arr;
  }
}
$follow_member = new Follow_member();
?>
