<script setup>
// import LayoutContainer from '@/Layouts/LayoutContainer.vue'
// defineOptions({
//     layout: LayoutContainer,
// });

</script>

<template>
    <Head :title = "`${$page.component } |`"/>
    <div class="border-2 border-dashed border-red-500">
        <h1>Hello from Laravel + Inertia + Vue</h1>
        <h2>{{ $page }}</h2>
    </div>
</template>
