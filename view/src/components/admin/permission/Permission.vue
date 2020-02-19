<template>
    <div>
        <h2>Permissions</h2>
        <div class="table">
            <div class="add-permission">
                <button class="btn btn-primary">
                    <router-link to="/permission-add" class="per-add">Thêm</router-link>
                </button>
            </div>
            <table class="table table-bordered">
                <thead class="thead-dark">
                <tr>
                    <th scope="col" class="">STT</th>
                    <th scope="col">Name</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(permission, index) in permissions" :key="index">
                    <th scope="row">{{ index+1 }}</th>
                    <td>{{ permission.title }}</td>
                    <td>
                        <router-link :to="/permission-edit/+permission.id"><i class="fas fa-edit edit"></i></router-link>
                        <a @click="permissionDelete(permission.title, permission.id)"><i class="fa fa-trash delete"></i></a>
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
                <li class="page-item hover-point" v-if="permissions.length >= 30">
                    <label class="page-link" @click="current_page++"> > </label>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Permission",
        data() {
            return {
                permissions: [],
                current_page: 1
            }
        },
        watch: {
            current_page: function () {
                this.GetPermission();
            }
        },
        methods: {
            GetPermission() {
                ApiGet('v1/permissions', {
                    fields: 'title,id',
                    page: this.current_page
                })
                    .then(response => {
                        this.permissions = response.data.permissions
                    })
                    .catch(error => {
                        console.log(error)
                    })
            },
            permissionDelete(title, id) {
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
                        ApiDelete('v1/permission-delete/' + id).then(response => {
                            this.GetPermission();
                            Swal.fire(
                                'Đã Xóa',
                                'Quyền '+title+' đã bị xóa.',
                                'success'
                            )
                        }).catch(error => {
                            console.log(error)
                        })

                    }else{
                        Swal.fire(
                            'Huỷ bỏ',
                            'Hành động được hủy bỏ!',
                            'success'
                        )
                    }
                })
            },

        },
        mounted() {
            this.GetPermission();
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

    .footer {
        color: black;
        display: flex;
        justify-content: center;
    }

    .add-permission {
        margin-bottom: 10px;
        display: flex;
        justify-content: flex-end;
        font-weight: bold;
    }
    .per-add {
        color: white;
    }
</style>