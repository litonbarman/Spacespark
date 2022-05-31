<?php

    require_once 'databaseGlobal.php';
    
	
	function addUser($username, $emailid, $phoneno, $password, $status, $profileurl, $hasprofile, $dob){
		
		$db = new DBConnection;
        $dbcon = $db->getConnection();
		$cmd = "INSERT INTO users VALUES( '$username'. '$emailid', '$phoneno', '$password', '$status', '$profileurl', '$hasprofile', '$dob');";
		
		if( $dbcon->query($cmd) ){
			return false;
		}
		
		return true;
	}
	
?>