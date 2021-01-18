function Delete( ID ){
    var check = confirm("Bạn có thật sự muốn xoá chương này ?");
    if ( check ){
        window.location = "index.php?controller=ChaptersController&action=delete&id="+ID;
    }
}