
var server = require('http').Server();

var io = require('socket.io')(server);

var Redis = require('ioredis');//redis client for node.js

var redis = new Redis();

redis.subscribe('test-channel');
redis.subscribe('chart-updated');

redis.on('message', function (channel, message) {
    // message = JSON.parse(message);
    console.log('Channel: ' + channel);
    console.log('Event: ' + message);
    // console.log('Data: ' + message.data);
    //console.log(message.data.username);
    // console.log(message.data.email);
    io.emit(channel + ':' + message.event, message.data);
});

server.listen(3003, function(){
    console.log('listening on *:3003');
});
