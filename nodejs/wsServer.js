var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);

// io.on('connection', function(socket){
//   socket.on('message', function(msg){
//     console.log('message: ' + msg);
//   });
// });

io.on('connection', function(socket){
  socket.on('message', function(msg){
    io.emit('message', msg);
  });
});

http.listen(9090, function(){
console.log('listening on *:9090');
});