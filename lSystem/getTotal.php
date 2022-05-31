<?php
   
    require_once "pointLoyality.php";
	
	echo PointLoyality::getTotalPoints($_GET['pnumber']);

?>