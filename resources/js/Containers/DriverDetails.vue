<template>
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
                      <div class="animate__animated" :class="selectedDriver.detailOpened?'animate__fadeInRight':'animate__fadeOutUp'">
                        <button @click="openDetails = false" type="button" class="rounded-full bg-white border p-1 text-gray-500 shadow-sm hover:bg-gray-100 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                          <ArrowLeftIcon class="h-5 w-5" aria-hidden="true" />
                        </button>
                      </div>
                      <h5 class="text-md font-bold ml-4 animate__animated animate__delay-0.3s" :class="selectedDriver.detailOpened?'animate__fadeInRight':'animate__fadeOutUp'">{{selectedDriver.name}}</h5>
                    </div>
                  </DialogTitle>
                  <div class="mt-2">
                    <ul role="list" class="space-y-6 p-3 overflow-hidden">
                      <li class="relative flex gap-x-4">
                        <div class="absolute left-0 top-0 flex w-6 justify-center -bottom-6">
                          <div class="w-px bg-gray-200"></div>
                        </div>

                        <div class="relative flex h-6 w-6 flex-none items-center justify-center bg-green-500 rounded-full">
                          <div class="h-1.5 w-1.5 rounded-full bg-green-100 ring-1 ring-white"></div>
                        </div>
                        <p class="flex-auto py-0.5 text-xs leading-5 text-gray-500 text-align-l text-left"><span class="font-medium text-gray-900">{{selectedDriver.from}}</span> Pickup Point.</p>
                        <time datetime="2023-01-23T10:32" class="flex-none py-0.5 text-xs leading-5 text-gray-500">{{selectedDriver.setOffTime}}</time>
                      </li>

                      <li class="relative flex gap-x-4">
                        <div class="absolute left-0 top-0 flex w-6 justify-center -bottom-6">
                          <div class="w-px bg-gray-200"></div>
                        </div>

                        <div class="relative flex h-6 w-6 flex-none items-center justify-center bg-white rounded-full">
                          <div class="h-1.5 w-1.5 rounded-full bg-gray-100 ring-1 ring-gray-300"></div>
                        </div>
                        <p class="flex-auto py-0.5 text-xs leading-5 text-gray-500 text-left"><span class="font-medium text-gray-900">Stop: 1</span> Mbarara town -
                          <a href="#" class="text-blue-400">0.002,13.87763</a></p>
                        <time datetime="2023-01-23T11:03" class="flex-none py-0.5 text-xs leading-5 text-gray-500">11:14am</time>
                      </li>

                      <li class="relative flex gap-x-4">
                        <div class="absolute left-0 top-0 flex w-6 justify-center -bottom-6">
                          <div class="w-px bg-gray-200"></div>
                        </div>

                        <img src="https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" class="relative mt-3 h-6 w-6 flex-none rounded-full bg-gray-50">
                        <div class="flex-auto rounded-md p-3 ring-1 ring-inset ring-gray-200 text-left">
                          <div class="flex justify-between gap-x-4">
                            <div class="py-0.5 text-xs leading-5 text-gray-500"><span class="font-medium text-gray-900">Ivan Driver</span> Current Location</div>
                            <time datetime="2023-01-23T15:56" class="flex-none py-0.5 text-xs leading-5 text-gray-500">now</time>
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
                        <p class="flex-auto py-0.5 text-xs leading-5 text-gray-500 text-left"><span class="font-medium text-gray-900">Kampala, Nansana</span> Final Delivery Point.</p>
                        <time datetime="2023-01-24T09:20" class="flex-none py-0.5 text-xs leading-5 text-gray-500">...</time>
                      </li>
                    </ul>
                    <div class="mt-4">
                      <h5 class="font-bold">Driver Details</h5>
                      <div class="flex items-center justify-between my-4">
                        <p class="truncate font-medium text-gray-900">
                          <button @click="openDetails = false;" type="button" class="rounded-full bg-white px-2 py-1 text-xs font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-green-300 hover:bg-gray-50">View Current Location</button>
                        </p>
                        <div class="ml-2 flex flex-shrink-0">
                          <p class="inline-flex rounded-full px-2 text-xs font-semibold leading-5" :class="selectedDriver.onTrip?'text-green-800 bg-green-100':'text-red-800 bg-red-100'">{{ selectedDriver.onTrip?'On Trip':'Not On Trip' }}</p>
                        </div>
                      </div>
                      <hr class="mb-4" />
                      <p class="text-gray-700 text-sm">Driver Name: <strong>{{ selectedDriver.name }}</strong></p>
                      <p class="text-gray-700 text-sm">Plate Number: <strong>UBG 699U</strong></p>
                      <p class="text-gray-700 text-sm">Device ID: <strong>7865432313456</strong></p>
                      <p class="text-gray-700 text-sm">Device Protocal: <strong>tk103</strong></p>
                      <p class="text-gray-700 text-sm">Patasente ID: <a href="#" target="_blank" class="font-bold text-blue-400">M23765</a></p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="mt-5 sm:mt-6">
                <button type="button" class="inline-flex w-full justify-center rounded-md bg-[#002760] px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" @click="openDetails = false">Go back to dashboard</button>
              </div>
            </DialogPanel>
          </TransitionChild>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
</template>


<script setup>
import { MapPinIcon, ClockIcon, ArrowLeftIcon } from '@heroicons/vue/20/solid'

import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'

</script>
