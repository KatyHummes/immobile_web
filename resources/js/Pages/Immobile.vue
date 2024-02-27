<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref, onMounted, onUnmounted, computed } from 'vue';
import { Swiper, SwiperSlide } from 'swiper/vue';
import 'swiper/swiper-bundle.css';
import { useForm } from 'laravel-precognition-vue-inertia';
import { useToast } from "primevue/usetoast";
import Toast from 'primevue/toast';
import Textarea from 'primevue/textarea';
import Button from 'primevue/button';

const props = defineProps({
    immobile: Object
});

//  Swiper Container 
const windowWidth = ref(window.innerWidth);

const slidesPerView = computed(() => {
    return windowWidth.value > 768 ? 5 : 2;
});

function onResize() {
    windowWidth.value = window.innerWidth;
}

onMounted(() => {
    window.addEventListener('resize', onResize);
});
onUnmounted(() => {
    window.removeEventListener('resize', onResize);
});

// Avaliações e Comentários
const toast = useToast();

const form = useForm('post', route('rating', props.immobile.id), {
    comment: '',
    // rating: 0
});

const submitComment = () => form.submit({
    preserveScroll: true,
    onSuccess: () => {
        form.reset()
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

</script>

<template>
    <Toast />
    <AppLayout>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 m-4 p-4">
            <!-- Swiper Container -->
            <div class="col-span-1 lg:col-span-3">
                <Swiper :slides-per-view="slidesPerView" :space-between="10" :pagination="{ clickable: true }"
                    class="swiper-wrapper">
                    <SwiperSlide v-for="photo in immobile.photos" :key="photo.id">
                        <img :src="'../storage/' + photo.photo_path" alt="Imagem do imóvel" class="object-cover rounded-lg">
                    </SwiperSlide>
                </Swiper>
            </div>
            <!-- Immobile Info -->
            <div class="col-span-1 lg:col-span-1 border-slate-100 border-4 bg-white rounded-2xl p-4">
                <h2 class="text-lg font-bold">Infomações Pricipais:</h2>
                <div>
                    <h2 class="text-2xl font-bold">{{ immobile.title }}</h2>
                    <h3 class="text-xl font-semibold text-blue-600">Preço: {{ immobile.price }}</h3>
                </div>
                <div>
                    <h2 class="text-lg font-bold">Endereço:</h2>
                    <p>Rua: {{ immobile.street }}, número: {{ immobile.number }}</p>
                    <p>Bairro: {{ immobile.neighborhood }}, Cidade: {{ immobile.city }}</p>
                    <p>Estado: {{ immobile.state }}</p>
                </div>
            </div>
            <div class="col-span-1 lg:col-span-1 border-slate-100 border-4 bg-white rounded-2xl p-4">
                <h2 class="text-lg font-bold">Descrição:</h2>
                <p>{{ immobile.description }}</p>
            </div>

            <!-- comodidades  -->
            <div class="col-span-1 lg:col-span-1 border-slate-100 border-4 bg-white rounded-2xl p-4">
                <h2 class="text-lg font-bold">Comodidades:</h2>
            </div>
            <!-- comentarios e avaliações -->
            <div class="col-span-1 lg:col-span-3 border-slate-100 border-4 bg-white rounded-2xl p-4">
                <h2 class="text-lg font-bold">Comentários e Avaliações:</h2>
                <form @submit.prevent="submitComment">
                    <div>
                        <Textarea v-model="form.comment" rows="5" cols="120" autoResize />
                        <Button label="Salvar" class="m-4" type="submit" />
                    </div>
                </form>
                <div v-for="evaluation in immobile.evaluations" :key="evaluation.id" class="mt-4">
                    <div class="flex items-center">
                        <!-- <img :src="comment.user.profile_photo_url" alt="Foto do usuário" class="h-10 w-10 rounded-full"> -->
                        <div class="ml-2">
                            <div class="font-semibold">{{ evaluation.user.name }}</div>
                            <div class="text-sm">{{ evaluation.user.email }}</div>
                        </div>
                    </div>

                    <div class="mt-2">
                        <p>{{ evaluation.comment }}</p>
                        <!-- <span class="text-sm">Nota: {{ comment.rating }}</span> -->
                    </div>

                </div>
            </div>
        </div>
    </AppLayout>
</template>