<?php

class Config{
    private $dbname = 'web_stories' ;
    private $hostname = "192.168.230.230" ;
    private $username = "dev" ;
    private $password = "123123" ;
    
    private $LimitPerPage = 15 ; // limit list in admin
    private $limitPerPage = 15 ; // limit in search
    private $limitCategories = 15; // limit categories in homepage
    private $limitPerCategory = 15; // limit stories per categories
    private $maxCategories = 100; // limit categories in sidebar

    private $title = "Web Stories";

    private $tableAccount = "accounts";
    private $tableCategories = "categories" ;
    private $tableStories = "stories" ;
    private $tableCategoryStory = "story_of_category";

    private $NoResult = " Không tìm thấy kết quả nào. ";
    private $errorID = "Bạn chưa chọn ! " ;
    private $errorName = "Bạn chưa nhập tên !" ;
    private $errorLogin = "Sai tên đăng nhập hoặc mật khẩu !";

    private $empty = "Trống";
    private $successAddCategory = "Thêm thể loại mới thành công !";
    private $successUpdateCategory = "Cập nhật thể loại thành công !";
    private $successDeleteCategory = "Xoá thể loại thành công !";
    private $defaultCategory = 1;
    private $defaultCategoryDelete = "Đây là thể loại mặc định, không thể xóa thể loại này";

    private $successAddStory = "Thêm truyện mới thành công !";
    private $successUpdateStory = "Cập nhật truyện thành công !";
    private $successDeleteStory = "Xoá truyện thành công !";
    private $nonCategory = "Chưa có thể loại";

    private $defaultImageStory = "images/Stories/defaultImage.png";
    
    private $NotFound = 
    " <a style = 'font-size: 100px;' href = 'index.php'> Quay lại trang chủ </a> " ;



    private static $instance = null;

    

    public function GetConfig( $name ){
        $instance = self::getInstance();
        return $instance->$name;
    }

    private function getInstance(){
        if (self::$instance == null){
            self::$instance = new Config();
        }
        return self::$instance;
    }
}

?>