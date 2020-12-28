<?php
include_once('./_common.php');
class DB{
  function insert_table($table, $arrset, $debug=false){
    $set = " set ";
    if( is_array( $arrset) ){
      $set .= $this->arrToAnd( $arrset, "," );
    }

    //if( $table && is_array($arrwhere) && is_array($arrset) ){
    if( $table && is_array($arrset) ){
      $que = "insert into $table $set ";
      if( $debug )  echo $que."<br />";
      sql_query( $que );

    }

    return $this->sql_affected_rows();
  }


  function update_table($table, $arrset, $arrwhere="", $debug=false){
    $where = " where 1 ";

    if( is_array( $arrwhere) ){
      $where .= " and ". $this->arrToAnd( $arrwhere );
    }

    $set = " set ";
    if( is_array( $arrset) ){
      $set .= $this->arrToAnd( $arrset, "," );
    }

    //if( $table && is_array($arrwhere) && is_array($arrset) ){
    if( $table && is_array($arrset) ){
      $que = "update $table $set $where ";
      if( $debug )  echo $que."<br />";
      sql_query( $que );

    }

    return $this->sql_affected_rows();
  }

  function delete_table($table, $arrwhere="", $debug=false){
    $where = " where 1 ";

    if( is_array( $arrwhere) ){
      $where .= " and ". $this->arrToAnd( $arrwhere );
    }

    if( $table ){
      $que = "delete from $table $where ";
      if( $debug )  echo $que."<br />";
      sql_query( $que );
    }

    return $this->sql_affected_rows();
  }

  function select_one_table($table, $arrwhere, $column="*"){
    $where = " where 1 ";

    if( is_array( $arrwhere) ){
      $where .= " and ". $this->arrToAnd( $arrwhere );
    }

    if( $table ){
      $que = "select ".$column." from $table $where ";
      if( $debug )  echo $que."<br />";
      sql_fetch( $que );
    }
  }
  function sql_affected_rows($link=null)
  {
      global $g5;

      if(!$link)
          $link = $g5['connect_db'];

      if(function_exists('mysqli_affected_rows') && G5_MYSQLI_USE)
          return mysqli_affected_rows($link);
      else
          return mysql_affected_rows($link);
  }
  function arrToAnd($arr, $operation="and"){
      $arrstr = array();
      foreach( $arr as $key => $val ){

        if( preg_match( "@_NUM@", $key) ){
          $key = str_replace("_NUM", "", $key);
          $arrstr[]   =   $key ."=".$val;
        }else{
          $arrstr[]   =   $key ."= '".$val."'";
        }
      }
      $str = "";
      if( is_array($arr) && count($arrstr) ){
        $str = implode(" ".$operation." ", $arrstr);
      }

      return $str;
  }
}
?>
