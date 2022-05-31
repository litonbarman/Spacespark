function AJAXCommunicate(method="POST", dest="process.php", query=null, handle=function(argu){console.log(argu);}){
    var sock;

    try{
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

function addSetupRow(phone, point, redeem){

    document.getElementById("se").style.display = "block";

    var div1 = document.getElementById("phone");
    var div2 = document.getElementById("point");
    var div3 = document.getElementById("redeem");

    div1.innerHTML = phone;
    div2.innerHTML = point;
    div3.innerHTML = redeem;
}


document.getElementById("number_but").onclick = function(){
   var number = document.getElementById("number").value;

   AJAXCommunicate("GET", "setup.php", "?number="+number, function(arg){
     if(arg != null){

         var result = JSON.parse(arg);
         addSetupRow( result[0][0], result[0][3], result[0][4] );
     }
   });

   showTotalPoints();
   showPoints();
   addRow3(number, 0);
}


document.getElementById("save").onclick = function(){
  var phone = document.getElementById("number").value;
  var point = document.getElementById("point").innerHTML;
  var redeem = document.getElementById("redeem").innerHTML;

  AJAXCommunicate("GET", "updateSetup.php", "?phone="+phone+"&point="+point+"&redeem="+redeem, function(arg){
    console.log(arg);
  });
}


function addRow(transId, points){

   var con = document.getElementById("container");

   var ind = document.createElement("div");
   ind.className = "con_individual";

   var el1 = document.createElement("div");
   var el2 = document.createElement("div");

   el1.className = "cols2";
   el2.className = "cols2";

   el1.innerHTML = transId;
   el2.innerHTML = points;

   ind.appendChild(el1);
   ind.appendChild(el2);

   con.appendChild(ind);
}

function addRow2(transId, points){

   var con = document.getElementById("container2");

   var ind = document.createElement("div");
   ind.className = "con_individual";

   var el1 = document.createElement("div");
   var el2 = document.createElement("div");

   el1.className = "cols2";
   el2.className = "cols2";

   el1.innerHTML = transId;
   el2.innerHTML = points;

   ind.appendChild(el1);
   ind.appendChild(el2);

   con.appendChild(ind);
}

function addRow3(transId, points){

   var con = document.getElementById("container3");

   var ind = document.createElement("div");
   ind.className = "con_individual";

   var el1 = document.createElement("div");
   var el2 = document.createElement("div");
   var el3 = document.createElement("div");

   el1.className = "cols2";
   el2.className = "cols2";
   el3.className = "cols2";

   el2.contentEditable = "true";

   el3.style.background = "#fff";
   el3.style.width = "100px";
   el3.style.marginLeft = "10";

   el1.innerHTML = transId;
   el2.innerHTML = points;
   el3.innerHTML = "Redeem";

   el3.onclick = function(){
     Redeem(el2.innerHTML);
   }

   ind.appendChild(el1);
   ind.appendChild(el2);
   ind.appendChild(el3);

   con.appendChild(ind);
}

function showPoints(){

	var pnumber = document.getElementById('number').value;

    AJAXCommunicate("GET", "getData.php", "?pnumber="+pnumber, function(arg){

		if( arg != null ){

			var result = JSON.parse( arg );

			for(i=0; i<result.length; i++){
				addRow2( result[i][1], result[i][2] );
			}

		}
		else{
			console.log(null);
		}

	});
}


function showTotalPoints(){

	var pnumber = document.getElementById('number').value;

    AJAXCommunicate("GET", "getTotal.php", "?pnumber="+pnumber, function(arg){

		addRow( pnumber, arg );

	});
}


function Redeem(redeem){  // redemFromTotal.php?phone=123&redeem=10
  var phone = document.getElementById("number").value;

  AJAXCommunicate("GET", "redemFromTotal.php", "?phone="+phone+"&redeem="+redeem, function(arg){

  });
}
