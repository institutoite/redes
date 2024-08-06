<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref } from 'vue';
//

const isAdmin = ref(false); // Ajusta esto según la lógica de tu aplicación
</script>

<template>
    <AppLayout title="Bienvenido a ITE">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Bienvenido a itelinker
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Sección 1 -->
                <section class="flex flex-col md:flex-row items-center bg-gray-100 dark:bg-gray-900 py-12">
                    <div class="md:w-1/2 p-6 text-center md:text-left" data-aos="fade-right">
                        <h2 class="text-3xl font-bold mb-4">Todo lo que eres, en un solo enlace</h2>
                        <p class="text-lg text-gray-200 dark:text-gray-200">
                            ¡Únete a miles de usuarios en ITE para gestionar tu enlace en bio! Con ITE, centraliza y comparte todo lo que creas, seleccionas y vendes desde tus perfiles de Instagram, TikTok, Twitter, YouTube y más. ¡Simplifica tu presencia digital con un solo enlace!
                        </p>
                        <a href="/admin" class="inline-block px-6 py-3 text-white bg-green-500 hover:bg-green-600 rounded-lg">
                            Comienza gratis
                        </a>
                    </div>
                    <div class="md:w-1/2 p-6" data-aos="fade-left">
                        <img src="https://via.placeholder.com/600x400" alt="Imagen representativa" class="w-full rounded-lg shadow-lg">
                    </div>
                </section>

                <!-- Sección 2 -->
                <section class="flex flex-col md:flex-row-reverse items-center py-12">
                    <div class="md:w-1/2 p-6 text-center md:text-right" data-aos="fade-left">
                        <h2 class="text-3xl font-bold mb-4">Crea y personaliza tu iteredes en minutos</h2>
                        <p class="text-lg text-gray-600 mb-4">
                            Conecta tus redes sociales como TikTok, Instagram y Twitter, junto con tu sitio web, tienda, videos, música, podcast, eventos y más. Todo se integra en una página de destino diseñada para maximizar tu impacto.
                        </p>
                        <a href="/admin" class="inline-block px-6 py-3 text-white bg-green-500 hover:bg-green-600 rounded-lg">
                            Comienza gratis
                        </a>
                    </div>
                    <div class="md:w-1/2 p-6" data-aos="fade-right">
                        <img src="https://via.placeholder.com/600x400" alt="Imagen representativa" class="w-full rounded-lg shadow-lg">
                    </div>
                </section>

                <!-- Sección 3 -->
                <section class="flex flex-col md:flex-row items-center bg-gray-100 dark:bg-gray-900 py-12">
                    <div class="md:w-1/2 p-6 text-center md:text-left" data-aos="fade-right">
                        <h2 class="text-3xl font-bold mb-4">Comparte tu ITE desde Instagram, TikTok, Twitter y más</h2>
                        <p class="text-lg text-gray-200 mb-4">
                            Agrega tu URL única de ITE a todas las plataformas y lugares donde encuentres a tu audiencia. Luego usa tu código QR para dirigir tu tráfico offline a online.
                        </p>
                        <a href="/admin" class="inline-block px-6 py-3 text-white bg-green-500 hover:bg-green-600 rounded-lg">
                            Comienza gratis
                        </a>
                    </div>
                    <div class="md:w-1/2 p-6" data-aos="fade-left">
                        <img src="https://via.placeholder.com/600x400" alt="Imagen representativa" class="w-full rounded-lg shadow-lg">
                    </div>
                </section>

                <!-- Sección 4 -->
                <section class="flex flex-col md:flex-row-reverse items-center py-12">
                    <div class="md:w-1/2 p-6 text-center md:text-right" data-aos="fade-left">
                        <h2 class="text-3xl font-bold mb-4">Conoce y Engancha a Tu Audiencia</h2>
                        <p class="text-lg text-gray-600 mb-4">
                            Monitorea la interacción y el rendimiento de tus seguidores, sigue tus ingresos y analiza qué estrategias están funcionando. Actualiza tu contenido en tiempo real para mantener a tu audiencia siempre interesada.
                        </p>
                        <a href="/admin" class="inline-block px-6 py-3 text-white bg-green-500 hover:bg-green-600 rounded-lg">
                            Comienza gratis
                        </a>
                    </div>
                    <div class="md:w-1/2 p-6" data-aos="fade-right">
                        <img src="https://via.placeholder.com/600x400" alt="Imagen representativa" class="w-full rounded-lg shadow-lg">
                    </div>
                </section>

                <!-- Footer -->
                <footer class="bg-gray-900 py-12">
                    <div class="max-w-7xl mx-auto px-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                            <!-- Sección de enlaces -->
                            <div>
                                <h3 class="text-xl font-semibold mb-4">Compañía</h3>
                                <ul>
                                    <li><a href="#" class="hover:underline text-danger">El Blog de ITE</a></li>
                                    <li><a href="#" class="hover:underline text-danger">Blog de Ingeniería</a></li>
                                    <li><a href="#" class="hover:underline text-danger">Marketplace</a></li>
                                    <li><a href="#" class="hover:underline text-danger">Novedades</a></li>
                                    <li><a href="#" class="hover:underline text-danger">Sobre Nosotros</a></li>
                                    <li><a href="#" class="hover:underline text-danger">Prensa</a></li>
                                    <li><a href="#" class="hover:underline text-danger">Carreras</a></li>
                                    <li><a href="#" class="hover:underline text-danger">Enlace en Bio</a></li>
                                    <li><a href="#" class="hover:underline text-danger">Bien Social</a></li>
                                </ul>
                            </div>

                            <!-- Sección de soporte -->
                            <div>
                                <h3 class="text-xl font-semibold mb-4">Soporte</h3>
                                <ul>
                                    <li><a href="#" class="hover:underline text-danger">Temas de Ayuda</a></li>
                                    <li><a href="#" class="hover:underline text-danger">Cómo Empezar</a></li>
                                    <li><a href="#" class="hover:underline text-danger">ITE Pro</a></li>
                                    <li><a href="#" class="hover:underline text-danger">Características y Cómo Usar</a></li>
                                    <li><a href="#" class="hover:underline text-danger">Preguntas Frecuentes</a></li>
                                    <li><a href="#" class="hover:underline text-danger">Reportar una Violación</a></li>
                                </ul>
                            </div>

                            <!-- Sección de confianza y legal -->
                            <div>
                                <h3 class="text-xl font-semibold mb-4">Confianza y Legal</h3>
                                <ul>
                                    <li><a href="#" class="hover:underline text-danger">Términos y Condiciones</a></li>
                                    <li><a href="#" class="hover:underline text-danger">Aviso de Privacidad</a></li>
                                    <li><a href="#" class="hover:underline text-danger">Aviso de Cookies</a></li>
                                    <li><a href="#" class="hover:underline text-danger">Centro de Confianza</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="mt-8 text-center">
                            <p class="text-sm">&copy; 2024 ITE. Todos los derechos reservados.</p>
                            <div class="mt-4 flex justify-center space-x-4">
                                <a href="#" class="hover:text-blue-500">Facebook</a>
                                <a href="#" class="hover:text-blue-500">Twitter</a>
                                <a href="#" class="hover:text-blue-500">Instagram</a>
                                <a href="#" class="hover:text-blue-500">LinkedIn</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>
/* Estilos adicionales según sea necesario */
</style>
