import VueRouter from 'vue-router';


let routes = [
    {
        path: '/',
        name: 'landing',
        component: require('./views/landing').default
    }
    ,
    {
        path: '/register',
        name: 'register',
        component: require('./views/register').default,
        meta: {
            auth: false
        }
    },
    {
        path: '/login',
        name: 'login',
        component: require('./views/login').default,
        meta: {
            auth: false
        }
    },
    {
        path: '/admin',
        name: 'admin.index',
        component: require('./views/admin/index').default,
        meta: {
            auth: true
        },
        children: [
            {
                path: 'dashboard',
                name: 'admin.dashboard',
                component: require('./views/dashboard').default
            },
            {
                path: 'account',
                name: 'account',
                component: require('./views/account').default
            },
            {
                path: 'users',
                name: 'admin.users',
                component: require('./views/users').default
            }
            ,
            {
                path: 'posts',
                name: 'admin.posts',
                component: require('./views/posts').default
            },
            {
                path: 'sample_posts',
                name: 'admin.sample_posts',
                component: require('./views/sample_posts').default
            },
            {
                path: 'corpus',
                name: 'admin.corpus',
                component: require('./views/corpus').default
            },
            {
                path: 'cluster',
                name: 'admin.cluster',
                component: require('./views/cluster').default
            },
            {
                path: 'evaluation',
                name: 'admin.evaluation',
                component: require('./views/evaluation').default
            }
            ,
            {
                path: 'base_class',
                name: 'admin.base_class',
                component: require('./views/base_class').default
            }
            ,
            {
                path: 'ig_accounts',
                name: 'admin.ig_accounts',
                component: require('./views/ig_accounts').default
            }
            ,
            {
                path: 'sample_ig_accounts',
                name: 'admin.sample_ig_accounts',
                component: require('./views/sample_ig_accounts').default
            }
            ,
            {
                path: 'ig_accounts_target',
                name: 'admin.ig_accounts_target',
                component: require('./views/ig_accounts_target').default
            }
            ,
            {
                path: 'account_tendencies',
                name: 'admin.account_tendencies',
                component: require('./views/account_tendencies').default
            }
            ,
            {
                path: 'bots',
                name: 'admin.bots',
                component: require('./views/bots').default
            }
            
        ]
    },
];

export default new VueRouter({
    base: '/',
    mode: 'history',
    routes,
    linkActiveClass: 'active'
});
