<?php
    if ( !defined("#_JEXEC_#") ){
        echo "<a style = 'font-size: 100px;' href = 'index.php'> Quay lại trang chủ </a> ";
        die;
    }
?>

<form class="form-style-6" action = "<?php echo URL::buildURL("Stories", "create"); ?>" method="post" enctype="multipart/form-data" >
    <h1>THÊM TRUYỆN</h1>
	<div class="form-group">
        <label for="name">Tên truyện</label>
        <input type="text" class="form-control" id="name" name="name">    
        <label for="cat">Thể loại</label>
        <select name="id_cat"  class="form-control">
            <?php foreach( $this->listCategories as $category ) { ?>
                <option value=<?php echo $category['id'] ?> ><?php echo $category['name'] ?></option>
            <?php } ?>