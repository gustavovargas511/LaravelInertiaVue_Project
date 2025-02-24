<script setup>
import { usePage, useForm } from "@inertiajs/vue3";
import { computed, ref, watch } from "vue";

import dayjs from 'dayjs';

// Get the page props
const form = useForm();
const page = usePage();
//const tasks = ref(page.props.tasks.data); // Use `ref` to make tasks reactive, 
                                         // also this way we get the tasks data from the controller
const tasks = ref(page.props.tasks.data);
const pagination = ref(page.props.tasks); // Store full pagination info
                                          // This now contains pagination info, and the data into `data` key
const user = computed(() => page.props.auth.user); // Access user from Inertia shared data


const deleteTask = (taskId) => {
    form.delete(route('tasks-destroy', taskId), {
        onSuccess: () => {
            tasks.value = tasks.value.filter((task) => task.id !== taskId);
        },
    });
};

const updateStatus = (taskId, status) => {
    // console.log(taskId, status);
    const form = useForm({ status }); // Initialize the form with the status..
    form.put(route('tasks-update-status', taskId), {
        status,
    });
};

// Search by any word functionality
const search = ref('');

watch(search, (value) => {
    // console.log(value);
    // console.log(tasks.value);
    if (value.length > 0) {
        tasks.value = tasks.value.filter((task) => {
            return task.title.toLowerCase().includes(value.toLowerCase()) ||
                task.description.toLowerCase().includes(value.toLowerCase());
        });
    } else {
        tasks.value = page.props.tasks.data;
    }
}
    
);

</script>

<template>
    <div class="w-3/4 mx-auto grid grid-cols-1 gap-4 justify-center items-center">
        <h1 class="text-3xl text-center">Welcome back {{ user.name }}</h1>
        <div v-if="tasks.length > 0">
            <h2 class="text-2xl text-center mb-4">These are your tasks:</h2>
            <div class="flex flex-row justify-end my-2 p-2"> <!-- Search bar -->
                    <input class="w-1/4 p-1 border-2 border-gray-200 rounded" 
                           type="search" 
                           placeholder="Search by any word"
                           v-model="search"/>
            </div>
            <div class="overflow-x-auto rounded-lg border border-gray-200">
                <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                    <thead class="ltr:text-left rtl:text-right">
                        <tr>
                            <th class="px-4 py-2 font-medium whitespace-nowrap text-gray-900">Title</th>
                            <th class="px-4 py-2 font-medium whitespace-nowrap text-gray-900">Description</th>
                            <th class="px-4 py-2 font-medium whitespace-nowrap text-gray-900">Created on</th>
                            <th class="px-4 py-2 font-medium whitespace-nowrap text-gray-900">Status</th>
                            <th class="px-4 py-2 font-medium whitespace-nowrap">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr v-for="task in tasks" :key="task.id">
                            <td class="px-4 py-2 font-medium whitespace-nowrap text-gray-900">{{ task.title }}</td>
                            <td class="px-4 py-2 text-gray-700">{{ task.description }}</td>
                            <td class="px-4 py-2 whitespace-nowrap text-gray-700"> 
                                {{ dayjs(task.created_at).format('MMMM D, YYYY [at] h:mm A') }}
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap text-gray-700"><select
                                v-model="task.status"
                                @change="updateStatus(task.id, $event.target.value)"
                                class="border rounded px-2 py-1"
                            >
                                <option value="pending">Pending</option>
                                <option value="in_process">In Process</option>
                                <option value="completed">Completed</option>
                            </select>
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap text-gray-700 space-x-2">
                            <Link
                                :href="route('tasks-edit', task.id)"
                                class="bg-blue-200 hover:bg-blue-300 rounded-full px-2 py-1 text-blue-500 hover:text-blue-700"
                                >Edit</Link
                            > 
                            <form
                                    @submit.prevent="deleteTask(task.id)"
                                    class="inline rounded-full px-2 py-1 bg-red-200 hover:bg-red-300 text-red-500 hover:text-red-700"
                                >
                                    <button type="submit">Delete</button>
                            </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div v-else>
            <p>No tasks found.</p>
        </div>
        <!-- Pagination -->
        <div class="flex flex-row justify-between items-center">
            <div class="flex flex-row justify-center items-center">
                <Link v-for="link in pagination.links"
                     :key="link.label"
                     :href="link.url"
                      v-html="link.label"
                      class="px-4 py-2 border rounded mx-1 hover:bg-gray-200"
                     :class="{
                            'bg-gray-200': link.active,
                            'text-gray-500 cursor-not-allowed': !link.url,
                            }">
                </Link>
            </div>
            <div class="flex flex-row justify-center items-center">
                <span class="px-4 py-2">
                    Showing {{ pagination.from }} to {{ pagination.to }} of {{ pagination.total }} results 
                </span>
            </div>
        </div>
    </div>
</template>
