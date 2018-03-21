import Vue from 'vue';
import VueRouter from 'vue-router';

import Home from '../components/Home.vue';
import Profile from '../components/auth/Profile.vue';
import Login from '../components/auth/Login.vue';
import Register from '../components/auth/Register.vue';
import PasswordEmail from '../components/auth/PasswordEmail.vue';
import ResetPassword from '../components/auth/ResetPassword.vue';
import NotFound from '../components/NotFound.vue';

import AllUsers from '../components/users/AllUsers.vue';
import SetUser from '../components/users/SetUser.vue';
import EditUser from '../components/users/EditUser.vue';

import PagePosts from '../components/posts/PagePosts.vue';
Vue.use(VueRouter);

const routes = [
    {
        path: '/',
        name: 'home',
        component: Home,
    },
    {
        path: '/profile',
        name: 'auth.profile',
        component: Profile,
        meta: {
            auth: true,
        },
    },
    {
        path: '/login',
        name: 'auth.login',
        component: Login,
        meta: {
            guest: true,
        },
    },
    {
        path: '/register',
        name: 'auth.register',
        component: Register,
        meta: {
            guest: true,
        },
    },
    {
        path: '/password/reset',
        name: 'auth.password.email',
        component: PasswordEmail,
        meta: {
            guest: true,
        },
    },
    {
        path: '/password/reset/:token',
        name: 'auth.reset.password',
        component: ResetPassword,
        meta: {
            guest: true,
        },
    },
    {
        path: '/user/all',
        name: 'user.all',
        component: AllUsers,
        meta: {
            auth: true,
        },
    },
    {
        path: '/user/set',
        name: 'user.set',
        component: SetUser,
        meta: {
            auth: true,
        },
    },
    {
        path: '/user/edit/:userId',
        name: 'user.edit',
        component: EditUser,
        meta: {
            auth: true,
        },
    },
    {
        path: '/posts/page/:page',
        name: 'posts.page',
        component: PagePosts,
        meta: {
            auth: true,
        },
    },

    // Must be the last entry in array.
    {
        path: '*',
        component: NotFound,
    },
];

export default new VueRouter({
    routes,
    mode: 'history',
    saveScrollPosition: false,
});
