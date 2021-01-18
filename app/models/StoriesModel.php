<?php

if ( !defined("#_JEXEC_#") ){
    echo "<a style = 'font-size: 100px;' href = 'index.php'> Quay lại trang chủ </a> ";
    die;
}

require_once("app/models/DataBase.php");

class StoriesModel {
  public static $instance =  null;

  private $tableStories;

  private $tableCategoryStory;

  private $db;

  public function __construct()
  {
        $this->db = Database::getInstance();
        $this->tableStories = Config::GetConfig("tableStories");
        $this->tableCategoryStory = Config::GetConfig("tableCategoryStory");
  }

  public function getInstance()
  {
        if ( self::$instance == null ) self::$instance = new StoriesModel;
        return self::$instance;
  }

  public function Filter($id_cat, $search = "", $from = "", $to = "" )
  {
        $where = " where id_story = `stories`.id ";
        if ( $id_cat ) $where .= " and id_cat = $id_cat ";
        if ( $search ) $where .= " and name like '%$search%' ";
        if ( !$to ) $to = date("Y-m-d H:i:s");
        $where .= " and created_time between '$from' and '$to' ";
        return $where;
  }

  public function readListStories($limit, $Filter, $page = 1 )
  {
        $start = ( (int)$page - 1 ) * (int)$limit;
        $sql = "select id, id_cat, name, feature_img, created_time from $this->tableStories, $this->tableCategoryStory 
                $Filter limit $start,$limit";
        return $this->db->query( $sql, array(), "yes" );
  }

  public function Count($type, $Filter = "", $limit = 1)
  {
        $sql = "select count(id) as total from $this->tableStories, $this->tableCategoryStory 
                $Filter";
        $total = $this->db->query( $sql, array(), "yes") ;
        
        $count = (int)$total[0]['total'] ;
        if ( $type == "count" ) return $count;
        else {
            $page = (int)( $count / $limit );
            if ( $count % $limit != 0 ) $page++;
            return $page;
        }
  }

  public function readDetailStory($ID)
  {
        $sql = "select * from $this->tableStories, $this->tableCategoryStory 
                where id_story = id and id = $ID";
        return $this->db->query( $sql, array(), "yes" );
  }

}


?>