<script setup>
    import Layout from '@/Layouts/MainLayout.vue'
    import Map from '@/Components/Map.vue';
    import { onMounted, ref } from 'vue';

    import {PlusIcon, } from '@heroicons/vue/24/outline'

    import { CheckCircleIcon, StarIcon } from '@heroicons/vue/20/solid'
    import { Link } from '@inertiajs/vue3';
    import SelectedClientOrder from '@/Containers/SelectedClientOrder.vue';

    defineOptions({ layout: Layout })

    const { orders, selectedOrder } = defineProps({
        orders: Array,
        selectedOrder: Object
    })

    const steps = [
        { name: 'Checking', value:'0', href: '#', status: 'pending' },
        { name: 'In Transit', value:'1' , href: '#', status: 'in_progress' },
        { name: 'Delivered', value:'2' , href: '#', status: 'completed' },
    ]

    const getStepValue = (status) =>{
        return steps.find(step => step.status == status).value;
    }



</script>

<template>
    <div class="px-4 sm:px-6 lg:px-8 max-w-7xl">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 items-start">
            <div>
                <div class="p-4 flex flex-col bg-white rounded-md">
                    <img class="mt-2" src="../assets/add_package.svg" alt="">
                    <h3 class="font-bold text-center mt-2">Add new package</h3>
                    <p class="text-center text-gray-400 text-sm">Fill out the form and create new package</p>

                    <Link  :href="route('create-order')" class=" inline-block block text-center rounded-full mt-2 mx-auto bg-green-600 p-1.5 text-white shadow-sm hover:bg-green-500">
                        <PlusIcon class="h-5 w-5" aria-hidden="true" />
                    </Link>
                </div>
                <div v-if="orders.length==0" id="isNotOrder">
                    <img class="my-4 opacity-50 mb-5 block max-h-[100px] mx-auto" src="../assets/empty-cart.svg" alt="">
                    <h2 class="text-lg text-gray-900 font-bold text-center">No orders yet</h2>
                    <p class="text-gray-500 text-center">You do not have any orders yet</p>
                </div>
                <div v-else>

                    <div v-for="order in orders" class="mt-4">
                        <Link :href="route('client.dashboard', { selectedOrder: order.id })"  preserve-scroll >
                            <div class="p-4 rounded-md" :class="[
                                                    {['bg-blue-600']: selectedOrder?.id == order?.id },
                                                    {'bg-white': selectedOrder?.id != order?.id }
                                                ]"
                                >
                                <h3 class="font-bold  mb-2"   :class="[
                                            {['text-white']: selectedOrder?.id == order?.id },
                                            {'text-black': selectedOrder?.id != order?.id }
                                        ]"  >Order ID: #{{ order.id }}</h3>
                                <div class="overflow-hidden rounded-full bg-white bg-opacity-40">
                                    <div class="h-2 rounded-full bg-green-300" style="width: 37.5%" />
                                </div>
                                <div class="mt-4">
                                    <nav class="flex" aria-label="Progress">
                                    <ol role="list" class="space-y-4">
                                        <li v-for="step in steps" :key="step.name">
                                        <a :href="step.href" class="group">
                                            <span class="flex items-start">
                                                <span class="relative flex h-5 w-5 flex-shrink-0 items-center justify-center">
                                                    <template v-if="selectedOrder?.id == order?.id">
                                                        <CheckCircleIcon  v-if="step.value < getStepValue(order.status)"  class="h-full w-full text-white group-hover:text-gray-300" aria-hidden="true" />
                                                        <template  v-else-if="step.value == getStepValue(order.status)" >
                                                            <span class="absolute h-4 w-4 rounded-full bg-white" />
                                                            <span class="relative block h-2 w-2 rounded-full bg-blue-600"   />
                                                        </template>
                                                        <div  v-else :href="step.href" class="h-2 w-2 rounded-full bg-gray-300 group-hover:bg-gray-400" />
                                                    </template>
                                                    <template v-else>
                                                            <CheckCircleIcon  v-if="step.value < getStepValue(order.status)" class="h-full w-full text-green-500 group-hover:text-green-700" aria-hidden="true" />
                                                            <template   v-else-if="step.value == getStepValue(order.status)" >
                                                                <span class="absolute h-4 w-4 rounded-full bg-indigo-200" />
                                                                <span class="relative block h-2 w-2 rounded-full bg-blue-600" />
                                                            </template>
                                                            <div  v-else :href="step.href"  class="h-2 w-2 rounded-full bg-gray-300 group-hover:bg-gray-400" />
                                                    </template>
                                                </span>
                                                <span v-if="step.value < getStepValue(order.status)"  class="ml-3 text-sm font-medium  " :class="[
                                                    {['bg-blue-600']: selectedOrder?.id == order?.id },
                                                    {'text-gray-400': selectedOrder?.id != order?.id }
                                                ]" >{{ step.name }}</span>
                                                <span v-else-if="step.value == getStepValue(order.status)" class="ml-3 text-sm font-medium  " :class="[
                                                    {['bg-blue-600']: selectedOrder?.id == order?.id },
                                                    {'text-gray-400': selectedOrder?.id != order?.id }
                                                ]" >{{ step.name }}</span>
                                                <span v-else  class="ml-3 text-sm font-medium  " :class="[
                                                    {['bg-blue-600']: selectedOrder?.id == order?.id },
                                                    {'text-gray-400': selectedOrder?.id != order?.id }
                                                ]" >{{ step.name }}</span>
                                            </span>
                                        </a>


                                        </li>


                                    </ol>
                                    </nav>
                                </div>
                            </div>
                        </Link>
                    </div>
                </div>
            </div>
            <div class="col-span-3 mb-12">
                <div v-if="!selectedOrder" id="isNotOrder">
                    <img class="my-4 opacity-50 mb-5 max-w-md block mx-auto" src="../assets/empty.svg" alt="">
                    <h2 class="text-lg text-gray-900 font-bold text-center">Select an Order to View :)</h2>
                    <p class="text-gray-500 text-center">Select an order from the list to view its details.</p>
                </div>
                <SelectedClientOrder v-else />
            </div>
        </div>
    </div>
</template>


<style scoped>

</style>
