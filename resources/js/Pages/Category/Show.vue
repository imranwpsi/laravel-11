<script setup>
import { defineProps } from 'vue';
import { useForm } from '@inertiajs/vue3';
import { route } from "ziggy-js";

const props = defineProps({ category: Object });

const form = useForm({
    name: props.category.name,
    slug: props.category.slug,
    parent_id: props.category.parent_id
});

const update = () => {
    form.put(route('category.update', props.category.id));
};

const destroy = () => {
    if (confirm('Are you sure?')) {
        form.delete(route('category.destroy', props.category.id));
    }
};
</script>

<template>
    <div>
        <h1 class="text-2xl font-bold">Edit Category</h1>

        <form @submit.prevent="update">
            <input v-model="form.name" class="border p-2 m-2" required />
            <input v-model="form.slug" class="border p-2 m-2" required />
            <button type="submit" class="bg-green-500 text-white px-4 py-2">Update</button>
        </form>

        <button @click="destroy" class="bg-red-500 text-white px-4 py-2 mt-4">Delete</button>
    </div>
</template>
