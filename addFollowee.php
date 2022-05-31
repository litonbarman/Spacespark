<?php

    require_once 'databaseGlobal.php';
    
	
	function addFollowee($userid, $followeeid){
		
		$db = new DBConnection;
        $dbcon = $db->getConnection();
		$cmd = "INSERT INTO followee VALUES( '$userid', '$followeeid' );";
		
		if( $dbcon->query($cmd) ){
			return false;
		}
		
		return true;
	}

?>