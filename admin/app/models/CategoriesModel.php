<?php

if ( !defined("#_JEXEC_#") ){
    echo "<a style = 'font-size: 100px;' href = 'index.php'> Quay lại trang chủ </a>";
    die;
}

class CategoriesModel{

    private $db;
    private $tableCategories;
    private $tableCategoryStory;
    private $LimitPerPage;

    public function __construct(){
        require_once("app/models/DataBase.php");

        $this->db = DataBase::getInstance();
        $this->tableCategories = Config::GetConfig("tableCategories");  
        $this->tableCategoryStory = Config::GetConfig("tableCategoryStory");
        $this->LimitPerPage = Config::GetConfig("limitPerPage");  
    }

    public function create( $name , $description, $status ){
        $sql = "insert into $this->tableCategories( name, description, status ) values (?,?,?)";
        $this->db->query( $sql, array( $name, $description, $status ), "no" );

    }

    public function Filter( $search = ""){
        $where = "";

        if ( $search ) $where = " where name like '%$search%' ";

        return $where;
    }

    public function Count( $type, $where = "" ){
        $sql = "select count(id) as total from $this->tableCategories $where " ;
        $total = $this->db->query( $sql, array(), "yes") ;
        $count = (int)$total[0]['total'] ;
        if ( $type == "count" ) return $count;
        else {
            $page = (int)( $count / $this->LimitPerPage );
            if ( $count % $this->LimitPerPage != 0 ) $page++;
            return $page;
        }
    }

    public function readDetail( $ID ){
        $sql = " select * from $this->tableCategories where id = ? ";
        return $this->db->query( $sql , array( $ID ), "yes" );
    }

    public function read( $page = 1, $where = "" ){

        $count = $this->Count( "count" , $where );

        $start = ( $page - 1 ) * $this->LimitPerPage ;
        
        $sql = "select * from $this->tableCategories $where limit $start , $this->LimitPerPage ";

        return $this->db->query( $sql, array(), "yes" );
    }

    public function readAll(){
        
        $sql = "select id,name from $this->tableCategories ";

        return $this->db->query( $sql, array(), "yes" );
    }

    public function update( $ID, $name, $description, $status ){
        $sql = "update $this->tableCategories set name = ?, description = ?, status = ? where id = ? ";
        $this->db->query( $sql , array( $name, $description, $status, $ID ), "no" );
    }

    public function delete( $ID ){
        $sql = "update $this->tableCategoryStory set id_cat = ? where id_cat = ? ";
        $this->db->query( $sql, array( 1, $ID ), "no" );
        $sql = "delete from $this->tableCategories where id = ? ";
        $this->db->query( $sql, array($ID), "no" );
    }
}

?>