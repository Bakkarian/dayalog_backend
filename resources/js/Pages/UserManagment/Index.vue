<script setup>
import { Head, Link } from '@inertiajs/vue3'
import Layout from '@/Layouts/MainLayout.vue'
import {
    ExclamationCircleIcon,
    CheckBadgeIcon,
} from '@heroicons/vue/24/solid'
import Pagination from '@/Components/Pagination.vue';
defineOptions({ layout: Layout })

const props = defineProps({
    users: Object
})

</script>

<template>
    <Head title="Users" />



    <div class="px-4 sm:px-6 lg:px-8 max-w-7xl">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Add Driver</h1>
                <p class="mt-2 text-sm text-gray-700">A list of all the users registered in the system.</p>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">

                <Link href="/create-driver" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"> Add User</Link>
            </div>
        </div>
        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Name</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Email</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Phone Number</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Patasente Id</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Actions</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                            <tr v-for="device in users.data" :key="device.model">
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{ device.name }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ device.email }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ device.phone_number }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-blue-500">
                                    <a href="#">{{ device.patasente_id }}</a>
                                </td>

                                <td class="whitespace-nowrap px-3 py-4 text-sm text-blue-500">
                                    <Link class="mr-2 text-blue-500 hover:text-blue-700 " :href="route('users.edit', device.id)" >Edit</Link>
                                </td>

                            </tr>
                            </tbody>
                        </table>
                        <Pagination :links="users.links" />
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>
