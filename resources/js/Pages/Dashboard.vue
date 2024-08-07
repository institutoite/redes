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
                            Iniciar
                        </a>
                    </div>
                    <div class="md:w-1/2 p-6" data-aos="fade-left">
                        <img src="/storage/imagenes/1.jpeg" alt="Imagen representativa" class="w-full rounded-lg shadow-lg">
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
                            Iniciar
                        </a>
                    </div>
                    <div class="md:w-1/2 p-6" data-aos="fade-right">
                        <img src="/storage/imagenes/2.jpeg" alt="Imagen representativa" class="w-full rounded-lg shadow-lg">
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
                            Iniciar
                        </a>
                    </div>
                    <div class="md:w-1/2 p-6" data-aos="fade-left">
                        <img src="/storage/imagenes/3.jpeg" alt="Imagen representativa" class="w-full rounded-lg shadow-lg">
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
                            Iniciar
                        </a>
                    </div>
                    <div class="md:w-1/2 p-6" data-aos="fade-right">
                        <img src="/storage/imagenes/4.jpeg" alt="Imagen representativa" class="w-full rounded-lg shadow-lg">
                    </div>
                </section>

                <!-- Footer -->
                <footer class="bg-gray-900 py-12">
                    <div class="max-w-7xl mx-auto px-6">
                        <div class="mt-8 text-center">
                            <p class="text-sm">&copy; 2024 ITE. Todos los derechos reservados.</p>
                            <div class="mt-4 flex justify-center space-x-4">
                                <a href="https://www.facebook.com/ite.educabol" class="hover:text-blue-500">Facebook</a>
                                <a href="https://www.tiktok.com/@ite_educabol" class="hover:text-blue-500">tik tok</a>
                                <a href="https://wa.me/59171039910" class="hover:text-blue-500">Whatsapp</a>
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
