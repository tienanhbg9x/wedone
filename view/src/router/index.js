const Home = () => import(/* webpackChunkName: "home" */ "../pages/Home");
const NotFound = () => import(/* webpackChunkName: "not-found" */ "../pages/NotFound");
const Login = () => import(/* webpackChunkName: "Login" */ "../components/login/Login");
const Register = () => import(/* webpackChunkName: "Register" */ "../components/register/Register");
const VerifyUser = () => import(/* webpackChunkName: "VerifyUser" */ "../components/register/VerifyUser");
const User = () => import(/* webpackChunkName: "User" */"../components/admin/user/User");
const Profile = () => import(/* webpackChunkName: "Profile" */"../components/admin/user/Profile");
const UserEdit = () => import(/* webpackChunkName: "UserEdit" */"../components/admin/user/UserEdit");
const Role = () => import(/* webpackChunkName: "Role" */"../components/admin/role/Role");
const RoleEdit = () => import(/* webpackChunkName: "RoleEdit" */"../components/admin/role/RoleEdit");
const RoleAdd = () => import(/* webpackChunkName: "RoleAdd" */"../components/admin/role/RoleAdd");
const Permission = () => import(/* webpackChunkName: "Permission" */"../components/admin/permission/Permission");
const PermissionEdit = () => import(/* webpackChunkName: "PermissionEdit" */"../components/admin/permission/PermissionEdit");
const PermissionAdd = () => import(/* webpackChunkName: "PermissionAdd" */"../components/admin/permission/PermissionAdd");

import LayoutDefault from "../layouts/default"
import LayoutLogin from "../layouts/login"
import Vue from "vue"
import Router from "vue-router"

Vue.use(Router);


export default {
    mode: 'history',
    base: process.env.BASE_URL,
    routes: [
        {
            path: '/',
            name: 'Home',
            component: Home,
            meta:{
                layout:LayoutDefault,
                requiresAuth:true,
                title:'Home'
            }
        },
        {
            path: '*',
            name: 'NotFound',
            component: NotFound,
            meta:{ layout:LayoutDefault }
        },
        {
            path: '/login',
            name: 'login',
            component: Login,
            meta: {
                title:'Login',
                layout:LayoutLogin,
                requiresVisitor:true
            }
        },
        {
            path:'/register',
            name: 'register',
            component: Register,
            meta: {
                title:'Register',
                layout:LayoutLogin,
                requiresVisitor:true,
            }
        },
        {
            path:'/verify',
            name: 'verify',
            component: VerifyUser,
            meta: {
                layout:LayoutLogin,
                requiresVisitor:true
            }
        },
        {
            path:'/roles',
            name:'roles',
            component: Role,
            meta: {
                layout:LayoutDefault,
                requiresAuth:true,
                title:'Roles'
            }
        },
        {
            path:'/role-edit/:id',
            name:'role-edit',
            component:RoleEdit,
            meta: {
                layout:LayoutDefault,
                requiresAuth:true
            }
        },
        {
            path:'/role-add',
            name:'role-add',
            component:RoleAdd,
            meta: {
                layout:LayoutDefault,
                requiresAuth:true
            }
        },
        {
            path:'/users',
            name:'users',
            component: User,
            meta: {
                layout:LayoutDefault,
                requiresAuth:true
            }
        },
        {
            path:'/user-edit/:id',
            name:'user-edit',
            component: UserEdit,
            meta: {
                layout:LayoutDefault,
                requiresAuth:true
            }
        },
        {
            path:'/permissions',
            name:'permissions',
            component: Permission,
            meta: {
                layout:LayoutDefault,
                requiresAuth:true,
                title:'Permissions'
            }
        },
        {
            path:'/permission-edit/:id',
            name:'permission-edit',
            component: PermissionEdit,
            meta: {
                layout:LayoutDefault,
                requiresAuth:true
            }
        },
        {
            path:'/permission-add',
            name:'permission-add',
            component: PermissionAdd,
            meta: {
                layout:LayoutDefault,
                requiresAuth:true
            }
        },
        {
            path:'/profile',
            name:'profile',
            component: Profile,
            meta: {
                layout:LayoutDefault,
                requiresAuth:true
            }
        },
    ]
}

