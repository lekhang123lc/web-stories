<?php
    if ( !defined("#_JEXEC_#") ){
        echo "<a style = 'font-size: 100px;' href = 'index.php'> Quay lại trang chủ </a> ";
        die;
    }
    $category = $this->content[0];
?>

<form class="form-style-6" action = "<?php echo URL::buildURL("Categories", "update", array( 'id' => $category['id'] ) ); ?>" method="post" >
    <h1>Chỉnh sửa</h1>
	<div class="form-group">
        <label for="name">Thể loại</label>
        <input type="text" class="form-control" id="name" name="name" value= "<?php echo $category['name']; ?>">    

        <label for="desc">Mô tả</label>
        <textarea rows="5" cols="120" maxlength = "1000" name="description" class="form-control"><?php echo $category['description']; ?></textarea>
	</div>
    <input type="hidden" name = "id_story" value = "<?php echo $article['id']; ?>">
    <input type="hidden" name = "id" value = "<?php echo $chapter['id']; ?>">
    <input type = "submit" value = "Lưu chỉnh sửa" class="btn btn-primary" />
    <a href="<?php echo $this->back_link; ?>" class="btn btn-danger">Hủy bỏ</a>
</form>

