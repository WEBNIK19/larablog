<template>
    <div class="container-fluid">
        <!--{{ allUsers }}-->
        <ul v-for="user in allUsers">
            <li>{{ user.name}}</li>
        </ul>
    </div>
</template>

<script>
    export default {
        computed: {
            allUsers() {
              return this.$store.getters.allUsers;
            },
        },
        mounted() {
            this.$store.dispatch('getAllUsers');
        },
    };
</script>