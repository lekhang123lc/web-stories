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
        </select> 

        <label for="desc">Nội dung</label><textarea class="form-control" rows="5" cols="120" maxlength = "1000" name="description" placeholder = "Nội dung"></textarea>
        <input type="file" name="fileToUpload" class="form-group" style="margin-top:10px">
	</div>
    
    <input type = "submit" value = "Lưu chỉnh sửa" class="btn btn-primary" />
    <a href="<?php echo $this->back_link; ?>" class="btn btn-danger">Hủy bỏ</a>
</form>
