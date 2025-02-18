<script setup>
const model = defineModel({
    type: null,
    required: true,
});

defineProps({
    name: {
        type: String,
        required: true,
    },
    type: { String, default: "text" },
    message: String,
});
</script>

<template>
    <div class="mb-6">
        <label for="name" class="block mb-2">{{ name }}</label>
        <input
            :type="type"
            id="name"
            name="name"
            v-model="model"
            class="w-full p-2 border border-gray-400 rounded-xl"
            :class="{ 'border-red-500': message }"
        />
        <p class="text-red-500 pt-2" v-if="message">{{ message }}</p>
    </div>
</template>
