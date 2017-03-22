<template>
    <div id="main">
        <nav class="main-nav">
            <div>abcede</div>
            <router-link :to="{ name: 'index' }">Go to Foo</router-link>
            <router-link :to="{ name: 'example' }">Go to Example</router-link>
        </nav>
        
        <main class="main-content">
            <transition name="slide">
                <router-view></router-view>
            </transition>
        </main>
    </div>
</template>
<script>
    export default {

    }
</script>
