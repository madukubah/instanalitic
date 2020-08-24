<template>
    <div>
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Account Tendencies</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div v-if='page == "INDEX"' >
                     <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">List</h3>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0" >
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Class</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr  v-bind:key="index"  v-for="(account, index) in accounts.data">
                                    <td>{{account.username}}</td>
                                    <td>{{account.class.class}}</td>
                                    <td>
                                        <button v-on:click="setDetail( account )" type="button" class="btn btn-primary btn-sm pull-left">Detail</button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            
                        </div>
                        <div class="card-footer">
                            <dir class="p-3 float-right">
                                <pagination :data="accounts" :limit="3" @pagination-change-page="geAccounts"></pagination>
                            </dir>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- detail -->
                 <div v-if='page == "DETAIL"' class="text-left" >
                    <button v-on:click="back()" type="button" class="btn btn-danger btn-sm pull-left">Back</button>
                    <br>
                    <br>
                    <div class="row">
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">{{ accountDetail.username }}</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0" style="height: 500px;" >
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Image Desc</th>
                                            <th>Class</th>
                                            <th>Cosine Value</th>
                                        </tr>
                                        </thead>
                                        <tbody>  
                                        <tr v-bind:key="index"  v-for="(post, index) in accountDetail.tendencies">
                                            <td>{{index+1}}</td>
                                            <td>{{post.text}}</td>
                                            <td>{{post.class}}</td>
                                            <td>{{post.value}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                        <div class="col-6">
                                <bar-chart 
                                    v-if="loaded"
                                    :chart-data="chartdata"
                                    :options="options"/>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /.content -->

    </div>

</template>

<script>

    import BarChart from '../components/chart/bar_chart'

    export default {
        components: { 
            BarChart,
        },
        data() {
            return {
                accounts :{},
                accountDetail :{},
                baseClasses :{},
                page : "INDEX", // INDEX | DETAIL | EDIT | CREATE
                loaded: true,
                chartdata: {},
                options: {},
            }
        },

        created() {
            this.geAccounts();
            this.getBaseClass();
        },

        methods: {
            async setDetail( account ){
                this.loaded = false;

                this.accountDetail = account;
                this.page = "DETAIL";
                var _baseClasses = {}
                var _sum = 0
                for( var i=0; i< this.baseClasses.data.length; i++ )
                {
                    _baseClasses[ this.baseClasses.data[i].class ] = 0;
                }
                for( var j=0; j< this.accountDetail.tendencies.length; j++ )
                {
                    _baseClasses[ this.accountDetail.tendencies[j].class ]++;
                    _sum ++;
                }

                var labels = [];
                var data = [];
                for(var key in _baseClasses) {
                    labels.push( key );
                    console.log( _sum * 100 );
                    // data.push( _baseClasses[key]/_sum * 100 );
                    data.push( _baseClasses[key]/_sum * 100 );
                }

                this.chartdata.labels = labels;
                this.chartdata.datasets = [
                        {
                            label: 'Class',
                            borderColor: '#249EBF',
                            // pointBackgroundColor: 'white',
                            // borderWidth: 1,
                            // pointBorderColor: '#249EBF',
                            backgroundColor: '#249EBF',
                            // backgroundColor: '#f87979',
                            data: data
                        }
                    ];
                
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

                this.loaded = true;
            },
            back(  ){
                this.accountDetail = {};
                this.page = "INDEX";
                this.loaded = false;
            },
            geAccounts( page = 1 ){
            axios.get('account_tendencies?page=' + page)
                .then((response) => 
                {
                    // console.log( response.data );
                    this.accounts = response.data;
                }
                )
                .catch(error => {
                    console.log(error.response.data);
                });
            },
            getBaseClass( page = 1 ){
                axios.get('base_class?page=' + page)
                    .then((response) => 
                    {
                        this.baseClasses = response.data;
                    })
                    .catch(error => {
                        console.log(error.response.data);
                    });
            },
        }
    }
</script>
