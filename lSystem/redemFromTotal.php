<?php
    
	require_once "pointLoyality.php";
	
	echo PointLoyality::RedeemFromTotal($_GET['phone'], $_GET['redeem']);

?>