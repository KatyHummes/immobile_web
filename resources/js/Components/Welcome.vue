<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';

</script>

<template>
    <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
        <ApplicationLogo class="block h-12 w-auto" />

        aqui vai ser para visualizar o imovel selecionado na home
    </div>

    <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
        <div class="bg-white p-4 grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-4 rounded-xl">

        </div>
    </div>
</template>
