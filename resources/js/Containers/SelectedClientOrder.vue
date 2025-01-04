
<script setup>
    import {
        StarIcon,
        MapPinIcon,
        CogIcon,
        ArrowUturnUpIcon,
        StopCircleIcon
    } from '@heroicons/vue/24/outline'
    import { usePage } from '@inertiajs/vue3';
    import { computed, ref } from 'vue';
import SelectedClientOrderMap from './SelectedClientOrderMap.vue';

    const page = usePage();
    const order = computed(() => page.props.selectedOrder)

    const orderVehicles = computed(() => page.props.selectedOrder.order_vehicles)
    const orderVehicle = computed(() => page.props.selectedOrder.order_vehicles[0])

    console.log(orderVehicle.value)

    let selectedTab = ref(1)

    const tabs = [
        { name: 'Order Details', href: '#', current: false },
        { name: 'Vehicle', href: '#', current: true },
        { name: 'Driver Information', href: '#', current: false },
    ]
</script>

<template>
        <div id="isOrder">
            <div class="bg-white rounded-md overflow-hidden">
               <SelectedClientOrderMap />
            </div>

            <h2 class="font-bold mt-6">Main Info</h2>
            <div class="bg-white rounded-md">
                <div class="border-b border-gray-200 pb-5 sm:pb-0">
                    <div class="mt-3 sm:mt-4 pt-4">
                    <div class="sm:hidden">
                        <label for="current-tab" class="sr-only">Select a tab</label>
                        <select id="current-tab" name="current-tab" class="block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                        <option v-for="(tab, index) in tabs" :key="tab.name" :selected="selectedTab == index?true:false" v-on:click="selectedTab = index">{{ tab.name }}</option>
                        </select>
                    </div>
                    <div class="hidden sm:block px-4">
                        <nav class="-mb-px flex space-x-8">
                            <a
                                v-for="(tab, index) in tabs"
                                :key="tab.name"
                                :href="tab.href"
                                v-on:click="selectedTab = index"
                                :class="[selectedTab == index ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700', 'whitespace-nowrap border-b-2 px-1 pb-4 text-sm font-medium']" :aria-current="tab.current ? 'page' : undefined">

                                {{ tab.name }}</a>
                        </nav>
                    </div>
                    </div>
                </div>

                <!--ORDER DETAILS TAB-->
                <div v-if="selectedTab == 0" class="flex p-6">
                    <img class="my-4 mb-5 w-[300px]" src="../assets/order-details.svg" alt="">
                    <div class="ml-6 flex-auto">
                        <div class="flex justify-between mb-4">
                            <h4 class="text-sm">Order ID: #{{ order.id }}</h4>
                        </div>
                    <hr />
                    <div class="flex mt-6 justify-between">
                        <div>
                            <h3 class="text-xs text-gray-400">Delivering From</h3>
                            <p class="text-sm">{{ order.from.name }}</p>
                        </div>
                        <div>
                            <h3 class="text-xs text-gray-400">Delivering To</h3>
                            <p class="text-sm">{{ order.to.name }}</p>
                        </div>
                    </div>
                    <div class="mt-6">
                        <div>
                            <h3 class="text-xs text-gray-400">Delivery Note</h3>
                            <p class="text-sm">{{ order.notes }}</p>
                        </div>
                    </div>
                    </div>
                </div>

                <!--VEHICLE TAB-->
                <div v-if="selectedTab == 1" class="flex p-6">
                    <img class="my-4 mb-5 w-[300px]" src="../assets/delivery-truck.svg" alt="">
                    <div v-if="orderVehicles.length == 0">
                        <div class="text-center">
                            <p class="text-sm text-gray-500">No vehicle selected for this order</p>
                        </div>
                    </div>
                    <div v-else class="ml-6 flex-auto">
                        <div class="flex justify-between mb-4">
                            <h4 class="text-sm">{{ orderVehicle?.vehicle?.make }}</h4>
                            <div class="text-sm flex"><span>4.5</span> <StarIcon class="text-yellow-400 h-4 w-4 ml-1"></StarIcon></div>
                        </div>
                        <hr />
                        <div class="flex mt-6 justify-between">
                            <div>
                                <h3 class="text-xs text-gray-400">MODEL</h3>
                                <p class="text-sm">{{ orderVehicle?.vehicle?.model }}</p>
                            </div>
                            <div>
                                <h3 class="text-xs text-gray-400">MAKE</h3>
                                <p class="text-sm">{{ orderVehicle?.vehicle?.make }}</p>
                            </div>
                        </div>
                        <div class="flex mt-6 justify-between">
                            <div>
                                <h3 class="text-xs text-gray-400">WEIGHT</h3>
                                <p class="text-sm">{{  orderVehicle?.vehicle?.capacity_weight }} Kg</p>
                            </div>
                            <div>
                                <h3 class="text-xs text-gray-400">PLATE No.</h3>
                                <p class="text-sm">{{  orderVehicle?.vehicle?.number_plate }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!--DRIVER INFO TAB-->
                <div v-if="selectedTab == 2" class="flex p-6">
                    <img class="my-4 mb-5 w-[300px]" src="../assets/driver-info.svg" alt="">
                    <div v-if="orderVehicles.length == 0">
                        <div class="text-center">
                            <p class="text-sm text-gray-500">No vehicle selected for this order</p>
                        </div>
                    </div>
                    <div v-else class="ml-6 flex-auto">
                        <div class="flex justify-between mb-4">
                            <h4 class="text-sm">Ivan Driver</h4>
                            <div class="text-sm flex"><span>4.5</span> <StarIcon class="text-yellow-400 h-4 w-4 ml-1"></StarIcon></div>
                        </div>
                        <hr />
                        <div class="flex mt-6 justify-between">
                            <div>
                                <h3 class="text-xs text-gray-400">IDENTIFICATION</h3>
                                <p class="text-sm">Valid</p>
                            </div>
                            <div>
                                <h3 class="text-xs text-gray-400">DRIVERS LICENCE</h3>
                                <p class="text-sm">Valid</p>
                            </div>
                        </div>
                        <div class="flex mt-6 justify-between">
                            <div>
                                <h3 class="text-xs text-gray-400">PHONE NUMBER</h3>
                                <p class="text-sm">Available</p>
                            </div>
                            <!-- <div>
                                <h3 class="text-xs text-gray-400">PLATE No.</h3>
                                <p class="text-sm">UGB 699U</p>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

</template>
