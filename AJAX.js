

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



function AJAX(method="GET", dest="process.php", query=null, handle=function(argu){document.write(argu);}){
    var sock;
	 
	try  {    
        sock = new XMLHttpRequest();
    }
	catch(e){
        
		console.log(e.message);
		
		try{      
            sock = new ActiveXObject("Microsoft.XMLHttp");    
        }
        catch(e){
			console.log(e.message);
		}  
    }

	if( sock ){
	    
		sock.open(method, (dest.concat(query)), true);
     
	    sock.onreadystatechange = function(){
        
		    if(sock.readyState==4 && sock.status==200){
		        handle(sock.responseText);
		    }	
	    }
    
	    sock.send(null);
	}
	else{
		console.log("ERROR : Something went wrong with the Asyncronize connection");		
	}
 }
 
/* Example use of the AJAX function :
 
 AJAX("GET", "AJAX.php", "", function(ds){console.log(ds);});
 
 
 function conditionalCall(){
	 
	 AJAX("GET", "AJAX.php", "", function(arg){
		 // process the responseText arg
	 });
	 
 } 
 
 
 
*/
