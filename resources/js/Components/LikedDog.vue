<script setup>
    import axios from 'axios';
    import {ref} from 'vue';
    import {onMounted} from 'vue';

    const props = defineProps(['like'])

    const randomImage = ref('');

    onMounted(() => {
        loadImage()
    })

    // Fetch random image
    const loadImage = () => {
        axios.get(route('api.dog.random-image'))
        .then((response) => {
            randomImage.value = response.data.data
        })
        .catch((error) => {
            console.log(error)
        })
    }
</script>
 
<template>

    <div class="w-1/3 p-px md:px-3">
        <a href="#">
            <article class="post bg-gray-100 text-white relative pb-full md:mb-6">
                <img class="w-full h-full absolute left-0 top-0 object-cover" :src="randomImage!= '' ? randomImage : 'https://dummyimage.com/420x260'" alt="image">
            </article>
        </a>
        <h3 class="text-gray-500 text-xs tracking-widest title-font mb-1 uppercase">{{JSON.parse(like.dog)['name']}}</h3>
        <p class="leading-relaxed text-base uppercase">
            {{JSON.parse(like.dog)['breed']}}
        </p>
    </div>
    
</template>