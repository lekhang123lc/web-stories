<?php

if ( !defined("#_JEXEC_#") ){
    echo "<a style = 'font-size: 100px;' href = 'index.php'> Quay lại trang chủ </a> ";
    die;
}

?>

<!Doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Truyện</title>
		<link rel="stylesheet" type="text/css" href="public/stylesheet/style.css"/>
		<link rel="stylesheet" type="text/css" href="public/stylesheet/bootstrap.css"/>
		<?php
			// foreach( $this->files as $file ){
			// 	if ( file_exists("public/stylesheet/$file.css") )
			// 		echo "<link rel='stylesheet' type='text/css' href='public/stylesheet/$file.css'/>";
			// }
		?>
	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a href="index.php" class="navbar-brand">
                <!-- <img src="../images/LOGO.png"/> -->
                Web Stories
            </a>
            <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Trang chủ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Đăng nhập</a>
				</li>
				<li class="nav-item">
                    <a class="nav-link" href="<?php echo URL::buildURL("Stories","showSearch"); ?>"> Tìm kiếm </a>
                </li>
            </ul>
            <!-- <form class="form-inline">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Search</button>
            </form> -->
        </div>
    </nav>
        
		<div class="container-fluid content-body">
			<div class="row">
				<div class="col-1"></div>
				<div class="col-2 cat"> <!-- sidebar categories -->
					<?php require("app/views/sidebar.php"); ?>
				</div>
				
				<div class="col-9">
					<?php 
						foreach( $this->files as $file )
							require("app/views/$file.php");
					?>
				</div>
			</div>
		</div>
		
		<?php if ( isset($Page) ) require_once("app/views/pagination.php");  ?>
		
		
	</body>
</html>