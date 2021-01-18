<?php

if ( !defined("#_JEXEC_#") ){
    echo "<a style = 'font-size: 100px;' href = 'index.php'> Quay lại trang chủ </a> ";
    die;
}

?>
<!-- login page -->
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Trang đăng nhập </title>
		<link rel="stylesheet" type="text/css" href="public/stylesheet/Account/login.css">
	</head>
	<body>
		
		<div class="form-style-6">
            <?php if ( isset($this->message) ) : ?>
                <div class="alert alert-danger" role="alert"> 
                    <strong> <?php echo $this->message; ?> </strong>
                </div>
            <?php endif; ?>