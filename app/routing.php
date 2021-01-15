<?php

if ( !defined("#_JEXEC_#") ){
    echo "<a style = 'font-size: 100px;' href = 'index.php'> Quay lại trang chủ </a> ";
    die;
}

class Routing{
    
    private $controller = "StoriesController" ;
    private $action = "home" ;
    private $params = array() ;

    public function __construct(){
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        if ( isset( $_GET[ 'controller' ] ) ) $this->controller = $_GET[ 'controller' ];
        if ( isset( $_GET[ 'action' ] ) ) $this->action = $_GET[ 'action' ];
        
        if ( isset( $_GET[ 'params' ] ) ) {
            parse_str( $_GET[ 'params' ] );
            if ( isset($params) ) $this->params = $params;
        }
    }

    public function start(){
        if ( !file_exists("app/controllers/$this->controller.php") ) {
            echo Config::GetConfig('NotFound');
            die;
        }
        include("app/controllers/$this->controller.php");
        if ( !class_exists($this->controller) ){
            echo Config::GetConfig('NotFound');
            die;
        }
        
        $Class = new $this->controller ;
        $Method = $this->action;

        if ( !method_exists( $Class, $Method) ) {
            echo Config::GetConfig('NotFound');
            die;
        }

        if ( !empty($this->params) ) $Class->$Method($this->params);
        else $Class->$Method();
    }
}

?>