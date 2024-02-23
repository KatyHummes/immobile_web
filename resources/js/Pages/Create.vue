<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import InputNumber from 'primevue/inputnumber';
import Textarea from 'primevue/textarea';
import InputText from 'primevue/inputtext';
import { useForm } from 'laravel-precognition-vue-inertia';


const form = useForm('post', route('store'), {
    title: '',
    description: '',
    price: '',
});

const CreateSubmit = () => form.submit({
    preserveScroll: true,
    onSuccess: () => form.reset(),
});

</script>

<template>
    <AppLayout title="Dashboard">
        <div class="m-4">
            <form @submit.prevent="CreateSubmit">
                <div class="grid md:grid-cols-7 gap-4">
                    <div class="mb-4">
                        <label for="title" class="font-bold block mb-2">Título</label>
                        <InputText v-model="form.title" />
                        <div v-if="form.invalid('title')" class="font-semibold text-red-500">
                            {{ form.errors.title }}
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="font-bold block mb-2">Preço</label>
                        <InputNumber v-model="form.price" mode="currency" showButtons currency="BRL" :min="0" :max="100" />
                        <div v-if="form.invalid('price')" class="font-semibold text-red-500">
                            {{ form.errors.price }}
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="description" class="font-bold block mb-2">Descrição</label>
                        <Textarea v-model="form.description" rows="5" cols="30" />
                        <div v-if="form.invalid('description')" class="font-semibold text-red-500">
                            {{ form.errors.description }}
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                    <button type="submit"
                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Salvar</button>
                </div>
            </form>
        </div>
    </AppLayout>
</template>