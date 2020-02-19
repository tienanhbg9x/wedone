<template>
    <div>
        <h2>Roles</h2>
        <div class="table">
            <div class="role">
                <button class="btn btn-primary">
                    <router-link to="/role-add" class="add-role">Thêm</router-link>
                </button>
            </div>
            <table class="table table-bordered ">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Name</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(role, index) in roles" :key="index">
                    <th scope="row">{{ index+1 }}</th>
                    <td>{{ role.title }}</td>
                    <td>
                        <router-link :to="'/role-edit/'+ role.id"><i class="fas fa-edit edit"></i></router-link>
                        <a @click="roleDelete(role.title, role.id)"><i class="fa fa-trash delete"></i></a>
                    </td>

                </tr>
                </tbody>
            </table>
            <div class="footer">
                <ul class="pagination">
                    <li class="page-item" v-if="current_page > 1">
                        <a class="page-link" @click="current_page--"> < </a>
                    </li>
                    <li class="page-item active">
                        <a class="page-link">{{ current_page }}</a>
                    </li>
                    <li class="page-item hover-point" v-if="roles.length >= 30">
                        <label class="page-link" @click="current_page++"> > </label>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Role",
        data() {
            return {
                permissions: [],
                roles: [],
                current_page: 1
            }
        },
        watch: {
            current_page() {
                this.GetRole()
            }
        },
        methods: {
            GetRole() {
                ApiGet('v1/roles', {
                    fields: 'title,id',
                    page: this.current_page
                })
                    .then(response => {
                        this.roles = response.data.roles
                    })
                    .catch(error => {
                        console.log(error)
                    })
            },
            roleDelete(title, id) {
                Swal.fire({
                    title: 'Bạn có muốn xóa ' + title + ' không?',
                    text: "Bạn sẽ không thể khôi phục lại!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Đồng ý'
                }).then((result) => {

                    if (result.value) {
                        ApiDelete('v1/role-delete/' + id).then(response => {
                            this.GetRole();
                            Swal.fire(
                                'Đã Xóa',
                                'Quyền đã bị xóa.',
                                'success'
                            )
                        }).catch(error => {
                            console.log(error)
                        })

                    } else {
                        Swal.fire(
                            'Huỷ bỏ',
                            'Hành động được hủy bỏ!',
                            'success'
                        )
                    }
                })
            }
        },
        mounted() {
            this.GetRole();
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
    h2 {
        margin-top: 2px;
        margin-bottom: 2px;
        text-align: center;
    }

    .table {
        text-align: center;
        color: #000000;
        padding: 0px 30px;
    }

    .edit {
        padding: 0px 5px;
        color: orange;
    }

    .delete {
        color: red;
    }

    .role {
        margin-bottom: 10px;
        display: flex;
        justify-content: flex-end;
    }

    .footer {
        color: black;
        display: flex;
        justify-content: center;
    }

    .add-role {
        color: white;
    }
</style>