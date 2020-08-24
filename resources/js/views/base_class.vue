<template>
    <div>
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Class</h1>
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
                                    <th>Code</th>
                                    <th>Class</th>
                                    <th>Value</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr  v-bind:key="index"  v-for="(baseClass, index) in baseClasses.data">
                                    <td>{{baseClass.code}}</td>
                                    <td>{{baseClass.class}}</td>
                                    <td>{{baseClass.values}}</td>
                                    <td>
                                        <button v-on:click="edit( baseClass )" type="button" class="btn btn-primary btn-sm pull-left">Edit</button>
                                        <button v-on:click="showDeleteModal( baseClass )" type="button" class="btn btn-danger btn-sm pull-left">Delete</button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            
                        </div>
                        <div class="card-footer">
                            <dir class="p-3 float-right">
                                <pagination :data="baseClasses" :limit="3" @pagination-change-page="getBaseClass"></pagination>
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
                            <h3 class="card-title">{{ baseClassDetail.username }} / {{ baseClassDetail.full_name }} ( {{ baseClassDetail.user_id }} )</h3>
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
                                <tr v-bind:key="index"  v-for="(post, index) in baseClassDetail.posts">
                                    <td>{{post.desc_image}}</td>
                                </tr>
                                </tbody>
                            </table>
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
                            <h3 class="card-title">New Class</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" @submit.prevent="onSubmit" @keydown="form.errors.clear()">
                            <div class="card-body" style="height: 239px;">
                                <div class="form-group row">
                                    <label for="code" class="col-sm-2 col-form-label">Code</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" id="code" name="code" required autocomplete="code" autofocus placeholder="code" v-model="form.code">
                                        <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('code')" v-text="form.errors.get('code')"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="class" class="col-sm-2 col-form-label">Class</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="class" name="class" required autocomplete="class" autofocus placeholder="class" v-model="form.class">
                                        <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('class')" v-text="form.errors.get('class')"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="values" class="col-sm-2 col-form-label">Value</label>
                                    <div class="col-sm-10">
                                        <!-- <input type="text" class="form-control" id="name" name="name" required autocomplete="name" autofocus placeholder="Name" v-model="form.name"> -->
                                        <textarea class="form-control" id="values" name="values" required autofocus autocomplete="values" placeholder="values" v-model="form.values" 
                                            cols="30" rows="3">

                                        </textarea>
                                        <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('values')" v-text="form.errors.get('values')"></span>
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
                    <button class="btn btn-primary btn-sm float-right" @click="deleteBaseClass" >Ok</button>
                </div>
            </template>
        </b-modal>
    </div>

</template>

<script>

    export default {

        data() {
            return {
                baseClasses :{},
                baseClassDetail :{},
                page : "INDEX", // INDEX | DETAIL | EDIT | CREATE
                formModeEdit : false,
                form: new Form({
                    'id': '',
                    'code': '',
                    'class': '',
                    'values': '',
                    '_method': ''
                })
            }
        },

        created() {
            this.getBaseClass();
        },

        methods: {
            setDetail( baseClass ){
                this.baseClassDetail = baseClass;
                this.page = "DETAIL";
            },
            edit( baseClass ){
                this.baseClassDetail = baseClass;
                this.page = "CREATE";
                this.form.code = baseClass.code;
                this.form.class = baseClass.class;
                this.form.values = baseClass.values;
                this.formModeEdit = true;

            },
            back(  ){
                this.baseClassDetail = {};
                this.page = "INDEX";
                this.form.reset();
            },
            create(  ){
                this.baseClassDetail = {};
                this.page = "CREATE";
                this.formModeEdit = false;

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
            onSubmit(){
                if( ! this.formModeEdit )
                {
                    this.form
                    .post('base_class')
                    .then((response) => 
                    {
                        console.log( response );
                        // this.baseClasses = response.data;
                        this.$bvToast.toast(`Berhasil !`, {
                            title: 'Success',
                            variant: 'success',
                            autoHideDelay: 5000,
                            appendToast: true
                        });

                        this.back( );
                        this.getBaseClass();
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
                    this.form.id = this.baseClassDetail.id ;

                    this.form
                    .post('base_class/'+this.baseClassDetail.id )
                    .then((response) => 
                    {
                        console.log( response );
                        // this.baseClasses = response.data;
                        this.$bvToast.toast(`Edit Berhasil  !`, {
                            title: 'Success',
                            variant: 'success',
                            autoHideDelay: 5000,
                            appendToast: true
                        });

                        this.back( );
                        this.getBaseClass();
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

            showDeleteModal( baseClass ){
                this.baseClassDetail = baseClass;
                this.$refs.modalDelete.show( );
            },
            deleteBaseClass(  ){
                var _form = new Form({
                    '_method': 'DELETE',
                });
                console.log(this.baseClassDetail.id);
                
                _form
                    .post('/base_class/'+ this.baseClassDetail.id )
                    .then( success => {
                        this.getBaseClass();
                        this.$refs.modalDelete.hide( );
                    });
            },
        }
    }

</script>
