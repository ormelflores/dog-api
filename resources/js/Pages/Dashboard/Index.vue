<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Dog from '@/Components/Dog.vue';
import { useForm, Head } from '@inertiajs/vue3';
import {ref} from 'vue';
import axios from 'axios';
import {onMounted} from 'vue';

const breeds = ref([]);

onMounted(() => {
    loadDogList()
});

const loadDogList = () => {
    axios.get(route('api.dog.lists'))
    .then((response) => {
        breeds.value = response.data.data
    })
    .catch((error) => {
        console.log(error)
    })
}
</script>
 
<template>
    <Head title="Dashboard" />
 
    <AuthenticatedLayout>
        <div class="flex justify-center ml-4  p-4">
            
            <section class="text-gray-600 body-font relative">
                <div class="">
                    <!-- <p class="text-center">Available Dogs</p> -->
                    <div class="flex flex-wrap justify-center">
                        <Dog
                        v-for="(breed, dog) in breeds"
                        :dog="dog"
                        :breed="breed"
                        />
                        <!-- <div class="container rounded-lg shadow-lg mb-2 ml-4 lg:w-1/5 md:w-1/2 p-4 w-full bg-white"  v-for="(dog, breed) in breeds">
                            <a class="block relative h-48 rounded overflow-hidden cursor-pointer" >
                            <img :alt="dog" class="object-cover object-center w-full h-full block" src="https://dummyimage.com/420x260">
                            </a>
                            <div class="mt-4">
                                <h3 class="text-gray-500 text-xs tracking-widest title-font mb-1 uppercase">{{breed}}</h3>
                                <p class="leading-relaxed text-base uppercase">
                                    {{dog}}
                                </p>
                                <button type="button">
                                    <svg class="w-6 h-6 text-indigo-500" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"  aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z"></path>
                                    </svg>
                                </button>
                            </div>
                        </div> -->
                    </div>
                </div>
            </section>
        </div>

    </AuthenticatedLayout>
</template>