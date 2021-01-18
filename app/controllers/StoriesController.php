<?php

if ( !defined("#_JEXEC_#") ){
    echo "<a style = 'font-size: 100px;' href = 'index.php'> Quay lại trang chủ </a> ";
    die;
}

class StoriesController {
  private $limitPerPage;

  private $limitCategories;

  private $limitPerCategory;

  private $CategoriesModel;

  private $StoriesModel;

  private $ChaptersModel;

  private $cat_id;

  private $currentPage;

  private $maxPage;

  private $search;

  private $from;

  private $to;

  private $message;

  private $files;

  private $content;

  private $categories =  array();

  private $listCategories;

  public function __construct()
  {
        require_once("app/models/CategoriesModel.php");
        $this->CategoriesModel = CategoriesModel::getInstance();
        require_once("app/models/StoriesModel.php");
        $this->StoriesModel = StoriesModel::getInstance();
        require_once("app/models/ChaptersModel.php");
        $this->ChaptersModel = ChaptersModel::getInstance();

        $this->limitPerPage = Config::GetConfig("limitPerPage");
        $this->limitCategories = Config::GetConfig("limitCategories");
        $this->limitPerCategory = Config::GetConfig("limitPerCategory");
  }

  public function home()
  {

        $this->categories = $this->CategoriesModel->readList( $this->limitCategories );
        foreach( $this->categories as $category ){
            $Filter = $this->StoriesModel->Filter( $category['id'] );
            $this->content[ $category['id'] ] = $this->StoriesModel->readListStories( $this->limitPerCategory, $Filter );
        }
        $this->files['home'] = "Stories/home";
        $this->display();
  }

  public function readListStories($params = array() )
  {

        $this->id_cat = isset( $params['id_cat'] ) ? $params['id_cat'] : "";
        $this->currentPage = isset( $params['currentPage'] ) ? $params['currentPage'] : 1;

        $Filter = $this->StoriesModel->Filter( $this->id_cat, $this->search, $this->from, $this->to );
        $this->content = $this->StoriesModel->readListStories( $this->limitPerPage, $Filter, $this->currentPage );
        $this->content['category'] = $this->CategoriesModel->readDetail($this->id_cat)[0];
        $this->maxPage = $this->StoriesModel->Count("page", $Filter, $this->limitPerPage);

        $this->files['stories'] = "Stories/readListStories";
        $this->display();
  }

  public function showSearch()
  {
        $this->files['search'] = "Stories/search";
        $this->message = "";

        $this->display();
  }

  public function search($params = array() )
  {
        $this->id_cat = isset( $params['id_cat'] ) ? $params['id_cat'] : "";
        $this->currentPage = isset( $params['currentPage'] ) ? $params['currentPage'] : 1;
        $this->search = isset( $params[ 'search' ] ) ? $params[ 'search' ] : "" ;
        if ( isset( $_POST['search'] ) ) $this->search = $_POST['search'] ;
        $this->from = isset( $params[ 'from' ] ) ? strtotime($params[ 'from' ]) : "" ;
        $this->to = isset( $params[ 'to' ] ) ? strtotime($params[ 'to' ]) : date("Y-m-d H:i:s") ;

        $Filter = $this->StoriesModel->Filter( $this->id_cat, $this->search, $this->from, $this->to );
        $this->content = $this->StoriesModel->readListStories( $this->limitPerPage, $Filter, $this->currentPage );

        $this->files['search'] = "Stories/search";
        if ( empty( $this->content ) ) $this->message = Config::GetConfig("NoResult");
        else $this->message = "Tổng cộng ".$this->StoriesModel->Count("count", $Filter)." kết quả. ";
        $this->maxPage = $this->StoriesModel->Count("page", $Filter, $this->limitPerPage);
        $this->display();

  }

  public function readDetailStory($params = array() )
  {
        $ID = $params['id'];
        $this->files['article'] = "Stories/article";
        $this->content['story'] = $this->StoriesModel->readDetailStory( $ID )[0];
        $this->content['chapters'] = $this->ChaptersModel->read( $ID );
        $this->content['category'] = $this->CategoriesModel->readDetail( $this->content['story']['id_cat'] )[0];

        $this->display();
  }

  private function display()
  {
        if ( empty($this->listCategories) ) 
            $this->listCategories = $this->CategoriesModel->readList( Config::GetConfig("maxCategories") );
        require_once("app/views/index.php");
  }

}


?>