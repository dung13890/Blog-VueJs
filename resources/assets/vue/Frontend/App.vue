<template>
    <div>
        <div>abcede</div>
        <router-link :to="{ name: 'index' }">Go to Foo</router-link>
        <router-link :to="{ name: 'example' }">Go to Example</router-link>
        <router-view></router-view>
    </div>
</template>
<script>
    export default {

    }
</script>
