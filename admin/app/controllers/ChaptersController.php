<?php

if ( !defined("#_JEXEC_#") ){
    echo "<a style = 'font-size: 100px;' href = 'index.php'> Quay lại trang chủ </a> ";
    die;
}

class ChaptersController{

    private $ChaptersModel;
    private $StoriesModel;

    private $file;

    public function __construct(){
        require_once("app/models/ChaptersModel.php");
        $this->ChaptersModel = new ChaptersModel;
        require_once("app/models/StoriesModel.php");
        $this->StoriesModel = new StoriesModel;
    }

    public function showCreate($params){
        $this->file = "create";
        $this->content['story'] = $this->StoriesModel->readDetail($params['id_story']);
        $this->display();
    }

    public function create(){
        if ( empty( $_POST[ 'name' ] ) ) $this->message = Config::GetConfig("errorName");
        else{

            $id_story = $_POST['id_story'];
            $name = $_POST['name'] ;
            $content = $_POST['content'];

            $created_time = date("Y-m-d H:i:s") ;
            $created_user = $_SESSION['username'];
            $last_modified_time = $created_time;
            $last_modified_user = $created_user;

            $this->ChaptersModel->create( $name, $content, $id_story, $created_time, $created_user, $last_modified_time, $last_modified_user ) ;
            $this->message = "Thêm chương mới thành công !";
            
        }
        header("Location: ".URL::buildURL("Stories", "showUpdate", ['id' => $_POST['id_story']]));
        
    }

    public function read( $params = array() ){  

        $this->content = $this->ChaptersModel->getChapters($params['id_story']);
        $this->file = "read";

        $this->display();
    }

    public function showUpdate( $params = array() ){
        $this->content['story'] = $this->StoriesModel->readDetail($params['id_story']);
        $this->content['chapter'] = $this->ChaptersModel->readDetail( $params[ 'id' ] ) ;
        $this->file = "update";
        $this->display();
    }


    public function update( $params = array() ){
        
        $id_story = $_POST['id_story'];
        $id = $_POST['id'];
        $name = $_POST['name'] ;
        $content = $_POST['content'];

        $created_time = date("Y-m-d H:i:s") ;
        $created_user = $_SESSION['username'];
        $last_modified_time = $created_time;
        $last_modified_user = $created_user;

        $this->ChaptersModel->update( $id_story, $id, $name, $content, $created_time, $created_user, $last_modified_time, $last_modified_user ) ;
        $this->message = "Thêm chương mới thành công !";
        
        header("Location: ".URL::buildURL("Stories", "showUpdate", ['id' => $_POST['id_story']]));
    }

    public function delete(){
        $this->ChaptersModel->delete($_GET['id']);
        header("Location: ".$_SESSION['back_link']);
    }

    private function display(){
        $this->file ="Chapters/$this->file";
        session_start();
        if ( empty($_SESSION['back_link']) ) $this->back_link="http://".$_SERVER['HTTP_HOST'];
        else $this->back_link = $_SESSION['back_link'];
        //$_SESSION['back_link'] = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        include("app/views/index.php");
    }

}

?>