<?php

if ( !defined("#_JEXEC_#") ){
    echo "<a style = 'font-size: 100px;' href = 'index.php'> Quay lại trang chủ </a> ";
    die;
}

$params = array( "id_cat" => $this->id_cat, 
				"currentPage" => $this->currentPage );
$Page = URL::buildPage($this->maxPage, "Stories", "readListStories", $params);
$stories = $this->content;
unset($stories['category']);
?>

<div class="item" >
    <div class="row">
        <div class="col-12"> <!-- category -->
            <h3><a href="<?php echo URL::buildURL("Stories","readListStories", array( "id_cat" => $this->content['category']['id'] ) ); ?>" ><?php echo $this->content['category']['name'] ?></a></h3>
        </div>
        <?php foreach( $stories as $values ) {?>
            <div class="col-4">
                <div class="card">
                    <a href="<?php echo URL::buildURL("Stories","readDetailStory",array( "id" => $values['id'] ) ) ?>">
                        <img src="<?php echo $values['feature_img'];?>" class="card-img-top"/>
                    </a>
                    <div class="card-body">
                        <h5 class="card-title"><a href="<?php echo URL::buildURL("Stories","readDetailStory",array( "id" => $values['id'] ) ) ?>"><?php echo $values['name'] ?></a> </h5>
                    </div>
                </div>
            </div>
        <?php }?>
    </div>	
</div>
<br/>