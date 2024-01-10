<script setup>
import { ref } from 'vue'
import { Listbox, ListboxButton, ListboxLabel, ListboxOption, ListboxOptions } from '@headlessui/vue'
import { CheckIcon, ChevronUpDownIcon } from '@heroicons/vue/20/solid'
import { PencilIcon } from '@heroicons/vue/20/solid';
import { useForm } from '@inertiajs/vue3';

const status = [
  { id: 'not_started', name: 'Not Started' },
  { id: 'transit', name: 'In Transit' },
  { id: 'reached', name:'Delivered'},
  { id: 'cancelled', name: 'Canceled' },
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



</script>


<template>
    <div class="relative mt-2 r flex">
        <div v-show="!editMode" class="py-1.5 pl-3  text-left  sm:text-sm sm:leading-6">
            {{ status.find(status => status.id == trip.status ).name }}
        </div>

         <!-- pencil to edit -->
         <span @click="editMode = true"  v-show="!editMode" class="ml-2 cursor-pointer relative py-1.5 px-2 text-left   focus:outline-none  sm:text-sm sm:leading-6" >
            <PencilIcon class="h-5 w-5 text-gray-400" />
        </span>

        <span v-show="editMode" class="flex mt-2">
            <Listbox  as="div" v-model="form.status">
                <div >
                    <ListboxButton class="relative w-full cursor-default rounded-md bg-white py-1.5 pl-3 pr-10 text-left text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    <span class="block truncate">{{ form.status.name }}</span>
                    <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                        <ChevronUpDownIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                    </span>
                    </ListboxButton>

                    <transition leave-active-class="transition ease-in duration-100" leave-from-class="opacity-100" leave-to-class="opacity-0">
                    <ListboxOptions class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                        <ListboxOption as="template" v-for="person in status" :key="person.id" :value="person" v-slot="{ active, selected }">
                        <li :class="[active ? 'bg-indigo-600 text-white' : 'text-gray-900', 'relative cursor-default select-none py-2 pl-8 pr-4']">
                            <span :class="[selected ? 'font-semibold' : 'font-normal', 'block truncate']">{{ person.name }}</span>

                            <span v-if="selected" :class="[active ? 'text-white' : 'text-indigo-600', 'absolute inset-y-0 left-0 flex items-center pl-1.5']">
                            <CheckIcon class="h-5 w-5" aria-hidden="true" />
                            </span>
                        </li>
                        </ListboxOption>
                    </ListboxOptions>
                    </transition>
                </div>
            </Listbox>
        </span>
    </div>
  </template>
