<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import LikedDog from '@/Components/LikedDog.vue';
    import { Head } from '@inertiajs/vue3';
    
    defineProps(['user', 'likes']);
</script>
 
<template>
    <Head :title="user.name" />

    <AuthenticatedLayout>
        <main class="bg-gray-100 bg-opacity-25">

        <div class="lg:w-8/12 lg:mx-auto mb-8">

            <header class="flex flex-wrap items-center p-4 md:py-8">

                <div class="md:w-3/12 md:ml-16">
                    <img src="/profile-user.png" alt="" class="w-20 h-20 md:w-40 md:h-40 object-cover rounded-full p-1">
                </div>

                <div class="w-8/12 md:w-7/12 ml-4">
                    <div class="md:flex md:flex-wrap md:items-center mb-4">
                    <h2 class="text-3xl inline-block font-light md:mr-2 mb-2 sm:mb-0">
                        {{user.name}}
                    </h2>

                    </div>
                    <!-- Medium screens -->
                    <div class="hidden md:block"  v-if="user.description != null">
                    <p>{{user.description}}</p>
                    </div>

                </div>

                <!-- Small Screen -->
                <div class="md:hidden text-sm my-2" v-if="user.description != null">
                    <p>{{user.description}}</p>
                </div>

            </header>

            <div class="px-px md:px-3">
            <ul class="flex items-center justify-around md:justify-center space-x-12  
                            uppercase tracking-widest font-semibold text-xs text-gray-600
                            border-t">
                <li class="md:border-t md:border-gray-700 md:-mt-px md:text-gray-700">
                <a class="inline-block p-3" href="#">
                    <i class="fas fa-th-large text-xl md:text-xs"></i>
                    <span class="hidden md:inline">Favorite Dogs</span>
                </a>
                </li>
            </ul>

            <!-- Favorite Dogs -->
            <div class="flex flex-wrap -mx-px md:-mx-3">
                <LikedDog v-for="like in likes" :like="like"/>
            </div>
            </div>
        </div>
        </main>
    </AuthenticatedLayout>
</template>