<template>
    <button type="submit" class="btn btn-light" @click="toggle()">
        <span :class="this.classes"></span>
        <span v-text="this.count"></span>
    </button>
</template>


<script>
    export default {
        props: ['reply'],

        data(){
            return {
                count: this.reply.favoritesCount,
                active: this.reply.isFavorited
            }
        },

        computed: {
            classes() {
                return ['fa', this.active ? 'fa-heart' : 'fa-heart-o'];
            },
            endpoint(){
                return '/replies/' + this.reply.id + '/favorites';
            }
        },

        methods: {
            toggle() {
                this.active ? this.unfavorite() : this.favorite();
            },

            favorite(){
                axios.post(this.endpoint);
                this.active = true;
                this.count++;
            },

            unfavorite(){
                axios.delete(this.endpoint);
                this.active = false;
                this.count--;
            }
        }
    }
</script>

<style scoped>
    span.fa.fa-heart {
        color: #ff0000;
    }
</style>