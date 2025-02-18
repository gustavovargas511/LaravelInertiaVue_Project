<script setup>
import { useForm } from "@inertiajs/vue3";

const form = useForm({
    title: null,
    description: null,
});

const createTask = () => {
    form.post("/tasks", {
        onSuccess: () => {
            form.reset();
        },
    });
};
</script>

<template>
        <div class="w-3/4 mx-auto grid grid-cols-1 gap-4 justify-center items-center">
            <h1 class="text-center">Create new task</h1>
            <form @submit.prevent="createTask">
                <div class="flex flex-col space-y-4">
                    <div>
                        <label for="title" class="block">Title</label>
                        <input type="text" id="title" v-model="form.title" class="w-full border border-gray-200 rounded-lg p-2">
                    </div>
                    <div>
                        <label for="description" class="block">Description</label>
                        <textarea id="description" v-model="form.description" class="w-full border border-gray-200 rounded-lg p-2"></textarea>
                    </div>
                    <div>
                        <button type="submit" class="bg-blue-500 text-white rounded-lg p-2">Create Task</button>
                    </div>
                </div>
            </form>
        </div>
</template>