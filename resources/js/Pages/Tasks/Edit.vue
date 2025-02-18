<script setup>
import { useForm } from "@inertiajs/vue3";

// Receive the task prop from the controller
const props = defineProps({
    task: Object,
});

console.log(props.task); // Log the task data directly
// Initialize the form with the task data as default values
const form = useForm({
    title: props.task.title,
    description: props.task.description,
});

const updateTask = () => {
    form.put(route("tasks-update", props.task.id), {
        onSuccess: () => {
            form.reset();
        },
    });
};
</script>

<template>
    <div
        class="w-3/4 mx-auto grid grid-cols-1 gap-4 justify-center items-center"
    >
        <h1 class="text-center">Edit new task</h1>
        <form @submit.prevent="updateTask">
            <div class="flex flex-col space-y-4">
                <div>
                    <label for="title" class="block">Title</label>
                    <input
                        type="text"
                        id="title"
                        v-model="form.title"
                        class="w-full border border-gray-200 rounded-lg p-2"
                    />
                </div>
                <div>
                    <label for="description" class="block">Description</label>
                    <textarea
                        id="description"
                        v-model="form.description"
                        class="w-full border border-gray-200 rounded-lg p-2"
                    ></textarea>
                </div>
                <div>
                    <button
                        type="submit"
                        class="bg-blue-500 text-white rounded-lg p-2"
                    >
                        Update Task
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>
