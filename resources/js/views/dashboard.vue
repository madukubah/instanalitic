<template>

    <div class="no">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-navy"><i class="far fa-user"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Accounts</span>
                                <span class="info-box-number">{{ accountsCount }}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-navy"><i class="far fa-user"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Sample Accounts</span>
                                <span class="info-box-number">{{ sampleAccountsCount }}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-success"><i class="far fa-sticky-note"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Total Posts</span>
                                <span class="info-box-number">{{ postsCount }}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="far fa-sticky-note"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Sample Posts</span>
                                <span class="info-box-number">{{ samplePostsCount }}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-warning"><i class="far fa-file-word"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Words</span>
                                <span class="info-box-number">{{ wordsCount }}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-danger"><i class="far fa-bookmark"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Clusters</span>
                                <span class="info-box-number">{{clustersCount}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
                <!-- =========================================================== -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
</template>

<script>
export default {
    data() {
        return {
           accountsCount : 0,
           sampleAccountsCount : 0,
           samplePostsCount : 0,
           wordsCount : 0,
           postsCount : 0,
           clustersCount : 0,
        }
    },

    created() {
        this.getSampleAccountsCount();
        this.getAccountsCount();
        this.getSamplePostsCount();
        this.getWordsCount();
        this.getPostsCount();
        this.getClusterWordsCount();
    },

     methods: {
         getSampleAccountsCount(){
            axios.get('sample_accounts/count')
                .then((response) => 
                {
                    console.log( response.data );
                    this.sampleAccountsCount = response.data.toLocaleString();
                }
                )
                .catch(error => {
                    console.log("terjadi kesalahan");
                });
        },
         getAccountsCount(){
            axios.get('accounts/count')
                .then((response) => 
                {
                    console.log( response.data );
                    this.accountsCount = response.data.toLocaleString();
                }
                )
                .catch(error => {
                    console.log("terjadi kesalahan");
                });
        },
        getSamplePostsCount(){
            axios.get('sample_posts/count')
                .then((response) => 
                {
                    console.log( response.data );
                    this.samplePostsCount = response.data.toLocaleString();
                }
                )
                .catch(error => {
                    console.log("terjadi kesalahan");
                });
        },
        getWordsCount(){
            axios.get('words/count')
                .then((response) => 
                {
                    console.log( response.data );
                    this.wordsCount = response.data.toLocaleString();
                }
                )
                .catch(error => {
                    console.log("terjadi kesalahan");
                });
        },
        getPostsCount(){
            axios.get('posts/count')
                .then((response) => 
                {
                    console.log( response.data );
                    this.postsCount = response.data.toLocaleString();
                }
                )
                .catch(error => {
                    console.log("terjadi kesalahan");
                });
        },
        getClusterWordsCount(){
            axios.get('cluster_words/count')
                .then((response) => 
                {
                    console.log( response.data );
                    this.clustersCount = response.data.toLocaleString();
                }
                )
                .catch(error => {
                    console.log("terjadi kesalahan");
                });
        }
    }

}

</script>
