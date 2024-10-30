<script>
import { ref, onMounted } from 'vue';

export default {
    name: 'Dashboard',
    setup() {
        const totales = ref({
            pendientes: 0,
            recibidos: 0,
            resueltos: 0,
            en_proceso: 0,
        });

        const obtenerTotales = async () => {
            try {
                const response = await fetch('/api/incidencias/totales'); // Asegúrate de que esta ruta sea correcta
                totales.value = await response.json();
            } catch (error) {
                console.error('Error al obtener totales de incidencias:', error);
            }
        };

        onMounted(obtenerTotales); // Llama a la función al montar el componente

        return {
            totales,
        };
    },
};
</script>

<style scoped>
/* Estilos específicos para el dashboard */
</style>
<template>
    <div>
        <div
            class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">

            <div class="min-h-screen ">
                <div class="max-w-7xl mx-auto p-6">
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Estadísticas de Incidentes</h1>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                        <div
                            class="relative flex flex-col bg-clip-border rounded-xl bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 shadow-md">
                            <div
                                class="bg-clip-border mx-4 rounded-xl overflow-hidden bg-gradient-to-tr from-blue-600 to-blue-400 text-white shadow-lg absolute -mt-4 grid h-16 w-16 place-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    aria-hidden="true" class="w-6 h-6 text-white">
                                    <path fill-rule="evenodd"
                                        d="M12 2a10 10 0 00-9 5.373C4.193 8.275 4 8.747 4 9.5c0 5.992 4.774 10.857 10.779 10.996C15.781 20.996 20 16.655 20 11.5A9.974 9.974 0 0012 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="p-4 text-right">
                                <p
                                    class="block font-sans text-sm leading-normal font-normal text-gray-600 dark:text-gray-400">
                                    INCIDENTES PENDIENTES</p>
                                <h4
                                    class="block font-sans text-2xl font-semibold leading-snug text-gray-900 dark:text-white">
                                    {{ totales.pendiente }}</h4>
                            </div>
                            <div class="border-t border-gray-200 dark:border-gray-700 p-4">
                                <p
                                    class="block font-sans text-base leading-relaxed font-normal text-gray-600 dark:text-gray-400">
                                    <strong class="text-red-500">-5%</strong>&nbsp;desde la semana pasada
                                </p>
                            </div>
                        </div>

                        <div
                            class="relative flex flex-col bg-clip-border rounded-xl bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 shadow-md">
                            <div
                                class="bg-clip-border mx-4 rounded-xl overflow-hidden bg-gradient-to-tr from-yellow-600 to-yellow-400 text-white shadow-lg absolute -mt-4 grid h-16 w-16 place-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    aria-hidden="true" class="w-6 h-6 text-white">
                                    <path fill-rule="evenodd" d="M3 3h18v2H3V3zm0 8h18v2H3v-2zm0 8h18v2H3v-2z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="p-4 text-right">
                                <p
                                    class="block font-sans text-sm leading-normal font-normal text-gray-600 dark:text-gray-400">
                                    INCIDENTES EN PROCESO</p>
                                <h4
                                    class="block font-sans text-2xl font-semibold leading-snug text-gray-900 dark:text-white">
                                    {{ totales.recibido }}</h4>
                            </div>
                            <div class="border-t border-gray-200 dark:border-gray-700 p-4">
                                <p
                                    class="block font-sans text-base leading-relaxed font-normal text-gray-600 dark:text-gray-400">
                                    <strong class="text-red-500">+10%</strong>&nbsp;desde la semana pasada
                                </p>
                            </div>
                        </div>

                        <div
                            class="relative flex flex-col bg-clip-border rounded-xl bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 shadow-md">
                            <div
                                class="bg-clip-border mx-4 rounded-xl overflow-hidden bg-gradient-to-tr from-green-600 to-green-400 text-white shadow-lg absolute -mt-4 grid h-16 w-16 place-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    aria-hidden="true" class="w-6 h-6 text-white">
                                    <path fill-rule="evenodd"
                                        d="M12 2a10 10 0 00-9 5.373C4.193 8.275 4 8.747 4 9.5c0 5.992 4.774 10.857 10.779 10.996C15.781 20.996 20 16.655 20 11.5A9.974 9.974 0 0012 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="p-4 text-right">
                                <p
                                    class="block font-sans text-sm leading-normal font-normal text-gray-600 dark:text-gray-400">
                                    INCIDENTES RESUELTOS</p>
                                <h4
                                    class="block font-sans text-2xl font-semibold leading-snug text-gray-900 dark:text-white">
                                    {{ totales.resuelto }}</h4>
                            </div>
                            <div class="border-t border-gray-200 dark:border-gray-700 p-4">
                                <p
                                    class="block font-sans text-base leading-relaxed font-normal text-gray-600 dark:text-gray-400">
                                    <strong class="text-green-500">+15%</strong>&nbsp;desde el mes pasado
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-12">
                        <h2 class="block font-sans text-xl font-semibold leading-snug text-gray-900 dark:text-white">
                            Estadísticas de Incidentes</h2>
                        <div class="mt-6">
                            <canvas id="incidentChart" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</template>
