<script setup>
// import {
//     Link,
//     Head
//  } from '@inertiajs/vue3'; // Import Link and Head from Inertia removed because it is already set on app.js
import { usePage } from "@inertiajs/vue3";
import { computed } from "vue";

// Get the page props
const page = usePage();
const user = computed(() => page.props.auth.user); // Access user from Inertia shared data
</script>

<template>
    <!-- Removed Head, is already set default Head on app.js -->
    <!-- <Head>
        <title>Laravel + Inertia + Vue</title>
    </Head> -->
    <header class="bg-gray-800 text-white p-4">
        <nav class="w-full flex items-center justify-between p-4">
            <div class="text-2xl font-bold space-x-6">
                <Link
                    :href="route('home')"
                    class="text-white hover:text-violet-500"
                    :class="{ 'text-violet-500': route().current('home') }"
                    >Home</Link
                >
                <Link
                    :href="route('about')"
                    class="text-white hover:text-violet-500"
                    :class="{ 'text-violet-500': route().current('about') }"
                    >About</Link
                >
            </div>
            <!-- <div>
                <h1>Welcome, {{ user ? user.name : "Guest" }}</h1>
            </div> -->
            <div
                v-if="user"
                class="flex flex-col md:flex-row justify-center items-center text-2xl font-bold space-x-6"
            >
                <Link
                    :href="route('dashboard')"
                    class="text-white hover:text-violet-500"
                    :class="{ 'text-violet-500': route().current('dashboard') }"
                    >Dashboard</Link
                >
                <Link
                    :href="route('logout')"
                    method="post"
                    as="button"
                    class="text-white hover:text-violet-500"
                    >Logout</Link
                >
                <div>
                    <img
                        :src="
                            user?.avatar
                                ? `/storage/${user.avatar}`
                                : '/images/user-solid.svg'
                        "
                        alt="User Avatar"
                        class="w-10 h-10 rounded-full"
                    />
                </div>
            </div>
            <div
                v-else
                class="flex flex-col md:flex-row text-2xl font-bold space-x-6"
            >
                <Link
                    :href="route('register')"
                    class="text-white hover:text-violet-500"
                    :class="{ 'text-violet-500': route().current('register') }"
                    >Register</Link
                >
                <Link
                    :href="route('login')"
                    class="text-white hover:text-violet-500"
                    :class="{ 'text-violet-500': route().current('login') }"
                    >Login</Link
                >
            </div>
        </nav>
    </header>
    <main class="p-4">
        <slot />
    </main>
    <!-- <footer class="sticky bottom-0 left-0 bg-gray-800 text-white p-4">
            <div class="text-center">
                <p>&copy; 2021</p>
            </div>

        </footer> -->
</template>
