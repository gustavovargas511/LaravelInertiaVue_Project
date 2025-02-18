<script setup>
import { reactive } from "vue";
import { useForm } from "@inertiajs/vue3";
import TextInput from "../components/TextInput.vue";

const form = useForm({
    name: null,
    email: null,
    password: null,
    password_confirmation: null,
    avatar: null,
    preview: null,
});

// const submitForm = () => {
//     // console.log(form);
//     router.post('/register', form);
// };

const change = (e) => {
    form.avatar = e.target.files[0];
    form.preview = URL.createObjectURL(e.target.files[0]);
    // console.log(e.target.files[0]);
};
</script>

<template>
    <Head title="Register |" />

    <div>
        <h1 class="text-3xl">Register</h1>
    </div>

    <div class="w-full lg:w-2/4 mx-auto">
        <form
            @submit.prevent="
                form.post('/register', {
                    onError: () => {
                        form.reset('password', 'password_confirmation');
                    },
                })
            "
        >
            <!-- @submit.prevent="submitForm" -->
            <div class="grid grid-cols-1 gap-2">
                <div class="justify-center items-center grid">
                    <div
                        class="relative w-28 h-28 rounded-full overflow-hidden border border-slate-300"
                    >
                        <label
                            for="avatar"
                            class="absolute inset-0 grid content-end cursor-pointer"
                        >
                            <span class="bg-white/70 pb-2 text-center"
                                >Avatar</span
                            ></label
                        >
                        <input
                            type="file"
                            id="avatar"
                            name="avatar"
                            hidden
                            @input="change"
                        />
                        <img class="object-cover w-28 h-28" :src="form.preview ?? '/images/user-solid.svg'" alt="">
                    </div>
                </div>
                <!-- <div>
                    <label for="avatar">Avatar</label>
                    <input
                        type="file"
                        id="avatar"
                        name="avatar"
                        class="w-full p-2 border border-gray-400 rounded-xl"
                        @input="change"
                    />
                    <p class="text-red-500 pt-2">{{ form.errors.avatar }}</p>
                </div> -->
                <TextInput
                    name="Name"
                    v-model="form.name"
                    :message="form.errors.name"
                />
                <TextInput
                    name="Email"
                    type="email"
                    v-model="form.email"
                    :message="form.errors.email"
                />
                <TextInput
                    name="Password"
                    type="password"
                    v-model="form.password"
                    :message="form.errors.password"
                />
                <TextInput
                    name="Password Confirmation"
                    type="password"
                    v-model="form.password_confirmation"
                />
                <!-- <div class="mb-6">
                    <label for="email" class="block mb-2">Email</label>
                    <input type="email" 
                           id="email" 
                           name="email"
                            v-model="form.email" 
                           class="w-full p-2 border border-gray-400 rounded-xl" />
                    <p class="text-red-500 pt-2">{{ form.errors.email}}</p>
                </div> -->
            </div>
            <div class="mb-6 flex flex-col items-center justify-center">
                <p class="text-slate-600 mb-2">
                    Already a user?...
                    <a :href="route('login')" class="text-link text-blue-400">
                        Login
                    </a>
                </p>
                <button
                    class="w-full md:w-1/4 bg-blue-400 text-white px-4 py-2 rounded-xl"
                    :disabled="form.processing"
                >
                    Register
                </button>
            </div>
        </form>
    </div>
</template>
