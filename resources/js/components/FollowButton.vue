<template>
    <div class="container">
        <button class="btn ml-4 btn-primary btn-sm" @click="followUser" v-text="buttonText"></button>
    </div>
</template>

<script>
    export default {
        props: ['userId', 'follows'],
        mounted() {
            console.log('Component mounted.')
        },

        data() {
            return {
                status: this.follows
            }
        },

        methods: {
            followUser() {
                // alert('hey bro');
                axios.post('/follow/' + this.userId).then((response) => {
                    this.status = !this.status
                }).catch(err => {
                    if (err.response.status == 401) {
                        window.location = '/login';
                    }
                })
            }
        },

        computed: {
            buttonText () {
                return this.status ? 'UnFollow' : 'Follow'
            }
        }
    }
</script>
