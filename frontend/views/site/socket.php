<?php
	$this->registerJsFile('/frontend/web/js/socket.js');
	echo '<b>ClientSocket</b>';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Siple Web-Socket Client</title>
</head>
<body>
<br /><br />

<script src="socket.js" type="text/javascript"></script>

Server address:
<input id="sock-addr" type="text" value="ws://vm12721.hv8.ru:8000"><br />
Message:
<input id="sock-msg" type="text">

<input id="sock-send-butt" type="button" value="send">
<br />
<br />
<input id="sock-recon-butt" type="button" value="reconnect"><input id="sock-disc-butt" type="button" value="disconnect">
<br />
<br />

Полученные сообщения от веб-сокета: 
<div id="sock-info" style="border: 1px solid"> </div>

</body>
</html>