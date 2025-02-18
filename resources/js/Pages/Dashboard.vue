<script setup>
import { usePage } from "@inertiajs/vue3";
import { computed } from "vue";

// Get the page props
const page = usePage();
const user = computed(() => page.props.auth.user); // Access user from Inertia shared data
</script>

<template>
    <div>
        <h1 class="text-3xl">Welcome back {{ user.name }}</h1>
    </div>
</template>
