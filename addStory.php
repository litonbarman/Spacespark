<?php

    require_once 'databaseGlobal.php';
    
	
	function addStory($userid, $posttxt, $TEXT, $imgloc, $hasimg){
		
		$db = new DBConnection;
        $dbcon = $db->getConnection();
		$cmd = "INSERT INTO story (userid , posttxt, TEXT, imgloc, hasimg) VALUES( '$userid', '$posttxt', '$TEXT', '$imgloc', '$hasimg' );";
		
		if( $dbcon->query($cmd) ){
			return false;
		}
		
		return true;
	}

?>