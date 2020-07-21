<template>
    <div>
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Posts</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div>
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
                                    <th>Image Desc</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-bind:key="index"  v-for="(post, index) in posts.data">
                                    <td>{{post.username}}</td>
                                    <td>{{post.desc_image}}</td>
                                </tr>
                                </tbody>
                            </table>
                            
                        </div>
                        <div class="card-footer">
                            <dir class="p-3 float-right">
                                <pagination :data="posts" :limit="3" @pagination-change-page="getPosts"></pagination>
                            </dir>
                        </div>
                        <!-- /.card-body -->
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

    export default {

        data() {
            return {
                posts :{},
            }

        },

        created() {
            this.getPosts();
        },

        methods: {
            getPosts( page = 1 ){
            axios.get('posts?page=' + page)
                .then((response) => 
                {
                    // console.log( response.data );
                    this.posts = response.data;
                }
                )
                .catch(error => {
                    console.log("terjadi kesalahan");
                });
        },
        }
    }

</script>
