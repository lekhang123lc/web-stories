
<div class="container">
    <?php foreach($this->categories as $category) {?>
	<div class="row" >

        <div class="col-12"> <!-- category -->
        <a class="btn btn-primary float-right" href="<?php echo URL::buildURL("Stories","readListStories",array( "id_cat" => $category['id'] ) ) ?>"> Đọc thêm </a>
            <h3><a href="<?php echo URL::buildURL("Stories","readListStories",array( "id_cat" => $category['id'] ) ) ?>"> <?php echo $category['name'] ?> </a></h3>
        </div>
        <div class="row">
            <?php $dem=0; ?>
        <?php foreach( $this->content[ $category['id'] ] as $values ) {?>
            <?php if ( ++$dem == 7 ) break; ?>
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
    <?php }?>
</div>
