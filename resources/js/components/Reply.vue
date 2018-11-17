<script>
    export default {
        props: ['attributes'],
        data() {
            return {
                editing: false,
                body: this.attributes.body
            };
        },
        methods: {
            update() {
                axios.patch('/replies/' + this.attributes.id, {
                    body: this.body
                });
                this.editing = false;
                flash('Your reply has been updated.');
            },

            destroy() {
                axios.delete('/replies/' + this.attributes.id);

                $(this.$el).fadeOut(300,() => {
                    flash('Your reply has been deleted.');
                });

            }
        }
    }
</script>