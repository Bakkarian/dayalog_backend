<template>

    <Head title="Devices" />

    <div class="px-4 sm:px-6 lg:px-8 max-w-7xl">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Devices</h1>
                <p class="mt-2 text-sm text-gray-700">A list of all the devices registered in the system.</p>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">

                <Link href="/add-device" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"> Add Device</Link>
            </div>
        </div>
        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Device Name</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Unique ID</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Model</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Position Id</th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                    <span class="sr-only">Status</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                            <tr v-for="device in devices.data" :key="device.model">
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{ device.name }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ device.uniqueid }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ device.model }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-blue-500">
                                    <a href="#">{{ device.positionid }}</a>
                                </td>
                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                    <CheckBadgeIcon v-if="device.disabled !== 0" class="h-6 w-6 text-green-500" aria-hidden="true" />
                                    <ExclamationCircleIcon v-if="device.disabled === 0" class="h-6 w-6 text-red-500" aria-hidden="true" />
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <Pagination :links="devices.links" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3'
import {
    ExclamationCircleIcon,
    CheckBadgeIcon,
} from '@heroicons/vue/24/solid'
import Pagination from '@/Components/Pagination.vue';
import Layout from '@/Layouts/MainLayout.vue'
defineOptions({ layout: Layout })


const props = defineProps({
    devices: String
})
</script>
