<template>
        <TransitionRoot as="template" :show="show">
        <Dialog as="div" class="relative z-10" @close="closeModal">
            <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
            </TransitionChild>

            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                        <DialogPanel class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-sm sm:p-6">
                            <div>
                                <div class="flex justify-between">
                                    <h2 class="font-bold">{{ selectedVehicle.number_plate }}</h2>
                                    <div class="mt-1 flex items-center gap-x-1.5">
                                        <div class="flex-none rounded-full p-1" :class="selectedVehicle.device?'bg-emerald-500/20':'bg-orange-500/20'">
                                            <div class="h-1.5 w-1.5 rounded-full" :class="selectedVehicle.device?'bg-emerald-500':'bg-orange-500'"/>
                                        </div>
                                        <p class="text-xs leading-5 text-gray-500">{{ selectedVehicle.device?'Attached':'Not Attached' }} to driver</p>
                                    </div>
                                </div>
                                <p>{{ selectedVehicle.model }}</p>
                                <p class="text-xs">{{ selectedVehicle.make }}</p>
                                <hr class="my-4" />
                                <Combobox as="div" v-model="selectedDriver">
                                    <ComboboxLabel class="block text-sm font-medium leading-6 text-gray-900">Assigned to <span class="text-gray-500 italic">(Search Below)</span></ComboboxLabel>
                                    <div class="relative mt-2">
                                        <ComboboxInput class="w-full rounded-md border-0 bg-white py-1.5 pl-3 pr-12 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" @change="query = $event.target.value" :display-value="(person) => person?.name" />
                                        <ComboboxButton class="absolute inset-y-0 right-0 flex items-center rounded-r-md px-2 focus:outline-none">
                                            <ChevronUpDownIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                                        </ComboboxButton>

                                        <ComboboxOptions v-if="filteredDrivers.length > 0" class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                                            <ComboboxOption v-for="driver in filteredDrivers" :key="driver.id" :value="driver" as="template" v-slot="{ active, selected }">
                                                <li :class="['relative cursor-default select-none py-2 pl-3 pr-9', active ? 'bg-indigo-600 text-white' : 'text-gray-900']">
                                                    <div class="flex items-center">
                                                        <span :class="['inline-block h-2 w-2 flex-shrink-0 rounded-full', driver.valid ? 'bg-green-400' : 'bg-gray-200']" aria-hidden="true" />
                                                        <span :class="['ml-3 truncate', selected && 'font-semibold']">
                                                        {{ driver.name }}
                                                        <span class="sr-only"> is {{ driver.valid ? 'online' : 'offline' }}</span>
                                                      </span>
                                                    </div>

                                                    <span v-if="selected" :class="['absolute inset-y-0 right-0 flex items-center pr-4', active ? 'text-white' : 'text-indigo-600']">
                                                      <CheckIcon class="h-5 w-5" aria-hidden="true" />
                                                    </span>
                                                </li>
                                            </ComboboxOption>
                                        </ComboboxOptions>
                                    </div>
                                </Combobox>
                            </div>
                            <div class="mt-5 sm:mt-6">
                                <button type="button" class="inline-flex w-full justify-center rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-0 focus-visible:outline-offset-0" @click="closeModal">Link Driver</button>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script setup>

import { CheckIcon, ChevronUpDownIcon } from '@heroicons/vue/20/solid'
  import {
      Combobox,
      ComboboxButton,
      ComboboxInput,
      ComboboxLabel,
      ComboboxOption,
      ComboboxOptions,
  } from '@headlessui/vue'
import { Dialog, DialogPanel, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { ref } from 'vue';
import { computed } from 'vue';

  const props = defineProps([
    'selectedVehicle',
    'show',
    'closeLinkModal'
    ])

  const closeModal = () => {
    props.closeLinkModal();
  }
  const drivers = [
      { id: 0, name: 'Alex Driver', valid: false },
      { id: 1, name: 'Ivan Driver', valid: true },
      { id: 2, name: 'Gearge Driver', valid: true },
  ]

  const query = ref('')
  const selectedDriver = ref(null)
  const filteredDrivers = computed(() =>
      query.value === ''
          ? drivers
          : drivers.filter((driver) => {
              return driver.name.toLowerCase().includes(query.value.toLowerCase())
          })
  )

</script>
