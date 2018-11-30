<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Json Component</div>

                    <button @click="getJson">Get JSON Data ({{clickCounter}})</button>

                    <div class="card-body">
                        I'm an PROP component.
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Url</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in urldata">
                                    <td>{{item.title}}</td>
                                    <td>{{item.url}}</td>
                                </tr>
                            </tbody>
                        </table>
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
               urldata: [],
               clickCounter: 0,
           }
       },
        methods:  {
          getJson: function () {
              this.clickCounter++;
              axios.get('/get-json').then((response) => {
                  console.log(response.data);
                  this.urldata = response.data;
              })
          }
        }
    }
</script>
