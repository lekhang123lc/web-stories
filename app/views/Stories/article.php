<?php

if ( !defined("#_JEXEC_#") ){
    echo "<a style = 'font-size: 100px;' href = 'index.php'> Quay lại trang chủ </a> ";
    die;
}

?>

<div class="intro">	
	<div class="intro-details">
		<h3><a href="<?php echo URL::buildURL("Stories","readListStories",array( "id_cat" => $this->content['category']['id'] ) ) ?>"><?php echo $this->content['category']['name']; ?></a> > <a href="<?php echo URL::buildURL("Stories","readDetailStory",array( "id" => $this->content['id'] ) ) ?>"><?php echo $this->content['story']['name']; ?></a></h3>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-3">
			<img src="<?php echo $this->content['story']['feature_img']; ?>" width='100%'>
		</div>
		<div class="col-9">
			<p> <?php echo $this->content['story']['description']; ?> </p>	
		</div>
	</div>
</div>
<br/>
<div class="crud table text-center table-striped">
    <table class="cate" width="100%">
        <th width="100%"><h3>Danh sách chương</h3></th>
        
        <tbody>
            <?php foreach( $this->content['chapters'] as $chapter ): ?>
                <tr class="text-center">
                <td><a href="<?php echo URL::buildURL("Chapters", "readDetailChapter", ['id' =>$chapter['id'],'id_story' => $this->content['story']['id'] ]); ?>"><?php echo $chapter['name']; ?></a></td>

                </tr>
            <?php endforeach; ?>