<script setup>
    import { MapPinIcon } from '@heroicons/vue/20/solid'
import { Link } from '@inertiajs/vue3';
  const props = defineProps({
    orders:{}
  })

</script>
<template>
    <li v-for="order in orders.data" :key="order.id">
            <Link :href="route('orders', {order_id: order.id, page: orders.current_page})" >
                <div class="block hover:bg-gray-50 cursor-pointer">
                        <div class="px-4 py-4 sm:px-6">
                            <div class="flex items-center justify-between">
                                <p class="truncate text-sm font-medium text-gray-900">Order: {{ order.patasente_purchase_order_id }} <span class="text-gray-400">ID - {{order.id}}</span></p>
                                <div class="ml-2 flex flex-shrink-0">
                                    <p v-for="item in order.items?.slice(0, 3)" class="inline-flex rounded-full px-2 mx-1 text-xs font-semibold leading-5" :class="'text-green-800 bg-green-100'">
                                        {{item.item}}
                                    </p>
                                    <p v-if="order.items?.length > 3" class="inline-flex rounded-full px-2 mx-1 text-xs font-semibold leading-5" :class="'text-green-800 bg-green-100'">
                                        +<span>{{order.items.length-3}}</span>
                                    </p>
                                </div>
                            </div>
                            <div class="mt-2 sm:flex sm:justify-between">
                                <div class="sm:flex">
                                    <p class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">
                                        <MapPinIcon class="mr-1.5 h-4 w-4 flex-shrink-0 text-gray-400" aria-hidden="true" />
                                        Deliver To: <span class="font-bold"> {{ order.to.name }}</span>
                                    </p>
                                </div>
                                <div class="sm:flex">
                                    <p class="mt-2 flex items-center text-sm text-gray-500 sm:ml-2 sm:mt-0">
                                        Order Status: <span class="font-bold"> {{ order.status }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
            </Link>

            </li>
</template>
