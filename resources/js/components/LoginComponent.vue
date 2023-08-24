<template>
    <div class="container">
        <div class="row">
            <div class="col-md-6 mt-5 mx-auto">
                <form v-on:submit.prevent="Login">
                    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>

                    <div class="form-group m-4">
                        <label> Email Address</label>
                        <input type="email" v-model="email" class="form-control" name="email" placeholder="Email Address">
                    </div>
                    <div class="form-group m-4">
                        <label> Password</label>
                        <input type="password" v-model="password" class="form-control" name="password" placeholder="Password">
                    </div>
                    <div class="form-group m-4">
                        <button class="btn btn-lg btn-primary btn-block" @click="login">Sign in</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</template>


<script>
import axios from 'axios'

export default{
    data(){
        return {
            email: '',
            password: '',
        }
    },

    methods:{
        login() {
            axios.post('/api/login',
                {
                    email:this.email,
                    password:this.password,
                    device_name: navigator.userAgent,
                })
                .then((res) => {
                    localStorage.setItem('usertoken', res.data)
                    this.email = ''
                    this.password = ''
                    window.location.href = 'booking'

                })
                .catch((err) => {
                    console.log(err)
                })

        },

    }
}
</script>
