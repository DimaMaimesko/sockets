
var server = require('http').Server();

var io = require('socket.io')(server);

var Redis = require('ioredis');//redis client for node.js

var redis = new Redis();

redis.psubscribe('private-message.*');


redis.on('pmessage', function (pattern, channel, message) {
    message = JSON.parse(message);
    console.log('Channel: ' + channel);
    console.log('Event: ' + message.event);
    console.log('Message: ' + message.data.message);
    console.log(channel + ':' + message.event);

    io.emit(channel + ':' + message.event, message.data);
});

server.listen(3007, function(){
    console.log('listening chating on *:3007');
});
