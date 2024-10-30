<template>
    <div class="container mx-auto">
        <div class="overflow-x-auto">
            <table
                class="min-w-full border border-gray-300 bg-white shadow-md rounded-lg overflow-hidden dark:bg-gray-800">
                <thead class="bg-gray-100 dark:bg-gray-700 ">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2 text-left text-gray-600 dark:text-gray-300">ID</th>
                        <th class="border border-gray-300 px-4 py-2 text-left text-gray-600 dark:text-gray-300">
                            Descripción</th>
                        <th class="border border-gray-300 px-4 py-2 text-left text-gray-600 dark:text-gray-300">
                            titulo</th>
                        <th class="border border-gray-300 px-4 py-2 text-left text-gray-600 dark:text-gray-300">Imagen
                        </th>
                        <th class="border border-gray-300 px-4 py-2 text-left text-gray-600 dark:text-gray-300">Fecha
                        </th>
                        <th class="border border-gray-300 px-4 py-2 text-left text-gray-600 dark:text-gray-300">Estado
                        </th>
                        <th class="border border-gray-300 px-4 py-2 text-left text-gray-600 dark:text-gray-300">Acciones
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="incidencia in incidencias" :key="incidencia.id"
                        class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <td
                            class="border border-gray-300 px-4 py-2 dark:border-gray-600 text-gray-600 dark:text-gray-300">
                            {{ incidencia.id }}</td>
                        <td
                            class="border border-gray-300 px-4 py-2 dark:border-gray-600 text-gray-600 dark:text-gray-300">
                            {{ incidencia.titulo }}</td>
                        <td
                            class="border border-gray-300 px-4 py-2 dark:border-gray-600 text-gray-600 dark:text-gray-300 ">
                            {{ incidencia.descripcion }}
                        </td>
                        <td class="border border-gray-300 px-4 py-2 dark:border-gray-600">
                            <img :src="incidencia.imagen_url" alt="Imagen de Incidencia"
                                class="h-16 w-16 object-cover rounded-md" />
                        </td>
                        <td
                            class="border border-gray-300 px-4 py-2 dark:border-gray-600 text-gray-600 dark:text-gray-300">
                            {{ incidencia.created_at }}
                        </td>
                        <td
                            class="border border-gray-300 px-4 py-2 dark:border-gray-600 text-gray-600 dark:text-gray-300 ">
                            {{ incidencia.estado }}
                        </td>
                        <td class="border border-gray-300 px-4 py-2 dark:border-gray-600">
                            <button 
        @click="actualizarEstado(incidencia.id, 'recibido')" 
        class="text-blue-500 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-500">
        Seguimiento
    </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</template>

<script>
import { ref, onMounted } from 'vue';


export default {
    name: 'Incidencia',
    setup() {
        const incidencias = ref([]);

        const obtenerIncidencias = async () => {
            try {
                const response = await fetch('/api/incidencias'); // Asegúrate de que esta ruta sea correcta
                incidencias.value = await response.json();
            } catch (error) {
                console.error('Error al obtener incidencias:', error);
            }
        };

        const actualizarEstado = async (id, nuevoEstado) => {
            try {
                const response = await fetch(`/api/incidencias/${id}`, {
                    method: 'PATCH', // Utiliza PATCH para actualizar un campo específico
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ estado: nuevoEstado }),
                });
                if (response.ok) {
                    obtenerIncidencias(); // Refresca la lista después de actualizar
                } else {
                    console.error('Error al actualizar el estado de la incidencia');
                }
            } catch (error) {
                console.error('Error al actualizar la incidencia:', error);
            }
        };

        onMounted(obtenerIncidencias); // Llama a la función al montar el componente

        return {
            incidencias,
            actualizarEstado,
        };
    },
};
</script>

<style scoped>
/* Estilos específicos para la tabla y la página */
</style>