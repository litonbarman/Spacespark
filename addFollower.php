<?php

    require_once 'databaseGlobal.php';
    
	
	function addFollower($userid, $followerid){
		
		$db = new DBConnection;
        $dbcon = $db->getConnection();
		$cmd = "INSERT INTO follower VALUES( '$userid', '$followerid' );";
		
		if( $dbcon->query($cmd) ){
			return false;
		}
		
		return true;
	}

?>