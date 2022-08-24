<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form v-on:submit.prevent="submit">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" v-model="email">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" v-model="password">
                    </div>
                    <button @click="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    const url = "/login";

    window.axios = require('axios');

    window.axios.defaults.headers.common = {
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    };

    export default {
        data() {
            return {
                email: "",
                password: ""
            }
        },
        
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            submit: function(e) {
                e.preventDefault();
                
                console.log("You clicked the button!");

                axios.post(url, {
                    email: email,
                    password: password
                })
                .then(function (response) {
                    console.log(response);
                })
                .catch(function (error) {
                    console.log(error);
                });
            }
        }
    }
</script>
