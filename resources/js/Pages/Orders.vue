<template>
    <div class="px-4 py-4 sm:px-6 lg:px-8 lg:py-6 max-w-7xl">
        <a href="/create-order" class="relative block max-w-[240px] rounded-lg border-2 border-dashed border-gray-300 p-4 text-center hover:border-gray-400">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mx-auto h-12 w-12 text-gray-400">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
            </svg>

            <span class="mt-2 block text-sm font-semibold text-gray-900">Create new order</span>
        </a>
    </div>
    <div class="px-4 py-10 sm:px-6 lg:px-8 lg:py-6 max-w-7xl">
        <div class="mb-4">
            <h1 class="text-xl">View Orders</h1>
        </div>
        <div class="grid grid-cols-5 gap-4">
            <div class="col-span-2 overflow-y-scroll">
                <div class="bg-white sm:rounded-md">
                    <ul role="list" class="divide-y divide-gray-200">
                        <OrderItems :orders="orders2" />
                    </ul>
                </div>

            </div>
            <SelectedOrder v-if="order" />
        </div>
    </div>


</template>

<script setup>
import {computed} from "vue";

import Layout from '@/Layouts/MainLayout.vue'
import OrderItems from '@/Containers/OrderItems.vue'
import SelectedOrder from '@/Containers/SelectedOrder.vue'
import { usePage } from '@inertiajs/vue3';


defineOptions({ layout: Layout })

const page = usePage();
const order = computed(() => page.props.selectedOrder)

const props = defineProps({orders2:{}})


</script>

<style scoped>

</style>
