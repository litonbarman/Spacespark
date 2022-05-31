<?php

    require_once 'databaseGlobal.php';
    
	
	function addContact($userid, $contactid){
		
		$db = new DBConnection;
        $dbcon = $db->getConnection();
		$cmd = "INSERT INTO contact VALUES( '$userid', '$contactid' );";
		
		if( $dbcon->query($cmd) ){
			return false;
		}
		
		return true;
	}

?>