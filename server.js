
// var http = require('http').Server();
//
// var io = require('socket.io')(http);

//io.origins('*:*');
//io.set('origins', '*:*');
//
// var Redis = require('ioredis');
//
// var redis = new Redis();
//
// redis.subscribe('chart-updated');
//
// redis.on('message', function (channel, message) {
//     console.log('Message recieved: ' + message);
//     console.log('Channel: ' + channel);
//     message = JSON.parse(message);
//     io.emit(channel + ':' + message.event, message.data);
// });
//
// http.listen(3000, function () {
//     console.log('Listening port 3000...')
// });
