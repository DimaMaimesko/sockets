<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Line Chart Component</div>
                    <div class="card-body">
                        I'm an Line Chart component.
                        <button @click="getJson">Update Data</button>

                        <line-chart
                            :chart-data="data"
                            :height="200"
                            :options="{responsive: true, maintainAspectRation: true}">
                        </line-chart>

                        <input type="checkbox" v-model="realtime">Realtime
                        <input type="text" v-model="label">
                        <input type="text" v-model="sale">
                        <button @click="sendData">Create label</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import LineChart from './LineChart'

    export default {
        components: {
           LineChart
        },
       data: function(){
           return {
               data: [],
               realtime: false,
               label: '',
               sale: 500
           }
       },
        mounted() {
          var socket = io('http://localhost:3000');

          socket.on("chart-updated:App\\Evens\\NewEvent", function(data){
              console.log(data.result);
              this.data = data.result;
          }.bind(this));
        },
        methods:  {
          getJson: function () {
              axios.get('/data-chart').then((response) => {
                  console.log(response.data);
                  this.data = response.data;
              })
          },
          sendData: function () {
              axios({
                  method: 'get',
                  url:    '/socket-chart',
                  params: {label: this.label, sale: this.sale, realtime: this.realtime}
              }).then((response) => {
                  this.data = response.data;
              })
          }
        }
    }
</script>
