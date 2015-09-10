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
<script src="socket.js" type="text/javascript"></script>
<input id="sock-addr" type="hidden" value="ws://vm12721.hv8.ru:8000"><br />
Users Log: 
<div id="sock-info" style="border: 1px solid"> </div>
</body>
</html>