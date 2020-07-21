<template>
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
        <router-link :to="{ name : 'landing' }" class="brand-link" >
            <img src="/images/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
              style="opacity: .8">
            <span class="brand-text font-weight-light">{{ $appName }}</span>
        </router-link>

      <!-- <a href="index3.html" class="brand-link">
          
      </a> -->

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                  <!-- <img src="/images/AdminLTELogo.png" class="img-circle elevation-2" alt="User Image"> -->
                  <img v-bind:src=" $baseUrl + '/uploads/users/' + $auth.user().profile_pict " class="img-circle elevation-2" alt="User Image">
              </div>
              <div class="info">
                    <router-link class="d-block"  tag="a" :to="{ name : 'account' }" >
                        {{ $auth.user().name }}
                    </router-link>
              </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
                      with font-awesome or any other icon font library -->

                    <li class="nav-item">
                        <router-link tag="a" :to="{ name : 'admin.dashboard' }"  class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </router-link>
                    </li>
                    <li class="nav-item has-treeview menu-open">
                        <a href="javascript:" class="nav-link">
                            <i class="nav-icon fas fa-table"></i>
                            <p>
                                Posts
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" >
                        <li class="nav-item">
                            <router-link tag="a" :to="{ name : 'admin.posts' }"  class="nav-link">
                                <i class="nav-icon fas fa-circle-o"></i>
                                <p>All Posts</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link tag="a" :to="{ name : 'admin.sample_posts' }"  class="nav-link">
                                <i class="nav-icon fas fa-circle-o"></i>
                                <p>Sample Posts</p>
                            </router-link>
                        </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview menu-open">
                        <a href="javascript:" class="nav-link">
                            <i class="nav-icon fas fa-table"></i>
                            <p>
                                Clusters
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" >
                            <li class="nav-item">
                                <router-link tag="a" :to="{ name : 'admin.corpus' }"  class="nav-link">
                                    <i class="nav-icon fas fa-circle-o"></i>
                                    <p>Corpus</p>
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link tag="a" :to="{ name : 'admin.cluster' }"  class="nav-link">
                                    <i class="nav-icon fas fa-circle-o"></i>
                                    <p>Cluster</p>
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link tag="a" :to="{ name : 'admin.evaluation' }"  class="nav-link">
                                    <i class="nav-icon fas fa-circle-o"></i>
                                    <p>Evaluation</p>
                                </router-link>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview menu-open">
                        <a href="javascript:" class="nav-link">
                            <i class="nav-icon fas fa-table"></i>
                            <p>
                                Accounts
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" >
                            <li class="nav-item">
                                <router-link tag="a" :to="{ name : 'admin.ig_accounts' }"  class="nav-link">
                                    <i class="nav-icon fas fa-circle-o"></i>
                                    <p>All Accounts</p>
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link tag="a" :to="{ name : 'admin.sample_ig_accounts' }"  class="nav-link">
                                    <i class="nav-icon fas fa-circle-o"></i>
                                    <p>Sample Accounts</p>
                                </router-link>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview menu-open">
                        <a href="javascript:" class="nav-link">
                            <i class="nav-icon fas fa-table"></i>
                            <p>
                                Classification
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" >
                            <li class="nav-item">
                                <router-link tag="a" :to="{ name : 'admin.base_class' }"  class="nav-link">
                                    <i class="nav-icon fas fa-circle-o"></i>
                                    <p>Class</p>
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link tag="a" :to="{ name : 'admin.ig_accounts_target' }"  class="nav-link">
                                    <i class="nav-icon fas fa-circle-o"></i>
                                    <p>Target</p>
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link tag="a" :to="{ name : 'admin.ig_accounts_target' }"  class="nav-link">
                                    <i class="nav-icon fas fa-circle-o"></i>
                                    <p>Account Tendency</p>
                                </router-link>
                            </li>
                        </ul>
                    </li>
                    <!-- <li class="nav-item">
                        <router-link tag="a" :to="{ name : 'admin.users' }" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>Users</p>
                        </router-link>
                    </li> -->

              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>

</template>
<script>
  export default {
    created() {
    },
    mounted() {
      //
    }
  }
</script>
