<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Modal from '@/Components/Modal.vue';
import { useForm } from 'laravel-precognition-vue-inertia';
import { ref } from "vue";
import InputNumber from 'primevue/inputnumber';
import Textarea from 'primevue/textarea';
import InputText from 'primevue/inputtext';
import Dropdown from 'primevue/dropdown';
import { useToast } from "primevue/usetoast";
import Toast from 'primevue/toast';
import Checkbox from 'primevue/checkbox';


const toast = useToast();

const props = defineProps({
    immobiles: Object,
    user: Object
});

const emit = defineEmits(['update:immobile']);

// lógica da modal editar Anúncios
const immobile = ref();
const editModal = ref(false);
const form = ref({
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

const openEditModal = (immobileData) => {

    immobile.value = immobileData;

    console.log(immobileData);
    editModal.value = true;


    form.value = useForm('put', `/imovel/${immobileData.id}`, {
        title: immobileData.title,
        description: immobileData.description,
        price: immobileData.price,
        street: immobileData.street,
        number: immobileData.number,
        neighborhood: immobileData.neighborhood,
        city: immobileData.city,
        state: immobileData.state,
        photos: immobileData.photos,
        tv: translateData(immobileData.amenitie.tv),
        wifi: translateData(immobileData.amenitie.wifi),
        air_conditioning: translateData(immobileData.amenitie.air_conditioning),
        bathroom: translateData(immobileData.amenitie.bathroom),
        moving: translateData(immobileData.amenitie.moving),
        furnished: translateData(immobileData.amenitie.furnished),
        garage: translateData(immobileData.amenitie.garage),
        ordinance: translateData(immobileData.amenitie.ordinance),
        reservation: translateData(immobileData.amenitie.reservation),
        maintenance:  translateData(immobileData.amenitie.maintenance),
        payment: translateData(immobileData.amenitie.payment),
        couple: translateData(immobileData.amenitie.couple),
        smoker: translateData(immobileData.amenitie.smoker),
        pets: translateData(immobileData.amenitie.pets),
        visits: translateData(immobileData.amenitie.visits),
    });
};

const closeEditModal = () => {
    editModal.value = false;
};

const updateImmobile = () => {
    console.log(form.value);
    form.value.submit({
        preserveScroll: true,
        onSuccess: () => {
            closeEditModal();
            toast.add(
                { severity: 'success', summary: 'Sucesso', detail: 'Imóvel atualizado com sucesso', life: 3000 }
            );
        },
        onError: () => {
            toast.add(
                { severity: 'error', summary: 'Erro', detail: 'Erro ao atualizar imóvel', life: 3000 }
            );
        }
    });
};

// confg da modal deletar Anúncios
const deleteModal = ref(false);
const formDelete = ref();

const openDeleteModal = (id) => {
    console.log(id)
    deleteModal.value = true;
    formDelete.value = useForm('delete', `/delete/${id}`, {
        id: immobile.id
    });
};

const closeDeleteModal = () => {
    deleteModal.value = false;
};

const deleteImmobile = () => {
    formDelete.value.submit({
        preserveScroll: true,
        onSuccess: () => {
            closeDeleteModal();
            toast.add(
                { severity: 'success', summary: 'Sucesso', detail: 'Imóvel deletado com sucesso', life: 3000 }
            );
        },
        onError: () => {
            toast.add(
                { severity: 'error', summary: 'Erro', detail: 'Erro ao deletar imóvel', life: 3000 }
            );
        }
    });
};

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

const translateData = (data) => {
    if (data === 1) {
        return true;
    } else {
        return false;
    }
}

</script>

<template>
    <Toast />
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl leading-tight">
                Seus Anúncios
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-purple-50 overflow-hidden shadow-xl sm:rounded-lg">
                    <div v-for="immobile in immobiles" :key="immobiles.id"
                        class="flex justify-between items-center m-4 p-4 rounded-xl border border-b-4 border-r-4 border-purple-200 bg-purple-100">
                        <h2>Título:{{ immobile.title }} - {{ immobile.id }}</h2>
                        <h2>Preço:{{ immobile.price }}</h2>
                        <h2>Estado:{{ immobile.state }}</h2>
                        <div class="flex flex-row justify-between items-center gap-5">
                            <button @click="openEditModal(immobile)">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor"
                                    class="w-6 h-6 hover:scale-125 ease-in-out hover:stroke-green-500">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>
                            </button>
                            <button @click="openDeleteModal(immobile.id)">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-6 h-6 hover:scale-125 ease-in-out hover:stroke-red-500">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>

    <!-- modal para exclusão de anúncio -->
    <Modal :show="deleteModal" @close="closeDeleteModal">
        <form @submit.prevent="deleteImmobile">
            <h2 class="flex items-center justify-center p-4 m-4 font-bold text-text-color">Tem certeza que deseja
                excluir este anúncio?</h2>
            <button @click="closeDeleteModal" type="button"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-red-500 rounded-lg text-lg w-8 h-8 absolute top-0 right-0 m-2 flex justify-center items-center">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="flex justify-between m-10">
                <button type="button" @click="closeDeleteModal"
                    class="inline-flex items-center px-4 py-2 bg-red-500 border border-gray-300 rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">Cancelar</button>
                <button type="submit"
                    class="inline-flex items-center px-8 py-4 bg-green-500 border border-gray-300 rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">Excluir</button>
            </div>
        </form>
    </Modal>

    <!-- modal para edição de anúncio -->
    <Modal :show="editModal" @close="closeEditModal" class="" max-width="7xl">
        <div class="flex items-start justify-between p-4 border-b rounded-t">
            <h3 class="text-xl font-semibold text-[var(--text-color)] ">
                Editar Anúncio
            </h3>
            <button @click="closeEditModal" type="button"
                class="text-slate-600 bg-transparent hover:bg-slate-300 hover:text-red-500 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
        </div>
        <div class="p-6 bg-purple-50">
            <form @submit.prevent="updateImmobile">
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
                <div class="flex justify-between mt-12">
                    <button @click="closeEditModal" type="button"
                        class="inline-flex items-center px-4 py-2 bg-[var(--red-500)] border border-gray-300 rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm hover:bg-[var(--red-700)] focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                        Cancelar
                    </button>
                    <button type="submit"
                        class="inline-flex items-center px-8 py-4 bg-[var(--green-500)] border border-gray-300 rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm hover:bg-[var(--green-700)] focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                        Salvar
                    </button>
                </div>
            </form>
        </div>
    </Modal>
</template>
