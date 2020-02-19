<template>
    <div id="wrapper">
        <add-sidebar></add-sidebar>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <add-header></add-header>
                <slot></slot>
            </div>
            <add-footer></add-footer>
        </div>
    </div>
</template>
<script>
    import AddSidebar from "../components/admin/sidebar/Sidebar"
    import AddFooter from "../components/admin/footer/Footer"
    import AddHeader from "../components/admin/header/Header"
    export default {
        name: "default",
        components:{
            AddFooter,
            AddHeader,
            AddSidebar,
        }
    }
</script>