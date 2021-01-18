<?php
    if ( !defined("#_JEXEC_#") ){
        echo "<a style = 'font-size: 100px;' href = 'index.php'> Quay lại trang chủ </a> ";
        die;
    }
    $article = $this->content['story'][0];
?>

<form class="form-style-6" action = "<?php echo URL::buildURL("Chapters", "create"); ?>" method="post" enctype="multipart/form-data" >
    <h1><?php echo $article['name'] ?>: Thêm chương</h1>
	<div class="form-group">
        <label for="name">Tên chương</label>
        <input type="text" class="form-control" id="name" name="name" value= "">     

        <label for="desc">Nội dung</label><textarea class="form-control" rows="10" cols="120" maxlength = "1000" name="content" placeholder = "Nội dung"></textarea>
	</div>
    <input type="hidden" name = "id_story" value = "<?php echo $article['id']; ?>">
    <input type = "submit" value = "Lưu" class="btn btn-primary" />
    <a href="<?php echo $this->back_link; ?>" class="btn btn-danger">Hủy bỏ</a>
</form>