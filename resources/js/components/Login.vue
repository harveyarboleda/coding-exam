<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="/" class="btn btn-primary btn-block mb-4">Back to index</a>
                <h1 class="mb-4">Login</h1>
                <form v-on:submit.prevent="submit">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" v-model="myEmail" :disabled="activity"/>
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" v-model="myPassword" :disabled="activity"/>
                    </div>
                    <button class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    
    const url = "/login";
    const Swal = require('sweetalert2');
    window.axios = require('axios');

    window.axios.defaults.headers.common = {
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    };
    
    export default {
        data() {
            return {
                myEmail: "",
                myPassword: "",
                activity: false
            }
        },
        computed: {
            activity() {
                return this.activity;
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            submit: function(e) {
                let self = this;
                e.preventDefault();
                
                if(this.myEmail.length == 0 || this.myPassword.length == 0) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Empty field!',
                        icon: 'error'
                    })
                    return false;
                }

                axios.post(url, {
                        email: this.myEmail,
                        password: this.myPassword
                })
                .then(function (response) {
                    if(response.data.code == 200) {
                        self.activity = true;
                        Swal.fire({
                            title: 'Success!',
                            text: 'Successfully login! You will redirected to user page in a few seconds.',
                            icon: 'success'
                        })
                        setTimeout( () => {
                            location.reload();
                        }, 5000);
                    } else {
                        Swal.fire({
                            title: response.data.title,
                            text: response.data.status,
                            icon: response.data.icon
                        })
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
                
                
            }
        }
    }
</script>
