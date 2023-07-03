<template>
    <div class="px-4 py-10 sm:px-6 lg:px-8 lg:py-6">
        <!-- Main area -->
        <h1 class="text-xl mb-8">Add Device</h1>
        <div class="grid lg:grid-cols-2 gap-8">
            <form @submit.prevent="form.post(route('device.store'))" class="bg-white p-8 rounded-md border">
                <div class="space-y-12 grid lg:grid-cols-1 gap-8">
                    <div class="border-b border-gray-900/10 pb-12">
                        <h2 class="text-base font-semibold leading-7 text-gray-900">Device Information</h2>
                        <p class="mt-1 text-sm leading-6 text-gray-600">All fields are required.</p>

                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-4">
                                <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">Device name</label>
                                <div class="mt-2">
                                    <input
                                            type="text"
                                            name="name"
                                            id="name"
                                            required
                                            placeholder="Unique device name"
                                            autocomplete="device-name"
                                            class="block w-full rounded-md border-0 py-1.5
                                             text-gray-900 shadow-sm ring-1 ring-inset
                                             ring-gray-300 placeholder:text-gray-400 focus:ring-2
                                             focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                            v-model="form.name"

                                            />
                                    <div v-if="form.errors.name"  class="text-xs text-red-500">{{ form.errors.name }}</div>
                                </div>
                            </div>

                            <div class="sm:col-span-4">
                                <label for="last-name" class="block text-sm font-medium leading-6 text-gray-900">Device Unique Id</label>
                                <p class="text-xs text-gray-500">Usually the last 10 digits of the IMEI number but with a "0" at the beginning</p>
                                <div class="mt-2">
                                    <input
                                        type="number"
                                        name="unique-id"
                                        required id="unique-id"
                                        autocomplete="unique-id"
                                        class="block w-full rounded-md border-0 py-1.5
                                            text-gray-900 shadow-sm ring-1
                                            ring-inset ring-gray-300 placeholder:text-gray-400
                                            focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm
                                        sm:leading-6"
                                        v-model="form.uniqueid"
                                        />

                                    <div v-if="form.errors.uniqueid"  class="text-xs text-red-500">{{ form.errors.uniqueid }}</div>

                                </div>
                            </div>

                            <div class="sm:col-span-4">
                                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Device Model</label>
                                <div class="mt-2">
                                    <input
                                        id="device-model"
                                        name="model"
                                        type="text"
                                        required
                                        placeholder="Example: tk103"
                                        autocomplete="model-number"
                                        class="block w-full rounded-md border-0 py-1.5
                                            text-gray-900 shadow-sm ring-1 ring-inset
                                            ring-gray-300 placeholder:text-gray-400 focus:ring-2
                                            focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"

                                            v-model="form.model"

                                    />
                                    <div v-if="form.errors.model"  class="text-xs text-red-500">{{ form.errors.model }}</div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="rounded-md bg-green-50 p-4 mt-4 border border-green-300">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <CheckCircleIcon class="h-5 w-5 text-green-400" aria-hidden="true" />
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800">Successfully created</p>
                        </div>
                        <div class="ml-auto pl-3">
                            <div class="-mx-1.5 -my-1.5">
                                <button type="button" class="inline-flex rounded-md bg-green-50 p-1.5 text-green-500 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2 focus:ring-offset-green-50">
                                    <span class="sr-only">Dismiss</span>
                                    <XMarkIcon class="h-5 w-5" aria-hidden="true" />
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="rounded-md bg-red-50 border border-red-400 p-4 mt-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <XCircleIcon class="h-5 w-5 text-red-400" aria-hidden="true" />
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">There was an error with your submission</h3>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save Device</button>
                </div>
            </form>
            <div class="hidden lg:block">
                <img class="max-w-md mx-auto" src="../assets/add-device.svg">
            </div>
        </div>
    </div>
  </template>

  <script setup>
import { useForm } from '@inertiajs/vue3';
import { CheckCircleIcon, XMarkIcon } from '@heroicons/vue/20/solid'
import { XCircleIcon } from '@heroicons/vue/20/solid'

const form = useForm({
    'name':'',
    'uniqueid':'',
    'model':''
})

</script>
