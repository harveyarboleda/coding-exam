<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="/" class="btn btn-primary btn-block mb-4">Back to index</a>
                <h1 class="mb-4">Register</h1>
                <form v-on:submit.prevent="submit">
                    <div class="mb-3">
                        <label for="text" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" v-model="myName"/>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" v-model="myEmail"/>
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Nominated Password</label>
                        <input type="password" class="form-control" id="password" aria-describedby="passwordHelp" v-model="myPassword" />
                        <div id="passwordHelp" class="form-text">Minimum characters: 8</div>
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirmed Password</label>
                        <input type="password" class="form-control" id="confirm_password" aria-describedby="confirm_passwordHelp" v-model="myConfirmPassword" />
                        <div id="confirm_passwordHelp" class="form-text">Minimum characters: 8</div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Role</label>
                        <select class="form-control" id="role" v-model="myRoleId">
                            <option v-for="list in listRole" :value="list.id">{{ list.roles_name }}</option>
                        </select>
                    </div>
                    <button class="btn btn-primary">Register</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    
    const url = "/register";
    const url2 = "/api/v1/roles";
    const Swal = require('sweetalert2');
    window.axios = require('axios');

    window.axios.defaults.headers.common = {
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    };
    
    export default {
        data() {
            return {
                myName: "",
                myEmail: "",
                myPassword: "",
                myConfirmPassword: "",
                myRoleId: "",
                listRole: null
            }
        },
        
        mounted() {
            console.log('Component mounted.');
            this.role();
        },
        methods: {
            submit: function(e) {
                e.preventDefault();
                let self = this;
                if(this.myName.length == 0 || this.myEmail.length == 0 || this.myPassword.length == 0 || this.myConfirmPassword.length == 0 || this.myRoleId.length == 0) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Empty field!',
                        icon: 'error'
                    })
                    return false;
                }

                if(this.myPassword != this.myConfirmPassword) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Nominated Password and Confirmed Password doesn\'t same!',
                        icon: 'error'
                    })
                    return false;
                }

                axios.post(url, {
                    email: this.myEmail,
                    password: this.myPassword,
                    confirm_password: this.myConfirmPassword,
                    name: this.myName,
                    roles_id: this.myRoleId
                })
                .then(function (response) {
                    
                    if(response.data.code == 200) {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Successfully registered!',
                            icon: 'success'
                        });

                        self.myName = "";
                        self.myEmail = "";
                        self.myPassword = "";
                        self.myConfirmPassword = "";
                        self.myRoleId = "";
                    }
                })
                .catch(function (error) {
                    Swal.fire({
                        title: "Error!",
                        icon: "error"
                    })
                });
            },
            role: function(e) {
                let self = this;
                axios.get(url2)
                .then(function (response) {
                    if(response.data.length != 0) {
                        self.listRole = response.data;
                    }
                })
            }
        }
    }
</script>
