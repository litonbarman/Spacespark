
/*
background-image:url('bac.jpg');
background-size:contain;
background-repeat: no-repeat;
background-position: center;
background-attachment: fixed;
*/

function print(x){
  document.getElementById('debug').innerHTML = x;
}


function maintainSize(){

  var box = document.getElementById('box');
  var a = document.getElementById('profileN');
  var b = document.getElementById('searchButton');
  var c = document.getElementById('search');


  a.style.right = 0+"px";
  var perA = ((a.offsetWidth + 5) / box.offsetWidth )*100;

  b.style.right = perA+"%";

  var perB = (((b.offsetWidth + 5) / box.offsetWidth )*100) + perA;

  c.style.right = perB+"%";

// vertical
  var g = document.getElementById('aInvitation');  // 625

  g.style.height = (window.innerHeight - 725) + "px";


  document.getElementById('aArrowUP').innerHTML = "<";
  document.getElementById('aArrowDOWN').innerHTML = "<";




  // make it center and set it's size

  var articleStory =  document.getElementById('articleStory');
  articleStory.style.width = (window.innerWidth- 580 - ((2/100) * window.innerWidth) );
  articleStory.style.left = (window.innerWidth - articleStory.offsetWidth)/2;

  var articleWhatsNew = document.getElementById('articleWhatsNew');
  articleWhatsNew.style.width = articleStory.offsetWidth + "px";

  articleWhatsNew.style.left = (window.innerWidth - articleWhatsNew.offsetWidth)/2;

  var articleContext1 = document.getElementById('articleContext1');
  articleContext1.style.width = articleStory.offsetWidth + "px";
  articleContext1.style.left = (window.innerWidth - articleContext1.offsetWidth)/2;
  articleContext1.style.height = (window.innerHeight - 455) + "px";

  var articleChats = document.getElementById('articleChats');
  articleChats.style.width = articleStory.offsetWidth + "px";
  articleChats.style.left = (window.innerWidth - articleContext1.offsetWidth)/2;
  articleChats.style.height = (window.innerHeight - 455) + "px";

  var chatsInput = document.getElementById('ChatsInput');
  chatsInput.style.width = articleChats.offsetWidth - 95;

  var chatsContainer = document.getElementById('ChatsContainer');
  chatsContainer.style.height = articleChats.offsetHeight - 50;

  // make articleContact size

  var articleContact = document.getElementById('articleContact');
  articleContact.style.height = (window.innerHeight - 550) + "px";


  // what new input
 var whatsnewInputParent = document.getElementById('articleWhatsNew').offsetWidth;
 var whatsnewInput = document.getElementById('articleWhatsNewInput');
 whatsnewInput.style.width = ( whatsnewInputParent - 194 ) + "px";



 youGotInvitation('req.jpg');
 friendRequest();
 friendRequest();

 addStory('story/story5.jpg');
 addStory('story/story1.jpg');
 addStory('story/story2.jpg');
 addStory('story/story3.jpg');
 addStory('story/story1.jpg');
 addStory('story/story2.jpg');
 addStory('story/story3.jpg');
 addStory('story/story1.jpg');
 addStory('story/story2.jpg');
 addStory('story/story3.jpg');


 addContact('profile.jpg', "Thomas Rhett");
 addContact('req.jpg', "Sam Smith");
 addContact('story/story1.jpg', "Liton Barman");

 // addPost(imageUrl, name, time, story, img1, img2, img3){
 addPost("profile.jpg", "Liton Barman", "10min ago", "dsfdsfddddddddvdsfvdsghs sgfsdfg sfdgsf", "", "", "");

 addClientChatBubble("Hello World");
 addServerChatBubble("Hello !");

}

function nFeed(x){
  var s = document.getElementById('nFeedNum');

  s.innerHTML = x;

  if(x>0){
     s.style.display = "block";
  }
  else{
     s.style.display = "none";
  }
}

function nInvi(){
  var s = document.getElementById('aInvitagNum');
  var c = document.getElementById('aInContain').childElementCount;


  if(c==0){
    s.style.display = "none";
  }
  else{
    s.innerHTML = c;
    s.style.display = "block";
  }

}

function scrollIT(x){

  if( (scrollAmount == 0 && x==1)){
    return;
  }




  if(x==1){
    scrollAmount -= 290;
    --scrollNO;
  }
  else{
    scrollAmount += 290;
    --scrollNO;
  }

  if(scrollAmount==0){
    document.getElementById('aArrowUP').style.display = "none";
    if(document.getElementById("aInContain").childElementCount == 2){
      document.getElementById('aArrowDOWN').style.display = "block";
    }
  }
  else if(( document.getElementById("aInContain").childElementCount * 290 ) == scrollAmount+290){
    document.getElementById('aArrowDOWN').style.display = "none";
    if(document.getElementById("aInContain").childElementCount == 2){
      document.getElementById('aArrowUP').style.display = "block";
    }
  }
  else{
      document.getElementById('aArrowUP').style.display = "block";
      document.getElementById('aArrowDOWN').style.display = "block";
  }
  scrollInvitation();
}

let scrollAmount = 0, scrollNO = 0;

function scrollInvitation(){
  var i = document.getElementById('aInContain');
  i.scrollTo(0, scrollAmount);
}

function removeyouGotInvitation(parent){
//  scrollAmount = 0; scrollNo = 0;
  scrollIT(1);
  parent.remove();
}

function youGotInvitation(imgURL){
   var contain = document.getElementById('aInContain');

   var invi = document.createElement('div');
   invi.className = "aInviG";

   var img = document.createElement('div');
   img.className = "aInviGImg";
   img.style.backgroundImage = "url("+imgURL+")";
   invi.appendChild(img);

   var option = document.createElement('div');
   option.className = "aInviGOPtion";
   option.innerHTML = "Accept Invitation";
   invi.appendChild(option);

   var cross = document.createElement('div');
   cross.className = "aInviCross";
   cross.innerHTML = "&#10060";
   cross.addEventListener("click", function(){ removeyouGotInvitation(invi) });
   invi.appendChild(cross);


   contain.appendChild(invi);


   if( contain.childElementCount == 0 || contain.childElementCount == 1 ){
     document.getElementById('aArrowUP').style.display = "none";
     document.getElementById('aArrowDOWN').style.display = "none";
   }
   else{
     document.getElementById('aArrowUP').style.display = "none";
     document.getElementById('aArrowDOWN').style.display = "block";
   }

nInvi();

}


function friendRequest(){

   var reContext = document.getElementById('articleRequest');

   var eachRequest = document.createElement("div");
   eachRequest.className = "articleRequestEach";

   var image = document.createElement('div');
   image.className = "articleRequestEachImage";
   eachRequest.appendChild(image);

   var text = document.createElement("div");
   text.className = "articleRequestText";
   text.innerHTML = "Salena Wants to add you to friend";
   eachRequest.appendChild(text);

   var button1 = document.createElement('div');
   button1.className = "articleRequestButton";
   button1.innerHTML = "Accept";
   eachRequest.appendChild(button1);

   var button2 = document.createElement('div');
   button2.className = "articleRequestButton";
   button2.innerHTML = "Delete";
   button2.style.left = 120+"px";
   button2.style.background = "white";
   button2.style.color = "black";
   eachRequest.appendChild(button2);

   reContext.appendChild(eachRequest);
}


function addStory(imgURL){

  var parent = document.getElementById('articleStory');
  var story = document.createElement('div');
  story.className = "articleStoryEach";
  story.style.backgroundImage = "url("+imgURL+")";;

  parent.appendChild(story);
}



function addContact(image, name){

   var con = document.getElementById('articleContact');

   var each = document.createElement('div');
   var img = document.createElement('div');
   var txt = document.createElement('div');

   each.className = "articleContactEach";
   img.className = "articleContactEachImg";
   img.style.backgroundImage = "url("+image+")";
   txt.className = "articleContactEachTxt";
   txt.innerHTML = name;

   each.appendChild(img);
   each.appendChild(txt);

   con.appendChild(each);
}



function addPost(imageUrl, name, time, story, img1, img2, img3){

   var con = document.getElementById('articleContext1');

   var each = document.createElement('div');
   var img = document.createElement('div');

   var imgname = document.createElement('div');
   var imgnamebr = document.createElement('br');
   var imgnamespan = document.createElement('span');

   var eachmeta = document.createElement('div');

   var portimg = document.createElement('div');
   var portimg1 = document.createElement('div');
   var portimg2 = document.createElement('div');
   var portimg3 = document.createElement('div');


   img.className = "articleContextEachImage";
   img.style.backgroundImage = "url("+imageUrl+")";

   imgname.className = "articleContextEachImageName";
   imgname.innerHTML = name;
   imgname.appendChild(imgnamebr);
   imgnamespan.innerHTML = time;
   imgname.appendChild(imgnamespan);

   eachmeta.className = "articleContextEachMeta";
   eachmeta.innerHTML = story;

   if(img1 != ""){
     portimg1.style.backgroundImage = "url("+img1+")";
   }

   if(img2 != ""){
     portimg2.style.backgroundImage = "url("+img2+")";
   }

   if(img3 != ""){
     portimg3.style.backgroundImage = "url("+img3+")";
   }

   portimg.className = "ariticleContextEachPortImages";
   portimg1.className = "ariticleContextEachPortImages1";
   portimg2.className = "ariticleContextEachPortImages2";
   portimg3.className = "ariticleContextEachPortImages3";

   portimg.appendChild(portimg1);
   portimg.appendChild(portimg2);
   portimg.appendChild(portimg3);

   each.className = "articleContextEach";
   each.appendChild(img);
   each.appendChild(imgname);
   each.appendChild(eachmeta);
   each.appendChild(portimg);

   con.appendChild(each);
}

let rightImg = new Image();
rightImg = "left.svg";

let leftImg = new Image();
leftImg = "right.svg";

function addClientChatBubble(text){
  var con = document.getElementById("ChatsContainer");
  var bubble = document.createElement("div");

  bubble.className = "chatBubble";
  bubble.style.left = document.getElementById("ChatsContainer").offsetWidth/2 - 20;
  bubble.innerHTML = text;

  var img = document.createElement("img");
  img.src = rightImg;
  img.className = "chatBubbleRight";
  bubble.appendChild(img);

  con.appendChild(bubble);
}

function addServerChatBubble(text){
  var con = document.getElementById("ChatsContainer");
  var bubble = document.createElement("div");

  bubble.className = "chatBubble";
    bubble.style.left = document.getElementById("ChatsContainer").offsetWidth/2  - 180;
  bubble.innerHTML = text;

  var img = document.createElement("img");
  img.src = leftImg;
  img.className = "chatBubbleLeft";
  bubble.appendChild(img);

  con.appendChild(bubble);
}








// dfds
