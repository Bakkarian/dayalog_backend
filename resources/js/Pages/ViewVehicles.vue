<template>
    <div class="px-4 py-10 sm:px-6 lg:px-8 lg:py-6">
        <!-- Main area -->
        <h1 class="text-xl mb-8">Vehicles</h1>
        <div class="grid lg:grid-cols-3 gap-8">
            <div class="col-span-1 row-end-2">
                <div class="mb-5">
                    <label for="email" class="sr-only">Search</label>
                    <input type="text" name="search" id="search" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Search vehicles" />
                </div>

                <ul role="list" class="row-auto divide-y divide-gray-100 overflow-hidden bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl overflow-y-scroll">
                    <li v-for="vehicle in vehicles" :key="vehicle.make" @click="selectedVehicle = vehicle" class="relative flex justify-between gap-x-6 px-4 py-5 hover:bg-gray-50 sm:px-6 cursor-pointer">
                        <div class="flex gap-x-4">
                            <div class="h-12 w-12 flex-none rounded-full bg-gray-200 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" :class="vehicle.deviceAttached?'text-green-500':'text-red-500'" class="w-6 h-6 mx-auto">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                                </svg>
                            </div>
                            <div class="min-w-0 flex-auto">
                                <p class="text-sm font-semibold leading-6 text-gray-900">
                                    <a>
                                        <span class="absolute inset-x-0 -top-px bottom-0" />
                                        {{ vehicle.name }}
                                    </a>
                                </p>
                                <p class="mt-1 flex text-xs leading-5 text-gray-500">
                                    <a class="relative truncate hover:underline">{{
                                            vehicle.make
                                        }}</a>
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-x-4">
                            <div class="hidden sm:flex sm:flex-col sm:items-end">
                                <p v-if="!vehicle.deviceAttached" class="mt-1 text-xs leading-5 text-gray-500">
                                    Not Attached
                                </p>
                                <div v-else class="mt-1 flex items-center gap-x-1.5">
                                    <div class="flex-none rounded-full bg-emerald-500/20 p-1">
                                        <div class="h-1.5 w-1.5 rounded-full bg-emerald-500" />
                                    </div>
                                    <p class="text-xs leading-5 text-gray-500">Attached</p>
                                </div>
                            </div>
                            <ChevronRightIcon class="h-5 w-5 flex-none text-gray-400" aria-hidden="true" />
                        </div>
                    </li>
                </ul>
            </div>
            <div  v-if="selectedVehicle" class="col-span-1 border-l pl-8">
                <div class="lg:fixed w-full max-w-[440px]">
                    <div class="bg-white p-6 rounded-md">
                        <div class="flex justify-between">
                            <h2 class="font-bold">{{ selectedVehicle["name"] }}</h2>
                            <div class="mt-1 flex items-center gap-x-1.5">
                                <div class="flex-none rounded-full p-1" :class="selectedVehicle['deviceAttached']?'bg-emerald-500/20':'bg-orange-500/20'">
                                    <div class="h-1.5 w-1.5 rounded-full" :class="selectedVehicle['deviceAttached']?'bg-emerald-500':'bg-orange-500'"/>
                                </div>
                                <p class="text-xs leading-5 text-gray-500">{{ selectedVehicle["deviceAttached"]?'Attached':'Not Attached' }} to driver</p>
                            </div>
                        </div>
                        <p>Isuzu</p>
                        <p class="text-xs">Kanta</p>
                        <hr class="my-4" />
                        <div v-if="selectedVehicle['deviceAttached']" id="driverDetails">
                            <p>Driver Name: <strong>Ivan Driver</strong></p>
                            <p>Phone / Email: <strong>0773099747 / ivanatresyn@gmail.com</strong></p>
                            <p>Merch Code: <strong><a href="#" class="text-blue-500">M00232</a></strong></p>
                            <p>Licence No: <strong>098765456783924</strong></p>
                            <div class="mt-2">
                                <span>Unlink Driver from vehicle: </span>
                                <button type="button" @click="openWarning = true" class="ml-4 rounded-full bg-red-600 px-3 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-red-500">Unlink Driver</button>
                            </div>
                        </div>
                        <div v-else>
                            <div class="mt-2">
                                <span>Link a Driver to this vehicle: </span>
                                <button type="button" @click="openLinkDriver = true" class="ml-4 rounded-full bg-green-600 px-3 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-green-500">Link Driver</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <TransitionRoot as="template" :show="openLinkDriver">
        <Dialog as="div" class="relative z-10" @close="openLinkDriver = false">
            <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
            </TransitionChild>

            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                        <DialogPanel class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-sm sm:p-6">
                            <div>
                                <div class="flex justify-between">
                                    <h2 class="font-bold">{{ selectedVehicle["name"] }}</h2>
                                    <div class="mt-1 flex items-center gap-x-1.5">
                                        <div class="flex-none rounded-full p-1" :class="selectedVehicle['deviceAttached']?'bg-emerald-500/20':'bg-orange-500/20'">
                                            <div class="h-1.5 w-1.5 rounded-full" :class="selectedVehicle['deviceAttached']?'bg-emerald-500':'bg-orange-500'"/>
                                        </div>
                                        <p class="text-xs leading-5 text-gray-500">{{ selectedVehicle["deviceAttached"]?'Attached':'Not Attached' }} to driver</p>
                                    </div>
                                </div>
                                <p>Isuzu</p>
                                <p class="text-xs">Kanta</p>
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
                                <button type="button" class="inline-flex w-full justify-center rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-0 focus-visible:outline-offset-0" @click="openLinkDriver = false">Link Driver</button>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
    <TransitionRoot as="template" :show="openWarning">
        <Dialog as="div" class="relative z-10" @close="openWarning = false">
            <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
            </TransitionChild>

            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                        <DialogPanel class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                            <div class="sm:flex sm:items-start">
                                <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                    <ExclamationTriangleIcon class="h-6 w-6 text-red-600" aria-hidden="true" />
                                </div>
                                <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                    <DialogTitle as="h3" class="text-base font-semibold leading-6 text-gray-900">Unlink Driver</DialogTitle>
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-500">Are you sure you want to unlink this driver from the vehicle? This will leave the vehicle un assigned to any driver. Be sure to link another driver if you proceed with this action.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                                <button type="button" class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm ring-0 border-0 hover:bg-red-500 sm:ml-3 sm:w-auto" @click="openWarning = false">Unlink</button>
                                <button type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto" @click="openWarning = false" ref="cancelButtonRef">Cancel</button>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
  </template>

  <script setup>
  import { ChevronRightIcon } from '@heroicons/vue/20/solid'
  import {computed, ref} from "vue";

  import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
  import { ExclamationTriangleIcon } from '@heroicons/vue/24/outline'

  import { CheckIcon, ChevronUpDownIcon } from '@heroicons/vue/20/solid'
  import {
      Combobox,
      ComboboxButton,
      ComboboxInput,
      ComboboxLabel,
      ComboboxOption,
      ComboboxOptions,
  } from '@headlessui/vue'

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

  const openLinkDriver = ref(false)

  const openWarning = ref(false)

  let selectedVehicle = ref({});

  const vehicles = [
      {
          name: 'UGB 699U',
          make: 'Toyota',
          id: 13456,
          deviceAttached: true,
      },
      {
          name: 'UGB 699U',
          make: 'Toyota',
          id: 13456,
          deviceAttached: false,
      },
      {
          name: 'UGB 699U',
          make: 'Toyota',
          id: 13456,
          deviceAttached: true,
      },
      {
          name: 'UGB 699U',
          make: 'Toyota',
          id: 13456,
          deviceAttached: false,
      },
      {
          name: 'UGB 699U',
          make: 'Toyota',
          id: 13456,
          deviceAttached: false,
      },
  ]
  selectedVehicle.value = vehicles[0];
  </script>
