<?php
    if ( !defined("#_JEXEC_#") ){
        echo "<a style = 'font-size: 100px;' href = 'index.php'> Quay lại trang chủ </a> ";
        die;
    }
    $article = $this->content['story'][0];
    $chapter = $this->content['chapter'][0];
?>

<form class="form-style-6" action = "<?php echo URL::buildURL("Categories", "update", array( 'id' => $category[0]['id'] ) ); ?>" method="post" >
    <h1>Chỉnh sửa</h1>
    <h1><?php echo $article['name'] ?>: Thêm chương</h1>
	<div class="form-group">
        <label for="name">Thể loại</label>
        <input type="text" class="form-control" id="name" name="name" value= "<?php echo $category[0]['name']; ?>">    

        <label for="desc">Mô tả</label>
        <textarea rows="5" cols="120" maxlength = "1000" name="description" class="form-control"><?php echo $category[0]['description']; ?>