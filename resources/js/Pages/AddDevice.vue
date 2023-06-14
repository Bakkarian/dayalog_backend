<template>
    <div class="px-4 py-10 sm:px-6 lg:px-8 lg:py-6">
        <!-- Main area -->
        <h1 class="text-xl mb-8">Add Device</h1>
        <div class="grid lg:grid-cols-2 gap-8">
            <form class="bg-white p-8 rounded-md border">
                <div class="space-y-12 grid lg:grid-cols-1 gap-8">
                    <div class="border-b border-gray-900/10 pb-12">
                        <h2 class="text-base font-semibold leading-7 text-gray-900">Device Information</h2>
                        <p class="mt-1 text-sm leading-6 text-gray-600">All fields are required.</p>

                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-4">
                                <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">Device name</label>
                                <div class="mt-2">
                                    <input type="text" name="device-name" id="device-name" required placeholder="Unique device name" autocomplete="device-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                                </div>
                            </div>

                            <div class="sm:col-span-4">
                                <label for="last-name" class="block text-sm font-medium leading-6 text-gray-900">Device Unique Id</label>
                                <p class="text-xs text-gray-500">Usually the last 10 digits of the IMEI number but with a "0" at the beginning</p>
                                <div class="mt-2">
                                    <input type="number" value="0" name="unique-id" required id="unique-id" autocomplete="unique-id" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                                </div>
                            </div>

                            <div class="sm:col-span-4">
                                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Device Model</label>
                                <div class="mt-2">
                                    <input id="device-model" name="model" type="text" required placeholder="Example: tk103" autocomplete="model-number" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                                </div>
                            </div>


                            <div class="sm:col-span-4">
                                <div class="mt-2">
                                    <input id="model" name="model" type="text" value="09876" required disabled class="block w-full disabled:text-gray-300 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                                </div>
                            </div>
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

  </script>
