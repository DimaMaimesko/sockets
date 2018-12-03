<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">
                        <textarea rows="10" class="form-control" readonly="true">
                            {{allMessages.join('\n')}}
                        </textarea>
                    </div>
                    <div class="card-body">
                      <input v-model="message" type="text" class="form-control" placeholder="Enter your message here">
                      <button @click="sendMessage" class="btn btn-primary">Send</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>



    export default {

       data: function(){
           return {
               allMessages: [],
               message: '',
           }
       },

        mounted: function(){
          var socket = io('http://127.0.0.1:3006');
          socket.on('send-message:App\\Events\\MessageSent', (data) => {
              console.log(data.message);
              this.allMessages.push(data.message);
          });
        },

        methods:  {
          sendMessage: function () {
              axios({
                  method: 'get',
                  url:    '/chat/sendMessage',
                  params: {message: this.message}
              }).then((response) => {
                  this.message = '';
                  console.log(response.data);
              })
          }
        }
    }
</script>
