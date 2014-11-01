<!DOCTYPE HTML>
<html>
<head>

<style type="text/css">
  #message{
    height: 200px;
  }
</style>
</head>
<body>
<div id="sse">
   <div id="message">
   </div>
   <input id="text">
   <button onclick="send()">SEND</button>
   

   <canvas id="myCanvas" width="300" height="300"></canvas>
   <script type="text/javascript">


var ws=0

  if ("WebSocket" in window)
  {
      document.getElementById('message').innerHTML="WEB SOCKET SUPPORTED";
     // Let us open a web socket
     ws = new WebSocket("ws://<?php echo $_SERVER['SERVER_ADDR']?>:8881");
     ws.onopen = function()
     {
        // Web Socket is connected, send data using send()
        document.getElementById('message').innerHTML+="<br>Connected";
     };
     ws.onmessage = function (evt) 
     { 
        var received_msg = evt.data;
        console.log(received_msg);
        received_msg=JSON.parse(received_msg);
        fillRect(received_msg)
     };
     ws.onclose = function()
     { 
        // websocket is closed.
        document.getElementById('message').innerHTML+="<br>Connection closed";
     }
    /* ws.onopen = function()
     {
        // Web Socket is connected, send data using send()
        ws.send("Message to send");
        alert("Message is sent...");
     };
     ws.onmessage = function (evt) 
     { 
        var received_msg = evt.data;
        alert("Message is received...");
     };
     ws.onclose = function()
     { 
        // websocket is closed.
        alert("Connection is closed..."); 
     };*/
  }
  else
  {
     // The browser doesn't support WebSocket
     document.getElementById('message').innerHTML="WEB SOCKET CONNECTION FAILED";
  }
  function send(){
    ws.send(document.getElementById('text').value);
  }

//while(1)
//  ws.send("hello");
</script>


<script>
function fillRect(myarray){
  var c = document.getElementById("myCanvas");
  var ctx = c.getContext("2d");
  for (var i = 0; i < myarray.length; i++) {
    data=myarray[i];
    ctx.fillStyle = "rgb("+(data[2])+","+(data[3])+","+(data[4])+")";    
    ctx.fillRect( data[0]-1, data[1]-1, data[0], data[1] );
  };
}

</script>
</div>
</body>
</html>