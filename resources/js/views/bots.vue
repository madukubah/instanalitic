<template>
    <div>
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Bots</h1>
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
                                <button v-on:click="create()" type="button" class="btn btn-primary btn-sm pull-right">Create</button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0" >
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Client Account</th>
                                    <th>Class</th>
                                    <th>Message</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr  v-bind:key="index"  v-for="(bot, index) in bots.data">
                                    <td>{{bot.client_account}}</td>
                                    <td>{{bot.class.class}}</td>
                                    <td>{{bot.message}}</td>
                                    <td>
                                        <button v-on:click="edit( bot )" type="button" class="btn btn-primary btn-sm pull-left">Edit</button>
                                        <button v-on:click="showDeleteModal( bot )" type="button" class="btn btn-danger btn-sm pull-left">Delete</button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            
                        </div>
                        <div class="card-footer">
                            <dir class="p-3 float-right">
                                <pagination :data="bots" :limit="3" @pagination-change-page="getBots"></pagination>
                            </dir>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!--  -->
                <div v-if='page == "CREATE"' class="text-left"  >
                    <button v-on:click="back()" type="button" class="btn btn-danger btn-sm pull-left">Back</button>
                    <br>
                    <br>
                    <div class="card ">
                        <div class="card-header">
                            <h3 class="card-title">New Bot</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" @submit.prevent="onSubmit" @keydown="form.errors.clear()">
                            <div class="card-body" style="height: 239px;">
                                <div class="form-group row">
                                    <label for="client_account" class="col-sm-2 col-form-label">Client Account</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="client_account" name="client_account" required autocomplete="client_account" autofocus placeholder="client_account" v-model="form.client_account">
                                        <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('client_account')" v-text="form.errors.get('client_account')"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="class_code" class="col-sm-2 col-form-label">Class</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="class_code" id="class_code" v-model="form.class_code">
                                            <option v-bind:value="baseClass.code" v-bind:key="index" v-for="(baseClass, index) in baseClasses.data" >
                                                {{baseClass.class}}
                                            </option>
                                            
                                        </select>
                                        <!-- <input type="number" class="form-control" id="class_code" name="class_code" required autocomplete="class_code" autofocus placeholder="class_code" v-model="form.class_code"> -->
                                        <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('class_code')" v-text="form.errors.get('class_code')"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="message" class="col-sm-2 col-form-label">Message</label>
                                    <div class="col-sm-10">
                                        <!-- <input type="text" class="form-control" id="name" name="name" required autocomplete="name" autofocus placeholder="Name" v-model="form.name"> -->
                                        <textarea class="form-control" id="message" name="message" required autofocus autocomplete="message" placeholder="message" v-model="form.message" 
                                            cols="30" rows="3">

                                        </textarea>
                                        <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('message')" v-text="form.errors.get('message')"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button v-if='!formModeEdit' type="submit" class="btn btn-sm btn-primary pull-right" :disabled="form.errors.any()">Create</button>
                                <button v-if='formModeEdit' type="submit" class="btn btn-sm btn-primary pull-right" :disabled="form.errors.any()">Edit</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!--  -->
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /.content -->

        <!-- modal delete  -->
        <b-modal ref="modalDelete"   v-bind:title="'Delete'">
            <label for="name" >Are You Sure ? </label>

            <template v-slot:modal-footer>
                <div class="w-100">
                    <button class="btn btn-primary btn-sm float-right" @click="deleteBot" >Ok</button>
                </div>
            </template>
        </b-modal>
    </div>

</template>

<script>

    export default {

        data() {
            return {
                bots :{},
                baseClasses :{},
                botDetail :{},
                page : "INDEX", // INDEX | DETAIL | EDIT | CREATE
                formModeEdit : false,
                form: new Form({
                    'id': '',
                    'client_account': '',
                    'class_code': '',
                    'message': '',
                    '_method': ''
                })
            }
        },

        created() {
            this.getBots();
            this.getBaseClass();
        },

        methods: {
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
            setDetail( bot ){
                this.botDetail = bot;
                this.page = "DETAIL";
            },
            edit( bot ){
                this.botDetail = bot;
                this.page = "CREATE";
                this.form.client_account = bot.client_account;
                this.form.class_code = bot.class_code;
                this.form.message = bot.message;
                this.formModeEdit = true;

            },
            back(  ){
                this.botDetail = {};
                this.page = "INDEX";
                this.form.reset();
            },
            create(  ){
                this.botDetail = {};
                this.page = "CREATE";
                this.formModeEdit = false;

            },
            getBots( page = 1 ){
                axios.get('bots?page=' + page)
                    .then((response) => 
                    {
                        this.bots = response.data;
                    })
                    .catch(error => {
                        console.log(error.response.data);
                    });
            },
            onSubmit(){
                if( ! this.formModeEdit )
                {
                    this.form
                    .post('bots')
                    .then((response) => 
                    {
                        console.log( response );
                        // this.bots = response.data;
                        this.$bvToast.toast(`Berhasil !`, {
                            title: 'Success',
                            variant: 'success',
                            autoHideDelay: 5000,
                            appendToast: true
                        });

                        this.back( );
                        this.getBots();
                    }
                    )
                    .catch(error => {
                        console.log(error);
                        this.$bvToast.toast(`Terjadi Kesalahan`, {
                            title: 'Error',
                            variant: 'danger',
                            autoHideDelay: 5000,
                            appendToast: true
                        });

                    });
                }
                else
                {
                    this.form._method = "PUT";
                    this.form.id = this.botDetail.id ;

                    this.form
                    .post('bots/'+this.botDetail.id )
                    .then((response) => 
                    {
                        console.log( response );
                        // this.bots = response.data;
                        this.$bvToast.toast(`Edit Berhasil  !`, {
                            title: 'Success',
                            variant: 'success',
                            autoHideDelay: 5000,
                            appendToast: true
                        });

                        this.back( );
                        this.getBots();
                    }
                    )
                    .catch(error => {
                        console.log(error);
                        this.$bvToast.toast(`Terjadi Kesalahan`, {
                            title: 'Error',
                            variant: 'danger',
                            autoHideDelay: 5000,
                            appendToast: true
                        });

                    });
                }
                
            },

            showDeleteModal( bot ){
                this.botDetail = bot;
                this.$refs.modalDelete.show( );
            },
            deleteBot(  ){
                var _form = new Form({
                    '_method': 'DELETE',
                });
                console.log(this.botDetail.id);
                
                _form
                    .post('/bots/'+ this.botDetail.id )
                    .then( success => {
                        this.getBots();
                        this.$refs.modalDelete.hide( );
                    });
            },
        }
    }

</script>
