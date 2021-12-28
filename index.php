<?php
  
  session_start();
  
  if( isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN']==true ){
	  
	
 $level = 1;           // set level of Current Working Directory
    

	$a = str_split( $_SERVER['DOCUMENT_ROOT'], 1 );	
	$b = dirname(__FILE__);
	
	while($level--){
		
		if($level == 0){
			$b = str_split( $b, 1 );
			break;
		}
		else{
			$b = dirname( $b );
		}
	}
	
	
	$no = 0;
	
	while( $no < count($a) ){
		
		if( $a[$no] == $b[$no] ){
			$no++;
		}
		else if( ( $a[$no] == '\\' || $a[$no] == '/' ) && ( $b[$no] == '\\' || $b[$no] == '/' ) ){
			$no++;
		}
		else{
			break;
		}
	}

    $at = 0;
    $path[$at] = '/';
	
	while($no < count($b)){
		
		if( $b[$no] == '\\' ){
			$path[$at] = '/'; 
		}
		else{
			$path[$at] = $b[$no];
		}
		
		$no++;
		$at++;
	}



    $path = $_SERVER['SERVER_NAME'].implode("", $path);

    
   header( 'Location:http://'.$path."/index.html" ); 
		
	  
	  
  }
  else{
    
    
	header( 'Location:http://'.$path."/loginsignup.html" ); 
	
	
  }
?>