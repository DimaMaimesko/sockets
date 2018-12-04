<template>
    <div class="container">
        <div class="row justify-content-center">
                <div class="card card-default">
                    <h3>{{userId}}</h3>
                    <select multiple="" class="form-control" v-model="selectedChannels">
                        <option v-for="user in users" :value="'private-message.' + user.id">{{user.name}}</option>
                    </select>
                    <span>Target User: {{ selectedChannels }}</span>

                    <div class="card-header">
                        <textarea rows="10" class="form-control" readonly="true">
                            {{allMessages.join('\n')}}
                        </textarea>
                    </div>

                    <div class="card-body">
                      <input v-model="message" type="text" class="form-control" placeholder="Enter your message here">
                      <button @click="sendMessage" class="btn btn-primary">Send</button>
                    </div>
{{userId}}
                </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
          users: '',
          userId: '',
        },

       data: function(){
           return {
               allMessages: [],
               message: '',
               selectedChannels: [],
           }
       },

        mounted: function(){
          var socket = io('http://127.0.0.1:3007');
          socket.on('private-message.' + this.userId + ':App\\Events\\PrivateMessageSent', (data) => {
              console.log(data.message);
              this.allMessages.push(data.message);
          });
          socket.on('private-message.:App\\Events\\PrivateMessageSent', (data) => {
              console.log(data.message);
              this.allMessages.push(data.message);
          });
        },

        methods:  {
          sendMessage: function () {
              if (!this.selectedChannels.length){
                  this.selectedChannels.push('private-message.');
              }
              axios({
                  method: 'get',
                  url:    '/chat/private/sendMessage',
                  params: {channels: this.selectedChannels, message: this.message}
              }).then((response) => {
                  // console.log(response.data.message);
                  // console.log(response.data.channels);
              })
          }
        }
    }
</script>
