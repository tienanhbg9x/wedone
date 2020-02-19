<template>
    <div>
        <h1>User</h1>
        <div class="table">
            <table class="table table-bordered ">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Created</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(user,index) in users" :key="index">
                    <th scope="row">{{ index+1 }}</th>
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                    <td>
                        <span v-for="(role, index) in roles" :key="index">
                            {{ role.title }}
                        </span>
                    </td>
                    <td>{{ user.created_at}}</td>
                    <td>
                        <router-link :to="'user-edit/'+user.id"><i class="fas fa-edit edit"></i></router-link>
                        <a @click="userDelete(user.id, user.name)"><i class="fa fa-trash delete"></i></a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="footer">
            <ul class="pagination">
                <li class="page-item" v-if="current_page > 1">
                    <a class="page-link" @click="current_page--"> < </a>
                </li>
                <li class="page-item active">
                    <a class="page-link">{{ current_page }}</a>
                </li>
                <li class="page-item hover-point" v-if="users.length >= 30">
                    <label class="page-link" @click="current_page++"> > </label>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        name: "User",
        data() {
            return {
                users: [],
                roles: [],
                current_page: 1
            }
        },
        methods: {
            GetUsers() {
                ApiGet('v1/users', {
                    fields: 'id,name,email,created_at',
                    page: this.current_page
                }).then(response => {
                    this.users = response.data.users;
                }).catch(error => {
                    console.log(error)
                })
            },
            GetRoles() {
                ApiGet('v1/roles', {
                    fields: 'title'
                }).then(response => {
                    this.roles = response.data.roles
                }).catch(error => {
                    console.log(error)
                })
            },
            userDelete(id, name) {
                Swal.fire({
                    title: 'Bạn có muốn xóa ' + name + ' không?',
                    text: "Bạn sẽ không thể khôi phục lại!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Đồng ý'
                }).then((result) => {
                    if (result.value) {
                        ApiDelete('v1/user-delete/' + id).then(response => {
                            this.GetUsers();
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
            this.GetUsers();
            this.GetRoles();
        }
    }
</script>

<style scoped>
    h1 {
        margin-top: 2px;
        margin-bottom: 10px;
        text-align: center;
    }

    .table {
        text-align: center;
        color: #000000;
        padding: 0px 80px;
    }

    .edit {
        padding: 0px 5px;
        color: orange;
    }

    .delete {
        color: red;
    }

    .footer {
        display: flex;
        justify-content: center;
    }
</style>