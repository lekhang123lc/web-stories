<?php
    if ( !defined("#_JEXEC_#") ){
        echo "<a style = 'font-size: 100px;' href = 'index.php'> Quay lại trang chủ </a> ";
        die;
    }

    // table categories
    $table = array();
    $idRow = 1;
    $indentityColumn = array( "STT", "Tên", "Mô tả", "Xóa" );

    foreach( $this->content as $row ){
        $count = ( $this->currentPage - 1 ) * $this->LimitPerPage + $idRow ;
        foreach( $row as $key => $value ){
            if ( $key == 'name' ) {
                $table[$count][$key] = "<a href=".URL::buildURL("Categories","showUpdate", array( "id" => $row['id'] ) ) ."> $value  <a/>";
            }
            else if ( $key != "status" ) $table[$count][$key] = $value ;
        }
        $idRow++ ;
    }
    
    // pagination
    
    $params = array( "id_cat" => $this->id_cat, 
                    "currentPage" => $this->currentPage,
                    "search" => $this->search );

    $Page = URL::buildPage( $this->maxPage, "Categories", "read", $params);

    // message
    if ( $this->search ){
        if ( $idRow > 1 )
            $this->message = "Kết quả tìm kiếm của ".$this->search.", trang ".$this->currentPage." trên ".$this->maxPage."<br/>";
        else $this->message = Config::GetConfig("NoResult");
    }


?>

<div class="crud-cates">
<!-- search -->
<form action="<?php echo URL::buildURL("Categories","read") ?>" method="post">
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
    <div class="cate-table">
    <a class="btn btn-primary float-right" href="<?php echo URL::buildURL("Categories","showCreate"); ?>">Thêm Mới</a>
        <h3>Thể loại</h3>
    </div>
    <div class="crud table">
        <table class="table cate text-center table-striped" width="100%" >
            <thead class="cate-title">
                <?php foreach( $indentityColumn as $value ) {?>
                    <th> <strong> <?php echo $value; ?> </strong> </th>
                <?php } ?>
            </thead>
            <tbody>
                <?php foreach( $table as $key => $row ) { ?>
                    <tr>
                            <td > <?php echo $key; ?> </td>
                        <?php foreach( $row as $index => $value ) {?>
                            <?php if ( $index != 'id' ) : ?>
                            <td > <?php  echo $value; ?> </td>
                        <?php endif; ?>
                        <?php } ?>
                            <td> <button onclick="Delete( <?php echo $row['id']; ?> )" class="btn btn-danger"> Xóa  </button> </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
                        
    </div>
    <br>
<?php endif; ?>
</div>
  
