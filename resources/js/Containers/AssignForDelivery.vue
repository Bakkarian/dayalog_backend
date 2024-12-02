 <script setup>

import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { useForm } from '@inertiajs/vue3'

import VehicleSelect from './VehicleSelect.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import TextArea from '@/Components/TextArea.vue';
import { Switch, SwitchGroup, SwitchLabel } from '@headlessui/vue'

const props = defineProps({
    orderId:{type:Number, required:true }
})

const emit = defineEmits(['close'])

const form = useForm({
    vehicleSelected: false,
    vehicle_id: null,
    origin: null,
    destination: null,
    notes: null,
})

const submit = () => {
    form.transform((data)=>{
        if(!data.vehicleSelected){
            delete data.vehicle_id;
        }
        return data;
    }).post(route('order.add-trip', props.orderId), {
        preserveScroll: true,
        onSuccess: () => {
            emit('close')
        },
    })
}




</script>
<template>
        <TransitionRoot as="template" :show="true" >
        <Dialog as="div" class="relative z-10" @close="emit('close')">
            <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
            </TransitionChild>

            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                        <DialogPanel class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-sm sm:p-6">
                            <form @submit.prevent="submit" >
                                <div>
                                    <div class="mt-3 sm:mt-5">
                                        <DialogTitle as="h3" class="text-base text-center font-semibold leading-6 text-gray-900">Assign Order For Delivery</DialogTitle>
                                        <hr class="my-2" />

                                        <SwitchGroup as="div" class="flex items-center py-3">
                                            <Switch v-model="form.vehicleSelected" :class="[form.vehicleSelected ? 'bg-indigo-600' : 'bg-gray-200', 'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2']">
                                                <span aria-hidden="true" :class="[form.vehicleSelected ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out']" />
                                            </Switch>
                                            <SwitchLabel as="span" class="ml-3 text-sm">
                                                <span class="font-medium text-gray-900">Selecting a vehicle</span>
                                            </SwitchLabel>
                                        </SwitchGroup>

                                        <div class="py-2" v-if="form.vehicleSelected">
                                            <InputLabel value="Select Vehicle *" />
                                            <div class="mt-2">
                                                <VehicleSelect v-model="form.vehicle_id" />
                                            </div>
                                        </div>

                                       <div class="sm:col-span-5 mt-2">

                                        <div class="">
                                                <TextInput id="name" type="text" placeholder="Origin" v-model="form.origin" />
                                                <InputError class="mt-2" />
                                            </div>
                                        </div>

                                        <div class="sm:col-span-5 mt-2">
                                            <div class="">
                                                <TextInput id="name" type="text" placeholder="Destination" v-model="form.destination" />
                                                <InputError class="mt-2" />
                                            </div>
                                        </div>


                                        <div class="sm:col-span-5 mt-2">
                                            <div class="">
                                                <TextArea id="name"  placeholder="Notes specific to this trip" v-model="form.notes" />
                                                <InputError class="mt-2" />
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="mt-5 sm:mt-6 flex">
                                    <button type="button" class="mr-2 inline-flex w-full justify-center rounded-md bg-gray-100 px-3 py-2 text-sm font-semibold text-red-500 shadow-sm hover:bg-gray-300" @click="emit('close')" >Close</button>
                                    <button type="submit"  class="inline-flex w-full justify-center rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500" >Assign</button>
                                </div>

                            </form>

                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>
