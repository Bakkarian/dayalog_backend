<template>
    <div class="px-4 py-10 sm:px-6 lg:px-8 lg:py-6 max-w-7xl">
        <!-- Main area -->
        <div class="mb-8">
            <h1 class="text-xl">Add Vehicle</h1>
        </div>
        <div class="">
            <div class="bg-white p-8 rounded-md border">
                <p class="text-xs mt-0">Field Marked with "<strong>*</strong>" are required</p>
                <div class="grid lg:grid-cols-2 gap-8">
                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-6">
                        <div class="sm:col-span-5">
                            <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">Number Plate / Plate Number *</label>
                            <div class="mt-2">
                                <input type="text" required placeholder="Plate number of the vehicle" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                            </div>
                        </div>
                        <div class="sm:col-span-5">
                            <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">Vin Number *</label>
                            <div class="mt-2">
                                <input type="text" placeholder="VIN" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                            </div>
                        </div>
                        <div class="sm:col-span-5">
                            <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">Make *</label>
                            <div class="mt-2">
                                <input type="text" required placeholder="Eg: Mercedes" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                            </div>
                        </div>
                        <div class="sm:col-span-5">
                            <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">Model *</label>
                            <div class="mt-2">
                                <input type="text" required placeholder="Eg: Actros 2330" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                            </div>
                        </div>
                        <div class="sm:col-span-5">
                            <div>
                                <label for="location" class="block text-sm font-medium leading-6 text-gray-900">Availability</label>
                                <select id="location" name="location" required class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    <option>Yes</option>
                                    <option selected="">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="sm:col-span-5">
                            <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">Drivers Licence Number *</label>
                            <div class="mt-2">
                                <input type="text" name="licence-number" id="phone" required placeholder="Drivers Licence Number" autocomplete="licence-number" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                            </div>
                        </div>
                    </div>
                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-6">
                        <div class="sm:col-span-5">
                            <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">Capacity Weight (Kgs) *</label>
                            <div class="mt-2">
                                <input type="text" required placeholder="Weight Capacity of vehicle" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                            </div>
                        </div>
                        <div class="sm:col-span-5">
                            <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">Capacity Volume </label>
                            <div class="mt-2">
                                <input type="text" placeholder="Weight Capacity of vehicle" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                            </div>
                        </div>
                        <div class="sm:col-span-5">
                            <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">Insurance Policy Number *</label>
                            <div class="mt-2">
                                <input type="text" placeholder="Insurance" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                            </div>
                        </div>
                        <div class="sm:col-span-5">
                            <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">Insurance Coverage</label>
                            <div class="mt-2">
                                <input type="text" placeholder="Coverage" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                            </div>
                        </div>
                        <div class="sm:col-span-5">
                            <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">Insurance Expiration</label>
                            <div class="mt-2">
                                <input type="date" placeholder="" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                            </div>
                        </div>
                        <div class="sm:col-span-5 border rounded-md p-6 bg-blue-300 bg-opacity-5">
                            <Combobox as="div" v-model="selectedPerson">
                                <ComboboxLabel class="block text-sm font-medium leading-6 text-gray-900">Attach a device</ComboboxLabel>
                                <div class="relative mt-2">
                                    <ComboboxInput class="w-full rounded-md border-0 bg-white py-1.5 pl-3 pr-12 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" @change="query = $event.target.value" :display-value="(device) => device?.name" />
                                    <ComboboxButton class="absolute inset-y-0 right-0 flex items-center rounded-r-md px-2 focus:outline-none">
                                        <ChevronUpDownIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                                    </ComboboxButton>

                                    <ComboboxOptions v-if="filteredPeople.length > 0" class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                                        <ComboboxOption v-for="device in filteredPeople" :key="device.id" :value="device" as="template" v-slot="{ active, selected }">
                                            <li :class="['relative cursor-default select-none py-2 pl-3 pr-9', active ? 'bg-indigo-600 text-white' : 'text-gray-900']">
                                                <div class="flex">
                                              <span :class="['truncate', selected && 'font-semibold']">
                                                {{ device.name }}
                                              </span>
                                                    <span :class="['ml-2 truncate text-gray-500', active ? 'text-indigo-200' : 'text-gray-500']">
                                                {{ device.id }}
                                              </span>
                                                </div>

                                                <span v-if="selected" :class="['absolute inset-y-0 right-0 flex items-center pr-4', active ? 'text-white' : 'text-indigo-600']">
                                              <CheckIcon class="h-5 w-5" aria-hidden="true" />
                                            </span>
                                            </li>
                                        </ComboboxOption>
                                    </ComboboxOptions>
                                </div>
                            </Combobox>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="rounded-md mt-12 bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add Vehicle</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
    import { computed, ref } from 'vue'
    import { CheckIcon, ChevronUpDownIcon } from '@heroicons/vue/20/solid'
    import {
        Combobox,
        ComboboxButton,
        ComboboxInput,
        ComboboxLabel,
        ComboboxOption,
        ComboboxOptions,
    } from '@headlessui/vue'

    const devices = [
        { name: 'Clear Me & Select Device', id: '' },
        { name: 'Ivan Tracker', id: '038020188471' },
        { name: 'Binjii Truck 1', id: '9172995223' },
    ]

    const query = ref('')
    const selectedPerson = ref(devices[0])
    const filteredPeople = computed(() =>
        query.value === ''
            ? devices
            : devices.filter((person) => {
                return person.name.toLowerCase().includes(query.value.toLowerCase())
            })
    )
</script>
