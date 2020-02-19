<template>
    <div class="style-user">
        <form action="" @submit.prevent="editRole()">
            <h6>Tên Role:*</h6>
            <input type="text" v-model="roleEdit" class="form-control" placeholder="Nhập tên role..." required>
            <button type="submit" class="btn btn btn-primary button1">Sửa</button>
        </form>
    </div>
</template>

<script>
    export default {
        name: "EditUser",
        data(){
            return{
                roleEdit:''
            }
        },
        methods:{
            editRole(){
                ApiPut(`v1/user-edit/${this.$route.params.id}`, {
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
        }
    }
</script>

<style scoped>
    .style-user{
        padding: 100px 100px;
    }
    .button1{
        margin-top: 10px;
    }

</style>