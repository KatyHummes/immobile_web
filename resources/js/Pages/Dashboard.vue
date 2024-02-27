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

const toast = useToast();

const props = defineProps({
    immobile: Object,
    user: Object
});

// lógica da modal editar Anúncios
const editModal = ref(false);
const formUpdate = ref();

const openEditModal = (immobileData) => {
    immobile.value = immobileData;
    editModal.value = true;
    console.log(immobileData);

    formUpdate.value = useForm('put', `/imovel/${immobileData.id}`, {
        title: immobileData.title,
        description: immobileData.description,
        price: immobileData.price,
        street: immobileData.street,
        number: immobileData.number,
        neighborhood: immobileData.neighborhood,
        city: immobileData.city,
        state: immobileData.state,
        photos: immobileData.photos
    });
};

const closeEditModal = () => {
    editModal.value = false;
};

const updateimmobile = () => {
    formUpdate.value.submit({
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
    deleteModal.value = true;
    formDelete = useForm('delete', `/delete/${immobile.value.id}`, {
        id: immobile.value.id
    });
};

const closeDeleteModal = () => {
    deleteModal.value = false;
};

const deleteimmobile = () => {
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
</script>

<template>
    <Toast />
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl leading-tight">
                Gerenciar Anúncios
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div v-for="immobiles in immobile" :key="immobiles.id"
                        class="flex justify-center items-center p-4 bg-purple-300">
                        <h2>{{ immobile.title }}</h2>
                        <h2>{{ immobile.price }}</h2>
                    </div>

                    <div class="flex justify-center items-center gap-4">
                        <button @click="openEditModal()">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6 hover:scale-125 ease-in-out hover:stroke-green-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </svg>
                        </button>
                        <button @click="openDeleteModal()">
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
    </AppLayout>

    <!-- modal para exclusão de anúncio -->
    <Modal :show="deleteModal" @close="closeDeleteModal">
        <form @submit.prevent="deleteimmobile">
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
    <Modal :show="editModal" @close="closeEditModal" :max-width="'4xl'">
        <div class="flex items-start justify-between p-4 border-b rounded-t">
            <h3 class="text-xl font-semibold text-[var(--text-color)] ">
                Editar Anúncio
            </h3>
            <button @click="closeEditModal" type="button"
                class="text-slate-100 bg-transparent hover:bg-[var(--surface-0)] hover:text-[var(--red-500)] rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
        </div>
        <div class="p-6 bg-slate-200">
            <form @submit.prevent="updateimmobile">
                <div class="grid md:grid-cols-2 gap-4">
                    <div class="mb-4">
                        <label for="title" class="font-bold block mb-2">Título:*</label>
                        <InputText v-model="form.title" class="w-full" />
                        <div v-if="form.invalid('title')" class="font-semibold text-red-500">
                            {{ form.errors.title }}
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="font-bold block mb-2">Preço:*</label>
                        <InputNumber v-model="form.price" mode="currency" showButtons currency="BRL" class="w-full" />
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
