<script setup>
import { useForm } from '@inertiajs/vue3'
import TextInput from "../components/TextInput.vue"

const form = useForm({
    email: null,
    password: null,
    remember: null,
});

</script>

<template>
    <Head title="Login |" />

    <div>
        <h1 class="text-3xl">Login</h1>
    </div>

    <div class="w-full lg:w-1/4 mx-auto">
        <form @submit.prevent="form.post('/login', {
            onError: () => {
                form.reset('password', 'remember');
            },
        })">
            <div class="grid grid-cols-1 gap-2">
                <TextInput name="Email" type="email" v-model="form.email" :message="form.errors.email"/>
                <TextInput name="Password" type="password" v-model="form.password" :message="form.errors.password"/>
            </div>
            <div class="flex flex-col items-start justify-center gap-2 mb-1">
                <div class="flex items-center gap-2">
                    <input id="remember" type="checkbox" v-model="form.remember" />
                    <label for="remember" class="text-slate-800">Remember Me</label>
                </div>
                <p class="text-slate-600 mb-2">
                    Need an account?... 
                    <a :href="route('register')" class="text-link text-blue-400">
                        Register
                    </a>
                </p>
            </div>
            <div class="mb-6">
                <button class="w-full bg-blue-400 text-white px-4 py-2 rounded-xl"
                        :disabled="form.processing">
                    Login
                </button>
            </div>
        </form>
    </div>
</template>
