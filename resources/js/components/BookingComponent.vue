<template>
    <div class="container">
        <div class="row">
            <div class="text-danger">{{ error }}</div>
        </div>
        <div class="row">
            <div class="col-md-6 mt-5 mx-auto m-5">
                <form v-on:submit.prevent="reserve">
                    <h1 class="h3 mb-3 font-weight-normal">Booking</h1>
                    <div class="form-group m-4">
                        <label htmlFor="first_name"> Room</label>
                        <select v-model="room_id" class="form-control" name="first_name" @change="getBookings">
                            <option selected="selected" value="1">first</option>
                            <option value="2">second</option>
                            <option value="3">third</option>
                        </select>
                    </div>
                    <div class="form-group m-4">
                        <label htmlFor="password">Reserve Date</label>
                        <datepicker
                            class="form-control"
                            v-model="date"
                            :enable-time-picker="false"
                            placeholder="Reserve Date"
                            :disabled-dates="disabledDates"
                        />
                    </div>
                    <div class="form-group m-4">
                        <label htmlFor="email"> Participants</label>
                        <input type="text" v-model="participants" class="form-control" name="participants"
                               placeholder="Participants">
                    </div>
                    <div class="form-group m-4">
                        <button class="btn btn-lg btn-primary btn-block">Reserve</button>
                    </div>
                </form>
            </div>

            <div class="container">
                <div class="row border-bottom">
                    <div class="col-md-2 mt-2">
                        Room ID
                    </div>
                    <div class="col-md-2 mt-2">
                        Date
                    </div>
                    <div class="col-md-2 mt-2">
                        Fee
                    </div>
                    <div class="col-md-2 mt-2">
                        Discount
                    </div>
                    <div class="col-md-2 mt-2">
                        Participants
                    </div>
                    <div class="col-md-2 mt-2">
                        Created
                    </div>
                </div>
                <div class="row border-bottom" v-for="booking in bookings">
                    <div class="col-md-2 mt-5">
                        {{ booking.room_id }}
                    </div>
                    <div class="col-md-2 mt-5">
                        {{ booking.book_date }}
                    </div>
                    <div class="col-md-2 mt-5">
                        {{ booking.fee }}
                    </div>
                    <div class="col-md-2 mt-5">
                        {{ booking.discount }} %
                    </div>
                    <div class="col-md-2 mt-5">
                        {{ booking.participants }}
                    </div>
                    <div class="col-md-2 mt-5">
                        {{ booking.created_at }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    data() {
        return {
            bookings: [],
            room_id: '1',
            date: '',
            dateString: '',
            participants: '',
            error: '',
            disabledDates: [],
        }
    },

    mounted() {
        window.axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('usertoken')}`

        this.getBookings();
    },

    methods: {
        getBookings() {
            this.getTimeSlots();

            axios.get(`/api/bookings/${this.room_id}`)
                .then((res) => {
                    this.bookings = res.data
                })
                .catch((err) => {
                    console.log(err)
                })
        },
        getTimeSlots(){
            axios.get(`/api/escape-rooms/${this.room_id}/time-slots`)
                .then((res) => {
                    this.disabledDates = res.data
                })
                .catch((err) => {
                    console.log(err)
                })
        },
        reserve() {
            this.error = ''

            axios.post('/api/bookings',{
                room_id: this.room_id,
                date: this.date,
                participants: this.participants
            })
                .then((res) => {
                    this.getBookings()
                })
                .catch((err) => {
                    console.log(err)
                    this.error = err.response.data.message
                })
        },
    }
}
</script>
