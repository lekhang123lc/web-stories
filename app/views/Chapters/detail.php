<?php

if ( !defined("#_JEXEC_#") ){
    echo "<a style = 'font-size: 100px;' href = 'index.php'> Quay lại trang chủ </a> ";
    die;
}

$prev = 0;
$next = 0;
foreach( $this->content['chapters'] as $key => $chapter ){
	if ( $chapter['id'] == $this->content['detail']['id'] ){
		if ( !empty($this->content['chapters'][$key+1]) ) $prev = $this->content['chapters'][$key+1]['id'];
		if ( !empty($this->content['chapters'][$key-1]) ) $next = $this->content['chapters'][$key-1]['id'];
	}
}

?>

<div class="intro">	
	<div class="intro-details">
		<h3><a href="<?php echo URL::buildURL("Stories","readListStories",array( "id_cat" => $this->content['category']['id'] ) ) ?>"><?php echo $this->content['category']['name']; ?></a> > <a href="<?php echo URL::buildURL("Stories","readDetailStory",array( "id" => $this->content['story']['id'] ) ) ?>"><?php echo $this->content['story']['name']; ?></a></h3>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-2">
			<?php if ( $prev ): ?>
				<a href="<?php echo URL::buildURL("Chapters","readDetailChapter", ['id'=>$prev, 'id_story'=>$this->content['story']['id']]); ?>" class="btn btn-primary">Chương trước</a>
			<?php endif; ?>
		</div>
		<div class="col-8">
			<select onchange="location = this.value;" class="form-control" >
				<?php foreach( $this->content['chapters'] as $chapter ) { ?>
					<option <?php if ( $chapter['id'] == $this->content['detail']['id'] ) echo " selected "; ?> value="<?php echo URL::buildURL("Chapters","readDetailChapter", ['id'=>$chapter['id'], 'id_story'=>$this->content['story']['id']]); ?>" >
						<?php echo $chapter['name'] ?>
					</option>
				<?php } ?>
			</select>
		</div>
		<div class="col-2">
			<?php if ( $next ): ?>
				<a href="<?php echo URL::buildURL("Chapters","readDetailChapter", ['id'=>$next, 'id_story'=>$this->content['story']['id']]); ?>" class="btn btn-primary">Chương sau</a>
			<?php endif; ?>
		</div>
	
		<div class="col-12" style="margin-top:1rem;margin-bottom:1rem;">
			<p> <?php echo $this->content['detail']['content']; ?> </p>
		</div>
		<div class="col-2">
			<?php if ( $prev ): ?>
				<a href="<?php echo URL::buildURL("Chapters","readDetailChapter", ['id'=>$prev, 'id_story'=>$this->content['story']['id']]); ?>" class="btn btn-primary">Chương trước</a>
			<?php endif; ?>
		</div>
		<div class="col-8">
			<select onchange="location = this.value;" class="form-control" >
				<?php foreach( $this->content['chapters'] as $chapter ) { ?>
					<option <?php if ( $chapter['id'] == $this->content['detail']['id'] ) echo " selected "; ?> value="<?php echo URL::buildURL("Chapters","readDetailChapter", ['id'=>$chapter['id'], 'id_story'=>$this->content['story']['id']]); ?>" >
						<?php echo $chapter['name'] ?>
					</option>
				<?php } ?>
			</select>
		</div>
		<div class="col-2">
			<?php if ( $next ): ?>
				<a href="<?php echo URL::buildURL("Chapters","readDetailChapter", ['id'=>$next, 'id_story'=>$this->content['story']['id']]); ?>" class="btn btn-primary">Chương sau</a>
			<?php endif; ?>
		</div>
	</div>
</div>
