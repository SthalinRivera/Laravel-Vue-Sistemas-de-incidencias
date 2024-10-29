<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { useToast } from "vue-toastification";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

const toast = useToast();

function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
    document.getElementById('background')?.classList.add('!hidden');
}
</script>

<template>
    <Head title="Welcome" />
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50 min-h-screen flex items-center justify-center">
        <div class="relative max-w-6xl p-6 shadow-lg rounded-lg bg-white dark:bg-zinc-900 transition-colors duration-300 grid grid-cols-1 lg:grid-cols-2 gap-6">
            <header class="text-center lg:text-left mb-2 lg:col-span-2">
                <nav v-if="canLogin" class="flex justify-center lg:justify-between">
                    <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200">EPIS-FI-UNDC</h1>
                    <div>
                        <Link v-if="$page.props.auth.user" :href="route('dashboard')"
                            class="rounded-md px-4 py-2 text-sm font-semibold text-gray-700 dark:text-gray-300 transition hover:bg-gray-100 dark:hover:bg-gray-800">
                            Dashboard
                        </Link>
                        <template v-else>
                            <Link :href="route('login')"
                                class="rounded-md px-4 py-2 text-sm font-semibold text-gray-700 dark:text-gray-300 transition hover:bg-gray-100 dark:hover:bg-gray-800">
                                Log in
                            </Link>
                            <Link v-if="canRegister" :href="route('register')"
                                class="rounded-md px-4 py-2 text-sm font-semibold text-gray-700 dark:text-gray-300 transition hover:bg-gray-100 hidden dark:hover:bg-gray-800">
                                Register
                            </Link>
                        </template>
                    </div>
                </nav>
            </header>

            <main class="lg:col-span-1">
                <div class="bg-white p-8 rounded-lg shadow-md ring-1 ring-gray-100 dark:bg-zinc-900 dark:ring-zinc-800">
                    <h2 class="text-2xl font-semibold mb-2 text-gray-700 dark:text-gray-200 text-center">Registrar
                        Incidencia</h2>
                    <form @submit.prevent="submitForm" enctype="multipart/form-data" class="space-y-2">

                        <!-- Campo de DNI -->
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">DNI</label>
                            <input type="text" v-model="dni"
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required />
                        </div>

                        <!-- Campo de Título -->
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Título</label>
                            <input type="text" v-model="titulo"
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required />
                        </div>

                        <!-- Campo de Descripción -->
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Descripción</label>
                            <textarea v-model="descripcion"
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Describa la incidencia que tiene..."
                                rows="4" required></textarea>
                        </div>

                        <!-- Campo de Archivo JPG -->
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Archivo
                                (JPG)</label>
                            <input type="file" @change="handleFileUpload" accept="image/jpeg"
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        </div>

                        <!-- Selector de Laboratorio -->
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Laboratorio</label>
                            <select v-model="laboratorio"
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required>
                                <option value="lab1">Lab1</option>
                                <option value="lab2">Lab2</option>
                                <option value="lab3">Lab3</option>
                                <option value="lab4">Lab4</option>
                                <option value="lab5">Lab5</option>
                                <option value="lab6">Lab6</option>
                                <option value="lab7">Lab7</option>
                                <option value="lab8">Lab8</option>
                                <option value="Aula1">Aula1</option>
                                <option value="Aula2">Aula2</option>
                                <option value="Aula3">Aula3</option>
                                <option value="Aula4">Aula4</option>
                                <option value="Aula5">Aula5</option>
                                <option value="Aula6">Aula6</option>
                            </select>
                        </div>

                        <!-- Botón de Enviar -->
                        <button type="submit"
                            class="w-full py-3 px-4 bg-blue-500 text-white font-bold rounded-md transition hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Guardar
                        </button>
                    </form>
                </div>
            </main>

            <!-- Imagen a la derecha -->
            <aside class="lg:col-span-1 flex items-center justify-center">
                <img
                    src="/fondo_incidencia.jpg"
                    alt="Imagen representativa"
                    class="w-full h-full object-cover transition-transform duration-300 transform group-hover:scale-110 rounded-lg" />
            </aside>

            <footer class="py-2 text-center text-xs text-gray-500 dark:text-gray-400 mt-2 lg:col-span-2">
                EPIS-FI-UNDC
            </footer>
        </div>
    </div>
</template>

<script>
export default {
    
    data() {
        return {
            dni: '',
            titulo: '',
            descripcion: '',
            archivo: null,
            laboratorio: 'lab1',
            estado: 'pendiente'
        };
    },
    methods: {
        handleFileUpload(event) {
            this.archivo = event.target.files[0];
        },
        async submitForm() {
            const formData = new FormData();
            formData.append('dni', this.dni);
            formData.append('titulo', this.titulo);
            formData.append('descripcion', this.descripcion);
            formData.append('laboratorio', this.laboratorio);
            formData.append('estado', this.estado);
            if (this.archivo) {
                formData.append('archivo', this.archivo);
            }

            try {
                await axios.post('/api/incidencias', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    },
                });
                // Muestra el toast de éxito
                toast.success('Incidencia registrada con éxito.');

                // Limpiar campos
                this.dni = '';
                this.titulo = '';
                this.descripcion = '';
                this.archivo = null;
                this.laboratorio = 'lab1';
            } catch (error) {
                toast.error('Error al registrar la incidencia. Intenta nuevamente.');
            }
        },
    },
};
</script>

<style scoped>
/* Aquí puedes añadir estilos adicionales */
</style>
