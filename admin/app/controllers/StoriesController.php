<?php

if ( !defined("#_JEXEC_#") ){
    echo "<a style = 'font-size: 100px;' href = 'index.php'> Quay lại trang chủ </a> ";
    die;
}

class StoriesController {
  private $AccountModel;

  private $StoriesModel;

  private $CategoriesModel;

  private $ChaptersModel;

  private $file;

  private $type;

  private $currentPage;

  private $maxPage;

  private $content;

  private $categories;

  private $search;

  private $message;

  private $LimitPerPage;

  private $id_cat;

  private $back_link;

  public function __construct()
  {
        require_once("app/models/StoriesModel.php");
        $this->StoriesModel = new StoriesModel;
        require_once("app/models/CategoriesModel.php");
        $this->CategoriesModel = new CategoriesModel;
        require_once("app/models/AccountModel.php");
        $this->AccountModel = new AccountModel;
        require_once("app/models/ChaptersModel.php");
        $this->ChaptersModel = new ChaptersModel;
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
            $id_cat = isset( $_POST["id_cat"] ) ? $_POST["id_cat"] : 1;
            $name = $_POST['name'] ;
            $content = isset( $_POST[ 'description' ] ) ? $_POST['description'] : Config::GetConfig("empty");

            if ( isset( $_FILES["fileToUpload"]["name"] ) ){ // process img
                $maxID = $this->StoriesModel->getMaxID();

                $target_dir = "images/Stories/";
                $target_file = "../".$target_dir .$maxID[0]['id']. basename($_FILES["fileToUpload"]["name"]);
                move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
                $feature_img = $target_dir .$maxID[0]['id']. basename($_FILES["fileToUpload"]["name"]);
            }
            else $feature_img = Config::GetConfig("defaultImageStory");
            
            $status = isset( $_POST[ 'status' ] ) ? $_POST[ 'status' ] : "publish";
            $created_time = date("Y-m-d H:i:s") ;
            $created_user = $_SESSION['username'];
            $last_modified_time = $created_time;
            $last_modified_user = $created_user;

            $this->StoriesModel->create( $id_cat, $name, $content, $feature_img, $status, $created_time, $created_user, $last_modified_time, $last_modified_user ) ;
            $this->message = Config::GetConfig("successAddStory");
        }
        
        $this->showUpdate([ 'id' => $this->StoriesModel->getMaxID()[0]['id'] ]);
  }

  public function read($params = array() )
  {
  
        
        $this->currentPage = isset( $params[ 'currentPage' ] ) ? $params[ 'currentPage' ] : 1 ;
        $this->search = isset( $_POST[ 'search' ] ) ? $_POST[ 'search' ] : "" ;
        if ( isset( $params[ 'search' ] ) ) $this->search = $params[ 'search' ];
        $Filter = $this->StoriesModel->Filter( $this->search ) ;

        $this->maxPage = $this->StoriesModel->Count( "page", $Filter ) ;
        $this->content = $this->StoriesModel->read( $this->currentPage, $Filter ) ;
        foreach( $this->content as $index => $row )
            foreach( $row as $key => $value ){
                if ( $key == "id_cat" ) {
                    if ( $value == 0 ) {
                        $category = Config::GetConfig("nonCategory");
                    }
                    else {
                        $category = $this->CategoriesModel->readDetail( $value );
                        $this->content[$index][$key] = $category[0]["name"];
                    }
                }
                else if ( $key == 'created_user' || $key == 'last_modified_user' ){
                    $USER = $this->AccountModel->getUser($value);
                    $this->content[$index][$key] = $USER['username'];
                }
            }
        $this->file = "read";
        $this->LimitPerPage = Config::GetConfig("LimitPerPage");  

        $this->display();
  }

  public function showUpdate($params = array() )
  {
        $this->content['stories'] = $this->StoriesModel->readDetail( $params[ 'id' ] ) ;
        $this->content['chapters'] = $this->ChaptersModel->read($params[ 'id' ]);
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
            $row_article = $this->StoriesModel->readDetail( $ID );
            $old_article = $row_article[0];
            $id_cat = isset( $_POST["id_cat"] ) ? $_POST["id_cat"] : 1;
            
            $name =  $_POST[ 'name' ] ;
            $content = isset( $_POST[ 'description' ] ) ? $_POST[ 'description' ] : Config::GetConfig("empty");

            if ( isset( $_FILES["fileToUpload"]["name"] ) ){ // process img
                if ( $old_article['feature_img'] != Config::GetConfig("defaultImageStory") )
                    if ( file_exists("../".$old_article['feature_img']) ) unlink("../".$old_article['feature_img']);

                $target_dir = "images/Stories/";
                $target_file = "../".$target_dir .$ID. basename($_FILES["fileToUpload"]["name"]);
                move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
                $feature_img = $target_dir .$ID. basename($_FILES["fileToUpload"]["name"]);
            }
            else $feature_img = $old_article['feature_img'];

            $status = isset( $_POST[ 'status' ] ) ? $_POST[ 'status' ] : "publish" ;
            $last_modified_time = date("Y-m-d H:i:s") ;
            $last_modified_user = $_SESSION['username'];

            $this->StoriesModel->update( $id_cat, $ID, $name, $content, $feature_img, $status, $last_modified_time, $last_modified_user );
            $this->message = Config::GetConfig("successUpdateStory");
        }
        
        $this->read();
  }

  public function delete()
  {
        if ( isset( $_GET['id'] ) ) {
            $ID = $_GET['id'] ;
            $row_article = $this->StoriesModel->readDetail( $ID );
            $old_article = $row_article[0];
            if ( file_exists("../".$old_article['feature_img']) && $old_article['feature_img'] != 'images/Stories/defaultImage.png' )
                unlink( "../".$old_article['feature_img'] );

            $this->StoriesModel->delete( $ID );
            $this->message = Config::GetConfig("successDeleteStory");
        }
        else $this->message = Config::GetConfig( "errorID" );

        $this->read();
  }

  private function display()
  {
        if ( empty($this->listCategories) )
            $this->listCategories = $this->CategoriesModel->readAll();
        $this->file ="Stories/$this->file";
        
        session_start();
        if ( empty($_SESSION['back_link']) ) $this->back_link="http://".$_SERVER['HTTP_HOST'];
        else $this->back_link = $_SESSION['back_link'];
        $_SESSION['back_link'] = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        include("app/views/index.php");
  }

}


?>