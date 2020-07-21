<template>
    <div>
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Instagram Accounts</h1>
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
                                    <th>User id</th>
                                    <th>Username</th>
                                    <th>Full Name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr  v-bind:key="index"  v-for="(account, index) in accounts.data">
                                    <td>{{account.user_id}}</td>
                                    <td>{{account.username}}</td>
                                    <td>{{account.full_name}}</td>
                                    <td>
                                        <button v-on:click="setDetail( account )" type="button" class="btn btn-primary btn-sm pull-left">Detail</button>
                                        <button v-on:click="setTarget( account )" type="button" class="btn btn-primary btn-sm pull-left">Set to Target</button>
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
                     <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ accountDetail.username }} / {{ accountDetail.full_name }} ( {{ accountDetail.user_id }} )</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0" >
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Image Desc</th>
                                </tr>
                                </thead>
                                <tbody>  
                                <tr v-bind:key="index"  v-for="(post, index) in accountDetail.posts">
                                    <td>{{post.desc_image}}</td>
                                </tr>
                                </tbody>
                            </table>
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
                accounts :{},
                accountDetail :{},
                page : "INDEX", // INDEX | DETAIL | EDIT | CREATE
                form : new Form({
                    'username'  : '',
                    '_method'   : '',
                })
            }
        },

        created() {
            this.geAccounts();
        },

        methods: {
            setDetail( account ){
                this.accountDetail = account;
                this.page = "DETAIL";
            },
            back(  ){
                this.accountDetail = {};
                this.page = "INDEX";
            },
            geAccounts( page = 1 ){
            axios.get('accounts?page=' + page)
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
            setTarget( account ){
                this.form.username = account.username ;
                this.form._method = 'POST';
                this.form
                    .post('/temp_target')
                    .then( success => {
                        // this.geAccounts();
                        // this.$refs.modalAdd.hide( );
                    }).catch( error => {
                        this.$bvToast.toast(`Sudah Di Jadikan Target`, {
                            title: 'Error',
                            variant: 'danger',
                            autoHideDelay: 5000,
                            appendToast: true
                        });
                    });
            },
        }
    }

</script>
