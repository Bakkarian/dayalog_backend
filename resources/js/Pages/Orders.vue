<template>
    <div class="px-4 py-10 sm:px-6 lg:px-8 lg:py-6 max-w-7xl">
        <a href="/create-order" class="relative block w-full rounded-lg border-2 border-dashed border-gray-300 p-12 text-center hover:border-gray-400">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mx-auto h-12 w-12 text-gray-400">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
            </svg>

            <span class="mt-2 block text-sm font-semibold text-gray-900">Create new order</span>
        </a>
    </div>
    <div class="px-4 py-10 sm:px-6 lg:px-8 lg:py-6 max-w-7xl">
        <div class="mb-8">
            <h1 class="text-xl">View Orders</h1>
        </div>
        <div class="grid grid-cols-5 gap-4">
            <div class="col-span-2">
                <div class="bg-white sm:rounded-md">
                    <ul role="list" class="divide-y divide-gray-200">
                        <li v-for="order in orders" :key="order.id">
                            <div @click="order.detailOpened = !order.detailOpened; closeOtherDetails(order.id); selectedOrder = order" class="block hover:bg-gray-50 cursor-pointer">
                                <div class="px-4 py-4 sm:px-6">
                                    <div class="flex items-center justify-between">
                                        <p class="truncate text-sm font-medium text-gray-900">Order: {{ order.generated_instrument_no }} <span class="text-gray-400">ID - {{order.id}}</span></p>
                                        <div class="ml-2 flex flex-shrink-0">
                                            <p v-for="item in order.po_items.slice(0, 3)" class="inline-flex rounded-full px-2 mx-1 text-xs font-semibold leading-5" :class="'text-green-800 bg-green-100'">
                                                {{item.item}}
                                            </p>
                                            <p v-if="order.po_items.length > 3" class="inline-flex rounded-full px-2 mx-1 text-xs font-semibold leading-5" :class="'text-green-800 bg-green-100'">
                                                +<span>{{order.po_items.length-3}}</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="mt-2 sm:flex sm:justify-between">
                                        <div class="sm:flex">
                                            <p class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">
                                                <MapPinIcon class="mr-1.5 h-4 w-4 flex-shrink-0 text-gray-400" aria-hidden="true" />
                                                Deliver To: <span class="font-bold"> {{ order.from_name }}</span>
                                            </p>
                                        </div>
                                        <div class="sm:flex">
                                            <p class="mt-2 flex items-center text-sm text-gray-500 sm:ml-2 sm:mt-0">
                                                Delivery Status: <span class="font-bold"> {{ order.delivery_status }}</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- DRIVER DETAILS MODAL -->
                <TransitionRoot as="template" :show="openDetails">
                    <Dialog as="div" class="relative z-30" @close="openDetails = false">
                        <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
                            <div class="fixed inset-0 bg-gray-900 bg-opacity-40 transition-opacity" />
                        </TransitionChild>

                        <div class="fixed inset-0 z-30 overflow-y-auto">
                            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                                <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                                    <DialogPanel class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-md sm:p-6">
                                        <div>
                                            <div class="">
                                                <DialogTitle as="h3" class="text-base font-semibold leading-6 text-gray-900">
                                                    <div class="p-3 flex items-center border-b">
                                                        <div class="animate__animated" :class="'animate__fadeInRight'">
                                                            <button @click="openDetails = false" type="button" class="rounded-full bg-white border p-1 text-gray-500 shadow-sm hover:bg-gray-100 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                                                                <ArrowLeftIcon class="h-5 w-5" aria-hidden="true" />
                                                            </button>
                                                        </div>
                                                        <h5 class="text-md font-bold ml-4 animate__animated animate__delay-0.3s" :class="'animate__fadeInRight'">Delivery Status: <span class="font-bold"> {{ selectedOrder.delivery_status }}</span></h5>
                                                    </div>
                                                </DialogTitle>
                                                <div class="mt-2">
                                                    <div class="mt-4">
                                                        <h5 class="font-bold">Driver Details</h5>
                                                        <div class="flex items-center justify-between my-4">
                                                            <p class="truncate font-medium text-gray-900">
                                                                <button @click="openDetails = false; showRoute();" type="button" class="rounded-full bg-white px-2 py-1 text-xs font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-green-300 hover:bg-gray-50">View Current Location</button>
                                                            </p>
                                                            <div class="ml-2 flex flex-shrink-0">
                                                                <p class="inline-flex rounded-full px-2 text-xs font-semibold leading-5" :class="selectedOrder.onTrip?'text-green-800 bg-green-100':'text-red-800 bg-red-100'">{{
                                                                        true ? 'On Trip' : 'Not On Trip'
                                                                    }}</p>
                                                            </div>
                                                        </div>
                                                        <hr class="mb-4" />
                                                        <p class="text-gray-700 text-sm">Driver Name: <strong>Ivan Driver</strong></p>
                                                        <p class="text-gray-700 text-sm">Driver Phone: <strong>+256773099747</strong></p>
                                                        <p class="text-gray-700 text-sm">Plate Number: <strong>UBG 699U</strong></p>
                                                        <p class="text-gray-700 text-sm">Device ID: <strong>7865432313456</strong></p>
                                                        <p class="text-gray-700 text-sm">Device Protocal: <strong>tk103</strong></p>
                                                        <p class="text-gray-700 text-sm">Patasente ID: <a href="#" target="_blank" class="font-bold text-blue-400">M23765</a></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-5 sm:mt-6">
                                            <button type="button" class="rounded-md bg-[#002760] w-full px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500" @click="openDetails = false">Cloce</button>
                                        </div>
                                    </DialogPanel>
                                </TransitionChild>
                            </div>
                        </div>
                    </Dialog>
                </TransitionRoot>
            </div>
            <div class="col-span-3">
                <div :class="'min-h-[420px]'" class="overflow-hidden bg-white transition-all ease-in-out duration-300">
                    <div class="p-3 flex items-center border-b border-t">
                        <div class="animate__animated" :class="'animate__fadeInRight'">
                            <button type="button" class="rounded-full bg-white border p-1 text-gray-500 shadow-sm hover:bg-gray-100 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                                <InformationCircleIcon class="h-5 w-5" aria-hidden="true" />
                                <!-- USE THIS IF DELIVERY IS SUCCESSFUL -->
<!--                                <CheckCircleIcon class="h-5 w-5" aria-hidden="true" />-->
                            </button>
                        </div>
                        <h5 class="text-md font-bold ml-4 animate__animated animate__delay-0.3s" :class="'animate__fadeInRight'">Delivery Status: <span class="font-bold"> {{ selectedOrder.delivery_status }}</span></h5>
                    </div>
                    <ul role="list" class="space-y-6 p-3 overflow-hidden">
                        <li class="relative flex gap-x-4">
                            <div class="absolute left-0 top-0 flex w-6 justify-center -bottom-6">
                                <div class="w-px bg-gray-200"></div>
                            </div>

                            <div class="relative flex h-6 w-6 flex-none items-center justify-center bg-green-500 rounded-full">
                                <div class="h-1.5 w-1.5 rounded-full bg-green-100 ring-1 ring-white"></div>
                            </div>
                            <p class="flex-auto py-0.5 text-xs leading-5 text-gray-500"><span class="font-medium text-gray-900">{{selectedOrder.to_name}}</span> Pickup Point.</p>
                            <time datetime="2023-01-23T10:32" class="flex-none py-0.5 text-xs leading-5 text-gray-500">...</time>
                        </li>

                        <li class="relative flex gap-x-4">
                            <div class="absolute left-0 top-0 flex w-6 justify-center -bottom-6">
                                <div class="w-px bg-gray-200"></div>
                            </div>

                            <div class="relative flex h-6 w-6 flex-none items-center justify-center bg-white rounded-full">
                                <div class="h-1.5 w-1.5 rounded-full bg-gray-100 ring-1 ring-gray-300"></div>
                            </div>
                            <p class="flex-auto py-0.5 text-xs leading-5 text-gray-500"><span class="font-medium text-gray-900">{{ selectedOrder.to_email_address==null?selectedOrder.to_name+' Phone':selectedOrder.to_name+' Email' }}: </span>
                                <a :href="selectedOrder.to_email_address==null?'tel:'+selectedOrder.to_phone:'mailto:'+selectedOrder.to_email_address" class="text-blue-400 font-bold">{{ selectedOrder.to_email_address==null?selectedOrder.to_phone:selectedOrder.to_email_address }}</a></p>
                            <time datetime="2023-01-23T11:03" class="flex-none py-0.5 text-xs leading-5 text-gray-500">Receiver Email</time>
                        </li>

                        <li class="relative flex gap-x-4">
                            <div class="absolute left-0 top-0 flex w-6 justify-center -bottom-6">
                                <div class="w-px bg-gray-200"></div>
                            </div>
                            <div class="relative flex h-6 w-6 flex-none items-center justify-center bg-orange-200 rounded-full">
                                <div class="h-1.5 w-1.5 rounded-full bg-gray-100 ring-1 ring-gray-300"></div>
                            </div>
                            <div class="flex-auto rounded-md p-3 ring-1 ring-inset ring-gray-200 sm:grid sm:grid-cols-2 gap-4 animate__animated animate__fadeIn">
                                <h4 class="col-span-2">Order Items</h4>
                                <div v-for="item in selectedOrder.po_items" class="border border-orange-400 rounded-md p-2 bg-orange-400 bg-opacity-5">
                                    <p class="sm:flex sm:justify-between">
                                        <span>{{item.item}}</span>
                                        <span class="text-sm font-bold">Total: {{item.total}}</span>
                                    </p>
                                    <p class="text-sm">Qty: {{item.qty}}</p>
                                </div>
                            </div>
                        </li>

                        <li class="relative flex gap-x-4">
                            <div class="absolute left-0 top-0 flex w-6 justify-center h-6">
                                <div class="w-px bg-gray-200"></div>
                            </div>

                            <div class="relative flex h-6 w-6 flex-none items-center justify-center bg-white">
                                <MapPinIcon class="h-6 w-6 text-blue-600" />
                            </div>
                            <p class="flex-auto py-0.5 text-xs leading-5 text-gray-500">
                                Final Delivery Point =>
                                <span class="font-medium text-gray-900">{{selectedOrder.to_billing_address}} <a :href="'#'" class="text-blue-500">{{selectedOrder.latitude}} , {{selectedOrder.longitude}}</a> </span></p>
                            <time datetime="2023-01-24T09:20" class="flex-none py-0.5 text-xs leading-5 text-gray-500">...</time>
                        </li>
                    </ul>
                    <div class="p-6">
                        <button type="button" class="rounded bg-indigo-600 px-2 py-1 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 mr-2" @click="openAssignModal = true;">Assign For Delivery</button>
                        <button type="button" class="rounded bg-green-600 px-2 py-1 text-sm font-semibold text-white shadow-sm hover:bg-green-500" @click="openDetails = !openDetails">View Delivery Details</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

            <TransitionRoot as="template" :show="openAssignModal">
                <Dialog as="div" class="relative z-10" @close="openAssignModal = false">
                    <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
                    </TransitionChild>

                    <div class="fixed inset-0 z-10 overflow-y-auto">
                        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                            <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                                <DialogPanel class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-sm sm:p-6">
                                    <div>
                                        <div class="mt-3 sm:mt-5">
                                            <DialogTitle as="h3" class="text-base text-center font-semibold leading-6 text-gray-900">Assign Order For Delivery</DialogTitle>
                                            <hr class="my-2" />
                                            <div class="mt-2">
                                                <Combobox as="div" v-model="selectedPerson">
                                                    <ComboboxLabel class="block text-sm font-medium leading-6 text-gray-900">Assign to</ComboboxLabel>
                                                    <div class="relative mt-2">
                                                        <ComboboxInput class="w-full rounded-md border-0 bg-white py-1.5 pl-3 pr-10 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" @change="query = $event.target.value" :display-value="(person) => person?.name" />
                                                        <ComboboxButton class="absolute inset-y-0 right-0 flex items-center rounded-r-md px-2 focus:outline-none">
                                                            <ChevronUpDownIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                                                        </ComboboxButton>

                                                        <ComboboxOptions v-if="filteredVehicles.length > 0" class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                                                            <ComboboxOption v-for="vehicle in filteredVehicles" :key="vehicle.id" :value="vehicle" as="template" v-slot="{ active, selected }">
                                                                <li :class="['relative cursor-default select-none py-2 pl-8 pr-4', active ? 'bg-indigo-600 text-white' : 'text-gray-900']">
                                                                    <span :class="['block truncate', selected && 'font-semibold']">
                                                                      {{ vehicle.name }}
                                                                    </span><span v-if="selected" :class="['absolute inset-y-0 left-0 flex items-center pl-1.5', active ? 'text-white' : 'text-indigo-600']">
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
                                    <div class="mt-5 sm:mt-6 flex">
                                        <button type="button" class="mr-2 inline-flex w-full justify-center rounded-md bg-gray-100 px-3 py-2 text-sm font-semibold text-red-500 shadow-sm hover:bg-gray-300" @click="openAssignModal = false">Close</button>
                                        <button type="button" class="inline-flex w-full justify-center rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500" @click="">Assign</button>
                                    </div>
                                </DialogPanel>
                            </TransitionChild>
                        </div>
                    </div>
                </Dialog>
            </TransitionRoot>
</template>

<script setup>
import { CalendarIcon, CheckIcon, MapPinIcon, ClockIcon, ArrowLeftIcon, InformationCircleIcon, CheckCircleIcon } from '@heroicons/vue/20/solid'
import {computed, ref} from "vue";
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { ChevronUpDownIcon } from '@heroicons/vue/20/solid'
import {
    Combobox,
    ComboboxButton,
    ComboboxInput,
    ComboboxLabel,
    ComboboxOption,
    ComboboxOptions,
} from '@headlessui/vue'

import Layout from '@/Layouts/MainLayout.vue'
defineOptions({ layout: Layout })

const openAssignModal = ref(false)

const vehicles = [
    { id: 1, name: 'Isuzu - UBB 123X' },
    // More users...
]

const query = ref('')
const selectedPerson = ref(null)
const filteredVehicles = computed(() =>
    query.value === ''
        ? vehicles
        : vehicles.filter((vehicl) => {
            return vehicl.name.toLowerCase().includes(query.value.toLowerCase())
        })
)

let orders = ref([
    {
        id: 1,
        "generated_instrument_no": "PO00009787",
        "to_name": "Real Avant",
        "from_name": "Yiga Ivan",
        "delivery_status": "Pending",
        "to_email_address": "ivanatresyn@gmail.com",
        "to_billing_address": "Kampala Central Region Uganda",
        "latitude": "0.3830823",
        "longitude": "32.6012999",
        po_items: [
            {
                "id": 15133,
                "financial_instrument_id": 9787,
                "product_and_service_id": null,
                "qty": "4",
                "item": "Coffee",
                "price": "5000",
                "unit_measure": "2",
                "ordered": null,
                "delivered": null,
                "outstanding": null,
                "deductions": null,
                "company_id": null,
                "company_supplier_id": null,
                "is_mis_delivery_item": "no",
                "period": "morning",
                "total": "20000",
                "balance": null,
                "paid": "no",
                "deleted": 0,
                "created_at": "2022-07-12T20:01:59.000000Z",
                "updated_at": "2022-07-12T20:01:59.000000Z"
            },
            {
                "id": 15134,
                "financial_instrument_id": 9787,
                "product_and_service_id": null,
                "qty": "5",
                "item": "Beans",
                "price": "2500",
                "unit_measure": "2",
                "ordered": null,
                "delivered": null,
                "outstanding": null,
                "deductions": null,
                "company_id": null,
                "company_supplier_id": null,
                "is_mis_delivery_item": "no",
                "period": "morning",
                "total": "12500",
                "balance": null,
                "paid": "no",
                "deleted": 0,
                "created_at": "2022-07-12T20:01:59.000000Z",
                "updated_at": "2022-07-12T20:01:59.000000Z"
            },
            {
                "id": 15135,
                "financial_instrument_id": 9787,
                "product_and_service_id": null,
                "qty": "6",
                "item": "Maize",
                "price": "1200",
                "unit_measure": "2",
                "ordered": null,
                "delivered": null,
                "outstanding": null,
                "deductions": null,
                "company_id": null,
                "company_supplier_id": null,
                "is_mis_delivery_item": "no",
                "period": "morning",
                "total": "7200",
                "balance": null,
                "paid": "no",
                "deleted": 0,
                "created_at": "2022-07-12T20:01:59.000000Z",
                "updated_at": "2022-07-12T20:01:59.000000Z"
            }
        ]
    },
    {
        id: 2,
        "generated_instrument_no": "PO00009787",
        "to_name": "Binjii Store",
        "from_name": "Yiga Ivan",
        "delivery_status": "Delivered",
        "to_phone": "+256773099747",
        "to_billing_address": "Kampala Central Region Uganda",
        "latitude": "0.3830823",
        "longitude": "32.6012999",
        po_items: [
            {
                "id": 15133,
                "financial_instrument_id": 9787,
                "product_and_service_id": null,
                "qty": "4",
                "item": "Coffee",
                "price": "5000",
                "unit_measure": "2",
                "ordered": null,
                "delivered": null,
                "outstanding": null,
                "deductions": null,
                "company_id": null,
                "company_supplier_id": null,
                "is_mis_delivery_item": "no",
                "period": "morning",
                "total": "20000",
                "balance": null,
                "paid": "no",
                "deleted": 0,
                "created_at": "2022-07-12T20:01:59.000000Z",
                "updated_at": "2022-07-12T20:01:59.000000Z"
            },
            {
                "id": 15134,
                "financial_instrument_id": 9787,
                "product_and_service_id": null,
                "qty": "5",
                "item": "Beans",
                "price": "2500",
                "unit_measure": "2",
                "ordered": null,
                "delivered": null,
                "outstanding": null,
                "deductions": null,
                "company_id": null,
                "company_supplier_id": null,
                "is_mis_delivery_item": "no",
                "period": "morning",
                "total": "12500",
                "balance": null,
                "paid": "no",
                "deleted": 0,
                "created_at": "2022-07-12T20:01:59.000000Z",
                "updated_at": "2022-07-12T20:01:59.000000Z"
            },
            {
                "id": 15135,
                "financial_instrument_id": 9787,
                "product_and_service_id": null,
                "qty": "6",
                "item": "Maize",
                "price": "1200",
                "unit_measure": "2",
                "ordered": null,
                "delivered": null,
                "outstanding": null,
                "deductions": null,
                "company_id": null,
                "company_supplier_id": null,
                "is_mis_delivery_item": "no",
                "period": "morning",
                "total": "7200",
                "balance": null,
                "paid": "no",
                "deleted": 0,
                "created_at": "2022-07-12T20:01:59.000000Z",
                "updated_at": "2022-07-12T20:01:59.000000Z"
            },
            {
                "id": 15134,
                "financial_instrument_id": 9787,
                "product_and_service_id": null,
                "qty": "5",
                "item": "Beans",
                "price": "2500",
                "unit_measure": "2",
                "ordered": null,
                "delivered": null,
                "outstanding": null,
                "deductions": null,
                "company_id": null,
                "company_supplier_id": null,
                "is_mis_delivery_item": "no",
                "period": "morning",
                "total": "12500",
                "balance": null,
                "paid": "no",
                "deleted": 0,
                "created_at": "2022-07-12T20:01:59.000000Z",
                "updated_at": "2022-07-12T20:01:59.000000Z"
            },
            {
                "id": 15135,
                "financial_instrument_id": 9787,
                "product_and_service_id": null,
                "qty": "6",
                "item": "Maize",
                "price": "1200",
                "unit_measure": "2",
                "ordered": null,
                "delivered": null,
                "outstanding": null,
                "deductions": null,
                "company_id": null,
                "company_supplier_id": null,
                "is_mis_delivery_item": "no",
                "period": "morning",
                "total": "7200",
                "balance": null,
                "paid": "no",
                "deleted": 0,
                "created_at": "2022-07-12T20:01:59.000000Z",
                "updated_at": "2022-07-12T20:01:59.000000Z"
            }
        ]
    },
])
let selectedOrder = ref({})
selectedOrder.value = orders.value[0]
function closeOtherDetails(id){
    for (let i = 0; i < orders.value.length; i++){
        let item = orders.value[i];
        if (item.id !== id){
            item.detailOpened = false;
        }
    }
}
const openDetails = ref(false)
</script>

<style scoped>

</style>
