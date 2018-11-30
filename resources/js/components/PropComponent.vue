<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Prop Component</div>

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
        props: [
          'urldata'
        ],
        mounted() {
            console.log(this.urldata);
        }
    }
</script>
