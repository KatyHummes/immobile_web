<script setup>
import { Head, Link } from '@inertiajs/vue3'
import { ref } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue'


const value = ref(null);
defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    immobiles: Array
});
</script>

<template>
    <AppLayout>
    <Head title="Welcome" />

    <div
        class=" sm:flex sm:justify-center sm:items-center  bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter">
        <div v-if="canLogin" class="sm:fixed sm:top-0 sm:end-0 p-6 text-end z-10">
            <Link v-if="$page.props.auth.user" :href="route('dashboard')"
                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
            Dashboard</Link>

            <template v-else>
                <Link :href="route('login')"
                    class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                Log in</Link>

                <Link v-if="canRegister" :href="route('register')"
                    class="ms-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                Register</Link>
            </template>
        </div>
        <div>
            <div class="max-w-7xl mx-auto p-6 lg:p-8">
                <div class="text-center bg-white p-4 m-10 rounded-lg">
                    <h1 class="font-bold text-4xl">Apartamentos para aluguel ou venda</h1>
                    <p class="font-bold text-2xl">para você e sua Família</p>
                </div>
            </div>

            <div class="grid md:grid-cols-4 ">
                <div v-for="immobile in immobiles" :key="immobile.id"
                    class="mb-4 rounded-2xl border-slate-100 border-4 bg-white">
                    <div>
                        <img :src="immobile.image || 'caminho_para_imagem_padrao.jpg'" alt="Imagem do imóvel"
                            class="w-full h-64 object-cover rounded-lg">
                        <h2 class="font-bold text-xl">{{ immobile.title }}</h2>
                        <p>Preço: {{ immobile.price }}</p>
                        <p>{{ immobile.description }}</p>

                    </div>
                </div>
            </div>

        </div>


    </div>
</AppLayout>
</template>

