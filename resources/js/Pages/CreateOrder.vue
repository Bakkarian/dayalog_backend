<template>

    <Head title="Add Order" />

    <div class="px-4 py-10 sm:px-6 lg:px-8 lg:py-6 max-w-7xl">
        <!-- Main area -->
        <div class="mb-8">
            <h1 class="text-xl">Create Order</h1>
        </div>
        <div class="grid lg:grid-cols-2 gap-8">
            <div class="bg-white p-8 rounded-md border">
                <form>
                    <p class="text-xs mt-0">Field Marked with "<strong>*</strong>" are required</p>
                    <div class="mt-10 mb-4 grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-6">

                        <div class="sm:col-span-5 sm:flex items-end">
                            <Combobox class="flex-auto mr-1" as="div" v-model="selectedPerson">
                                <ComboboxLabel class="block text-sm font-medium leading-6 text-gray-900">From (Search and select user)</ComboboxLabel>
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
                            <button @click="openCreateAcc = !openCreateAcc" type="button" class="rounded-md ml-1 bg-indigo-600 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Create User</button>
                        </div>
                        <div class="sm:col-span-5">
                            <InputLabel value="Deliver To *" />
                            <div class="mt-2">
                                <TextInput type="text"   placeholder="person/company to be delivered to"  />
                                <InputError class="mt-2" :message="''" />
                            </div>
                        </div>
                        <div class="sm:col-span-5">
                            <InputLabel value="Delivery Address *" />
                            <div class="mt-2">
                                <TextInput type="text"   placeholder="Start typing and select"  />
                                <InputError class="mt-2" :message="''" />
                            </div>
                        </div>
                    </div>
                    <hr />
                    <p class="mt-2">Order Items</p>
                    <div class="grid grid-cols-2 gap-4 mt-4">
                        <div>
                            <TextInput class="my-2" type="text"   placeholder="Item Name"  />
                            <TextInput class="my-2" type="text"   placeholder="Quantity"  />
                            <TextInput class="my-2" type="text"   placeholder="Item Price per quantity"  />
                            <select id="location" name="location" class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 sm:text-sm sm:leading-6">
                                <option selected>Select Quantity Measure</option>
                                <option>Kilograms</option>
                                <option>Liters</option>
                            </select>
                            <button @click="openConnectModal = true" type="button" class="mt-2 inline-flex items-center rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500">
                                <PlusIcon class="-ml-0.5 mr-1.5 h-5 w-5" aria-hidden="true" />
                                Add Item
                            </button>
                        </div>
                        <div class="border-l border-dashed min-h-[420px]">
                            <div v-for="item in 3" class="ml-4 mb-4 border border-orange-400 rounded-md p-2 bg-orange-400 bg-opacity-5">
                                <p class="sm:flex sm:justify-between">
                                    <span>Milk</span>
                                    <XMarkIcon @click="null" class="-ml-0.5 mr-1.5 h-5 w-5 text-red-400 cursor-pointer" aria-hidden="true" />
                                </p>
                                <p class="sm:flex sm:justify-between">
                                    <span class="text-sm">Qty: 1415 L</span>
                                    <span class="text-sm font-bold">Total: 7,230,000</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <FlashMessage />
                    <button type="submit"
                            class="rounded-md mt-12 bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Create Order
                    </button>
                </form>
            </div>
            <div class="">
<!--                <div class="text-center border border-dashed border-gray-400 rounded-md pb-4">
                    <img class="h-16 mx-auto" src="https://patasente.com/wp-content/uploads/2020/07/Logo-3.png" />
                    <h3 class="text-sm font-semibold text-gray-900">Account Not Connected</h3>
                    <p class="mt-1 text-sm text-gray-500">Get started by linking your Patasente account.</p>
                    <div class="mt-6">
                        <button @click="openConnectModal = true" type="button" class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            <LinkIcon class="-ml-0.5 mr-1.5 h-5 w-5" aria-hidden="true" />
                            Connect Account
                        </button>
                    </div>
                </div>-->

                <div v-if="openCreateAcc" class="bg-white p-4 rounded-md border max-w-[400px] animate__animated animate__fadeInRight">
                    <div>
                        <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Full Name</label>
                        <div class="mt-2">
                            <input type="text" name="full-name" id="name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Full Name" />
                        </div>
                    </div>
                    <div class="mt-2">
                        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email</label>
                        <div class="mt-2">
                            <input type="email" name="email" id="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="you@example.com" />
                        </div>
                    </div>
                    <button type="button" class="rounded-md mt-4 bg-green-600 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-green-500">Add User</button>
                </div>
            </div>
        </div>
    </div>

    <TransitionRoot as="template" :show="openConnectModal">
        <Dialog as="div" class="relative z-10" @close="openConnectModal = false">
            <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
            </TransitionChild>

            <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                        <DialogPanel class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-sm sm:p-6">
                            <div>
                                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-green-100">
                                    <LinkIcon class="h-6 w-6 text-green-600" aria-hidden="true" />
                                </div>
                                <div class="mt-3 text-center sm:mt-5">
                                    <DialogTitle as="h3" class="text-base font-semibold leading-6 text-gray-900">Connect Account</DialogTitle>
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-500">By connecting your Patasente account, you accept that your information will be shared with Dayalog</p>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-5 sm:mt-6">
                                <div>
                                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Phone/Email/Merchant Code</label>
                                    <div class="mt-2">
                                        <input type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                                    <div class="mt-2">
                                        <input type="password" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                                    </div>
                                </div>
                                <button type="button" class="mt-4 inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Connect</button>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import FlashMessage from '@/Containers/FlashMessage.vue';
import { Head, useForm } from '@inertiajs/vue3';
import Layout from '@/Layouts/MainLayout.vue'
import { LinkIcon, PlusIcon, XMarkIcon } from '@heroicons/vue/20/solid'
import {computed, ref} from "vue";
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { CheckIcon } from '@heroicons/vue/24/outline'
import { ChevronUpDownIcon } from '@heroicons/vue/20/solid'
import {
    Combobox,
    ComboboxButton,
    ComboboxInput,
    ComboboxLabel,
    ComboboxOption,
    ComboboxOptions,
} from '@headlessui/vue'

const accounts = [
    { id: 1, name: 'Ivan Yiga' },
    { id: 2, name: 'Afasha Isakiye' },
]

const query = ref('')
const selectedPerson = ref(null)
const filteredPeople = computed(() =>
    query.value === ''
        ? accounts
        : accounts.filter((person) => {
            return person.name.toLowerCase().includes(query.value.toLowerCase())
        })
)
defineOptions({ layout: Layout })

let openConnectModal = ref(false);
let openCreateAcc = ref(false)

</script>
