<?php

if ( !defined("#_JEXEC_#") ){
    echo "<a style = 'font-size: 100px;' href = 'index.php'> Quay lại trang chủ </a> ";
    die;
}

class CategoriesController {
  private $model;

  private $file;

  private $type;

  private $currentPage;

  private $maxPage;

  private $content;

  private $search;

  private $message;

  private $LimitPerPage;

  private $id_cat;

  public function __construct()
  {
        include("app/models/CategoriesModel.php");
        $this->model = new CategoriesModel();
  }

  public function showCreate()
  {
        $this->file = "create";
        $this->display();
  }

  public function create()
  {
        if ( !isset( $_POST[ 'name' ] ) ) $this->message = Config::GetConfig("errorName");
        else{
            $name = $_POST['name'] ;
            $description = isset( $_POST[ 'description' ] ) ? $_POST['description'] : Config::GetConfig("empty");
            $status = isset( $_POST[ 'status' ] ) ? $_POST[ 'status' ] : "publish";

            $this->model->create( $name, $description, $status ) ;
            $this->message = Config::GetConfig("successAddCategory");
        }
        
        $this->read();
  }

  public function read($params = array() )
  {
  
        
        $currentPage = isset( $params[ 'currentPage' ] ) ? $params[ 'currentPage' ] : 1 ;
        $search = isset( $_POST[ 'search' ] ) ? $_POST[ 'search' ] : "" ;
        if ( isset( $params[ 'search' ] ) ) $search = $params[ 'search' ];
        $Filter = $this->model->Filter( $search ) ;

        $this->currentPage = $currentPage ;
        $this->search = $search ;
        $this->maxPage = $this->model->Count( "page", $Filter ) ;
        $this->content = $this->model->read( $currentPage, $Filter ) ;
        $this->file = "read";
        $this->LimitPerPage = Config::GetConfig("LimitPerPage");  

        $this->display();
  }

  public function showUpdate($params = array() )
  {
        $this->content = $this->model->readDetail( $params[ 'id' ] ) ;
        $this->file = "update";
        $this->display();
  }

  public function update($params = array() )
  {
        
        if ( !isset( $params['id'] ) ) $this->message = Config::GetConfig( "errorID" );
        else if ( !isset( $_POST[ 'name' ] )  ){
            $this->message = Config::GetConfig( "errorName" );
        }
        else{
            $ID =  $params[ 'id' ] ;
            $name =  $_POST[ 'name' ] ;
            $description = isset( $_POST[ 'description' ] ) ? $_POST[ 'description' ] : Config::GetConfig("empty");
            $status = isset( $_POST[ 'status' ] ) ? $_POST[ 'status' ] : "publish" ;

            $this->model->update( $ID, $name, $description, $status );
            $this->message = Config::GetConfig("successUpdateCategory");
        }
        
        $this->read();
  }

  public function delete()
  {
        if ( isset( $_GET['id'] ) ) {
            $ID =  $_GET['id']  ;
            if ( $ID != Config::GetConfig("defaultCategory") ){
                $this->model->delete( $ID );
                $this->message = Config::GetConfig("successDeleteCategory");
            }
            else $this->message = Config::GetConfig("defaultCategoryDelete");
        }
        else $this->message = Config::GetConfig( "errorID" );

        $this->read();
  }

  private function display()
  {
        $this->file ="Categories/$this->file";
        session_start();
        if ( empty($_SESSION['back_link']) ) $this->back_link="http://".$_SERVER['HTTP_HOST'];
        else $this->back_link = $_SESSION['back_link'];
        $_SESSION['back_link'] = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        include("app/views/index.php");
  }

}


?>