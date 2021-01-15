function Delete( ID ){
    var check = confirm("Bạn có thật sự muốn thể loại này ?");
    if ( check ){
        window.location = "index.php?controller=CategoriesController&action=delete&id="+ID;
        //console.log(ID);
    }
}