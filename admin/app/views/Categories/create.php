<?php
    if ( !defined("#_JEXEC_#") ){
        echo "<a style = 'font-size: 100px;' href = 'index.php'> Quay lại trang chủ </a> ";
        die;
    }
?>
<form class="form-style-6" action = "<?php echo URL::buildURL("Categories", "create", array( 'id' => $category[0]['id'] ) ); ?>" method="post" >
    <h1>Tạo thể loại mới</h1>
	<div class="form-group">
        <label for="name">Thể loại</label>
        <input type="text" class="form-control" id="name" name="name">    

        <label for="desc">Mô tả</label><textarea rows="5" cols="120" maxlength = "1000" name="description" class="form-control"></textarea>
	</div>
    <input type = "submit" value = "Thêm thể loại" class="btn btn-primary" />
    <a href="<?php echo $this->back_link; ?>" class="btn btn-danger">Hủy bỏ</a>
</form>
