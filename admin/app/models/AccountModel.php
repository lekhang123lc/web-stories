<?php

if ( !defined("#_JEXEC_#") ){
    echo "<a style = 'font-size: 100px;' href = 'index.php'> Quay lại trang chủ </a> ";
    die;
}


class AccountModel{

    private $db;
    private $tableAccount;

    public function __construct(){
        require_once("app/models/DataBase.php");
        $this->db = DataBase::getInstance();
        $this->tableAccount = Config::GetConfig("tableAccount");
    }

    public function getPass( $username ){
        $sql = "SELECT id, password from $this->tableAccount where username = ?";
        $table = $this->db->query($sql, array( $username ), "yes");
        if ( !empty( $table[0] ) ) return $table[0];
        else return "";
    }

    public function getUser( $ID ){
        $sql = "SELECT username from $this->tableAccount where id = ?";
        $table = $this->db->query($sql, array( $ID ), "yes");
        if ( !empty( $table[0] ) ) return $table[0];
        else return "";
    }

}

?>
