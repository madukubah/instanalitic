<template>
    <div>
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Corpus</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <wordcloud
                    :data="words"
                    nameKey="value"
                    valueKey="count"
                    
                    :showTooltip="true"
                    :wordClick="wordClickHandler">
                </wordcloud>
                <!-- <div>
                     <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Corpus</h3>

                        </div>
                        <div class="card-body table-responsive p-0" >
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Word</th>
                                    <th>Count</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-bind:key="index"  v-for="(word, index) in wordClouds">
                                    <td>{{word.name}}</td>
                                    <td>{{word.value}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /.content -->

    </div>

</template>

<script>
    import wordcloud from 'vue-wordcloud'

    export default {

        data() {
            return {
                words :[],
                wordClouds :[],
                // myColors: ['#1f77b4', '#629fc9', '#94bedb', '#c9e0ef'],
                myColors: ['#1f77b4'],
            }
        },
        components: {
            wordcloud,
        },
        created() {
            this.getWords();
        },

        methods: {
            wordClickHandler(name, value, vm) {
                console.log('wordClickHandler', name, value, vm);
            },
            getWords( page = 1 ){
            axios.get('words')
                .then((response) => 
                {
                    // console.log( response.data );
                    this.words = response.data;
                }
                )
                .catch(error => {
                    // console.log(error);
                    console.log(error.response.data);
                });
            },
        }
    }

</script>
