<script setup>
import { Head, Link } from '@inertiajs/vue3';
import GuestMicrositesLayout from '@/Layouts/GuestMicrositesLayout.vue';

const props = defineProps({
    microsites: {
        type: Array,
        required: true,
    },
});

</script>

<template>
    <Head title="Micrositios" />
    <GuestMicrositesLayout>
        <div class="container mx-auto py-8">
            <h1 class="text-2xl font-bold mb-4">Micrositios</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div
                    v-for="microsite in props.microsites"
                    :key="microsite.id"
                    class="p-6 bg-white rounded-lg shadow-md dark:bg-gray-800"
                >
                    <img
                        :src="microsite.logo"
                        alt="Logo de Micrositio"
                        class="w-24 h-24 object-cover mx-auto mb-4 rounded-full shadow-lg"
                    />
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">{{ microsite.name }}</h2>
                    <p class="text-gray-600 dark:text-gray-400">Slug: {{ microsite.slug }}</p>
                    <p class="text-gray-600 dark:text-gray-400">Categoría: {{ microsite.category.name }}</p>
                    <p class="text-gray-600 dark:text-gray-400">Tipo de sitio: {{ microsite.site_type }}</p>
                    <Link
                        :href="`/microsite/pay/${microsite.slug}_${microsite.id}`"
                        class="mt-4 inline-block bg-[#FF2D20] text-white px-4 py-2 rounded hover:bg-[#E6221A] transition"
                    >
                        Seleccionar Micrositio
                    </Link>
                </div>
            </div>
        </div>
    </GuestMicrositesLayout>
</template>
