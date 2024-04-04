<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import User from '@/Components/User.vue';
    import { Head } from '@inertiajs/vue3';
    
    defineProps(['users']);
</script>
 
<template>
    <Head title="Users" />
 
    <AuthenticatedLayout>
        <div class="flex flex-wrap justify-center ml-4  p-4">
            <User v-for="user in users" :user="user"/>
        </div>
    </AuthenticatedLayout>
</template>