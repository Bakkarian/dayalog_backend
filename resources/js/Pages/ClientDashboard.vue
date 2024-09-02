<template>
    <div class="px-4 sm:px-6 lg:px-8 max-w-7xl">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 items-start">
            <div>
                <div class="p-4 bg-white rounded-md">
                    <img class="mt-2" src="../assets/add_package.svg" alt="">
                    <h3 class="font-bold text-center mt-2">Add new package</h3>
                    <p class="text-center text-gray-400 text-sm">Fill out the form and create new package</p>
                    <button type="button" class="rounded-full mt-2 block mx-auto bg-green-600 p-1.5 text-white shadow-sm hover:bg-green-500">
                        <PlusIcon class="h-5 w-5" aria-hidden="true" />
                    </button>
                </div>
                <div v-if="orders.length==0" id="isNotOrder">
                    <img class="my-4 opacity-50 mb-5 block max-h-[100px] mx-auto" src="../assets/empty-cart.svg" alt="">
                    <h2 class="text-lg text-gray-900 font-bold text-center">No orders yet</h2>
                    <p class="text-gray-500 text-center">You do not have any orders yet</p>
                </div>
                <div v-else>
                    <div class="mt-4">
                    <div class="p-4  bg-blue-600 rounded-md">
                    <h3 class="font-bold text-white mb-2">Order ID: #8765432</h3>
                    <div class="overflow-hidden rounded-full bg-white bg-opacity-40">
                        <div class="h-2 rounded-full bg-green-300" style="width: 37.5%" />
                    </div>
                    
                    <div class="mt-4">
                        <nav class="flex" aria-label="Progress">
                        <ol role="list" class="space-y-4">
                            <li v-for="step in IncompleteSteps" :key="step.name">
                            <a v-if="step.status === 'complete'" :href="step.href" class="group">
                                <span class="flex items-start">
                                <span class="relative flex h-5 w-5 flex-shrink-0 items-center justify-center">
                                    <CheckCircleIcon class="h-full w-full text-white group-hover:text-gray-300" aria-hidden="true" />
                                </span>
                                <span class="ml-3 text-sm font-medium text-white group-hover:text-gray-900">{{ step.name }}</span>
                                </span>
                            </a>
                            <a v-else-if="step.status === 'current'" :href="step.href" class="flex items-start" aria-current="step">
                                <span class="relative flex h-5 w-5 flex-shrink-0 items-center justify-center" aria-hidden="true">
                                <span class="absolute h-4 w-4 rounded-full bg-indigo-200" />
                                <span class="relative block h-2 w-2 rounded-full bg-blue-600" />
                                </span>
                                <span class="ml-3 text-sm font-medium text-gray-400">{{ step.name }}</span>
                            </a>
                            <a v-else :href="step.href" class="group">
                                <div class="flex items-start">
                                <div class="relative flex h-5 w-5 flex-shrink-0 items-center justify-center" aria-hidden="true">
                                    <div class="h-2 w-2 rounded-full bg-gray-300 group-hover:bg-gray-400" />
                                </div>
                                <p class="ml-3 text-sm font-medium text-gray-400 group-hover:text-orange-300">{{ step.name }}</p>
                                </div>
                            </a>
                            </li>
                        </ol>
                        </nav>
                    </div>
                </div>
                </div>
                <div class="mt-4">
                    <div class="p-4  bg-white rounded-md">
                    <h3 class="font-bold mb-2">Order ID: #8765432</h3>
                    <div class="overflow-hidden rounded-full bg-gray-200">
                        <div class="h-2 rounded-full bg-green-300" style="width: 0.0%" />
                    </div>
                    
                    <div class="mt-4">
                        <nav class="flex" aria-label="Progress">
                        <ol role="list" class="space-y-4">
                            <li v-for="step in CompleteSteps" :key="step.name">
                            <a v-if="step.status === 'complete'" :href="step.href" class="group">
                                <span class="flex items-start">
                                <span class="relative flex h-5 w-5 flex-shrink-0 items-center justify-center">
                                    <CheckCircleIcon class="h-full w-full text-green-500 group-hover:text-green-700" aria-hidden="true" />
                                </span>
                                <span class="ml-3 text-sm font-medium text-green-500 group-hover:text-green-700">{{ step.name }}</span>
                                </span>
                            </a>
                            <a v-else-if="step.status === 'current'" :href="step.href" class="flex items-start" aria-current="step">
                                <span class="relative flex h-5 w-5 flex-shrink-0 items-center justify-center" aria-hidden="true">
                                <span class="absolute h-4 w-4 rounded-full bg-indigo-200" />
                                <span class="relative block h-2 w-2 rounded-full bg-blue-600" />
                                </span>
                                <span class="ml-3 text-sm font-medium text-gray-400">{{ step.name }}</span>
                            </a>
                            <a v-else :href="step.href" class="group">
                                <div class="flex items-start">
                                <div class="relative flex h-5 w-5 flex-shrink-0 items-center justify-center" aria-hidden="true">
                                    <div class="h-2 w-2 rounded-full bg-gray-300 group-hover:bg-gray-400" />
                                </div>
                                <p class="ml-3 text-sm font-medium text-gray-400 group-hover:text-orange-300">{{ step.name }}</p>
                                </div>
                            </a>
                            </li>
                        </ol>
                        </nav>
                    </div>
                </div>
                </div>
                </div>
            </div>
            <div class="col-span-3 mb-12">
                <div v-if="orders.length==0" id="isNotOrder">
                    <img class="my-4 opacity-50 mb-5 max-w-md block mx-auto" src="../assets/empty.svg" alt="">
                    <h2 class="text-lg text-gray-900 font-bold text-center">The Streets are empty :)</h2>
                    <p class="text-gray-500 text-center">You do not have any orders in progress.</p>
                </div>
                <div v-else id="isOrder">
                    <div class="bg-white rounded-md overflow-hidden">
                        <div class="relative bg-gray-200 h-96 p-4">
                            <p class="text-center mt-4">Map goes here!</p>
                            <p class="text-center mt-4 text-gray-500">Map should have the route of the order in progress..</p>
                            <div class="absolute bottom-0 left-0 right-0 mb-6 mx-12 p-3 bg-white rounded-lg shadow-lg">
                                <div class="flex justify-between">
                                    <div>
                                        <div class="flex">
                                            <MapPinIcon class="w-5 h-5 text-blue-500"></MapPinIcon>
                                            <div>
                                                <h5 class="text-sm">Current location</h5>
                                                <p class="text-gray-400 text-xs">Kampala, Uganda</p>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div>
                                        <div class="flex">
                                            <CogIcon class="w-5 h-5 text-blue-500"></CogIcon>
                                            <div>
                                                <h5 class="text-sm">Speed</h5>
                                                <p class="text-gray-400 text-xs">34.5k/hr</p>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div>
                                        <div class="flex">
                                            <ArrowUturnUpIcon class="w-5 h-5 text-blue-500"></ArrowUturnUpIcon>
                                            <div>
                                                <h5 class="text-sm">Km Left</h5>
                                                <p class="text-gray-400 text-xs">34.5km</p>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div>
                                        <div class="flex">
                                            <StopCircleIcon class="w-5 h-5 text-blue-500"></StopCircleIcon>
                                            <div>
                                                <h5 class="text-sm">Last Stop</h5>
                                                <p class="text-gray-400 text-xs">1hr ago</p>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                <a v-for="(tab, index) in tabs" :key="tab.name" :href="tab.href" v-on:click="selectedTab = index" :class="[selectedTab == index ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700', 'whitespace-nowrap border-b-2 px-1 pb-4 text-sm font-medium']" :aria-current="tab.current ? 'page' : undefined">{{ tab.name }}</a>
                                </nav>
                            </div>
                            </div>
                        </div>

                        <!--ORDER DETAILS TAB-->
                        <div v-if="selectedTab == 0" class="flex p-6">
                            <img class="my-4 mb-5 w-[300px]" src="../assets/order-details.svg" alt="">
                            <div class="ml-6 flex-auto">
                                <div class="flex justify-between mb-4">
                                    <h4 class="text-sm">Order ID: #876755</h4>
                                </div>
                            <hr />
                            <div class="flex mt-6 justify-between">
                                <div>
                                    <h3 class="text-xs text-gray-400">Delivering From</h3>
                                    <p class="text-sm">George William Ltd</p>
                                </div>
                                <div>
                                    <h3 class="text-xs text-gray-400">Delivering To</h3>
                                    <p class="text-sm">Toyota Ug Ltd</p>
                                </div>
                            </div>
                            <div class="mt-6">
                                <div>
                                    <h3 class="text-xs text-gray-400">Delivery Note</h3>
                                    <p class="text-sm">The notes are here in detail</p>
                                </div>
                            </div>
                            </div>
                        </div>

                        <!--VEHICLE TAB-->
                        <div v-if="selectedTab == 1" class="flex p-6">
                            <img class="my-4 mb-5 w-[300px]" src="../assets/delivery-truck.svg" alt="">
                            <div class="ml-6 flex-auto">
                                <div class="flex justify-between mb-4">
                                    <h4 class="text-sm">Toyota</h4>
                                    <div class="text-sm flex"><span>4.5</span> <StarIcon class="text-yellow-400 h-4 w-4 ml-1"></StarIcon></div>
                                </div>
                            <hr />
                            <div class="flex mt-6 justify-between">
                                <div>
                                    <h3 class="text-xs text-gray-400">MODEL</h3>
                                    <p class="text-sm">Cargo Track HD320</p>
                                </div>
                                <div>
                                    <h3 class="text-xs text-gray-400">MAKE</h3>
                                    <p class="text-sm">Toyota</p>
                                </div>
                            </div>
                            <div class="flex mt-6 justify-between">
                                <div>
                                    <h3 class="text-xs text-gray-400">WEIGHT</h3>
                                    <p class="text-sm">5,450 Kg</p>
                                </div>
                                <div>
                                    <h3 class="text-xs text-gray-400">PLATE No.</h3>
                                    <p class="text-sm">UGB 699U</p>
                                </div>
                            </div>
                            </div>
                        </div>

                        <!--DRIVER INFO TAB-->
                        <div v-if="selectedTab == 2" class="flex p-6">
                            <img class="my-4 mb-5 w-[300px]" src="../assets/driver-info.svg" alt="">
                            <div class="ml-6 flex-auto">
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
            </div>
        </div>
    </div>
</template>

<script setup>
import Layout from '@/Layouts/MainLayout.vue'
 import Map from '@/Components/Map.vue';
 import { ref } from 'vue';
defineOptions({ layout: Layout })
import {
    XMarkIcon,
    BackwardIcon,
    ForwardIcon, 
    PauseIcon, 
    PlayIcon,
    PlusIcon,
    //revind icon
    ChevronRightIcon ,
    CheckIcon,
    MapPinIcon,
    CogIcon,
    ArrowUturnUpIcon,
    StopCircleIcon
  } from '@heroicons/vue/24/outline'
import { CheckCircleIcon, StarIcon } from '@heroicons/vue/20/solid'

import { useRouter, useRoute } from 'vue-router'

const router = useRouter()
const route = useRoute()

let orders = [0];

  const IncompleteSteps = [
  { name: 'Checking', href: '#', status: 'complete' },
  { name: 'In Transit', href: '#', status: 'current' },
  { name: 'Delivered', href: '#', status: 'upcoming' },
]
  const CompleteSteps = [
  { name: 'Checking', href: '#', status: 'complete' },
  { name: 'In Transit', href: '#', status: 'complete' },
  { name: 'Delivered', href: '#', status: 'complete' },
]

let selectedTab = ref(1)
const tabs = [
  { name: 'Order Details', href: '#', current: false },
  { name: 'Vehicle', href: '#', current: true },
  { name: 'Driver Information', href: '#', current: false },
//   { name: 'Customer Information', href: '#', current: false },
]

function goToNewPackage() {
    
}
</script>

<style scoped>

</style>
