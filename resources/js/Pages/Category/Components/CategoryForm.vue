<script setup>
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    slug: ''
});

const submit = () => {
    form.post(route('category.store'));
};
</script>

<template>
    <form @submit.prevent="submit">
        <input v-model="form.name" placeholder="Category Name" required class="border p-2" />
        <input v-model="form.slug" placeholder="Slug" required class="border p-2" />
        <button type="submit" class="bg-blue-500 text-white px-4 py-2">Add Category</button>
    </form>
</template>
