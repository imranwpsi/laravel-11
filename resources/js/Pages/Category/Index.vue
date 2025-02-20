<script setup>
import { Link, useForm } from '@inertiajs/vue3';
import { route } from "ziggy-js";

defineProps({ categories: Array });

const form = useForm({
    name: '',
    slug: '',
    parent_id: ''
});

const submit = () => {
    form.post(route('category.store'));
};
</script>

<template>
    <div>
        <h1 class="text-2xl font-bold">Categories</h1>

        <form @submit.prevent="submit">
            <input v-model="form.name" placeholder="Category Name" required class="border p-2 m-2" />
            <input v-model="form.slug" placeholder="Slug" required class="border p-2 m-2" />
            <select v-model="form.parent_id" class="border p-2 m-2">
                <option :value="null">No Parent</option>
                <option v-for="category in categories" :key="category.id" :value="category.id">
                    {{ category.name }}
                </option>
            </select>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2">Add Category</button>
        </form>

        <ul class="mt-4">
            <li v-for="category in categories" :key="category.id">
                <Link :href="route('category.show', category.id)">{{ category.name }}</Link>
            </li>
        </ul>
    </div>
</template>
