<template>
    <div>
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Cluster</h1>
                        <br>
                        <button v-if='page == "ANALYSIS"' v-on:click="setCLUSTER()" type="button" class="btn btn-primary btn-sm pull-right">Cluster</button>
                        <button v-if='page == "CLUSTER"' v-on:click="setANALYSIS()" type="button" class="btn btn-primary btn-sm pull-right">Analysis</button>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <h3 v-if='page == "CLUSTER"' class="m-0 text-dark">Cluster</h3>
                <div class="row" v-if='page == "CLUSTER"'>
                    <div class="col-4"  v-bind:key="index"  v-for="(cluster, index) in clusters"  >
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

                <h3 v-if='page == "ANALYSIS"' class="m-0 text-dark">Analysis</h3>
                <div class="row" v-if='page == "ANALYSIS"'>
                    <div class="col-4"  v-bind:key="index"  v-for="(cluster, index) in clustersAnalysis"  >
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
                                    <tr v-bind:key="key"  v-for="(item, key) in cluster.wordCountsDict">
                                        <td>{{key}}</td>
                                        <td>{{cluster.wordCountsDict[ key ]  }}</td>
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
                clustersAnalysis :[],
                page : "CLUSTER", // CLUSTER | ANALYSIS

            }
        },
        created() {
            this.getClusters();
        },

        methods: {
            setCLUSTER( ) {
                    this.page = "CLUSTER";
            },
            setANALYSIS( ) {
                    this.page = "ANALYSIS";
            },
            getClusters( page = 1 ){
                axios.get('cluster_words')
                    .then((response) => 
                        {
                            // console.log( response.data );
                            // this.clusters = response.data;
                            var self = this;
                            response.data.forEach( ( item )=>{
                                var wordCounts = [];
                                var wordCountsDict = {};
                                for( var i =0 ; i < item.words.length; i++ )
                                {
                                    wordCounts.push( {
                                        word : item.words[ i ],
                                        count : item.counts[ i ]
                                    } )
                                    wordCountsDict[ item.words[ i ] ] = item.counts[ i ]
                                }

                                wordCounts.sort((a, b) =>  b.count - a.count );

                                this.clusters.push({
                                    cluster : item.cluster,
                                    count : item.count,
                                    wordCounts : wordCounts
                                });

                                // set cluster analysis
                                this.clustersAnalysis.push({
                                    cluster : item.cluster,
                                    count : item.count,
                                    wordCountsDict : wordCountsDict
                                });

                            } );
                            this.analyzeCluster( this.clustersAnalysis );
                        }
                    )
                    .catch(error => {
                        console.log(error);
                        console.log(error.response.data);
                    });
            },
            analyzeCluster( clusters ) {
                // reduce same word in every cluster so we can determinate characteristic of cluster
                for( var i =0 ; i < clusters.length; i++ )
                {
                    for (var key in clusters[i].wordCountsDict ) {
                        var items = []
                        items.push(
                            { 
                                cluster : i ,
                                value : clusters[i].wordCountsDict[key] 
                            }
                        )

                        for( var j = 0 ; j < clusters.length; j++ )
                        {
                            if( i == j ) continue;
                            if (clusters[j].wordCountsDict.hasOwnProperty(key)) {           
                                items.push(
                                    { 
                                        cluster : j ,
                                        value : clusters[j].wordCountsDict[key] 
                                    }
                                )
                            }
                        }
                        items.sort((a, b) =>  b.value - a.value );
                        
                        for( var k =2 ; k < items.length; k++ )
                        {
                            delete clusters[ items[k].cluster ].wordCountsDict[key]
                        }
                    }
                    // clusters[i].wordCountsDict = 
                    // this.sort_object( clusters[i].wordCountsDict );
                    
                    // var keys = Object.keys( clusters[i].wordCountsDict )
                    // var i, len = keys.length; 
                    // clusters[i].wordCountsDict = keys.sort()
                }
            },
            sort_object(obj) {
                items = Object.keys(obj).map(function(key) {
                    return [key, obj[key]];
                });
                items.sort(function(first, second) {
                    return second[1] - first[1];
                });
                sorted_obj={}
                $.each(items, function(k, v) {
                    use_key = v[0]
                    use_value = v[1]
                    sorted_obj[use_key] = use_value
                })
                return(sorted_obj)
            } 

        }
    }

</script>
