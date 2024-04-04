<script setup>
    defineProps(['user'])
</script>
 
<template>
    <div class="flex flex-col justify-center max-w-xs p-6 shadow-md rounded-xl sm:px-12 ml-2 bg-white mt-2">
        <img src="profile-user.png" alt="" class="">
        <div class="space-y-4 text-center  ">
            <div class="my-2 space-y-1">
                <h2 class="text-xl font-semibold sm:text-2xl text-indigo-500">{{user.name}}</h2>
                <p class="px-5 text-xs sm:text-base "></p>
            </div>
            <div class="flex justify-center pt-2 ">
                <a :href="route('users.show', user.uuid)" class="w-full inline-flex justify-center mb-2 rounded-md border border-indigo-500 shadow-sm px-4 py-2 bg-white text-base font-medium text-indigo-500 hover:text-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 sm:mt-0 sm:text-sm">
                    <i class="fa-solid fa-cart-shopping"></i> &nbsp; View Profile
                </a>
            </div>
        </div>
    </div>
    
</template>