<script setup>
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'

const form = reactive({
    title: '',
    description: '',
    price: '',
})

function submit() {
    router.post('/store', form)
        .then(() => {
            form.title = ''
            form.description = ''
            form.price = ''
        })
        .catch(() => {
            console.log('error')
        })
}
</script>

<template>
    <div>
        <form @submit.prevent="submit">
            <div class="mb-4">
                <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title</label>
                <input v-model="form.title" type="text" id="title" name="title" class="form-input">
            </div>
            <div class="mb-4">
                <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                <input v-model="form.description" type="text" id="description" name="description" class="form-input">
            </div>
            <div class="mb-4">
                <label for="price" class="block text-gray-700 text-sm font-bold mb-2">Price</label>
                <input v-model="form.price" type="text" id="price" name="price" class="form-input">
            </div>
            <div class="mb-4">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>
            </div>
        </form>
    </div>
</template>