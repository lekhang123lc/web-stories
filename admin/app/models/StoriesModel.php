<?php

if ( !defined("#_JEXEC_#") ){
    echo "<a style = 'font-size: 100px;' href = 'index.php'> Quay lại trang chủ </a>";
    die;
}

class StoriesModel {
  private $db;

  private $tableStories;

  private $tableCategoryStory;

  private $limitPerPage;

  public function __construct()
  {
        require_once("app/models/DataBase.php");
        $this->db = DataBase::getInstance();
        $this->tableCategoryStory = Config::GetConfig("tableCategoryStory");
        $this->tableStories = Config::GetConfig("tableStories");  
        $this->LimitPerPage = Config::GetConfig("limitPerPage");  
        
  }

  public function getMaxID()
  {
        $sql = "SELECT id FROM $this->tableStories ORDER BY id DESC LIMIT 0, 1";
        return $this->db->query( $sql, array(), "yes" );
  }

  public function create($id_cat, $name, $content, $feature_img, $status, $created_time, $created_user, $last_modified_time, $last_modified_user)
  {
        $sql = "insert into $this->tableStories( name, description, feature_img, status, 
                created_time, created_user, last_modified_time, last_modified_user ) values (?,?,?,?,?,?,?,?)";
        $this->db->query( $sql, array( $name, $content, $feature_img, $status, $created_time, $created_user, $last_modified_time, $last_modified_user ), "no" );
        
        $maxID = $this->getMaxID();
        $sql = "insert into $this->tableCategoryStory(id_cat, id_story) values(?,?)";
        $this->db->query( $sql, array( $id_cat, $maxID[0]['id'] ), "no" );
        return $maxID[0]['id'];
  }

  public function Filter($search = "")
  {
        $where = " where id_story = id ";

        if ( $search ) $where .= " and name like '%$search%' ";

        return $where;
  }

  public function Count($type, $where = "" )
  {
        $sql = "select count(id) as total from $this->tableStories, $this->tableCategoryStory $where " ;
        $total = $this->db->query( $sql, array(), "yes") ;
        $count = (int)$total[0]['total'] ;
        
        if ( $type == "count" ) return $count;
        else {
            $page = (int)( $count / $this->LimitPerPage );
            if ( $count % $this->LimitPerPage != 0 ) $page++;
            return $page;
        }
  }

  public function readDetail($ID)
  {
        $sql = " select * from $this->tableStories, $this->tableCategoryStory where id = ? ";
        return $this->db->query( $sql , array( $ID ), "yes" );
  }

  public function read($page = 1, $where = "" )
  {

        $count = $this->Count( "count" , $where );

        $start = ( $page - 1 ) * $this->LimitPerPage ;
        
        $sql = "select * from $this->tableCategoryStory,$this->tableStories $where limit $start , $this->LimitPerPage ";

        return $this->db->query( $sql, array(), "yes" );
  }

  public function update($id_cat, $ID, $name, $content, $feature_img, $status, $last_modified_time, $last_modified_user)
  {
        $sql = "update $this->tableCategoryStory set id_cat = ?, id_story = ? where id_story = ?";
        $this->db->query( $sql, array( $id_cat, $ID, $ID ), "no" );

        $sql = "update $this->tableStories set name = ?, description = ?, feature_img = ?, status = ?, last_modified_time = ?, last_modified_user = ? where id =? ";
        $this->db->query( $sql, array( $name, $content, $feature_img, $status, $last_modified_time, $last_modified_user, $ID ), "no" );
  }

  public function delete($ID)
  {
        $sql = "delete from $this->tableCategoryStory where id_story = ? ";
        $this->db->query( $sql, array( $ID ), "no" );

        $sql = "delete from $this->tableStories where id = ? ";
        $this->db->query( $sql, array( $ID ), "no" );
  }

}


?>