<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="p-5 mb-2" style="background: #eee;">
                    Hello there! {{this.name}}
                    <br/>
                    <a href="/logout">
                        <button class="btn btn-danger">Logout</button>
                    </a>
                </div>
                <div class="p-5 mb-2" style="background: #eee;">
                    <h1 class="clearfix">
                        Roles
                        <div class="float-end">
                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addRoleModal">Add</button>
                            <button class="btn btn-primary" @click="role()">Refresh</button>
                        </div>
                    </h1>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 10%;">#</th>
                                <th scope="col" style="width: 40%;">Roles Name</th>
                                <th scope="col">Roles Description</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="list in listRole">
                                <td>{{list.id}}</td>
                                <td>{{list.roles_name}}</td>
                                <td>{{list.roles_description}}</td>
                                <td>
                                    <button class="btn btn-warning" @click="getData(list.id,'role')">Edit</button>
                                    <button class="btn btn-danger" @click="deleteThis(list.id, 'role')">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="p-5 mb-2" style="background: #eee;">
                    <h1 class="clearfix">
                        Accounts
                        <div class="float-end">
                            <button class="btn btn-primary" @click="account()">Refresh</button>
                        </div>
                    </h1>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">E-mail</th>
                                <th scope="col">Role</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="list in listAccount">
                                <td>{{list.id}}</td>
                                <td>{{list.name}}</td>
                                <td>{{list.email}}</td>
                                <td>{{findMyRole(list.roles_id).roles_name}}</td>
                                <td>
                                    <button class="btn btn-warning" @click="getData(list.id,'account')">Edit</button>
                                    <button class="btn btn-danger" @click="deleteThis(list.id, 'account')">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal fade" id="editAccountModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="editAccountModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editAccountModalLabel">Edit Role</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="cancelEdit(1)"></button>
                    </div>
                    <div class="modal-body">
                        <form v-on:submit.prevent="updateThis('account')">
                            <div class="mb-3">
                                <label for="text" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" v-model="EDITAname"/>
                            </div>
                            <div class="mb-3">
                                <label for="text" class="form-label">E-mail</label>
                                <input type="text" class="form-control" id="name" v-model="EDITAemail"/>
                            </div>
                            <div class="mb-3">
                                <label for="text" class="form-label">Role</label>
                                <select class="form-control" id="role" v-model="EDITArole">
                                    <option v-for="list in listRole" :value="list.id">{{ list.roles_name }}</option>
                                </select>
                            </div>
                            <button class="btn btn-primary">Update Account</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="editRoleModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="editRoleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editRoleModalLabel">Edit Role</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="cancelEdit(1)"></button>
                    </div>
                    <div class="modal-body">
                        <form v-on:submit.prevent="updateThis('role')">
                            <div class="mb-3">
                                <label for="text" class="form-label">Roles Name</label>
                                <input type="text" class="form-control" id="name" v-model="EDITRroles_name"/>
                            </div>
                            <div class="mb-3">
                                <label for="text" class="form-label">Roles Description</label>
                                <input type="text" class="form-control" id="name" v-model="EDITRroles_description"/>
                            </div>
                            <button class="btn btn-primary">Update Role</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="addRoleModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="addRoleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addRoleModalLabel">Add Role</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form v-on:submit.prevent="addThis('role')">
                            <div class="mb-3">
                                <label for="text" class="form-label">Roles Name</label>
                                <input type="text" class="form-control" id="name" v-model="ADDRroles_name"/>
                            </div>
                            <div class="mb-3">
                                <label for="text" class="form-label">Roles Description</label>
                                <input type="text" class="form-control" id="name" v-model="ADDRroles_description"/>
                            </div>
                            <button class="btn btn-primary">Add Role</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</template>


<script>
    const Swal = require('sweetalert2');
    const bootstrap = require('bootstrap');
    const url = "/api/v1/roles";
    const url2 = "/api/v1/users";
    const url3 = "/api/v1/updateRole";
    const url4 = "/api/v1/updateAccount";

    const url5 = "/api/v1/deleteRole";
    const url6 = "/api/v1/deleteAccount";
    const url7 = "/api/v1/addRole";

    export default {
        props: [
            'name'
        ],
        data () {
            return {
                ADDRroles_name:        "",
                ADDRroles_description: "",

                EDITRid:                "",
                EDITRroles_name:        "",
                EDITRroles_description: "",
                EDITAid:                "",
                EDITAname:              "",
                EDITAemail:             "",
                EDITArole:              "",
                listRole:               null,
                listAccount:            null,
            };
        },
        mounted() {
            this.role();
            this.account();
        },
        methods: {
            role: function(e) {
                let self = this;
                axios.get(url)
                .then(function (response) {
                    if(response.data.length != 0) {
                        self.listRole = response.data;
                    }
                })
                this.alert('success', 'Refresh!');
            },

            account: function(e) {
                let self = this;
                axios.get(url2)
                .then(function (response) {
                    if(response.data.length != 0) {
                        self.listAccount = response.data;
                    }
                });
                this.alert('success', 'Refresh!');
            },
            findMyRole(id) {
                return this.listRole.find(x => x.id === id);
            },
            findMyAccount(id) {
                return this.listRole.find(x => x.id === id);
            },
            getData(id, type) {
                if(type == "role") {
                    
                    new bootstrap.Modal(document.getElementById('editRoleModal')).show();
                    this.EDITRid = this.listRole.find(x => x.id === id).id;
                    this.EDITRroles_name = this.listRole.find(x => x.id === id).roles_name;
                    this.EDITRroles_description = this.listRole.find(x => x.id === id).roles_description;
                } else if(type == "account") {
                    new bootstrap.Modal(document.getElementById('editAccountModal')).show();
                    this.EDITAid = this.listAccount.find(x => x.id === id).id;
                    this.EDITAname = this.listAccount.find(x => x.id === id).name;
                    this.EDITAemail = this.listAccount.find(x => x.id === id).email;
                    this.EDITArole = this.listAccount.find(x => x.id === id).roles_id;
                }
            },
            cancelEdit(checking) {
                this.ADDRroles_name        = "";
                this.ADDRroles_description = "";

                this.EDITRid                = "";
                this.EDITRroles_name        = "";
                this.EDITRroles_description = "";

                this.EDITAid                = "";
                this.EDITAname              = "";
                this.EDITAemail             = "";
                this.EDITArole              = "";

                if(checking == 1) {
                    this.alert('success', 'Editing Canceled!');
                }
            },
            alert(icon, title) {
                var toastMixin = Swal.mixin({
                    toast: true,
                    icon: icon,
                    title: title,
                    animation: true,
                    position: 'bottom-right',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });
                toastMixin.fire();
            },
            deleteThis(id, type) {
                let self = this;
                const whatType = (type == "role") ? "role" : "account";
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire(
                            'Deleted!',
                            'This '+whatType+' has been deleted.',
                            'success'
                        )

                        

                        if(type == "role") {
                            self.deleteRole(id);
                        } else if(type == "account") {
                            self.deleteAccount(id);
                        }

                        // updated
                        this.account();
                        this.role();
                    }
                })
            },
            updateThis(type) {
                let self = this;
                const whatType = (type == "role") ? "role" : "account";
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire(
                            'Deleted!',
                            'This '+whatType+' has been updated.',
                            'success'
                        )

                        
                        if(type == "role") {
                            var id = self.EDITRid;
                            self.updateRole(id);
                            
                        } else if(type == "account") {
                            var id = self.EDITAid;
                            self.updateAccount(id);
                        }

                        // updated
                        this.account();
                        this.role();
                        
                    }
                })
            },
            updateAccount(id) {
                let self = this;
                axios.get(url4+"/"+id, {
                    params: {
                        email: self.EDITAemail,
                        name: self.EDITAname,
                        roles_id: self.EDITArole
                    }
                })
                .then(function (response) {
                    
                    Swal.fire({
                        title: 'Success!',
                        text: 'Successfully updated!',
                        icon: 'success'
                    });

                    self.cancelEdit(0);
                });
                document.addEventListener('DOMContentLoaded', () => {
                    var modal = new bootstrap.Modal('#editAccountModal');
                    document.addEventListener('closeModal', () => {
                        modal.hide();
                    });
                });
            },
            updateRole(id) {
                let self = this;
                axios.get(url3+"/"+id, {
                    params: {
                        roles_name: self.EDITRroles_name,
                        roles_description: self.EDITRroles_description
                    }
                })
                .then(function (response) {
                    
                    Swal.fire({
                        title: 'Success!',
                        text: 'Successfully updated!',
                        icon: 'success'
                    });

                    self.cancelEdit(0);
                    
                });
                document.addEventListener('DOMContentLoaded', () => {
                    var modal = new bootstrap.Modal('#editRoleModal');
                    document.addEventListener('closeModal', () => {
                        modal.hide();
                    });
                });
            },
            
            deleteAccount(id) {
                axios.get(url6+"/"+id).then(function (response) {
                    
                    Swal.fire({
                            title: 'Success!',
                            text: 'Successfully updated!',
                            icon: 'success'
                        });

                    cancelEdit(0);
                });
            },
            deleteRole(id) {
                axios.get(url5+"/"+id).then(function (response) {
                    
                    Swal.fire({
                        title: 'Success!',
                        text: 'Successfully deleted!',
                        icon: 'success'
                    });

                    cancelEdit(0);
                });
            },
            addThis(type) {
                let self = this;
                const whatType = (type == "role") ? "role" : "account";
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you want to add this?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, add it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire(
                            'Deleted!',
                            'This '+whatType+' has been added.',
                            'success'
                        )

                        
                        if(type == "role") {
                            self.addRole();
                            
                        }
                        // updated
                        this.account();
                        this.role();
                        
                    }
                })
            },
            addRole(id) {
                let self = this;
                axios.get(url7, {
                    params: {
                        roles_name: self.ADDRroles_name,
                        roles_description: self.ADDRroles_description
                    }
                })
                .then(function (response) {
                    
                    Swal.fire({
                        title: 'Success!',
                        text: 'Successfully added!',
                        icon: 'success'
                    });

                    self.cancelEdit(0);
                    
                });
                
                document.addEventListener('DOMContentLoaded', () => {
                    var modal = new bootstrap.Modal('#addRoleModal');
                    document.addEventListener('closeModal', () => {
                        modal.hide();
                    });
                });
            },
        }
    }
</script>