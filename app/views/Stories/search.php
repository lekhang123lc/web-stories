<?php

if ( !defined("#_JEXEC_#") ){
    echo "<a style = 'font-size: 100px;' href = 'index.php'> Quay lại trang chủ </a> ";
    die;
}

if ( $this->message ){

$params = array( "id_cat" => $this->id_cat, 
				"currentPage" => $this->currentPage,
				"search" => $this->search,
				"from" => $this->from,
				"to" => $this->to );
$Page = URL::buildPage($this->maxPage, "Stories", "search", $params);
// echo "<pre>";
// var_dump($this->content);
// die;
}

?>

<div class="container">
<div class="title-search">
    <h3>Tìm kiếm trên Web Stories:</h3>
</div>
				
<form action="<?php echo URL::buildURL("Stories","search"); ?>" class="search-story" method="post">
	<div id="filter">
		<div class="filter-table">
			<div class="form-group row">
				<input class="col-sm-2 form-control" type="text" name="search" placeholder="Tìm kiếm Truyện"/>			
		
				<label for="inputEmail3" class="col-sm-2 col-form-label">Thể loại</label>
				<div class="col-sm-2">
					<select name="id_cat" class="form-control" id="inputEmail3" >
							<option value="" > Tất cả </option>
						<?php foreach( $this->listCategories as $category ) { ?>
							<option value=<?php echo $category['id'] ?> ><?php echo $category['name'] ?></option>
						<?php } ?>
					</select>
				</div>

				<label for="inputEmail2" class="col-sm-2 col-form-label">Thời gian đăng</label>
				<div class="col-sm-2">
					<select name = "to" class="form-control" id="inputEmail2" >
						<option value = ""> Tất cả </option>
						<option value = "<?php echo date("Y-m-d H:i:s",strtotime("-1 days")); ?>"> Hôm qua </option>
						<option value = "<?php echo date("Y-m-d H:i:s",strtotime("-1 weeks")); ?>"> Tuần trước </option>
						<option value = "<?php echo date("Y-m-d H:i:s",strtotime("-1 months")); ?>"> Tháng trước </option>
					</select>
				</div>
				<button type="submit" class="btn btn-primary">Tìm kiếm</button>
  			</div>
		</div>
	</div>
</form>
<br/>


<?php if ( $this->message ): ?>				
	<h3>Kết quả tìm kiếm</h3>
	<?php echo $this->message; ?>
	<div class="row">
		<?php foreach( $this->content as $values ) {?>
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
		<?php } ?>

		<br/>
		
        
	</div>
	
<?php endif; ?>
</div>