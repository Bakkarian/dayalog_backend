<template>
    <Head title="Vehicles" />

    <div class="px-4 py-10 sm:px-6 lg:px-8 lg:py-6">
        <!-- Main area -->
        <h1 class="text-xl mb-8">Vehicles</h1>
        <div class="grid lg:grid-cols-3 gap-8">
            <div class="col-span-1 row-end-2">
                <div class="mb-5">
                    <label for="email" class="sr-only">Search</label>
                    <input type="text" name="search" id="search" class="block w-full rounded-md border-0 py-1.5 text-gray-900 \
                        shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset \
                         focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Search vehicles"
                         v-model="term"
                         @keyup="searchVehicles"
                         />
                </div>

                <ul role="list" class="row-auto divide-y divide-gray-100 overflow-hidden bg-white shadow-sm ring-1 \
                         ring-gray-900/5 sm:rounded-xl overflow-y-scroll">
                    <li v-for="vehicle in vehicles.data" :key="vehicle.id" @click="selectedVehicleId = vehicle.id" class="relative \
                        flex justify-between gap-x-6 px-4 py-5 hover:bg-gray-50 sm:px-6 cursor-pointer">
                        <div class="flex gap-x-4">
                            <div class="h-12 w-12 flex-none rounded-full bg-gray-200 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" :class="vehicle.driver?'text-green-500':'text-red-500'" class="w-6 h-6 mx-auto">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902  17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5   18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026  0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                                </svg>
                            </div>
                            <div class="min-w-0 flex-auto">
                                <p class="text-sm font-semibold leading-6 text-gray-900">
                                    <a>
                                        <span class="absolute inset-x-0 -top-px bottom-0" />
                                        {{ vehicle.number_plate }}
                                    </a>
                                </p>
                                <p class="mt-1 flex text-xs leading-5 text-gray-500">
                                    <a class="relative truncate hover:underline">{{vehicle.make}}</a>
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-x-4">
                            <div class="hidden sm:flex sm:flex-col sm:items-end">
                                <p v-if="!vehicle.driver" class="mt-1 text-xs leading-5 text-gray-500">
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
                                <h2 class="font-bold">{{ selectedVehicle.number_plate }}</h2>
                                <div class="mt-1 flex items-center gap-x-1.5">
                                    <div class="flex-none rounded-full p-1" :class="selectedVehicle.driver?'bg-emerald-500/20':'bg-orange-500/20'">
                                        <div class="h-1.5 w-1.5 rounded-full" :class="selectedVehicle.driver?'bg-emerald-500':'bg-orange-500'"/>
                                    </div>
                                    <p class="text-xs leading-5 text-gray-500">{{ selectedVehicle.driver?'Attached':'Not Attached' }} to driver</p>
                                </div>
                            </div>
                            <p>{{ selectedVehicle.make }}</p>
                            <p class="text-xs">{{ selectedVehicle.model }}</p>
                            <hr class="my-4" />
                            <div v-if="selectedVehicle.driver" id="driverDetails">
                                <p>Driver Name: <strong>{{ selectedVehicle.driver?.bio_data?.name }}</strong></p>
                                <p>Phone / Email: <strong>{{ selectedVehicle.driver?.bio_data?.phone_number }} / {{ selectedVehicle.driver?.bio_data?.email }} </strong></p>
                                <p>Merch Code: <strong><a href="#" class="text-blue-500">{{ selectedVehicle.driver?.bio_data?.patasente_id }} </a></strong></p>
                                <p>Licence No: <strong>{{ selectedVehicle.driver?.license }} </strong></p>
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
    <LinkDriverToVehicle v-if="openLinkDriver" :selectedVehicle="selectedVehicle" :show="openLinkDriver"  :closeLinkModal="closeLinkModal"/>
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
                                <button type="button" class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm ring-0 border-0 hover:bg-red-500 sm:ml-3 sm:w-auto" @click="unlinkVehicleDriver">Unlink</button>
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
  import {computed, ref, watch, reactive} from "vue";

  import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
  import { ExclamationTriangleIcon } from '@heroicons/vue/24/outline'

  import { useForm, usePage, router, Head } from '@inertiajs/vue3';
  import LinkDriverToVehicle from '@/Containers/LinkDriverToVehicle.vue';
  import debounce from 'lodash/debounce'
  import Layout from '@/Layouts/MainLayout.vue'
  defineOptions({ layout: Layout })


  const vehicles = computed(() => usePage().props.vehicles)
  const openLinkDriver = ref(false)
  const openWarning = ref(false)

  const selectedVehicleId = ref(false)
  const term = ref('')

  const selectedVehicle = computed(()=>{
    return vehicles.value?.data.find(vehicle => vehicle.id == selectedVehicleId.value);
  })

  const searchVehicles = debounce(()=>{
    router.reload({
        data: {
            term: term.value,
        },
        only: ['vehicles'],
    })
  }, 500)

  const closeLinkModal = () => {
    openLinkDriver.value = false
  }

  const form = useForm({
    'vehicle_id':selectedVehicle.value?.id,
    'driver_id':selectedVehicle.value?.driver?.id
  })

  watch(selectedVehicle, async (newVehicle) => {
    form.vehicle_id = newVehicle?.id;
    form.driver_id = newVehicle?.driver?.id
  })

  const unlinkVehicleDriver = () => {
    form.delete(route('vehicle.detach-driver'),{
        onSuccess: () => {
            openWarning.value = false
        }
    })
  }
  </script>
