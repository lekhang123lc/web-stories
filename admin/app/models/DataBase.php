<?php

if ( !defined("#_JEXEC_#") ){
    echo "<a style = 'font-size: 100px;' href = 'index.php'> Quay lại trang chủ </a>";
    die;
}

class DataBase {
  private $conn;

  private $dbname;

  private $hostname;

  private $username;

  private $password;

  private static $instance =  null;

  public function __construct()
  {
        $this->dbname = Config::GetConfig( "dbname" );
        $this->hostname = Config::GetConfig( "hostname" );
        $this->username = Config::GetConfig( "username" );
        $this->password = Config::GetConfig( "password" );

        $this->connect();
  }

  private function connect()
  {
        $this->conn = new PDO("mysql:host=$this->hostname;dbname=$this->dbname", $this->username, $this->password);
  }

  public function __destruct()
  {
        $this->close();
  }

  private function close()
  {
        $this->conn = null;
  }

  public function getInstance()
  {
  
        if ( self::$instance == null ) self::$instance = new DataBase;
        return self::$instance;
  }

  public function query($sql, $data = array(), $return)
  {
        $select = $this->conn->prepare($sql);
        $select->setFetchMode(PDO::FETCH_ASSOC);
        $select->execute($data);
        if ( $return == "yes" ) return $select->fetchAll();
  }

}


?>