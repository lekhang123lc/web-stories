<?php
    if ( !defined("#_JEXEC_#") ){
        echo "<a style = 'font-size: 100px;' href = 'index.php'> Quay lại trang chủ </a> ";
        die;
    }

    // table stories
    $table = array();
    $idRow = 1;
    $indentityColumn = array( "STT", "Thể loại", "Tên", "Thời gian đăng", "Người đăng", "Lần sửa cuối", "Người sửa cuối", "Xóa" );
    $columns = array( 'id_cat', 'created_time', 'created_user', 'last_modified_time', 'last_modified_user' );
    $idColumn = array();

    foreach( $this->content as $row ){
        $count = ( $this->currentPage - 1 ) * $this->LimitPerPage + $idRow ;
        foreach( $row as $key => $value ){
            if ( $key == 'name' ) {
                $table[$count][$key] = "<a href=".URL::buildURL("Stories","showUpdate", array( "id" => $row['id'] ) ) ."> $value  <a/>";
            }
            if ( $key == 'id' ) $idColumn[$count] = $value;
            foreach( $columns as $column )
                if ( $key ==  $column ) {
                    $table[$count][$key] = $value;
                    break;
                }
        }
        $idRow++ ;
    }
    
    // pagination
    
    $params = array( "id_cat" => $this->id_cat, 
                    "currentPage" => $this->currentPage,
                    "search" => $this->search );

    $Page = URL::buildPage( $this->maxPage, "Stories", "read", $params);

    // message
    if ( $this->search ){
        if ( $idRow > 1 )
            $this->message = "Kết quả tìm kiếm của ".$this->search.", trang ".$this->currentPage." trên ".$this->maxPage."<br/>";
        else $this->message = Config::GetConfig("NoResult");
    }


?>

<div class="crud-story">
<!-- search -->
<form action="<?php echo URL::buildURL("Stories","read") ?>" method="post">
    <div class="input-group mb-3">
        <input type="text" name="search" class="form-control" placeholder="Tìm kiếm" aria-label="" aria-describedby="basic-addon1">
        <div class="input-group-prepend">
            <button class="btn btn-outline-secondary" type="submmit" class="btn btn-primary">Tìm kiếm</button>
        </div>
    </div>
</form>
<br/>
<?php echo $this->message; ?>
<br/>

<?php if ( $this->message != Config::GetConfig("NoResult") ) : ?>
    <div class="story-table">
        <a class="btn btn-primary float-right" href="<?php echo URL::buildURL("Stories","showCreate"); ?>">Thêm Mới</a>
        <h3>Danh sách truyện</h3>
    </div>
    <div class="crud table text-center table-striped">
        <table class="cate" >
            <thead class="cate-title">
                <?php foreach( $indentityColumn as $value ) {?>
                    <th> <strong> <?php echo $value; ?> </strong> </th>
                <?php } ?>
            </thead>
            <tbody>
                <?php foreach( $table as $key => $row ) { ?>
                    <tr>
                            <td > <?php echo $key; ?> </td>
                        <?php foreach( $row as $value ) {?>
                            <td > <?php echo $value; ?> </td>
                        <?php } ?>
                            <td> <button onclick="Delete(<?php echo $idColumn[$key]; ?>)" class="btn btn-danger"> Xóa  </button> </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
                        
    </div>
    <br>
<?php endif; ?>
</div>



            
		
		
		
