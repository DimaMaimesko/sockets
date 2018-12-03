<!doctype html>
<html>
<head>
    <title>New Users</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font: 13px Helvetica, Arial; }
        form { background: #000; padding: 3px; position: fixed; bottom: 0; width: 100%; }
        form input { border: 0; padding: 10px; width: 90%; margin-right: .5%; }
        form button { width: 9%; background: rgb(130, 224, 255); border: none; padding: 10px; }
        #messages { list-style-type: none; margin: 0; padding: 0; }
        #messages li { padding: 5px 10px; }
        #messages li:nth-child(odd) { background: #eee; }
    </style>
</head>
<body>
<div id="chart">

    <ul v-for="item in users">@{{item}}</ul>
    <ul v-for="item in fromevent">@{{item}}</ul>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.2.0/socket.io.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script>

    var socket = io('http://127.0.0.1:3003');

    new Vue({
        el: "#chart",
        data: {
            users: [],
            fromevent: [],

        },

        mounted: function(){
            socket.on('test-channel:UserSignedUp', (data) => {
                this.users.push(data.username);
                console.log(this.users);
            });
            socket.on('chart-updated:App\\Events\\NewEvent', (data) => {
                this.fromevent.push(data.result);
                console.log(this.fromevent);
            });
        },
        methods: {


        }

    })



</script>

</body>
</html>
