<template>
    <div class="px-4 sm:px-6 lg:px-8 max-w-7xl">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 items-start">

            <div class="col-span-2 mb-12">
                <div class="p-4 bg-white rounded-md">
                    <div class="flex">
                        <div class="flex-auto mr-2">
                            <Combobox as="div" v-model="selectedLocation" @update:modelValue="query = ''">
                                <ComboboxLabel class="block text-sm font-medium leading-6 text-gray-900">Origin</ComboboxLabel>
                                <div class="relative mt-2">
                                <ComboboxInput class="w-full rounded-md border-0 bg-white py-1.5 pl-3 pr-10 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" @change="query = $event.target.value" @blur="query = ''" :display-value="(location) => location?.name" />
                                <ComboboxButton class="absolute inset-y-0 right-0 flex items-center rounded-r-md px-2 focus:outline-none">
                                    <ChevronUpDownIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                                </ComboboxButton>

                                <ComboboxOptions v-if="filteredLocation.length > 0" class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                                    <ComboboxOption v-for="loc in filteredLocation" :key="loc.id" :value="loc" as="template" v-slot="{ active, selected }">
                                    <li :class="['relative cursor-default select-none py-2 pl-8 pr-4', active ? 'bg-indigo-600 text-white' : 'text-gray-900']">
                                        <span :class="['block truncate', selected && 'font-semibold']">
                                        {{ loc.name }}
                                        </span>

                                        <span v-if="selected" :class="['absolute inset-y-0 left-0 flex items-center pl-1.5', active ? 'text-white' : 'text-indigo-600']">
                                        <CheckIcon class="h-5 w-5" aria-hidden="true" />
                                        </span>
                                    </li>
                                    </ComboboxOption>
                                </ComboboxOptions>
                                </div>
                            </Combobox>
                        </div>

                        <div class="flex-auto ml-2">
                            <Combobox as="div" v-model="selectedLocation" @update:modelValue="query = ''">
                                <ComboboxLabel class="block text-sm font-medium leading-6 text-gray-900">Destination</ComboboxLabel>
                                <div class="relative mt-2">
                                <ComboboxInput class="w-full rounded-md border-0 bg-white py-1.5 pl-3 pr-10 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" @change="query = $event.target.value" @blur="query = ''" :display-value="(location) => location?.name" />
                                <ComboboxButton class="absolute inset-y-0 right-0 flex items-center rounded-r-md px-2 focus:outline-none">
                                    <ChevronUpDownIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                                </ComboboxButton>

                                <ComboboxOptions v-if="filteredLocation.length > 0" class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                                    <ComboboxOption v-for="loc in filteredLocation" :key="loc.id" :value="loc" as="template" v-slot="{ active, selected }">
                                    <li :class="['relative cursor-default select-none py-2 pl-8 pr-4', active ? 'bg-indigo-600 text-white' : 'text-gray-900']">
                                        <span :class="['block truncate', selected && 'font-semibold']">
                                        {{ loc.name }}
                                        </span>

                                        <span v-if="selected" :class="['absolute inset-y-0 left-0 flex items-center pl-1.5', active ? 'text-white' : 'text-indigo-600']">
                                        <CheckIcon class="h-5 w-5" aria-hidden="true" />
                                        </span>
                                    </li>
                                    </ComboboxOption>
                                </ComboboxOptions>
                                </div>
                            </Combobox>
                        </div>
                    </div>
                    <div class="flex justify-between mt-2">
                        <div>
                            <label for="weight" class="block text-sm font-medium leading-6 text-gray-900">Weight</label>
                            <div class="mt-2">
                            <input type="number" name="weight" id="weight" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Weight in KGs" />
                            </div>
                        </div>
                        <div>
                            <label for="length" class="block text-sm font-medium leading-6 text-gray-900">Length</label>
                            <div class="mt-2">
                            <input type="number" name="length" id="length" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Length in ft" />
                            </div>
                        </div>
                        <div>
                            <label for="litres" class="block text-sm font-medium leading-6 text-gray-900">Length</label>
                            <div class="mt-2">
                            <input type="number" name="litres" id="litres" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Litres" />
                            </div>
                        </div>
                    </div>
                    <div class="flex mt-4">
                        <button type="button" class=" mr-4 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline">Search Trucks</button>
                        <button type="button" class="rounded-md bg-green-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline">Post Load Package</button>
                    </div>
                </div>
                <hr />
            </div>

            <div class="col-span-2 mb-12 bg-white bg-opacity-50 p-6">
                <h2 class="mb-4">Results</h2>
                <ul role="list" class="row-auto divide-y divide-gray-100 overflow-hidden bg-white shadow-sm ring-1 \
                         ring-gray-900/5 sm:rounded-xl overflow-y-scroll">
                    <li v-for="i in 12" @click="selectedResult = i" class="relative gap-x-6 px-4 py-5 hover:bg-gray-50 sm:px-6 cursor-pointer">
                        <div class="flex justify-between">
                            <div class="flex gap-x-4">
                            <div class="h-12 w-12 flex-none rounded-full bg-gray-200 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6 mx-auto text-green-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902  17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5   18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026  0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                                </svg>
                            </div>
                            <div class="min-w-0 flex-auto">
                                <p class="text-sm font-semibold leading-6 text-gray-900">
                                    <a>
                                        <span class="absolute inset-x-0 -top-px bottom-0" />
                                        UBG 699U
                                    </a>
                                </p>
                                <p class="mt-1 flex text-xs leading-5 text-gray-500">
                                    <a class="relative truncate hover:underline">Isuzu</a>
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-x-4">
                            <div class="hidden sm:flex sm:flex-col sm:items-end">
                                <!-- <p class="mt-1 text-xs leading-5 text-gray-500">
                                    Unavailable
                                </p> -->
                                <div class="mt-1 flex items-center gap-x-1.5">
                                    <div class="flex-none rounded-full bg-emerald-500/20 p-1">
                                        <div class="h-1.5 w-1.5 rounded-full bg-emerald-500" />
                                    </div>
                                    <p class="text-xs leading-5 text-gray-500">Available</p>
                                </div>
                            </div>
                            <ChevronRightIcon class="h-5 w-5 flex-none text-gray-400" aria-hidden="true" />
                        </div>
                        </div>
                        <div v-if="i == selectedResult" class="p-5 bg-gray-50 rounded shadow-md mt-2 animate__animated animate__fadeIn">
                            <div class="flex items-center">
                                <button type="button" class="rounded mr-4 bg-indigo-600 px-2 py-1 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Send Request</button>
                                <div class="flex-auto flex justify-between">
                                    <div>
                                        <h3 class="text-xs text-gray-500">Vehicle Model</h3>
                                        <p class="text-sm">Canter</p>
                                    </div>
                                    <div>
                                        <h3 class="text-xs text-gray-500">Weight Capacity</h3>
                                        <p class="text-sm">1450Kg</p>
                                    </div>
                                    <div>
                                        <h3 class="text-xs text-gray-500">Length</h3>
                                        <p class="text-sm">40ft</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</template>

<script setup>
import Layout from '@/Layouts/MainLayout.vue'
defineOptions({ layout: Layout })


import { computed, ref } from 'vue'
import { CheckIcon, ChevronUpDownIcon } from '@heroicons/vue/20/solid'
import {
  Combobox,
  ComboboxButton,
  ComboboxInput,
  ComboboxLabel,
  ComboboxOption,
  ComboboxOptions,
} from '@headlessui/vue'


const locationPred = [
  { id: 1, name: 'Kampala, Uganda' },
  // More users...
]

const query = ref('')
const selectedLocation = ref(null)
const filteredLocation = computed(() =>
  query.value === ''
    ? locationPred
    : locationPred.filter((location) => {
        return location.name.toLowerCase().includes(query.value.toLowerCase())
      }),
)

let selectedResult = ref(0);
</script>

<style scoped>
</style>