<template>
    <div class="permission-add">
        <h6>Tên Quyền:*</h6>
        <form action="" v-on:submit.prevent="addPermission">
            <input type="text" v-model="namePermission" placeholder="Nhập tên permission" class="form-control"
                               id="namePermission" required>
            <button class="btn btn-primary">Thêm</button>
        </form>
    </div>
</template>

<script>
    export default {
        name: "PermissionAdd",
        data() {
            return {
                namePermission: ''
            }
        },
        methods: {
            addPermission() {
                ApiPost('v1/permission-create', {
                    title: this.namePermission,
                }).then(response => {
                    Swal.fire(
                        'Thêm thành công',
                        `Quyền ${this.namePermission} đã được thêm`,
                        'success'
                    );
                    setTimeout(function () {
                        this.$router.push('/permissions')
                    }.bind(this), 1000)
                }).catch(error => {
                    console.log(error)
                })
            }
        },
    }
</script>

<style scoped>
    .permission-add {
        padding: 100px 100px;
    }

    #namePermission {
        margin-bottom: 10px;
    }
</style>