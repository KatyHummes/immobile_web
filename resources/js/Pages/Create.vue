<script setup>
import { useForm } from 'laravel-precognition-vue-inertia';
import { ref } from "vue";
import AppLayout from '@/Layouts/AppLayout.vue';
import InputNumber from 'primevue/inputnumber';
import Textarea from 'primevue/textarea';
import InputText from 'primevue/inputtext';
import Dropdown from 'primevue/dropdown';


const props = defineProps({
    immobile: Object,
});

const form = useForm('post', route('store'), {
    title: '',
    description: '',
    price: '',
    street: '',
    number: '',
    neighborhood: '',
    city: '',
    state: '',
    photos: []
});

const CreateSubmit = () => form.submit({
    preserveScroll: true,
    onSuccess: () => form.reset(),
});



const states = ref([
    'Acre', 'Alagoas', 'Amapá', 'Amazonas', 'Bahia', 'Ceará', 'Distrito Federal', 'Espírito Santo', 'Goiás',
    'Maranhão', 'Mato Grosso', 'Mato Grosso do Sul', 'Minas Gerais', 'Pará', 'Paraíba', 'Paraná', 'Pernambuco',
    'Piauí', 'Rio de Janeiro', 'Rio Grande do Norte', 'Rondônia', 'Roraima', 'Santa Catarina', 'São Paulo', 'Sergipe', 'Tocantins'
]);


</script>

<template>
    <AppLayout title="Dashboard">
        <div class="m-7 p-5 bg-white rounded-lg">
            <form @submit.prevent="CreateSubmit">
                <div class="grid md:grid-cols-3 gap-4">
                    <div class="mb-4">
                        <label for="title" class="font-bold block mb-2">Título:*</label>
                        <InputText v-model="form.title" class="w-full" />
                        <div v-if="form.invalid('title')" class="font-semibold text-red-500">
                            {{ form.errors.title }}
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="font-bold block mb-2">Preço:*</label>
                        <InputNumber v-model="form.price" mode="currency" showButtons currency="BRL" :min="0" :max="100"
                            class="w-full" />
                        <div v-if="form.invalid('price')" class="font-semibold text-red-500">
                            {{ form.errors.price }}
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="street" class="font-bold block mb-2">Rua:</label>
                        <InputText v-model="form.street" class="w-full" />
                        <div v-if="form.invalid('street')" class="font-semibold text-red-500">
                            {{ form.errors.street }}
                        </div>
                    </div>
                    <div>
                        <label for="number" class="font-bold block mb-2">Número:</label>
                        <InputNumber v-model="form.number" class="w-full" />
                        <div v-if="form.invalid('number')" class="font-semibold text-red-500">
                            {{ form.errors.number }}
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="neighborhood" class="font-bold block mb-2">Bairro:*</label>
                        <InputText v-model="form.neighborhood" class="w-full" />
                        <div v-if="form.invalid('neighborhood')" class="font-semibold text-red-500">
                            {{ form.errors.neighborhood }}
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="city" class="font-bold block mb-2">Cidade:*</label>
                        <InputText v-model="form.city" class="w-full" />
                        <div v-if="form.invalid('city')" class="font-semibold text-red-500">
                            {{ form.errors.city }}
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="state" class="font-bold block mb-2">Estado</label>
                        <Dropdown v-model="form.state" :options="states" placeholder="Selecione a Cidade" class="w-full" />
                        <div v-if="form.invalid('state')" class="font-semibold text-red-500">
                            {{ form.errors.state }}
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="description" class="font-bold block mb-2">Descrição:*</label>
                        <Textarea v-model="form.description" rows="5" cols="30" class="w-full" />
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