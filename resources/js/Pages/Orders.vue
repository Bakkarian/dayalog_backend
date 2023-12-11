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
                        <OrderItems :orders="orders2" />
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
                                                                <button @click="openDetails = false;" type="button" class="rounded-full bg-white px-2 py-1 text-xs font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-green-300 hover:bg-gray-50">View Current Location</button>
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
            <SelectedOrder v-if="order" />
        </div>
    </div>


</template>

<script setup>
import { CalendarIcon, CheckIcon, MapPinIcon, ClockIcon, ArrowLeftIcon, InformationCircleIcon, CheckCircleIcon } from '@heroicons/vue/20/solid'
import {computed, ref} from "vue";
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'

import Layout from '@/Layouts/MainLayout.vue'
import OrderItems from '@/Containers/OrderItems.vue'
import SelectedOrder from '@/Containers/SelectedOrder.vue'
import { usePage } from '@inertiajs/vue3';


defineOptions({ layout: Layout })

const page = usePage();
const order = computed(() => page.props.selectedOrder)

const props = defineProps({orders2:{}})

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
