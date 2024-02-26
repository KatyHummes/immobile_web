<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3'
import { Swiper, SwiperSlide } from 'swiper/vue';
import 'swiper/swiper-bundle.css';

const props = defineProps({
    immobile: Object,
});
</script>

<template>
    <AppLayout>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 m-4 p-4">
            <!-- Swiper Container -->
            <div class="col-span-2  lg:col-span-1">
                <Swiper :slides-per-view="auto" :space-between="10" :pagination="{ clickable: true }" class="swiper-wrapper">
                    <SwiperSlide v-for="photo in immobile.photos" :key="photo.id">
                        <img :src="'../storage/' + photo.photo_path" alt="Imagem do imóvel"
                            class="object-cover rounded-lg">
                    </SwiperSlide>
                </Swiper>
            </div>

           <!-- Immobile Info -->
            <div class="col-span-1 lg:col-span-1 border-slate-100 border-4 bg-white rounded-2xl p-4">
                <div>
                    <h2 class="text-2xl font-bold">{{ immobile.title }}</h2>
                    <h3 class="text-xl font-semibold text-blue-600">Preço: {{ immobile.price }}</h3>
                </div>
                <div>
                    <h2 class="text-lg font-bold">Descrição:</h2>
                    <p>{{ immobile.description }}</p>
                </div>
                <div>
                    <h2 class="text-lg font-bold">Endereço:</h2>
                    <p>Rua: {{ immobile.street }}, número: {{ immobile.number }}</p>
                    <p>Bairro: {{ immobile.neighborhood }}, Cidade: {{ immobile.city }}</p>
                    <p>Estado: {{ immobile.state }}</p>
                </div>
            </div>

            <!-- comodidades  -->

            <!-- comentarios e avaliações -->
        </div>
    </AppLayout>
</template>