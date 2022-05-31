<?php
   
    require_once "pointLoyality.php";

    echo PointLoyality::updateAllUnique( $_GET['phone'], $_GET['point'], $_GET['redeem'] );

?>