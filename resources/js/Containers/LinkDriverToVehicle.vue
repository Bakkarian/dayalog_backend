<template>
        <TransitionRoot as="template" :show="show">
        <Dialog as="div" class="relative z-10" @close="closeModal">
            <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
            </TransitionChild>

            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <TransitionChild as="template"
                                     enter="ease-out duration-300"
                                     enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                     enter-to="opacity-100 translate-y-0 sm:scale-100"
                                     leave="ease-in duration-200"
                                     leave-from="opacity-100 translate-y-0 sm:scale-100"
                                     leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                        <DialogPanel class="relative transform overflow-hidden rounded-lg bg-white px-4 \
                                            pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full \
                                            sm:max-w-sm sm:p-6">
                            <div>
                                <div class="flex justify-between">
                                    <h2 class="font-bold">{{ selectedVehicle.number_plate }}</h2>
                                    <div class="mt-1 flex items-center gap-x-1.5">
                                        <div class="flex-none rounded-full p-1" :class="selectedvehicle?.vehicleDevice?.device?'bg-emerald-500/20':'bg-orange-500/20'">
                                            <div class="h-1.5 w-1.5 rounded-full" :class="selectedvehicle?.vehicleDevice?.device?'bg-emerald-500':'bg-orange-500'"/>
                                        </div>
                                        <p class="text-xs leading-5 text-gray-500">{{ selectedvehicle?.vehicleDevice?.device?'Attached':'Not Attached' }} to driver</p>
                                    </div>
                                </div>
                                <p>{{ selectedVehicle.model }}</p>
                                <p class="text-xs">{{ selectedVehicle.make }}</p>
                                <hr class="my-4" />
                                <AttachDriver v-model="form.driver_id" />
                            </div>
                            <div class="mt-5 sm:mt-6">
                                <button type="button" class="inline-flex w-full justify-center rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-0 focus-visible:outline-offset-0" @click="handleAttachDriver">Link Driver</button>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script setup>

import { Dialog, DialogPanel, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { ref} from 'vue';
import { useForm } from '@inertiajs/vue3';

import AttachDriver from './AttachDriver.vue';
  const props = defineProps([
    'selectedVehicle',
    'show',
    'closeLinkModal'
    ])

    const form = useForm({
        'driver_id': ''
    })

  const closeModal = () => {
    props.closeLinkModal();
  }

  const handleAttachDriver = () => {
    form.post(route('vehicle.attach-driver',[props.selectedVehicle.id]),{
    preserveScroll: true,
    onSuccess: () =>{
        props.closeLinkModal();
    },
    })
  }

</script>
