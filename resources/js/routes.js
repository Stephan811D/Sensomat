import NotFound from './components/NotFound';
import Login from './components/Login';
import App from './App.vue';

import Dashboard from './components/Dashboard';
import DashboardDetail from './components/DashboardDetail';

import Automats from './components/Automats';
import AutomatDetail from './components/AutomatDetail';
import Products from './components/Products';
import ProductTypes from './components/ProductTypes';

export default {
    mode: 'history',
    linkExactActiveClass: 'active',
    routes: [{
            path: '*',
            component: NotFound
        },
        {
            path: '/login',
            name: 'Login',
            component: Login
        },
        {
            path: '/',
            name: 'App',
            component: App,
            children: [{
                    path: 'dashboard',
                    name: 'Dashboard',
                    component: Dashboard
                },
                {
                    path: 'dashboard/:id',
                    name: 'DashboardDetail',
                    component: DashboardDetail
                },
                {
                    path: 'automats',
                    name: 'Automats',
                    component: Automats
                },
                {
                    path: 'automat/:id',
                    name: 'AutomatDetail',
                    component: AutomatDetail
                },
                {
                    path: 'products',
                    name: 'Products',
                    component: Products
                },
                {
                    path: 'productTypes',
                    name: 'ProductTypes',
                    component: ProductTypes
                }
            ],
            beforeEnter: (to, from, next) => {
                axios.get('/api/authenticated').then(() => {
                    next()
                }).catch(() => {
                    return next({
                        name: 'Login'
                    })
                })
            }
        },
    ]
}
