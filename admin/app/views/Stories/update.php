<?php
    if ( !defined("#_JEXEC_#") ){
        echo "<a style = 'font-size: 100px;' href = 'index.php'> Quay lại trang chủ </a> ";
        die;
    }
    $article = $this->content['stories'][0];
    $chapters = $this->content['chapters'];
?>



<form class="form-style-6" action = "<?php echo URL::buildURL("Stories", "update", array( 'id' => $article['id'] ) ); ?>" method="post" enctype="multipart/form-data" >
    <h1>CHỈNH SỬA TRUYỆN</h1>
    <div class="form-group">
        <label for="name">Tên truyện</label>
        <input type="text" class="form-control" id="name" name="name" value= "<?php echo $article['name']; ?>">    
        <label for="cat">Thể loại</label>
        <select name="id_cat"  class="form-control">
            <?php foreach( $this->listCategories as $category ) { ?>
                <option value=<?php echo $category['id'] ?> ><?php echo $category['name'] ?></option>
            <?php } ?>
        </select> 

        <label for="desc">Nội dung</label><textarea class="form-control" rows="5" cols="120" maxlength = "1000" name="description" placeholder = "Nội dung"><?php echo $article['description']; ?></textarea>
        <input type="file" name="fileToUpload" class="form-group">
	</div>
    
    <input type = "submit" value = "Lưu chỉnh sửa" class="btn btn-primary" />
    <a href="<?php echo $this->back_link; ?>" class="btn btn-danger">Hủy bỏ</a>
</form>
<div class="row"></div>
<div class="crud table text-center table-striped">
    <table class="cate" width="100%">
        <th width="80%"><h3>Danh sách chương</h3></th>
        <th width="20%"><a class="btn btn-primary" href="<?php echo URL::buildURL("Chapters", "showCreate", ['id_story' => $article['id'] ]); ?> ?>">Thêm chương</a></th>
        <tbody>
            <?php foreach( $chapters as $chapter ): ?>
                <tr class="text-center">
                <td><a href="<?php echo URL::buildURL("Chapters", "showUpdate", ['id' =>$chapter['id'],'id_story' => $article['id'] ]); ?>"><?php echo $chapter['name']; ?></a></td>
                <td><button onclick="Delete(<?php echo $chapter['id']; ?>)" class="btn btn-danger"> Xóa  </button></td>
                </tr>
            <?php endforeach; ?>