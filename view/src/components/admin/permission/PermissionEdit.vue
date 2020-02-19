<template>
    <div class="permission-edit">
        <h6>Tên Quyền:*</h6>
        <form action="" @submit.prevent="editPermission()">
            <input type="text" v-model="permissionEdit" class="form-control" placeholder="Nhập tên quyền" required>
            <button class="btn btn-primary button">Sửa</button>
        </form>
    </div>
</template>

<script>
    export default {
        name: "PermissionEdit",
        data() {
            return {
                permissionEdit: ''
            }
        },
        methods: {
            editPermission() {
                ApiPut(`v1/permission-edit/${this.$route.params.id}`, {
                    title: this.permissionEdit
                }).then(response => {
                    Swal.fire(
                        'Sửa thành công',
                        'Quyền đã được sửa.',
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
    .permission-edit {
        padding: 100px 100px;
    }

    .button {
        margin-top: 10px;
    }
</style>