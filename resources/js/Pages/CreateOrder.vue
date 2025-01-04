<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextArea from '@/Components/TextArea.vue';
import FlashMessage from '@/Containers/FlashMessage.vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import Layout from '@/Layouts/MainLayout.vue'
import UserSelect from '@/Containers/UserSelect.vue';
import CreateOrderItems from '@/Containers/CreateOrderItems.vue'
import CreateNewOrderUser from '@/Containers/CreateNewOrderUser.vue'
import { computed, ref } from 'vue';
import { Switch, SwitchGroup, SwitchLabel } from '@headlessui/vue'
import TextInput from '@/Components/TextInput.vue';
import VehicleSelect from '@/Containers/VehicleSelect.vue';

defineOptions({ layout: Layout })
const page = usePage();
const user =  computed(() => page.props.auth.user).value

const creatingNewFromUser = ref(false)
const creatingNewToUser = ref(false)


const handleNewFromUser = (user) => {
    form.from = user.id;
    creatingNewFromUser.value = false
}

const handleNewToUser = (user) => {
    form.to = user.id;
    creatingNewToUser.value = false
}

const form = useForm('CreateOrder',{
  toMe:true,
  fromMe:true,

  from: "",
  to: "",

  notes: "",
  orderItems: [],

  singleShipment: true,
  singleShipmentOrigin:"",
  singleShipmentDestination:"",
  vehicleSelected:false,
  singleShipmentVehicle:"",
  vehicle_id:null,

})


const submitOrder = () => {
    form.transform((data)=>{
        if(data.fromMe){
            data.from = user.id
        }

        if(data.fromMe){
            data.to = user.id
        }

        return data;

    }).post(route('order.store'), {
        onSuccess: () => form.reset(),
    })
}


</script>

<template>

    <Head title="Add Order" />

    <div class="px-4 py-10 sm:px-6 lg:px-8 lg:py-6 max-w-7xl">
        <!-- Main area -->
        <div class="mb-2">
            <h1 class="text-xl">Create Order</h1>
        </div>
        <div class="grid lg:grid-cols-2 gap-8">
            <div class="bg-white p-8 rounded-md border">
                <form @submit.prevent="submitOrder">
                    <p class="text-xs mt-0">Field Marked with "<strong>*</strong>" are required</p>
                    <div class="mt-10 mb-4 grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-6">

                        <div class="sm:col-span-5">

                            <div class="flex">
                                <InputLabel value="Deliver From *" />


                                <SwitchGroup as="div" class="flex items-center  ">
                                    <Switch v-model="form.fromMe" :class="[form.fromMe ? 'bg-indigo-600' : 'bg-gray-200', 'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2']">
                                        <span aria-hidden="true" :class="[form.fromMe ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out']" />
                                    </Switch>
                                    <SwitchLabel as="span" class="ml-3 text-sm">
                                        <span class="font-sm text-gray-900">From Me</span>
                                    </SwitchLabel>
                                </SwitchGroup>
                            </div>



                            <div  v-if="!form.fromMe" class="mt-2">
                                <div class="flex items-center">
                                    <UserSelect  v-model="form.from" />
                                    <button
                                        @click="creatingNewFromUser = true;creatingNewToUser = false;"
                                        type="button"
                                        class="rounded-md h-fit ml-1 bg-indigo-600 px-2.5 \
                                        py-1.5 text-sm font-semibold text-white shadow-sm \
                                        hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 \
                                        focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                                        >New User</button>
                                </div>
                            </div>
                            <InputError class="mt-2" :message="form.errors.from" />
                        </div>



                        <div class="sm:col-span-5">

                            <div class=" flex">
                            <InputLabel value="Deliver To *" />

                                <SwitchGroup as="div" class="flex items-center  ">
                                    <Switch v-model="form.toMe" :class="[form.toMe ? 'bg-indigo-600' : 'bg-gray-200', 'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2']">
                                        <span aria-hidden="true" :class="[form.toMe ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out']" />
                                    </Switch>
                                    <SwitchLabel as="span" class="ml-3 text-sm">
                                        <span class="font-sm text-gray-900">To Me</span>
                                    </SwitchLabel>
                                </SwitchGroup>
                            </div>


                            <div  v-if="!form.toMe"  class="mt-2">
                                <div class="flex items-center ">
                                    <UserSelect  v-model="form.to" />
                                    <button
                                        @click="creatingNewToUser = true;creatingNewFromUser = false;"
                                        type="button"
                                        class="rounded-md h-fit ml-1 bg-indigo-600 px-2.5 \
                                        py-1.5 text-sm font-semibold text-white shadow-sm \
                                        hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 \
                                        focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                                        >New User</button>
                                </div>
                            </div>
                            <InputError class="mt-2" :message="form.errors.to" />
                        </div>

                        <div class="sm:col-span-5">
                            <InputLabel value="Delivery Notes *" />
                            <div class="mt-2">
                                <TextArea v-model="form.notes" placeholder="Start typing and select"  />
                                <InputError class="mt-2" :message="''" />
                            </div>
                            <InputError class="mt-2" :message="form.errors.notes" />
                        </div>

                    </div>


                    <InputError class="mt-2" :message="form.errors.orderItems" />
                    <CreateOrderItems  v-model="form.orderItems"  />

                    <div class="my-10">
                        <hr/>


                        <div class="pt-2">
                            <SwitchGroup as="div" class="flex items-center  ">
                                <Switch v-model="form.singleShipment" :class="[form.singleShipment ? 'bg-indigo-600' : 'bg-gray-200', 'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2']">
                                    <span aria-hidden="true" :class="[form.singleShipment ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out']" />
                                </Switch>
                                <SwitchLabel as="span" class="ml-3 text-sm">
                                    <span class="mt-2">Single Shipment</span>
                                </SwitchLabel>
                            </SwitchGroup>
                        </div>

                        <div class="grid  ">
                            <div v-if="form.singleShipment" class="">
                            <div class="">

                                <hr class="my-2" />

                                <div class="sm:col-span-5 mt-2">

                                    <div class="">
                                        <TextInput id="name" type="text" placeholder="Origin" v-model="form.singleShipmentOrigin" />
                                        <InputError class="mt-2" :message="form.errors.singleShipmentOrigin" />
                                    </div>
                                </div>

                                <div class="sm:col-span-5 mt-2">
                                    <div class="">
                                        <TextInput id="name" type="text" placeholder="Destination" v-model="form.singleShipmentDestination" />
                                        <InputError class="mt-2" :message="form.errors.singleShipmentDestination" />
                                    </div>
                                </div>

                                <SwitchGroup as="div" class="flex items-center py-3">
                                    <Switch v-model="form.vehicleSelected" :class="[form.vehicleSelected ? 'bg-indigo-600' : 'bg-gray-200', 'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2']">
                                        <span aria-hidden="true" :class="[form.vehicleSelected ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out']" />
                                    </Switch>
                                    <SwitchLabel as="span" class="ml-3 text-sm">
                                        <span class="font-medium text-gray-900">Selecting a truck</span>
                                    </SwitchLabel>
                                </SwitchGroup>

                                <div class="py-2" v-if="form.vehicleSelected">
                                    <InputLabel value="Select Vehicle *" />
                                    <div class="mt-2">
                                        <VehicleSelect v-model="form.vehicle_id" />
                                        <InputError class="mt-2" :message="form.errors.vehicle_id" />
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-2 pt-1 border-t">
                        <FlashMessage />
                        <div class="flex flex-row-reverse">
                            <button type="submit"
                                class="rounded-md mt-1 bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            Create Order
                        </button>
                        </div>
                    </div>
                </form>
            </div>

            <div v-if="creatingNewFromUser">
                <h3>Create new delivery from user</h3>
                <CreateNewOrderUser   :onCreateNewUser="handleNewFromUser"  />
            </div>

            <div v-if="creatingNewToUser">
                <h3>Create new delivery to user</h3>
                <CreateNewOrderUser   :onCreateNewUser="handleNewToUser"  />
            </div>

        </div>
    </div>


</template>
