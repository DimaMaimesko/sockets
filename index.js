var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);

app.get('/abc', function(req, res){
    res.sendFile(__dirname + '/index.html');
});


io.on("connection", function(socket){
    console.log('a user connected');
    io.emit('message_from_server', 'A new User has connected');
    socket.on('chat message', function(msg){
        console.log('message: ' + msg);
        io.emit('message_from_server', msg);
    });
    socket.on('disconnect', function(){
        console.log('user disconnected');
        io.emit('message_from_server', 'User has disconnected');
    });
});

http.listen(3001, function(){
    console.log('listening on *:3001');
});
