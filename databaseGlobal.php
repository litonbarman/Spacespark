<?php

/*

------------------------------------------------
SpaceSpark
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


//   define("debug", true);


   define("address", "localhost");
   define("username", "root");
   define("password", "");
   define("dbname", "exampledb");


   define("users", "users");
   define("followee", "followee");
   define("follower", "follower");
   define("contact", "contact");
   define("story", "story");
   define("sparkgroup", "sparkgroup");
   define("groupmembers", "groupmembers");
   define("groupmessage", "groupmessage");
   define("message", "message");
   
   
   
   
   class DBConnection {
		
		protected $address;
	    protected $username;
	    protected $password;
	    protected $dbname;   
	   
	    public function __construct(){
			
		    $this->address  = address;
		    $this->username = username;
		    $this->password = password;
		    $this->dbname   = dbname;
	    }
		
		public function getConnection(){
			
			try{
				$con = new mysqli( $this->address, $this->username, $this->password, $this->dbname );
				
				if( $con->connect_error ){
					throw new Exception("Error : Failed to connect to database");
				}
				
				return $con;
			}
			catch(Exception $e){
				return false;
			}
		}
		
		public query($cmd){
			
		}
	}
   

?>