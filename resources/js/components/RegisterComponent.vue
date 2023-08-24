<template>
    <div class="container">
        <div class="row">
            <div class="col-md-6 mt-5 mx-auto m-5">
                <form v-on:submit.prevent="register">
                    <h1 class="h3 mb-3 font-weight-normal">Register</h1>
                    <div class="form-group m-4">
                        <label htmlFor="first_name"> First Name</label>
                        <input type="text" v-model="first_name" class="form-control" name="first_name"
                               placeholder="first name">
                    </div>
                    <div class="form-group m-4">
                        <label htmlFor="last_name"> Last Name</label>
                        <input type="text" v-model="last_name" class="form-control" name="last_name"
                               placeholder="last name">
                    </div>
                    <div class="form-group m-4">
                        <label htmlFor="password"> Birth date</label>
                        <datepicker
                            class="form-control"
                            v-model="birth_date"
                            :enable-time-picker="false"
                            :upperLimit="to"
                            :clearable="true"
                            placeholder="Birth Date"
                        />
                    </div>
                    <div class="form-group m-4">
                        <label htmlFor="email"> Email Address</label>
                        <input type="email" v-model="email" class="form-control" name="email"
                               placeholder="Email Address">
                    </div>
                    <div class="form-group m-4">
                        <label htmlFor="password"> Password</label>
                        <input type="password" v-model="password" class="form-control" name="password"
                               placeholder="Password">
                    </div>
                    <div class="form-group m-4">
                        <button class="btn btn-lg btn-primary btn-block">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    data() {
        return {
            first_name: '',
            last_name: '',
            birth_date: new Date(),
            email: '',
            password: '',
            to: new Date()
        }
    },

    methods: {
        register() {
            axios.post('/api/register',
                {
                    name: this.first_name + ' ' + this.last_name,
                    email: this.email,
                    password: this.password,
                    birth_date: this.birth_date,
                })
                .then((res) => {
                    console.log(res)
                    window.location.href = 'login'
                })
                .catch((err) => {
                    console.log(err)
                })
        },
    }
}
</script>
