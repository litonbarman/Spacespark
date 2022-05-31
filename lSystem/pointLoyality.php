<?php

/*

---------------------------------------------------------------

    POINT BASED LOYALITY SYSTEM   
	
---------------------------------------------------------------
	Author : Liton Barman
---------------------------------------------------------------


    PointLoyality                                 ->   the main class
	Data                                          ->   arbitary class / datastructure ( the data flow class ) 
	
	PointLoyality::setup()                        ->   this function create the necessary table for this system into the database
	
	PointLoyality::getAll()                       ->   this function return all th data stores into the PointLoyality table
	PointLoyality::getSingleUnique()              ->   this function return the data of single user based on phone number
	PointLoyality::updateAllUnique()              ->   this function update all entries (pointType & earnType) of particular phone number
	PointLoyality::getAllUnique()                 ->   it return all the detail / all transaction and its associated with the particular/unique phoneNo
	PointLoyality::getAllUniqueNonJSON()          ->   it return all entries of a particular phone number in non JSON format
	PointLoyality::getCon()                       ->   return connection of the database
	PointLoyality::getTable()                     ->   return the table name of this system
    PointLoyality::getData()                      ->   return data of the individual entry as an instance of the class Data define at the begining
    PointLoyality::insertNewPointGroup()          ->   create new entry into the the database
    PointLoyality::updatePoint()                  ->   update point of the newly created entry
	PointLoyality::updateEarnType()               ->   update the earn type associated with the phone_number & transaction_id
	PointLoyality::updateBurnType()               ->   update the burn type associated with the phone_number & transaction_id
    PointLoyality::updateExpiry()                 ->   update the expiry date associated with the phone_number & transaction_id 
    
	PointLoyality::calculatePoints()              ->   calculate and return points earned based on the amount_spend
	PointLoyality::calculateRedeem()              ->   calculate and return the redeem from number of points
	PointLoyality::Redeem()                       ->   update the point and return the redeem amountPoint
    PointLoyality::Earn()                         ->   calculate and update points
    PointLoyality::isExpired()                    ->   check if the points associated with the phone_number & transaction_id is expired or not	if yes it return true, false otherwise
	PointLoyality::getTotalPoints()               ->   it return the total usable / valid point associated by the particular phone number
    PointLoyality::RedeemFromTotal()              ->   this function redeem points calculated from all the valid(non-expired entries) of a particular phone  number	



	Earn Type  (1, 10, 100) :-
	Points earned  |  Money Spend / earn type
	    1          |      1
		1          |      10
		1          |      100
	
	
    Burn Type (1, 10, 1000) :-
	Money get      |  Points spend / burn type
        1          |       1
        1          |       10
        1          |       1000



    
	Note :  No need to create the instance of the PointLoyality class, 
	        instead call the necessary function as PointLoyality::function_name(),
			because the class itself including all its featurea are defined statically 
	
*/

   
    define("address",  "localhost");
    define("username", "root");
    define("password", "");
    define("dbname",   "rise_retail");

    define("pntLylSys", "point_loyality_system");


	class Data {

        public $phoneNo;
		public $tranId;
		public $Points;
		public $EarnType;
		public $BurnType;
		public $Expiry;
	}

    abstract class PointLoyality {

		protected static $address  = address;
	    protected static $username = username;
	    protected static $password = password;
	    protected static $dbname   = dbname;   
	    protected static $table    = pntLylSys;

	    public function __construct(){}
		public function __destruct(){}

		public static final function setup(){

			$con = self::getCon();

			if( $con != NULL ){
				
				$table = pntLylSys;

				$cmd = "CREATE TABLE $table (PhoneNumber VARCHAR(14) NOT NULL PRIMARY KEY, TransactionId VARCHAR(30) NOT NULL UNIQUE, Points INT NOT NULL, EarnType INT NOT NULL, BurnType INT NOT NULL, Expiry DATE NOT NULL );";

				if( !$con->query($cmd) ){
					echo "Error : Setup failed";
				}
			}
		} 
		
		public static final function getAll(){
			
			$con = self::getCon();
			
			if( $con != NULL ){
				
				$table = pntLylSys;
				
				$cmd = "SELECT * FROM $table;";
				
				$data = $con->query( $cmd );
				
				if( $data ){
					$result = NULL;
				    $a=0;
				
				    while( $row = mysqli_fetch_array($data) ){
					    
						$arr[0] = $row[0];
						$arr[1] = $row[1];
						$arr[2] = $row[2];
						$arr[3] = $row[3];
						$arr[4] = $row[4];
						$arr[5] = $row[5];
						
						$result[$a++] = $arr;
				    }
					
					if( $result != NULL){
						echo json_encode($result);
					}
					else{
						echo NULL;
					}
				}
				else{
					echo NULL;
				}
			}
		}
		
		public static final function getSingleUnique($phoneNo){
			
			$con = self::getCon();
			
			if( $con != NULL ){
				
				$table = pntLylSys;
				
				$cmd = "SELECT * FROM $table WHERE PhoneNumber = '$phoneNo';";
				
				$data = $con->query( $cmd );
				
				if( $data ){
					$result = NULL;
				    $a=0;
				
				    while( $a==0 && $row = mysqli_fetch_array($data) ){
					    
						$arr[0] = $row[0];
						$arr[1] = $row[1];
						$arr[2] = $row[2];
						$arr[3] = $row[3];
						$arr[4] = $row[4];
						$arr[5] = $row[5];
						
						$result[$a++] = $arr;
				    }
					
					if( $result != NULL){
						return json_encode($result);
					}
					else{
						return NULL;
					}
				}
				else{
					return NULL;
				}
			}
			
		}
		
		public static final function updateAllUnique($phone, $point, $redeem){
			
			$con =  self::getCon();

			if( $con != NULL ){
				
				$table = pntLylSys;
				
				$cmd = "UPDATE $table SET EarnType = '$point', BurnType = '$redeem' WHERE PhoneNumber = '$phone'; ";
				
				$result = $con->query($cmd);
				
				if( !$result ){
					return NULL;
				}
				return 1;
			}
		}
		
		public static final function getAllUnique($phoneNo){
			
			$con = self::getCon();
			
			if( $con != NULL ){
				
				$table = pntLylSys;
				
				$cmd = "SELECT * FROM $table WHERE PhoneNumber = '$phoneNo';";
				
				$data = $con->query( $cmd );
				
				if( $data ){
					$result = NULL;
				    $a=0;
				
				    while( $row = mysqli_fetch_array($data) ){
					    
						$arr[0] = $row[0];
						$arr[1] = $row[1];
						$arr[2] = $row[2];
						$arr[3] = $row[3];
						$arr[4] = $row[4];
						$arr[5] = $row[5];
						
						$result[$a++] = $arr;
				    }
					
					if( $result != NULL){
						return json_encode($result);
					}
					else{
						return NULL;
					}
				}
				else{
					return NULL;
				}
			}
		}
		
		public static final function getAllUniqueNonJSON($phoneNo){
			
			$con = self::getCon();
			
			if( $con != NULL ){
				
				$table = pntLylSys;
				
				$cmd = "SELECT * FROM $table WHERE PhoneNumber = '$phoneNo';";
				
				$data = $con->query( $cmd );
				
				if( $data ){
					$result = NULL;
				    $a=0;
				
				    while( $row = mysqli_fetch_array($data) ){
					    
						$arr[0] = $row[0];
						$arr[1] = $row[1];
						$arr[2] = $row[2];
						$arr[3] = $row[3];
						$arr[4] = $row[4];
						$arr[5] = $row[5];
						
						$result[$a++] = $arr;
				    }
					
					if( $result != NULL){
						return $result;
					}
					else{
						return NULL;
					}
				}
				else{
					return NULL;
				}
			}
		}

		public static final function getCon(){

			try{
			    $con = new mysqli( self::$address, self::$username, self::$password, self::$dbname );

				if( $con->connect_error ){
					throw new Exception("Error : Connection error");
				}
				else{
					return $con;
				}
			}
        	catch(Exception $e){
				return NULL;
			}		
		}
		
		public static final function getTable(){
			return self::$table;
		}
		
		
		public static final function getData( $phoneNo, $transNo ){
			
			$con = self::getCon();
			
			if( $con != NULL ){
				
				$table = pntLylSys;

				$cmd = "SELECT * FROM $table WHERE PhoneNumber = '$phoneNo' AND TransactionId = '$transNo';";

				$result = $con->query($cmd);

				if( !$result ){
					return NULL;
				}
				else{
					
					$row = mysqli_fetch_row($result);
					
					$temp = new Data;
                    
				    $temp->phoneNo   = $row[0];
				    $temp->tranId    = $row[1];
				    $temp->Points    = $row[2];
	                $temp->EarnType  = $row[3];
	                $temp->BurnType  = $row[4];
	                $temp->Expiry    = $row[5];
                         
					return $temp;				
				}
			}
		}
		
		public static final function insertNewPointGroup($phoneNo, $transNo){
			
			$con = self::getCon();
			
			if( $con != NULL ){
				
				$today =  date("Y-m-d");
				$table = pntLylSys;
				
				$cmd = "INSERT INTO $table ('PhoneNumber', 'TransactionId', 'Points', 'EarnType', 'BurnType', 'Expiry') VALUES ( '$phoneNo', '$transNo', '0', '1', '1', '$today')";
				
				$result = $con->query($cmd);
				
				if( !$result ){
					return NULL;
				}
				else{
					return 1;
				}
			}
		}

		public static final function updatePoint( $phoneNo, $transNo, $point){

			$con =  self::getCon();

			if( $con != NULL ){
				
				$table = pntLylSys;
				
				$cmd = "UPDATE $table SET Points = '$point' WHERE PhoneNumber = '$phoneNo' AND TransactionId = '$transNo'; ";
				
				$result = $con->query($cmd);
				
				if( !$result ){
					return NULL;
				}
				return 1;
			}
		}
		
		public static final function updateEarnType( $phoneNo, $transNo, $type ){
			
			$con = self::getCon();
			
			if( $con != NULL ){
				
				try{
					$table = pntLylSys;
					
					$cmd = "UPDATE $table SET EarnType = '$type' WHERE PhoneNumber = '$phoneNo' AND TransactionId = '$transNo';";
					
					$result = $con->query( $cmd );
					
					if(!$result){
						return NULL;
					}
					else{
						return 1;
					}
				}
				catch(Exception $e){
				    return NULL;
				}
			}
			else{
				return NULL;
			}
			
		}
		
		public static final function updateBurnType( $phoneNo, $transNo, $type ){
			
			$con = self::getCon();
			
			if( $con != NULL ){
				
				try{
					
					$table = pntLylSys;
					
					$cmd = "UPDATE $table SET BurnType = '$type' WHERE PhoneNumber = '$phoneNo' AND TransactionId = '$transNo'; ";
					
					$result = $con->query( $cmd );
					
					if(!$result){
						return NULL;
					}
					else{
						return 1;
					}
				}
				catch(Exception $e){
					return NULL;
				}
			}
			else{
				return NULL;
			}
		}

		public static final function updateExpiry( $phoneNo, $transNo, $date ){

			$con = self::getCon();

			if( $con != NULL  ){

				try{
					
					$table = pntLylSys;
					
					$cmd = "UPDATE $table SET Expiry = '$date' WHERE PhoneNumber = '$phoneNo' AND TransactionId = '$transNo';";

					$result = $con->query( $cmd );
					
					if(!$result){
						return NULL;
					}
					else{
						return 1;
					}
				}
				catch(Exception $e){
					return NULL;
				}
			}
			else{
				return NULL;
			}
		}
		
		public static final function calculatePoints( $phoneNo, $transNo, $amountSpend ){
			
			$data = self::getData( $phoneNo, $transNo );
			return $amountSpend / $data->EarnType;
		}
		
		public static final function calculateRedeem( $phoneNo, $transNo, $pointRedeem ){
			
			$data = self::getData( $phoneNo, $transNo );
            return $data->Points / $pointRedeem;
		}
		

		public static final function Redeem( $phoneNo, $transNo, $amountPoint ){

			$data = self::getData( $phoneNo, $transNo );
			$points = $data->Points;
			
			self::updatePoint( $phoneNo, $transNo, ( $points - $amountPoint ) );
			return self::calculateRedeem( $phoneNo, $transNo, $amountPoint );
		}

		public static final function Earn( $phoneNo, $transNo, $spend ){

			$data = self::getData($phoneNo, $transNo);
            $points = $data->Points;

			$earn = self::calculatePoints( $phoneNo, $transNo, $spend );
			self::updatePoint( $phoneNo, $transNo, ($points + $earn) );
		}

		public static final function isExpired( $phoneNo, $transNo ){

			$data = self::getData($phoneNo, $transNo);
			$expiry = $data->Expiry;

			$expiry = strtotime($expiry);
			$expiry = date("Y-m-d", $expiry);

			$today = date("Y-m-d");

			if( $today <= $expiry ){
				return false;
			}
			else{
				return true;
			}
		}

	    public static final function getTotalPoints($phoneNo){

			$data = json_decode( PointLoyality::getAllUnique( $phoneNo ) );
			$points = 0;

			if( $data != NULL ){

			    for($i=0; $i<count($data); $i++){

				    if( !PointLoyality::isExpired( $data[$i][0], $data[$i][1] ) ){
					    $points += $data[$i][2];
				    }
			    }
			}

			return $points;
		}
		
		public static final function RedeemFromTotal($phoneNo, $redeem){
			
			$data = self::getAllUniqueNonJSON($phoneNo);
						
			for( $i=0; $redeem!=0 || $i<count($data); $i++ ){
				
				if( !self::isExpired( $data[$i][0], $data[$i][1] ) ){

                    if( $data[$i][2]>0 && $data[$i][2] >= $redeem ){
						
						self::updatePoint( $data[$i][0], $data[$i][1], ($data[$i][2]-$redeem) );
						$redeem = 0;
						break;
					}
                    else{
						if( $data[$i][2]>0 && $data[$i][2] < $redeem ){
						
						    $newR = $redeem - $data[$i][2];
						    self::updatePoint( $data[$i][0], $data[$i][1], 0 );
						    $redeem = $newR;
					    }
					}
				}					
			}
		}
			
	}

?>