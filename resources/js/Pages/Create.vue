<script setup>
import { useForm } from 'laravel-precognition-vue-inertia';
import { ref } from "vue";
import AppLayout from '@/Layouts/AppLayout.vue';
import InputNumber from 'primevue/inputnumber';
import Textarea from 'primevue/textarea';
import InputText from 'primevue/inputtext';
import Dropdown from 'primevue/dropdown';
import { useToast } from "primevue/usetoast";
import Toast from 'primevue/toast';
import Checkbox from 'primevue/checkbox';

const toast = useToast();

const props = defineProps({
    immobile: Object,
});

const form = useForm('post', route('store'), {
    title: '',
    description: '',
    price: 0,
    street: '',
    number: 0,
    neighborhood: '',
    city: '',
    state: '',
    photos: [],
    tv: false,
    wifi: false,
    air_conditioning: false,
    bathroom: false,
    moving: false,
    furnished: false,
    garage: false,
    ordinance: false,
    reservation: false,
    maintenance: false,
    payment: false,
    couple: false,
    smoker: false,
    pets: false,
    visits: false,
});

const createSubmit = () => form.submit({
    preserveScroll: true,
    onSuccess: () => {
        // form.reset()
        form.photoPreviews = []
        toast.add(
            { severity: 'success', summary: 'Sucesso', detail: 'Imóvel cadastrado com sucesso', life: 3000 }
        );
    },
    onError: () => {
        toast.add(
            { severity: 'error', summary: 'Erro', detail: 'Erro ao cadastrar imóvel', life: 3000 }
        );
    }
});

const onPhotoChange = (event) => {
    form.photos = [];
    form.photoPreviews = [];

    for (let i = 0; i < event.target.files.length; i++) {
        const file = event.target.files[i];
        form.photos.push(file);
        const previewUrl = URL.createObjectURL(file);
        form.photoPreviews.push(previewUrl);
    }
};

const states = ref([
    'Acre', 'Alagoas', 'Amapá', 'Amazonas', 'Bahia', 'Ceará', 'Distrito Federal', 'Espírito Santo', 'Goiás',
    'Maranhão', 'Mato Grosso', 'Mato Grosso do Sul', 'Minas Gerais', 'Pará', 'Paraíba', 'Paraná', 'Pernambuco',
    'Piauí', 'Rio de Janeiro', 'Rio Grande do Norte', 'Rio Grande do Sul', 'Rondônia', 'Roraima', 'Santa Catarina', 'São Paulo', 'Sergipe', 'Tocantins'
]);
</script>

<template>
    <Toast />
    <AppLayout>
        <div class="m-7 p-5 rounded-lg  border border-b-4 border-r-4 border-purple-200 bg-purple-50">
            <h2 class="text-lg font-bold m-4">Infomações Pricipais:</h2>
            <form @submit.prevent="createSubmit">
                <div class="grid md:grid-cols-3 gap-4">
                    <div class="mb-4">
                        <label for="title" class="font-bold block mb-2">Título:*</label>
                        <InputText v-model="form.title"
                            class="w-full  border border-b-4 border-r-4 border-purple-200 bg-purple-100" />
                        <div v-if="form.invalid('title')" class="font-semibold text-red-500">
                            {{ form.errors.title }}
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="font-bold block mb-2">Preço:*</label>
                        <InputNumber v-model="form.price" mode="currency" currency="BRL"
                            class="w-full border border-b-4 border-r-4 border-purple-200 bg-purple-100" />
                        <div v-if="form.invalid('price')" class="font-semibold text-red-500">
                            {{ form.errors.price }}
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="street" class="font-bold block mb-2">Rua:</label>
                        <InputText v-model="form.street"
                            class="w-full  border border-b-4 border-r-4 border-purple-200 bg-purple-100" />
                        <div v-if="form.invalid('street')" class="font-semibold text-red-500">
                            {{ form.errors.street }}
                        </div>
                    </div>
                    <div>
                        <label for="number" class="font-bold block mb-2">Número:</label>
                        <InputNumber v-model="form.number"
                            class="w-full border border-b-4 border-r-4 border-purple-200 bg-purple-100" />
                        <div v-if="form.invalid('number')" class="font-semibold text-red-500">
                            {{ form.errors.number }}
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="neighborhood" class="font-bold block mb-2">Bairro:*</label>
                        <InputText v-model="form.neighborhood"
                            class="w-full  border border-b-4 border-r-4 border-purple-200 bg-purple-100" />
                        <div v-if="form.invalid('neighborhood')" class="font-semibold text-red-500">
                            {{ form.errors.neighborhood }}
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="city" class="font-bold block mb-2">Cidade:*</label>
                        <InputText v-model="form.city"
                            class="w-full  border border-b-4 border-r-4 border-purple-200 bg-purple-100" />
                        <div v-if="form.invalid('city')" class="font-semibold text-red-500">
                            {{ form.errors.city }}
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="state" class="font-bold block mb-2">Estado</label>
                        <Dropdown v-model="form.state" :options="states" placeholder="Selecione a Cidade"
                            class="w-full  border border-b-4 border-r-4 border-purple-200 bg-purple-100" />
                        <div v-if="form.invalid('state')" class="font-semibold text-red-500">
                            {{ form.errors.state }}
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="description" class="font-bold block mb-2">Descrição:*</label>
                        <Textarea v-model="form.description" rows="5" cols="30"
                            class="w-full  border border-b-4 border-r-4 border-purple-200 bg-purple-100" />
                        <div v-if="form.invalid('description')" class="font-semibold text-red-500">
                            {{ form.errors.description }}
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="photos" class="font-bold block mb-2">Fotos:</label>
                        <input type="file" @change="onPhotoChange" multiple class="w-full border-gray-300 rounded-lg">
                        <div v-if="form.invalid('photos')" class="font-semibold text-red-500">
                            {{ form.errors.photos }}
                        </div>
                        <!-- Container para pré-visualizações de fotos com Tailwind CSS -->
                        <div class="flex flex-wrap -m-1">
                            <div v-for="(previewUrl, index) in form.photoPreviews" :key="index" class="p-1">
                                <img :src="previewUrl" class="h-24 w-24 object-cover rounded-lg" />
                            </div>
                        </div>
                    </div>

                </div>

                <div class="grid md:grid-cols-2">

                    <div class="grid grid-cols-2 md:grid-cols-3">
                        <h2 class="text-lg font-bold m-4">Comodidades:</h2>
                        <div>
                            <div class="flex align-items-center">
                                <Checkbox v-model="form.tv" inputId="tv" :binary="true" />
                                <label for="tv" class="ml-2">TV</label>
                            </div>
                            <div class="flex align-items-center">
                                <Checkbox v-model="form.wifi" inputId="wifi" :binary="true" />
                                <label for="wifi" class="ml-2">Wifi</label>
                            </div>
                            <div class="flex align-items-center">
                                <Checkbox v-model="form.air_conditioning" inputId="air-conditioning" :binary="true" />
                                <label for="air-conditioning" class="ml-2">Ar Condicionado</label>
                            </div>
                            <div class="flex align-items-center">
                                <Checkbox v-model="form.bathroom" inputId="bathroom" :binary="true" />
                                <label for="bathroom" class="ml-2">Banheiro Privado</label>
                            </div>
                            <div class="flex align-items-center">
                                <Checkbox v-model="form.moving" inputId="moving" :binary="true" />
                                <label for="moving" class="ml-2">Auxilio Mudança</label>
                            </div>
                            <div class="flex align-items-center">
                                <Checkbox v-model="form.furnished" inputId="furnished" :binary="true" />
                                <label for="furnished" class="ml-2">Imóvel Mobiliado</label>
                            </div>
                            <div class="flex align-items-center">
                                <Checkbox v-model="form.ordinance" inputId="ordinance" :binary="true" />
                                <label for="ordinance" class="ml-2">Postaria 24</label>
                            </div>
                            <div class="flex align-items-center">
                                <Checkbox v-model="form.garage" inputId="garage" :binary="true" />
                                <label for="garage" class="ml-2">Garagem</label>
                            </div>
                            <div class="flex align-items-center">
                                <Checkbox v-model="form.reservation" inputId="reservation" :binary="true" />
                                <label for="reservation" class="ml-2">Reserva Segura</label>
                            </div>
                            <div class="flex align-items-center">
                                <Checkbox v-model="form.maintenance" inputId="maintenance" :binary="true" />
                                <label for="maintenance" class="ml-2">Manutenção</label>
                            </div>
                            <div class="flex align-items-center">
                                <Checkbox v-model="form.payment" inputId="payment" :binary="true" />
                                <label for="payment" class="ml-2">Contas Inclusas</label>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold m-4">Regras:</h2>
                        <div>
                            <div class="flex align-items-center">
                                <Checkbox v-model="form.couple" inputId="couple" :binary="true" />
                                <label for="couple" class="ml-2">Casal</label>
                            </div>
                            <div class="flex align-items-center">
                                <Checkbox v-model="form.smoker" inputId="smoker" :binary="true" />
                                <label for="smoker" class="ml-2">Fumante</label>
                            </div>
                            <div class="flex align-items-center">
                                <Checkbox v-model="form.pets" inputId="pets" :binary="true" />
                                <label for="pets" class="ml-2">Animais de Estimção</label>
                            </div>
                            <div class="flex align-items-center">
                                <Checkbox v-model="form.visits" inputId="visits" :binary="true" />
                                <label for="visits" class="ml-2">Visitas</label>
                            </div>
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
<style>
.p-inputnumber input {
    background-color: rgb(243 232 255 / var(--tw-bg-opacity));
    border: none;
    box-shadow: none;
}
</style>