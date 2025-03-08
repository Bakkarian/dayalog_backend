<script setup>
import { Link, useForm, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import AssignForDelivery from './AssignForDelivery.vue';
import OrderTrips from './OrderTrips.vue';
import { ref } from 'vue';
import { InformationCircleIcon, MapPinIcon } from '@heroicons/vue/20/solid';

const page = usePage();
const selectedOrder = computed(() => page.props.selectedOrder)
const openAssignModal = ref(false)


const form  = useForm({});

const cancelOrder = () => {
    form
     .transform((data) => {
        return {
            ...data,
            status: 'cancelled',
        }
     })
     .put(route('order.update', selectedOrder.value?.id))
}

const completedOrder = () => {
   form
    .transform((data) => {
    return {
        ...data,
        status: 'completed'
    }
    })
    .put(route('order.update', selectedOrder.value?.id))
}

</script>

<template>
    <div class="col-span-3">
        <div :class="'min-h-[420px]'" class="overflow-hidden bg-white transition-all ease-in-out duration-300">
            <div class="p-3 flex items-center border-b border-t">
                <div class="animate__animated" :class="'animate__fadeInRight'">
                    <button type="button" class="rounded-full bg-white border p-1 text-gray-500 shadow-sm hover:bg-gray-100 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                        <InformationCircleIcon class="h-5 w-5" aria-hidden="true" />
                    </button>
                </div>
                <h5 class="text-md font-bold ml-4 animate__animated animate__delay-0.3s" :class="'animate__fadeInRight'">Order Status: <span class="font-bold"> {{ selectedOrder.status }}</span></h5>
            </div>
            <ul role="list" class="space-y-6 p-3 overflow-hidden">

                <li class="relative flex gap-x-4">
                    <div class="absolute left-0 top-0 flex w-6 justify-center -bottom-6">
                        <div class="w-px bg-gray-200"></div>
                    </div>
                    <div class="relative flex h-6 w-6 flex-none items-center justify-center bg-orange-200 rounded-full">
                        <div class="h-1.5 w-1.5 rounded-full bg-gray-100 ring-1 ring-gray-300"></div>
                    </div>
                    <div class="flex-auto rounded-md p-3 ring-1 ring-inset ring-gray-200 animate__animated animate__fadeIn">
                        <h4 class="col-span-2">Order Items</h4>
                        <div class="sm:grid sm:grid-cols-2 gap-4 pr-4 h-[200px] overflow-y-scroll">
                            <div v-for="item in selectedOrder.items" class="border border-orange-400 rounded-md p-2 bg-orange-400 bg-opacity-5">
                            <p class="sm:flex sm:justify-between">
                                <span>{{item.item}}</span>
                                <span class="text-sm font-bold">Total:  {{ (item.price * item.qty).toLocaleString("en-US") }}</span>
                            </p>
                            <p class="text-sm">Qty: {{item.qty}}</p>
                        </div>
                        </div>
                    </div>
                </li>

                <li class="relative flex gap-x-4">
                    <div class="absolute left-0 top-0 flex w-6 justify-center -bottom-6">
                        <div class="w-px bg-gray-200"></div>
                    </div>

                    <div class="relative flex h-6 w-6 flex-none items-center justify-center bg-green-500 rounded-full">
                        <div class="h-1.5 w-1.5 rounded-full bg-green-100 ring-1 ring-white"></div>
                    </div>
                    <p class="flex-auto py-0.5 text-xs leading-5 text-gray-500">
                        <span class="font-medium text-gray-900">{{selectedOrder.from?.name}}</span> Pickup From.
                    </p>
                    <time datetime="2023-01-23T10:32" class="flex-none py-0.5 text-xs leading-5 text-gray-500">...</time>
                </li>

                <li class="relative flex gap-x-4">
                    <div class="absolute left-0 top-0 flex w-6 justify-center -bottom-6">
                        <div class="w-px bg-gray-200"></div>
                    </div>

                    <div class="relative flex h-6 w-6 flex-none items-center justify-center bg-white rounded-full">
                        <div class="h-1.5 w-1.5 rounded-full bg-gray-100 ring-1 ring-gray-300"></div>
                    </div>
                    <p class="flex-auto py-0.5 text-xs leading-5 text-gray-500">
                        <span class="font-medium text-gray-900">{{ selectedOrder?.to?.email_address==null?selectedOrder?.to?.name + ' Phone':selectedOrder?.to?.email+' Email' }}: </span>
                        <a :href="selectedOrder?.to?.email== null ? 'tel:' + selectedOrder?.to?.phone:'mailto:'+selectedOrder?.to?.email" class="text-blue-400 font-bold">{{ selectedOrder?.to?.email==null?selectedOrder?.to?.phone_number:selectedOrder?.to?.email }}</a></p>
                    <time datetime="2023-01-23T11:03" class="flex-none py-0.5 text-xs leading-5 text-gray-500">Receiver Email</time>
                </li>

                <li >

                    <div class="relative flex gap-x-4">
                        <div class="absolute left-0 top-0 flex w-6 justify-center h-6">
                            <div class="w-px bg-gray-200"></div>
                        </div>

                        <div class="relative flex h-6 w-6 flex-none items-center justify-center bg-white">
                            <MapPinIcon class="h-6 w-6 text-blue-600" />
                        </div>

                        <h2 class="flex-auto py-0.5 text-md leading-5 font-semibold">Trips</h2>
                    </div>


                    <OrderTrips :vehiclesOrders="selectedOrder?.order_vehicles" />
                </li>
            </ul>
            <div  class="p-6">

                <template v-if="selectedOrder.status != 'completed' && selectedOrder.status != 'cancelled' ">
                    <button type="button" class="rounded bg-indigo-600 px-2 py-1 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 mr-2" @click.prevent="openAssignModal = true;">
                    {{  selectedOrder.order_vehicles[0]?  'Add a trip' : 'Assign For Delivery' }}
                    </button>

                    <button  type="button" class="rounded bg-green-600 px-2 py-1 text-sm font-semibold text-white shadow-sm hover:bg-green-500 mr-2" @click.prevent="completedOrder" >
                        Mark as Complete
                    </button>

                </template>
                    <Link :href="route('order.view-order-map', selectedOrder.id)"   class="rounded inline-flex px-2 py-1 text-sm font-semibold text-blue-400 mr-2"  >
                        <MapPinIcon class="h-4 w-4 text-blue-400" /> View on map
                    </Link>

            </div>


        </div>
    </div>
    <AssignForDelivery v-if="openAssignModal" @close="openAssignModal = false" :orderId="selectedOrder.id" />
</template>
