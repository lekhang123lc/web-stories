<?php

if ( !defined("#_JEXEC_#") ){
    echo "<a style = 'font-size: 100px;' href = 'index.php'> Quay lại trang chủ </a> ";
    die;
}

class URL {
  public static function buildURL($controller, $action, $params = array() )
  {
        
        $query = http_build_query( array('params' => $params) );
        $url = urlencode( $query ); 
        return "index.php?controller=$controller"."Controller&action=$action&params=$url";
  }

  public static function buildPage($maxPage, $controller, $action, $params = array() )
  {
        $currentPage = $params['currentPage'];
        if ( !empty($_GET['search']) )  $params['search'] = $_GET['search'];
        if ( !empty($_POST['search']) ) $params['search'] = $_POST['search'];

        $currentParams = $_GET['params'];
        if ( !empty($currentParams['search']) )  $params['search'] = $_GET['search'];
        if ( !empty($_POST['search']) ) $params['search'] = $_POST['search'];
        if ( !empty($currentParams['id_cat']) )  $params['id_cat'] = $_GET['id_cat'];
        if ( !empty($_POST['id_cat']) ) $params['id_cat'] = $_POST['id_cat'];
        if ( !empty($currentParams['to']) )  $params['to'] = $_GET['to'];
        if ( !empty($_POST['to']) ) $params['to'] = $_POST['to'];

        $Page = array();

        if ( $currentPage > 1 ) {
            $params['currentPage'] = 1;
            $Page[]= "<a class='page-link' href=".self::buildURL( $controller, $action, $params )."> Trang đầu </a>";
            $params['currentPage'] = $currentPage - 1;
            $Page[]= "<a class='page-link' href=".self::buildURL( $controller, $action, $params )."> Trang trước </a>";
        }
    
        for( $i = $currentPage - 2; $i <= $currentPage + 2; $i++ ){
            if ( $i < 1 ) continue;
            if ( $i > $maxPage ) break;
            if ( $i == $currentPage ) $Page[] = "currentPage";
            else{
                $params['currentPage'] = $i;
                $Page[] = "<a class='page-link' href=".self::buildURL( $controller, $action, $params )."> $i </a>";
            }
        }
    
        if ( $currentPage < $maxPage ) {
            $params['currentPage'] = $currentPage + 1;
            $Page[]= "<a class='page-link' href=".self::buildURL( $controller, $action, $params )."> Trang sau </a>";
            $params['currentPage'] = $maxPage;
            $Page[]= "<a class='page-link' href=".self::buildURL( $controller, $action, $params )."> Trang cuối </a>";
        }

        return $Page;

  }

}


?>