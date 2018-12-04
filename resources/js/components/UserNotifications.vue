<template>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle notification-dropdown" href="#" data-toggle="dropdown">
            <span class="fa fa-bell"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
            <p v-show="!notifications.length">You dont' have any new notification.</p>
            <div v-if="notifications.length">
                <a :href="notification.data.link" class="dropdown-item"
                   v-for="notification in notifications"
                   v-text="notification.data.message"
                   @click="markAsRead(notification)">
                </a>
            </div>
        </div>
    </li>
</template>

<script>
    export default {
        data() {
            return {
                notifications: false,
            }
        },

        created() {
            axios.get("/profiles/" + window.App.user.name + "/notifications")
                .then(response => this.notifications = response.data);
        },

        methods: {
            markAsRead(notification) {
                axios.delete("/profiles/" + window.App.user.name + "/notifications/" + notification.id);
            }
        }
    }
</script>