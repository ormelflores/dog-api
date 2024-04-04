<script setup>
import {usePage} from '@inertiajs/vue3';
import axios from 'axios';
import {ref} from 'vue';
import {onMounted} from 'vue';
import swal from 'sweetalert';

const props = defineProps(['dog', 'breed'])

const randomImage = ref('');

const toggleLiked = ref(false);

onMounted(() => {
    loadImage()
})

const loadImage = () => {
    axios.get(route('api.dog.random-image'))
    .then((response) => {
        randomImage.value = response.data.data
    })
    .catch((error) => {
        console.log(error)
    })
}

const like = (name, breed) => {
    axios.post(route('api.dog.like'), {
        dog: {name: name, breed:breed},
    })
    .then((response) => {
        console.log(response);
    })
    .catch((error) => {
        console.log(error.response.data)

        swal({
            icon: 'error',
            title: error.response.data.message,
            text: error.response.data.errors.details,
            className: "p-8",
            buttons: false,
            timer: 1500
        }).then(e => {
            toggleLiked.value = false
        });
    })
}

const unlike = (name, breed) => {
    axios.post(route('api.dog.unlike'), {
        dog: {name: name, breed:breed},
    })
    .then((response) => {
        console.log(response);
    })
    .catch((error) => {
        console.log(error.response.data)
    })
}
const userLikedDogs = usePage().props.auth.user.likes;

// Parse favorite dogs
const likedBreeds = userLikedDogs.map(like => {
  const dogInfo = JSON.parse(like.dog); 
  return dogInfo;
});

// Matching favorite dogs to lists
const matchedDogs = likedBreeds.filter(likedDog => {
  return likedDog.name === props.dog && likedDog.breed == props.breed;
});

toggleLiked.value = matchedDogs.length > 0 ? true : false 

</script>
 
<template>
    <div class="container rounded-lg shadow-lg mb-2 sm:ml-4 lg:w-1/5 md:w-1/2 p-4 w-full bg-white">
        <a class="block relative h-48 rounded overflow-hidden cursor-pointer" >
        <img :alt="dog" class="object-cover object-center w-full h-full block" :src="randomImage!= '' ? randomImage : 'https://dummyimage.com/420x260'">
        </a>
        <div class="mt-4">
            <h3 class="text-gray-500 text-xs tracking-widest title-font mb-1 uppercase">{{breed}}</h3>
            <p class="leading-relaxed text-base uppercase">
                {{dog}}
            </p>

            <button type="button" @click="toggleLiked = !toggleLiked">
                <svg v-if="toggleLiked" @click="unlike(dog, breed)" class="w-6 h-6 text-indigo-500" data-slot="icon" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path d="M1 8.25a1.25 1.25 0 1 1 2.5 0v7.5a1.25 1.25 0 1 1-2.5 0v-7.5ZM11 3V1.7c0-.268.14-.526.395-.607A2 2 0 0 1 14 3c0 .995-.182 1.948-.514 2.826-.204.54.166 1.174.744 1.174h2.52c1.243 0 2.261 1.01 2.146 2.247a23.864 23.864 0 0 1-1.341 5.974C17.153 16.323 16.072 17 14.9 17h-3.192a3 3 0 0 1-1.341-.317l-2.734-1.366A3 3 0 0 0 6.292 15H5V8h.963c.685 0 1.258-.483 1.612-1.068a4.011 4.011 0 0 1 2.166-1.73c.432-.143.853-.386 1.011-.814.16-.432.248-.9.248-1.388Z"></path>
                </svg>
                <svg v-else @click="like(dog, breed)" class="w-6 h-6 text-indigo-500" data-slot="icon"  fill="none"  stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"  aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z"></path>
                </svg>
            </button>
        </div>
    </div>
    
</template>