<script setup>
// import LayoutContainer from '@/Layouts/LayoutContainer.vue'
// defineOptions({
//     layout: LayoutContainer,
// });

// Refactor: flash message

import { ref, onMounted } from "vue";
import { usePage } from "@inertiajs/vue3";

const flash = ref(usePage().props.flash.message);

onMounted(() => {
    if (flash.value) {
        setTimeout(() => {
            flash.value = null;
        }, 5000);
    }
});

</script>

<template>
    <div v-if="flash" class="absolute top-0 w-full flex justify-center">
        <p class="text-lg absolute bg-green-400 p-4">
            {{ flash }}
        </p>
    </div>
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
