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
        <p>This is a basic project with login functionality,
            using Laravel, Inertia and Vue 3, made to show
        what our team can offer to you.</p>
        <p>Feel free to test it <div class="text-slate-600">(..or break it)</div></p>
    </div>

</template>
