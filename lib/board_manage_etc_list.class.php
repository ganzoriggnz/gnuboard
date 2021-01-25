<?php
class board_manage_etc_list {

	public $page		= 1;
	public $page_rows	= 10;
	public $orderby	= 'id desc';
    public $bo_table;
    public $write_table;
    public $g5;

	function __construct()
	{
        global $g5;
        $this->g5 = $g5;
	}

	public function set_bo_table($bo_table) {
        $this->bo_table=$bo_table;
        $this->write_table=$this->g5['write_prefix'].$bo_table;
	}

	//중복체크
	public function check($title)
	{
	}

	//등록 및 수정
	public function write($opt) {

        if(!$this->bo_table) return false;

		//등록 or 수정 체크
		$w = "";
		if($opt['wr_id']!='') {
			$w = "u";
            $wr_id = intval($opt['wr_id']);
		} else {

		}

		//처리
		if($w=="") {
			$q = "insert into ".$this->write_table." set ";
		} else {
			$q = "update ".$this->write_table." set ";
			unset($opt['wr_id']);
		}
		
		foreach($opt as $k=>$v){ 
			$q .= " ".$k." = '".$v."',";	
		}
		
		$q = substr($q,0,-1);

		if($w=='') {
			$q .= "";
		} else {
			$q .= " where wr_id='{$wr_id}'";
		}
		sql_query($q);

		//고유값 리턴
		if($w=='') {
            $wr_id = sql_insert_id();
		}

		return $wr_id;
	}

	//목록 가져와서 배열로 반환
	public function lists($opt) {
        if(!$this->bo_table) return false;

		$where = "";

		$field = " * ";
		if($opt['field']) $field = $opt['field'];

		$orderby = " id desc ";
		if($opt['orderby']) {
			$orderby = $opt['orderby'];
		} else {
			$orderby = $this->orderby;
		}
		if($opt['s_wr_id']) $where .= " and wr_id = '{$opt['s_wr_id']}' ";
		if($opt['sl_wr_subject']) $where .= " and wr_subject like '%{$opt['sl_wr_subject']}%' ";

		$q = "select {$field} from ".$this->write_table." where (1) {$where} ORDER BY {$orderby} ";

		//페이징
        $q_total = "select COUNT(*) as cnt from ".$this->write_table." where (1) {$where} ORDER BY {$orderby} ";
		$total_count_data = sql_fetch($q_total);
        $total_count = $total_count_data['cnt'];
		$total_page  = ceil($total_count / $this->page_rows);  // 전체 페이지 계산
		$page = ($this->page)? $this->page : 1;
		$from_record = ($page - 1) * $this->page_rows; // 시작 열을 구함

		//쿼리 생성
		$q .= " limit ".$from_record.", ".$this->page_rows;
		//echo $q.'<br>';
		
		//쿼리 실행
        $q_result = sql_query($q);
        $list = array();
        while($row = sql_fetch_array($q_result)) {
            $list[] = $row;
        }

        if($opt['simple_wr_content']) {
            if(count($list)) {
                foreach($list as $k => $v) {
                    $list[$k]['wr_content'] = strip_tags($v['wr_content']);
                    $list[$k]['wr_content'] = trim(preg_replace('/\s+/', '', $list[$k]['wr_content']));
                    $list[$k]['wr_content'] = cut_str($list[$k]['wr_content'],40);
                }
            }
        }

		$result['list'] = $list;
		$result['total_count'] = $total_count;
		$result['total_page'] = $total_page;

		return $result;
	}

	//전체 게시판 목록 불러오기
	public function getBoadList() {
        $q = "SELECT bo_table, bo_subject FROM ".$this->g5['board_table']." WHERE gr_id = 'attendance' ORDER BY bo_subject ASC ";
        $q_result = sql_query($q);
        $list = array();
        while($row = sql_fetch_array($q_result)) {
            $list[] = $row;
        }
        return $list;
    }
}
