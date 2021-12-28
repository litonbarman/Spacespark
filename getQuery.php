<?php
/*

------------------------------------------------
 NCC WEB PORTAL
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
   
   class getQuery {
	   
	   private $address;
	   private $username;
	   private $password;
	   private $dbname;
	   
	   private $usertable;
	   
	   
	    public function __construct(){
		   
		   $this->address = address;
		   $this->username = username;
		   $this->password = password;
		   $this->dbname = dbname;
		   
		   $this->usertable = usertable;
	    }
		
		
		 public function getQuery($id){
			
			try{
		        $con = new mysqli($this->address, $this->username, $this->password, $this->dbname);
				
				if( ! $con->connect_error ){
					
					throw new Exception("Failed to connect to database");
					
				}
				else{
					
					$cmd = "SELECT * FROM $this->usertable WHERE  ID = '$id';";
					
					try{
						
						$result = $con->query($cmd);
						
						if( ! $result ){
							throw new Exception("Unable to retrieve data from database ");
						}
						else{
							
							
							if( $result['Password'] == $password ){
							    mysqli_close($con);
							    return $result;	
								
							}
                            else{
								mysqli_close($con);
							    return false;
							}							
							
						}
					}
					catch(Exception $e){
						//echo "ERROR : ".$e->getMessage();
						return false;
					}
				}
		    }
			catch(Exception $e){
				//echo "ERROR : ".$e->getMessage();
				return false;
			}
			
		}  
		
		
   }
   
   
?>