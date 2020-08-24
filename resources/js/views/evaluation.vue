<template>
    <div>
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Evaluation</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <h3 class="m-0 text-dark">SSE</h3>
                <line-chart2
                    v-if="loaded"
                    :chartdata="chartdataWsse"
                    :options="options"/>
                <br>
                <!-- <h3 class="m-0 text-dark">Silhouette Coefficient</h3>
                <line-chart
                    v-if="loaded"
                    :chartdata="chartdataEvaluator"
                    :options="options"/> -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
</template>

<script>

    import LineChart from '../components/chart/line_chart'
    import LineChart2 from '../components/chart/line_chart'

    export default {
        name: 'LineChartContainer',
        components: { 
            LineChart,
            LineChart2
             },
        data: () => ({
            loaded: false,
            chartdataEvaluator: {},
            chartdataWsse: {},
            options: {},
        }),
        async mounted () {
            this.loaded = false
            try {
                
                axios.get('evaluations')
                    .then((response) => 
                    {
                        console.log( response.data );
                        this.words = response.data;
                        this.chartdataEvaluator.labels = response.data.evaluator.map( (item) => item.cluster );
                        this.chartdataEvaluator.datasets = [
                            {
                                label: 'downloads',
                                borderColor: '#249EBF',
                                pointBackgroundColor: 'white',
                                borderWidth: 1,
                                pointBorderColor: '#249EBF',
                                backgroundColor: 'transparent',
                                data: response.data.evaluator.map( (item) => item.value )
                            }
                        ];

                        this.chartdataWsse.labels = response.data.wsse.map( (item) => item.cluster );
                        this.chartdataWsse.datasets = [
                            {
                                label: 'downloads',
                                borderColor: '#249EBF',
                                pointBackgroundColor: 'white',
                                borderWidth: 1,
                                pointBorderColor: '#249EBF',
                                backgroundColor: 'transparent',
                                data: response.data.wsse.map( (item) => item.value )
                            }
                        ];
                        this.loaded = true
                    }
                    )
                    .catch(error => {
                        // console.log(error);
                        console.log(error.response.data);
                    });
                
                this.options = {
                    scales: {
                        yAxes: [{
                            ticks: {
                            beginAtZero: true
                            },
                            gridLines: {
                            display: true
                            }
                        }],
                        xAxes: [ {
                            gridLines: {
                                display: false
                                }
                            }]
                    },
                    legend: {
                        display: false
                    },
                    responsive: true,
                    maintainAspectRatio: false
                }
            } catch (e) {
                console.error(e)
            }
        }
    }

</script>
