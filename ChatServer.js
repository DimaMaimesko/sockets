
var server = require('http').Server();

var io = require('socket.io')(server);

var Redis = require('ioredis');//redis client for node.js

var redis = new Redis();

redis.subscribe('send-message');


redis.on('message', function (channel, message) {
    message = JSON.parse(message);
    console.log('Channel: ' + channel);
    console.log('Event: ' + message.event);
    console.log('Data: ' + message.data);
    console.log('Message: ' + message.data.message);
    io.emit(channel + ':' + message.event, message.data);
});

server.listen(3006, function(){
    console.log('listening chating on *:3006');
});
