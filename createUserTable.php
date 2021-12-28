<?php
   
/*

------------------------------------------------
 SPACESPARK
------------------------------------------------
 Author : Liton Barman
  
 This software is License under GNU General Public License
 version 3 ( GPLv3 )
 
 Redistribution and use of this software in source and binary forms, 
 with or without modification, are permitted provided that 
 the following conditions are met:
 
 . The source code must be made public whenever a distribution of
   the software is made.
 . Modifications of the software must be realised under the same license
 . Changes made to the Source Code must be documented


*/  


   require_once('databaseGlobal.php');
	
	
   
    
    function createTable($con){
		
		$cmd = "CREATE TABLE userdata ( ID INT NOT NULL AUTO_INCREMENT, username VARCHAR(100), email VARCHAR(100), password VARCHAR(100), regtno VARCHAR(12), PRIMARY KEY(ID) );";
		
		
		try{
			if( ! $con->query( $cmd ) ){
				throw new Exception("Failed to create UserData Table, please try again ");
			}
			else{
				echo "Table UserData created, try to insert new entries again ";
				
				mysqli_close($con);
			}
		}
		catch(Exception $e){
			echo "ERROR : ".$e->getMessage();
		}
		
	}
	
	function entryData($username, $email,  $password, $REGTNO){
	    try{
	        $con = new mysqli(address, username, password, dbname);
			   
	        if( $con->connect_error ){	
			    throw new Exception("Failed to establise connection to sqli server .<br/>");
	        }
	        else{	   
		        $cmd = "SELECT * FROM userdata;";
				   
				try{
					if( ! $con->query($cmd) ){
						throw new Exception("Last insertion failed or table doesn't exist <br/>");
					}
					else{
						mysqli_close($con);
						$con = new mysqli(address, username, password, dbname);
						
						if( $con->connect_error){
							echo "Connection error<br/>";
							return false;
						}
						
						$cmd = "INSERT INTO userdata (username, email, password, regtno) VALUES ('$username', '$email', '$password', '$REGTNO');";
						
						// echo $username." ".$email." ".$password." ".$REGTNO."<br/>";
						
						try{
							if( ! $con->query($cmd) ){
								throw new Exception("Insertion failed due to some unknown error <br/>");
							}
							else{
								echo "Insertion successfull<br/>";
							}
						}
						catch(Exception $e){
							echo "ERROR : ".$e->getMessage();
						}
						
						
						mysqli_close($con);
						return true;
					}
				}
				catch(Exception $e){
					echo "ERROR : ".$e->getMessage();
					
					echo "Creating the User Data Table <br/>";
					createTable( $con );
					
					
					return false;
				}
			}
		}
		catch(Exception $e){
    	    echo "ERROR : ".$e->getMessage();
		    return false;
		}    
	   
	   
	   
    }
   
if( isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password1']) && isset($_POST['nccid'])  ){
    
	entryData( $_POST['name'], $_POST['email'], $_POST['password1'], $_POST['nccid'] );  

}
  
  

?>