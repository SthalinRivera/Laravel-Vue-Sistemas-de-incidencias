<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Incidencia from '@/Components/Incidencia.vue';
</script>

<template>
    <AppLayout title="Incidencia">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Incidencias
            </h2>
        </template>

        <div class="py-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <Incidencia />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
