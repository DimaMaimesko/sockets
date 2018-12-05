<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>Private room # {{room.name}}</h1>
                <h5>for next users:</h5>
                <ul v-for="user in room.users">{{user.name}}</ul>
                <div class="card card-default">
                    <div class="card-header">
                        <textarea rows="10" class="form-control" readonly="true">
                            {{allMessages.join('\n')}}
                        </textarea>
                    </div>
                    <div class="card-body">
                      <input v-model="message" @keyup.enter="sendMessage" type="text" class="form-control" placeholder="Enter your message here and press Enter">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>



    export default {

        props: {
          room: {},
        },

       data: function(){
           return {
               allMessages: [],
               message: '',
           }
       },

        mounted() {
           console.log('Users: ' + this.room.users);
           console.log('Room id: ' + this.room.id);
           window.Echo.private('room.' + this.room.id).listen('PrivateEchoMessage', ({message}) => {
               this.allMessages.push(message);
               console.log('From chat: '+message);
           });
        },

        methods:  {
          sendMessage: function () {
              axios({
                  method: 'post',
                  url:    '/private-echo-chat/send',
                  params: {message: this.message, room_id: this.room.id}
              }).then((response) => {
                  console.log('Data: '+response.data);
              });
              this.allMessages.push(this.message)
              this.message = '';
          }
        }
    }
</script>
