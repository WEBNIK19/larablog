<template>
    <div class="container-fluid">
        <!--{{ allUsers }}-->
        <ul>
            <li v-for="user in allUsers"><router-link :to="{ name: 'user.edit', params: {userId: user.id} }">{{ user.name}}</router-link></li>
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