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
                            :height="100"
                            :options="{responsive: true, maintainAspectRation: true}">
                        </line-chart>

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
           }
       },
        methods:  {
          getJson: function () {
              axios.get('/data-chart').then((response) => {
                  console.log(response.data);
                  this.data = response.data;
              })
          }
        }
    }
</script>
