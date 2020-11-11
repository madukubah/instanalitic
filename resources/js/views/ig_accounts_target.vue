<template>
    <div>
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Target Accounts</h1>
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
                            <div class="card-tools">
                                <button v-on:click="showAddModal()" type="button" class="btn btn-primary btn-sm pull-right">Create</button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0" >
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-bind:key="index"  v-for="(account, index) in accounts.data">
                                    <td>{{index+1}}</td>
                                    <td>{{account.username}}</td>
                                    <td>
                                        <button v-on:click="showDeleteModal( account )" type="button" class="btn btn-danger btn-sm pull-left">Delete</button>
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

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /.content -->

        <!-- modal create -->
        <b-modal ref="modalAdd"  v-bind:title="'Add Target' ">
            <label for="name" >Username</label>
            <input type="text" class="form-control mb-2" id="username" name="username" required autocomplete="username" autofocus placeholder="username" v-model="form.username">
            <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('username')" v-text="form.errors.get('username')"></span>

            <template v-slot:modal-footer>
                <div class="w-100">
                    <button class="btn btn-primary btn-sm float-right" @click="addAccount" >Add</button>
                </div>
            </template>
        </b-modal>

        <!-- modal delete  -->
        <b-modal ref="modalDelete"   v-bind:title="'Delete'">
            <label for="name" >Are You Sure ? </label>

            <template v-slot:modal-footer>
                <div class="w-100">
                    <button class="btn btn-primary btn-sm float-right" @click="deleteTarget" >Ok</button>
                </div>
            </template>
        </b-modal>
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
                } )
            }
        },

        created() {
            this.geAccounts();
        },

        methods: {
            showAddModal(  ){
                this.form.reset();
                this.$refs.modalAdd.show( );
            },
            setDetail( account ){
                this.accountDetail = account;
                this.page = "DETAIL";
            },
            geAccounts( page = 1 ){
                axios.get('temp_target?page=' + page)
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
            addAccount(  ){
                this.form._method = 'POST';
                this.form
                    .post('/temp_target')
                    .then( success => {
                        this.geAccounts();
                        this.$refs.modalAdd.hide( );
                    });
            },
            showDeleteModal( accountDetail ){
                this.accountDetail = accountDetail;
                // this.$refs.modalDelete.show( );
                this.deleteTarget(  );
            },
            deleteTarget(  ){
                var _form = new Form({
                    '_method': 'DELETE',
                });
                console.log(this.accountDetail.id);
                
                _form
                    .post('/temp_target/'+ this.accountDetail.id )
                    .then( success => {
                        this.geAccounts();
                        // this.$refs.modalDelete.hide( );
                    });
            },
        }
    }

</script>
