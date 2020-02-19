<template>
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar"
            v-bind:class="{ toggled: isToggled }"
    >

        <!-- Sidebar - Brand -->
        <router-link class="sidebar-brand d-flex align-items-center justify-content-center" to="/">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Zilo<sup>1</sup></div>
        </router-link>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <router-link class="nav-link" to="/">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Home</span></router-link>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Interface
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog"></i>
                <span>Settings</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Custom Components:</h6>
                    <a class="collapse-item" href="">Buttons</a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Utilities Collapse Menu -->
<!--        <li class="nav-item">-->
<!--            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">-->
<!--                <i class="fas fa-fw fa-wrench"></i>-->
<!--                <span>Utilities</span>-->
<!--            </a>-->
<!--            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">-->
<!--                <div class="bg-white py-2 collapse-inner rounded">-->
<!--                    <h6 class="collapse-header">Custom Utilities:</h6>-->
<!--                    <a class="collapse-item" href="">Colors</a>-->
<!--                </div>-->
<!--            </div>-->
<!--        </li>-->

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            USER
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <!--  -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-user-circle"></i>
                <span>Quản lý thông tin người dùng</span>
            </a>
            <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">User Management:</h6>
                    <router-link class="collapse-item" to="/users"><i class="fas fa-user-circle"></i> User</router-link>
                    <router-link class="collapse-item" to="/roles"><i class="fas fa-user-circle"></i> Roles</router-link>
                    <router-link class="collapse-item" to="/permissions"><i class="fas fa-user-circle"></i> Permissions</router-link>
                    <div class="collapse-divider"></div>
                </div>
            </div>
        </li>

        <!-- Nav Item - Charts -->
<!--        <li class="nav-item">-->
<!--            <a class="nav-link" href="">-->
<!--                <i class="fas fa-fw fa-chart-area"></i>-->
<!--                <span>Charts</span></a>-->
<!--        </li>-->

        <!-- Nav Item - Tables -->
<!--        <li class="nav-item">-->
<!--            <a class="nav-link" href="">-->
<!--                <i class="fas fa-fw fa-table"></i>-->
<!--                <span>Tables</span></a>-->
<!--        </li>-->

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle" v-on:click="changeSidebar"></button>
        </div>

    </ul>
</template>

<script>
    export default {
        name: "Sidebar",
        data () {
          return {
              isToggled: false
          }
        },
        computed: {
            loggedIn() {
                return this.$store.getters.loggedIn
            }
        },
        methods:{
            changeSidebar(){
               this.isToggled = !this.isToggled
            }
        }
    }
</script>

