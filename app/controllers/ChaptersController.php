<?php

if ( !defined("#_JEXEC_#") ){
    echo "<a style = 'font-size: 100px;' href = 'index.php'> Quay lại trang chủ </a> ";
    die;
}
class ChaptersController {
  private $ChaptersModel;

  private $StoriesModel;

  private $file;

  public function __construct()
  {

        require_once("app/models/CategoriesModel.php");
        $this->CategoriesModel = CategoriesModel::getInstance();
        require_once("app/models/StoriesModel.php");
        $this->StoriesModel = StoriesModel::getInstance();
        require_once("app/models/ChaptersModel.php");
        $this->ChaptersModel = ChaptersModel::getInstance();
  }

  public function read($params = array() )
  {
  

        $this->content = $this->ChaptersModel->getChapters($params['id_story']);
        $this->file = "read";

        $this->display();
  }

  public function readDetailChapter($params = array() )
  {

        $ID = $params['id'];
        $id_story = $params['id_story'];

        $this->files['article'] = "Chapters/detail";
        $this->content['story'] = $this->StoriesModel->readDetailStory( $id_story )[0];
        $this->content['chapters'] = $this->ChaptersModel->read( $id_story );
        $this->content['detail'] = $this->ChaptersModel->readDetail( $ID )[0];
        $this->content['category'] = $this->CategoriesModel->readDetail( $this->content['story']['id_cat'] )[0];    

        $this->display();
  }

  private function display()
  {

        if ( empty($this->listCategories) ) 
            $this->listCategories = $this->CategoriesModel->readList( Config::GetConfig("maxCategories") );

        include("app/views/index.php");
  }

}



?>