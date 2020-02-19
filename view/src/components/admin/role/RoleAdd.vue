<template>
    <div class="role-add">
        <h6>Tên Quyền:*</h6>
        <form action="" v-on:submit.prevent="addRole()">
            <input type="text" v-model="nameRole" placeholder="Nhập tên quyền" class="form-control"
                               id="nameRole" required>
            <button class="btn btn-primary">Thêm</button>
        </form>
    </div>
</template>

<script>
    export default {
        name: "RoleAdd",
        data() {
            return {
                nameRole: '',
            }
        },
        methods: {
            addRole() {
                ApiPost('v1/role-create', {
                    title: this.nameRole
                }).then(response => {
                    Swal.fire(
                        'Thêm thành công',
                        `Quyền ${this.nameRole} đã được thêm`,
                        'success'
                    );
                    setTimeout(function () {
                        this.$router.push('/roles')
                    }.bind(this), 1000)
                }).catch(error => {
                    console.log(error)
                })
            }
        }
    }
</script>

<style scoped>
    .role-add {
        padding: 100px 100px;
    }

    #nameRole {
        margin-bottom: 10px;
    }
</style>