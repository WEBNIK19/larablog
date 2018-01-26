<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        {{ $t("translation.homepage") }}
                    </div>
                </div>
                <router-link :to="{ name: 'user.all' }" tag="li" active-class="active" v-if="!logged">
                    <router-link :to="{ name: 'user.all' }">
                        {{ $t("translation.userAll") }}
                    </router-link>
                </router-link>
            </div>
        </div>
    </div>
</template>
