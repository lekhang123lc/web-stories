<?php

if ( !defined("#_JEXEC_#") ){
    echo "<a style = 'font-size: 100px;' href = 'index.php'> Quay lại trang chủ </a> ";
    die;
}

require_once("app/models/DataBase.php");
class CategoriesModel{

    public static $instance = null;
    private $tableCategories;
    private $db;

    public function __construct(){
        $this->db = Database::getInstance();
        $this->tableCategories = Config::GetConfig("tableCategories");
    }

    public function getInstance(){
        if ( self::$instance == null ) self::$instance = new CategoriesModel;
        return self::$instance;
    }

    public function readList( $limit ){
        $sql = "select * from $this->tableCategories limit $limit";
        return $this->db->query( $sql, array(), "yes" );
    }

    public function readDetail( $ID ){
        $sql = "select * from $this->tableCategories where id = $ID";
        return $this->db->query( $sql, array(), "yes" );
    }

}

?>