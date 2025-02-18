<script setup>
// import LayoutContainer from '@/Layouts/LayoutContainer.vue'
// defineOptions({
//     layout: LayoutContainer,
// });

</script>

<template>
    <Head :title = "`${$page.component } |`"/>
    <div class="w-3/4 mx-auto">
        <h1 class="text-3xl">Home</h1>
        <p class="text-slate-600">Welcome to the Home page</p>
    </div>
    <div class="w-3/4 mx-auto">
        <p>Project to manage Tasks by user (login functionality),
            using Laravel, Inertia and Vue 3.</p>
        <p>Feel free to test it <div class="text-slate-600">(..or break it)</div></p>
    </div>

</template>
