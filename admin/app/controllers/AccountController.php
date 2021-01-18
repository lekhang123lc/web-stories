<?php

if ( !defined("#_JEXEC_#") ){
    echo "<a style = 'font-size: 100px;' href = 'index.php'> Quay lại trang chủ </a> ";
    die;
}

class AccountController{
    private $model;
    private $message;

    public function __construct(){
        require("app/models/AccountModel.php");
        $this->model = new AccountModel( "tableAccount" );
    }

    public function login(){
        if ( isset( $_SESSION[ 'username' ] ) ) header("Location: index.php?controller=CategoriesController&action=read");
        else $this->display();
    }

    public function requestLogin(){
        $username = $_POST[ 'username' ];
        $password = md5( $_POST[ 'password' ] );
        $USER = $this->model->GetPass( $username ) ;
        if ( empty( $USER['password'] ) ) $this->loginFailed();
        else if ( $USER['password'] != $password ) $this->loginFailed();
        else $this->loginSuccess( $USER['id'] );
    }

    private function loginSuccess( $id ){
        $_SESSION['username'] = $id;
        header("Location: index.php?controller=CategoriesController&action=read");
    }

    private function loginFailed(){
        $this->message = Config::GetConfig("errorLogin");;
        $this->display();
    }

    public function logout(){
        unset( $_SESSION['username'] );
        header("Location: index.php");
    }

    private function display(){
        require("app/views/Account/index.php");
    }
}

?>