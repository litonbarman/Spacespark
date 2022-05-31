<?php

    require_once 'databaseGlobal.php';
    
	
	function addSparkGroup($hasgroupimg, $groupimgurl, $about){
		
		$db = new DBConnection;
        $dbcon = $db->getConnection();
		$cmd = "INSERT INTO sparkgroup (hasgroupimg, groupimgurl, about) VALUES( '$hasgroupimg, '$groupimgurl', '$about' );";
		
		if( $dbcon->query($cmd) ){
			return false;
		}
		
		return true;
	}

?>