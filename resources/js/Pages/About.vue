<script setup>

const props = defineProps({
    title: String,
    content: String,
});

</script>

<template>
    <Head title = "About |"/>
    <div class="border-2 border-dashed border-red-500">
        <h1>{{ props.title }}</h1>
        <p>{{ props.content }}</p>
    </div>
</template>