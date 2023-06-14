<template>
    <div class="px-4 py-10 sm:px-6 lg:px-8 lg:py-6 max-w-7xl">
        <!-- Main area -->
        <div class="mb-8">
            <h1 class="text-xl">Create Driver</h1>
        </div>
        <div class="grid lg:grid-cols-2 gap-8">
            <div class="bg-white p-8 rounded-md border">
                <p class="text-xs mt-0">Field Marked with "<strong>*</strong>" are required</p>
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-6">
                    <div class="sm:col-span-5">
                        <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">Full Name *</label>
                        <div class="mt-2">
                            <input type="text" name="full-name" id="full-name" required placeholder="Driver's Full Name" autocomplete="full-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                        </div>
                    </div>
                    <div class="sm:col-span-5">
                        <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">Email Address (Optional)</label>
                        <div class="mt-2">
                            <input type="email" name="email" id="email" placeholder="Driver's Email" autocomplete="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                        </div>
                    </div>
                    <div class="sm:col-span-5">
                        <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">Patasente Merchant Code *</label>
                        <div class="mt-2">
                            <input type="text" name="merchant-code" id="merchant-code" required placeholder="Merchant Code" autocomplete="merchant-code" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                        </div>
                    </div>
                    <div class="sm:col-span-5">
                        <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">Phone Number *</label>
                        <div class="mt-2">
                            <input type="tel" name="phone number" id="phone" required placeholder="Driver's Phone Number" autocomplete="phone" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                        </div>
                    </div>
                    <div class="sm:col-span-5">
                        <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">Drivers Licence Number *</label>
                        <div class="mt-2">
                            <input type="text" name="licence-number" id="phone" required placeholder="Drivers Licence Number" autocomplete="licence-number" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                        </div>
                    </div>
                    <div class="sm:col-span-5">
                        <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">Password *</label>
                        <div class="mt-2">
                            <input type="text" name="password" id="password" placeholder="Merchant Code" autocomplete="password" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                        </div>
                    </div>
<!--                    <div class="sm:col-span-5">
                        <Combobox as="div" v-model="selectedPerson">
                    <ComboboxLabel class="block text-sm font-medium leading-6 text-gray-900">Search Account</ComboboxLabel>
                    <p class="text-xs mt-0">Search accounts and select the one you are looking for. These accounts are registered on Patasente Platform</p>
                    <div class="relative mt-2">
                        <ComboboxInput class="w-full rounded-md border-0 bg-white py-1.5 pl-3 pr-10 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" @change="query = $event.target.value" :display-value="(person) => person?.name" />
                        <ComboboxButton class="absolute inset-y-0 right-0 flex items-center rounded-r-md px-2 focus:outline-none">
                            <ChevronUpDownIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                        </ComboboxButton>

                        <ComboboxOptions v-if="filteredPeople.length > 0" class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                            <ComboboxOption v-for="person in filteredPeople" :key="person.id" :value="person" as="template" v-slot="{ active, selected }">
                                <li :class="['relative cursor-default select-none py-2 pl-3 pr-9', active ? 'bg-indigo-600 text-white' : 'text-gray-900']">
                                <span :class="['block truncate', selected && 'font-semibold']">
                                  {{ person.name }}
                                </span>

                                                        <span v-if="selected" :class="['absolute inset-y-0 right-0 flex items-center pr-4', active ? 'text-white' : 'text-indigo-600']">
                                  <CheckIcon class="h-5 w-5" aria-hidden="true" />
                                </span>
                                </li>
                            </ComboboxOption>
                        </ComboboxOptions>
                    </div>
                </Combobox>
                    </div>-->
                </div>
                <button type="submit" class="rounded-md mt-12 bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Create Driver</button>
            </div>
            <div class="hidden lg:block">
                <img class="max-w-md mx-auto" src="../assets/create-driver.svg">
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

    const people = [
        { id: 1, name: 'Leslie Alexander' },
        // More users...
    ]

    const query = ref('')
    const selectedPerson = ref(null)
    const filteredPeople = computed(() =>
        query.value === ''
            ? people
            : people.filter((person) => {
                return person.name.toLowerCase().includes(query.value.toLowerCase())
            })
    )
</script>
