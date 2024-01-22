<script setup>
import {  ArrowLeftIcon } from '@heroicons/vue/20/solid'
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { ref } from 'vue';

const props = defineProps(
    {
        trip: {
            type: Object,
            required: true,
        },
    }
)

const statusMap = {
    'not_started': 'Not Started',
    'transit': 'On Trip',
    'reached': 'Delivered',
    'canceled' : 'Canceled'
}

const openDetails = ref(false)

</script>

<template>

    <span>
        <button @click="openDetails = true" type="button" class="rounded bg-green-600 px-2 py-1 text-sm font-semibold text-white shadow-sm hover:bg-green-500" >View Delivery Details</button>
        <TransitionRoot as="template" :show="openDetails">
        <Dialog as="div" class="relative z-30" @close="openDetails = false">
            <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
                <div class="fixed inset-0 bg-gray-900 bg-opacity-40 transition-opacity" />
            </TransitionChild>

            <div class="fixed inset-0 z-30 overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                        <DialogPanel class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-md sm:p-6">
                            <div>
                                <div class="">
                                    <DialogTitle as="h3" class="text-base font-semibold leading-6 text-gray-900">
                                        <div class="p-3 flex items-center border-b">
                                            <div class="animate__animated" :class="'animate__fadeInRight'">
                                                <button @click="openDetails = false" type="button" class="rounded-full bg-white border p-1 text-gray-500 shadow-sm hover:bg-gray-100 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                                                    <ArrowLeftIcon class="h-5 w-5" aria-hidden="true" />
                                                </button>
                                            </div>
                                            <h5 class="text-md font-bold ml-4 animate__animated animate__delay-0.3s" :class="'animate__fadeInRight'">Trip Info: <span class="font-bold"> {{ trip.origin }} to {{ trip.destination }}  </span></h5>
                                        </div>
                                    </DialogTitle>
                                    <div class="mt-2">
                                        <div class="mt-4">
                                            <h5 class="font-bold">Trip Notes</h5>



                                            <div class="flex flex-col  justify-between my-4">
                                                <p class="mb-3">{{ trip.notes }}</p>
                                                <p class="truncate font-medium text-gray-900">
                                                    <button @click="openDetails = false;" type="button" class="rounded-full bg-white px-2 py-1 text-xs font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-green-300 hover:bg-gray-50">View Current Location</button>
                                                </p>
                                                <div class="ml-2 flex flex-shrink-0">
                                                    <p class="inline-flex rounded-full px-2 text-xs font-semibold leading-5" :class="['transit','reached'].includes(props.trip.status)  ?'text-green-800 bg-green-100':'text-red-800 bg-red-100'">{{
                                                            statusMap[props.trip.status]
                                                        }}</p>
                                                </div>
                                            </div>
                                            <hr class="mb-4" />
                                            <p class="text-gray-700 text-sm">Driver Name: <strong>{{ trip.vehicle.driver.bio_data.name }}</strong></p>
                                            <p class="text-gray-700 text-sm">Driver Phone: <strong>{{ trip.vehicle.driver.bio_data.phone_number }}</strong></p>
                                            <p class="text-gray-700 text-sm">Plate Number: <strong>{{ trip.vehicle.number_plate }}</strong></p>
                                            <p class="text-gray-700 text-sm">Device ID: <strong>{{  trip.vehicle.device.uniqueid }}</strong></p>
                                            <!-- TODO: link to Patasente profile -->
                                            <p class="text-gray-700 text-sm">Patasente ID: <a href="#" target="_blank" class="font-bold text-blue-400">{{ trip.vehicle.driver.bio_data.patasente_id }}</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-5 sm:mt-6">
                                <button type="button" class="rounded-md bg-[#002760] w-full px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500" @click="openDetails = false">Close</button>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
    </span>
</template>
