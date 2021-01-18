<?php

if ( !defined("#_JEXEC_#") ){
    echo "<a style = 'font-size: 100px;' href = 'index.php'> Quay lại trang chủ </a> ";
    die;
}

?>
<!-- show pagination -->
<div> </div>
<div class = "container">
<div class = "row" >
    <div class = "col-6" > </div>
        <ul class="pagination">
            <?php foreach( $Page as $key => $link ) { ?>
                <?php if ( $link == "currentPage" ) { ?>
                    <li class="page-item disabled active">
                        <a class="page-link" ><?php echo $this->currentPage; ?></a>
                    </li>
                <?php } else{ ?>
                    <li class="page-item">
                        <?php echo $link; ?>
                    </li>
                    <?php }?>
            <?php }?>