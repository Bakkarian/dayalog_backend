<script setup>
import { ref, watch } from 'vue'

import { useForm } from '@inertiajs/vue3';

const status = [
  { id: 'not_started', name: 'Not Started' },
  { id: 'transit', name: 'In Transit' },
  { id: 'reached', name:'Mark As Delivered'},
  { id: 'cancelled', name: 'Cancel' },
]


const props = defineProps({
    trip: {
        type: Object,
        required: true,
    },
})


const form = useForm({
    status: status.find(status => status.id == props.trip.status),
})


const editMode = ref(false);

watch(() => form.status, (newStatus, oldStatus) => {


        form
        .transform((data) => ({
            ...data,
            status: newStatus,
        }))
        .put(route('order.update-trip', props.trip.id),{
            preserveScroll: true,
            onSuccess: () => editMode.value = false,
        })
    
})



</script>


<template>
    <div class="relative mt-2 w-full ">
        <div>

            <label class="block text-sm font-medium text-gray-700 mb-1">
                Status
            </label>

        </div>

        
        <div   class="w-full flex mt-2">
            <div class="w-full grid grid-cols-4 gap-2">
                <button v-for="person in status" :key="person.id" class="relative w-full cursor-pointer rounded-md py-1.5 px-3 text-left text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6"
                    @click="form.status = person.id"
                    :class="{'bg-indigo-600 text-white ': props.trip.status == person.id}"
                >
                    <div class="flex items-center justify-center">
                        <span class="block truncate">{{ person.name }}</span>
                    </div>
                </button>
            </div>
        </div>
    </div>
  </template>

