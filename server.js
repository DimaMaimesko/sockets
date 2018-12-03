
var http = require('http').Server();

var io = require('socket.io')(http);

// io.origins('*:*');
// io.set('origins', '*:*');

var Redis = require('ioredis');

var redis = new Redis();

redis.subscribe('chart-updated');

redis.on('message', function (channel, message) {
    message = JSON.parse(message);
    console.log('Message recieved: ' + message);
    console.log('Channel: ' + channel);
    console.log('Event: ' + message.event);
    console.log('Data: ' + message.data.result.labels);

    io.emit(channel + ':' + message.event, message.data.result);
});

http.listen(3005, function () {
    console.log('Listening port 3005...')
});
