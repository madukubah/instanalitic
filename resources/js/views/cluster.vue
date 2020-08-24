<template>
    <div>
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Cluster</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6"  v-bind:key="index"  v-for="(cluster, index) in clusters"  >
                        <div class="card" >
                            <div class="card-header">
                                <h3 class="card-title">Cluster : {{ cluster.cluster }} ( {{ cluster.count }} Posts )</h3>
                            </div>
                            <div class="card-body table-responsive p-0" style="height: 300px;" >
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>Word</th>
                                        <th>Count</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-bind:key="index"  v-for="(wordCount, index) in cluster.wordCounts">
                                        <td>{{wordCount.word}}</td>
                                        <td>{{wordCount.count}}</td>
                                        <!-- <td>{{cluster.counts[ index ]}}</td> -->
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
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

    export default {

        data() {
            return {
                clusters :[],
            }
        },
        created() {
            this.getClusters();
        },

        methods: {
            getClusters( page = 1 ){
            axios.get('cluster_words')
                .then((response) => 
                {
                    // console.log( response.data );
                    // this.clusters = response.data;
                    var self = this;
                    response.data.forEach( ( item )=>{
                        // self.clusters
                        var wordCounts = [];
                        for( var i =0 ; i < item.words.length; i++ )
                        {
                            wordCounts.push( {
                                word : item.words[ i ],
                                count : item.counts[ i ]
                            } )
                        }

                        wordCounts.sort((a, b) =>  b.count - a.count );

                        // console.log( ( wordCounts ) );
                        this.clusters.push({
                            cluster : item.cluster,
                            count : item.count,
                            wordCounts : wordCounts
                        });
                    } );
                }
                )
                .catch(error => {
                    console.log(error);
                    console.log(error.response.data);
                });
            },
        }
    }

</script>
