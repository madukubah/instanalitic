<template>
    <div>
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Corpus</h1>
                        <br>
                        <button v-if='page == "WORD_CLOUD"' v-on:click="setTable()" type="button" class="btn btn-primary btn-sm pull-right">Table</button>
                        <button v-if='page == "TABLE"' v-on:click="setWordCloud()" type="button" class="btn btn-primary btn-sm pull-right">Word Cloud</button>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <wordcloud v-if='page == "WORD_CLOUD"'
                    :data="words"
                    nameKey="value"
                    valueKey="count"
                    
                    :showTooltip="true"
                    :wordClick="wordClickHandler">
                </wordcloud>
                <div v-if='page == "TABLE"' >
                     <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Corpus</h3>

                        </div>
                        <div class="card-body table-responsive p-0" >
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Word</th>
                                    <th>Count</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-bind:key="index"  v-for="(word, index) in words">
                                    <td>{{index+1}}</td>
                                    <td>{{word.value}}</td>
                                    <td>{{word.count}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

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
                page : "TABLE", // TABLE | WORD_CLOUD
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
            setTable( ) {
                    this.page = "TABLE";
            },
            setWordCloud( ) {
                    this.page = "WORD_CLOUD";
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
