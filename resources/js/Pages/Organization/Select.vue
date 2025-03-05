<script setup>
import { Head, Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';


const organizations = computed(() =>  usePage().props.auth.organizations)

</script>
<template>
       <Head title="Select Organization" />

       <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
           <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
               <div class="p-6 bg-white border-b border-gray-200">
                   <h2 class="text-2xl">Select Organization</h2>
                   <p class="mt-4">Please select an organization to continue</p>
                   <div class="mt-4">
                       <ul>
                           <li v-for="org in organizations" :key="org.id">
                             <Link :href="route('org.store.selection', org.id )" method="post" as="button">{{ org.name }}</Link>
                           </li>
                           <li>
                               <Link
                                   class="text-blue-500 hover:text-blue-700 underline"
                                   :href="route('org.create')"
                               >
                                   Add a new organization
                               </Link>
                           </li>
                       </ul>
                   </div>
               </div>
           </div>
       </div>
       
</template>