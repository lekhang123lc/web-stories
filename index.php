<?php
    define("#_JEXEC_#",1);

    include("config.php");
    include("app/routing.php");
    include("libraries/url.php");

    $app = new Routing();
    $app->start();
?>