$( document ).ready(function() {

    var socket = io.connect('http://vm12721.hv8.ru:8890');

    socket.on('notification', function (data) {

        var message = JSON.parse(data);

        $( "#notifications" ).prepend( "<p><strong>" + message.name + "</strong>: " + message.message + "</p>" );

    });

});