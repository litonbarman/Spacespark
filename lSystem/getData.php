<?php
   
    require_once "pointLoyality.php";
	
	echo PointLoyality::getAllUnique($_GET['pnumber']);

?>