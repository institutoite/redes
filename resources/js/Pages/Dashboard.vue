<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
</script>

<template>
    <AppLayout title="IFE Educabol">
        <template #header>
            <h2 class="font-semibold text-xl text-[#375F7A] dark:text-white leading-tight">
                Panel de IFE Educabol
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <section class="overflow-hidden rounded-3xl bg-white dark:bg-gray-800 shadow-sm">
                    <div class="grid gap-8 p-8 md:grid-cols-2 md:p-12 items-center">
                        <div>
                            <p class="font-semibold uppercase tracking-widest text-sm text-[#26BAA5]">Formación que transforma</p>
                            <h1 class="mt-3 text-4xl font-bold text-[#375F7A] dark:text-white">Bienvenido a IFE Educabol</h1>
                            <p class="mt-5 text-gray-600 dark:text-gray-300">
                                Gestiona los programas, modalidades y contenidos educativos desde un solo lugar.
                            </p>
                            <a href="/admin" class="mt-7 inline-flex rounded-xl bg-[#26BAA5] px-6 py-3 font-semibold text-white hover:bg-[#375F7A]">
                                Ir a administración
                            </a>
                        </div>
                        <div class="rounded-2xl bg-gray-50 p-8 dark:bg-gray-900">
                            <img src="/images/logo-ife-educabol-ofical-instituto-de-formacion-educabol.png" alt="IFE Educabol" class="w-full max-h-64 object-contain">
                        </div>
                    </div>
                </section>

                <footer class="py-10 text-center text-sm text-gray-500 dark:text-gray-400">
                    <p>&copy; {{ new Date().getFullYear() }} IFE Educabol. Todos los derechos reservados.</p>
                    <div class="mt-4 flex flex-wrap justify-center gap-5">
                        <a href="https://www.facebook.com/ife.educabol" target="_blank" rel="noopener noreferrer" class="hover:text-[#26BAA5]">Facebook</a>
                        <a href="https://www.tiktok.com/@ife_educabol" target="_blank" rel="noopener noreferrer" class="hover:text-[#26BAA5]">TikTok</a>
                        <a href="https://www.youtube.com/@ife_educabol" target="_blank" rel="noopener noreferrer" class="hover:text-[#26BAA5]">YouTube</a>
                        <a href="https://www.instagram.com/ife_educabol" target="_blank" rel="noopener noreferrer" class="hover:text-[#26BAA5]">Instagram</a>
                    </div>
                </footer>
            </div>
        </div>
    </AppLayout>
</template>
