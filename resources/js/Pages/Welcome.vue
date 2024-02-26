<script setup>
import { Head, Link } from '@inertiajs/vue3'
import { ref } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue'
import { Swiper, SwiperSlide } from 'swiper/vue';
import 'swiper/swiper-bundle.css';


defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    immobiles: Array
});
</script>

<template>
    <AppLayout>

        <Head title="Welcome" />

        <div v-if="canLogin" class="sm:fixed sm:top-0 sm:end-0 p-6 text-end z-10">
            <Link v-if="$page.props.auth.user" :href="route('dashboard')"
                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm">
            Dashboard</Link>

            <template v-else>
                <Link :href="route('login')"
                    class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm">
                Log in</Link>

                <Link v-if="canRegister" :href="route('register')"
                    class="ms-4 font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm">
                Register</Link>
            </template>
        </div>
        <div>
            <div class="mx-auto p-6 lg:p-8">
                <div class="text-center bg-white p-4 m-10 rounded-lg">
                    <h1 class="font-bold text-4xl">Apartamentos para aluguel ou venda</h1>
                    <p class="font-bold text-2xl">para você e sua Família</p>
                </div>
            </div>
            <div class="mx-4 grid md:grid-cols-4 lg:grid-cols-5 gap-4">
                <div v-for="immobile in immobiles" :key="immobile.id"
                    class="mb-4 rounded-2xl border-slate-100 border-4 bg-white">
                    <Link :href="route('immobile.show', immobile.id)">
                    <div class="m-4">
                        <div class="flex justify-between items-center">
                            <h2 class="text-2xl font-bold">{{ immobile.title }}</h2>
                            <p>Preço: {{ immobile.price }}</p>
                        </div>
                        <Swiper :slides-per-view="1" :space-between="50" :pagination="{ clickable: true }"
                            :scrollbar="{ draggable: true }" v-slot:container-start class="my-4 swiper-wrapper">
                            <SwiperSlide v-for="photo in immobile.photos" :key="photo.id">
                                <img :src="'../storage/' + photo.photo_path" alt="Imagem do imóvel"
                                    class="w-full h-64 object-cover rounded-lg">
                            </SwiperSlide>
                        </Swiper>
                    </div>
                    </Link>
                </div>
            </div>

        </div>



    </AppLayout>
</template>

