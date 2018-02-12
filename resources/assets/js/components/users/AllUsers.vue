<template>
    <div class="container-fluid">
        <!--{{ allUsers }}-->
        <ul>
            <li v-for="user in allUsers">{{ user.name}} {{user.id}}</li>
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