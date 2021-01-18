<?php
    if ( !defined("#_JEXEC_#") ){
        echo "<a style = 'font-size: 100px;' href = 'index.php'> Quay lại trang chủ </a> ";
        die;
    }
?>

<html lang="en">
<head>  
	<meta charset="UTF-8">
    <title>Admin</title>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->
    <link rel="stylesheet" type="text/css" href="public/stylesheet/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="public/stylesheet/style.css"/>
    <?php
        //if ( file_exists("public/stylesheet/$this->file.css") )
            //echo " <link rel='stylesheet' type='text/css' href='public/stylesheet/$this->file.css'/>";
        if ( file_exists("public/js/$this->file.js") )
            echo " <script src='public/js/$this->file.js'> </script> ";
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
                    <a class="nav-link" href="<?php echo URL::buildURL("Categories","read") ?>">Thể loại</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URL::buildURL("Stories","read") ?>">Truyện</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URL::buildURL("Account","logout") ?>">Đăng xuất</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../index.php">Website</a>
                </li>
            </ul>
            <!-- <form class="form-inline">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Search</button>
            </form> -->
        </div>
    </nav>

	<div class="container mt-3">
        <div class="row">
            <!-- <div class="col-3"> 
                <div class="cat">
                <table>
                    <tbody>
                        <tr><td> <a href="<?php echo URL::buildURL("Stories","showCreate"); ?>">Thêm truyện</a>  </td> </tr>
                        <tr><td> <a href="<?php echo URL::buildURL("Categories","showCreate"); ?>">Thêm thể loại</a>  </td></tr>
                    </tbody>
                </table>
                </div>
            </div>  -->
            <div class="col-12">
                <?php 
                    if ( file_exists("app/views/$this->file.php") ) require_once("app/views/$this->file.php"); 
                ?>                    
            </div>
    </div>
    <div>
        <?php if ( isset($Page) ) require_once("app/views/pagination.php");  ?>
    </div>
</body>
</html>