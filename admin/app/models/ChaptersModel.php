<?php

if ( !defined("#_JEXEC_#") ){
    echo "<a style = 'font-size: 100px;' href = 'index.php'> Quay lại trang chủ </a>";
    die;
}
class ChaptersModel {
  private $db;

  private $tableChapters =  "chapters";

  public function __construct()
  {

        require_once("app/models/DataBase.php");
        $this->db = DataBase::getInstance();
  }

  public function getMaxID()
  {

        $sql = "SELECT id FROM $this->tableChapters ORDER BY id DESC LIMIT 0, 1";
        return $this->db->query( $sql, array(), "yes" );
  }

  public function create($name, $content, $id_story, $created_time, $created_user, $last_modified_time, $last_modified_user)
  {

        $sql = "insert into $this->tableChapters( name, content, id_story, 
                created_time, created_user, last_modified_time, last_modified_user ) values (?,?,?,?,?,?,?)";

        $this->db->query( $sql, array( $name, $content, $id_story, $created_time, $created_user, $last_modified_time, $last_modified_user ), "no" );
  }

  public function Filter($search = "")
  {

        $where = " where id_story = id ";

        if ( $search ) $where .= " and name like '%$search%' ";

        return $where;
  }

  public function Count($type, $where = "" )
  {

        $sql = "select count(id) as total from $this->tableChapters $where " ;
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

        $sql = " select * from $this->tableChapters where id = ? ";
        return $this->db->query( $sql , array( $ID ), "yes" );
  }

  public function read($id)
  {

        
        $sql = "select `id`,`name` from $this->tableChapters where `id_story` = $id order by `last_modified_time` desc";

        return $this->db->query( $sql, array(), "yes" );
  }

  public function update($id_story, $ID, $name, $content, $last_modified_time, $last_modified_user)
  {


        $sql = "update $this->tableChapters set name = ?, content = ?, id_story = ?, last_modified_time = ?, last_modified_user = ? where id =? ";
        $this->db->query( $sql, array( $name, $content, $id_story, $last_modified_time, $last_modified_user, $ID ), "no" );
  }

  public function delete($ID)
  {


        $sql = "delete from $this->tableChapters where id = ? ";
        $this->db->query( $sql, array( $ID ), "no" );
  }

}



?>