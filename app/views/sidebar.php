<?php

if ( !defined("#_JEXEC_#") ){
    echo "<a style = 'font-size: 100px;' href = 'index.php'> Quay lại trang chủ </a> ";
    die;
}

$urlCategories = array();
foreach( $this->listCategories as $i => $category ){
    $urlCategories[ $i ] = URL::buildURL( "Stories", "readListStories", array( 'id_cat' => $category['id'] ) );
}

?>

<table> 
    <thead> <th class="text-center"> Thể loại </th> </thead> 
    <tbody> 
        <?php foreach( $this->listCategories as $i => $category ) { ?>

            <tr><td><a href="<?php echo $urlCategories[$i]; ?>"> 
                <?php echo $category['name']; ?> 
            </a></td></tr>

        <?php } ?>
    </tbody>
</table>

