function Delete( ID ){
    var check = confirm("Bạn có thật sự muốn truyện này ?");
    if ( check ){
        document.cookie = "id="+ID;
        window.location = "index.php?controller=StoriesController&action=delete&id="+ID;
    }
}