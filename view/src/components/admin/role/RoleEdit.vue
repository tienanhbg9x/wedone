<template>
    <div class="role-edit">
        <form action="" @submit.prevent="editRole()">
            <h6>Role:*</h6>
            <input type="text" v-model="roleEdit" class="form-control" placeholder="Nhập tên role" required>
            <h6>Permission:*</h6>
            <ul class="style-ul">
                <li v-for="(permission,index) in permissions " :key="index" class="show-permissions">
                    <input type="checkbox"
                           v-model="permissionRole"
                           :value="index">
                    {{ permission.title }}
                </li>
            </ul>
            <button class="btn btn-primary">Sửa</button>
        </form>
    </div>
</template>

<script>
    export default {
        name: "RoleEdit",
        data() {
            return {
                roleEdit: '',
                permissions: [],
                permissionRole: [],
            }
        },
        methods: {
            editRole() {
                ApiPut(`v1/role-edit/${this.$route.params.id}`, {
                    title: this.roleEdit
                }).then(response => {
                    Swal.fire(
                        'Sửa thành công',
                        'Quyền đã được sửa.',
                        'success'
                    );
                    setTimeout(function () {
                        this.$router.push('/roles')
                    }.bind(this), 1000)

                }).catch(error => {
                    console.log(error)
                })
            }
        },
        mounted() {
            ApiGet('v1/permissions', {
                fields: 'title',
            })
                .then(response => {
                    this.permissions = response.data.permissions
                })
                .catch(error => {
                    console.log(error)
                })
        }
    }
</script>

<style scoped>
    .role-edit {
        padding: 100px 100px;
    }

    button {
        margin-top: 10px;
    }

    h6 {
        margin-top: 10px;
    }

    ul {
        list-style: none;
    }

    .show-permissions {
        width: 33.33%;
        float: left;
        padding-right: 10px;
    }
    .style-ul{
        display: inline-block;
        padding-left: 0px;
    }
</style>